<?php
class Purchaseorder extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . 'auth/index');
            exit;
        }
    }
    public function index($param = null)
    {
        $data['title'] = 'Purchase Order';
        $_SESSION['menu'] = 'purchasing';
        $_SESSION['sub'] = 'purchase_order';

        if ($param == null) {
            $data['purchase_orders'] = $this->model('PurchaseOrder_model')->getAllPurchaseOrders();
        } else {
            $data['purchase_orders'] = $this->model('PurchaseOrder_model')->getPurchaseOrderByStatus($param);
        }
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('purchaseorder/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        if (isset($_SESSION['user'])) {
            $_SESSION['auth'] = true;
        }

        $data['title'] = 'Create Purchase Order';
        $_SESSION['menu'] = 'purchasing';
        $_SESSION['sub'] = 'purchase_order';
        $data['next_po_number'] = $this->model('PurchaseOrder_model')->getNextPONumber();
        $data['suppliers'] = $this->model('Supplier_model')->getAllSuppliers();
        $data['branches'] = $this->model('Branch_model')->getAllBranches();

        $_SESSION['invoice_number'] = sprintf('PO-%03d', $data['next_po_number']);
        $_SESSION['cart'] = $_SESSION['cart'] ?? [];
        if (isset($_SESSION['supplier_id']) && empty($_SESSION['cart'])) {
            $_SESSION['products'] = $this->model('Product_model')->getAllProductBySupplierId($_SESSION['supplier_id']);
        }

        $_SESSION['invoice_amount'] = array_sum(array_column($_SESSION['cart'], 'total'));


        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('purchaseorder/create', $data);
        $this->view('templates/footer');
    }

    public function auth()
    {
        if (isset($_SESSION['user'])) {
            $_SESSION['auth'] = true;
        }

        $data['title'] = 'Auth Purchase Order';
        $_SESSION['menu'] = 'authorization';
        $_SESSION['sub'] = 'purchase_order_auth';

        // $data['suppliers'] = $this->model('Supplier_model')->getAllSuppliers();
        // $data['branches'] = $this->model('Branch_model')->getAllBranches();

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('purchaseorder/auth', $data);
        $this->view('templates/footer');
    }

    public function setSession()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                if ($data['table'] == 'supplier') {
                    $_SESSION['supplier_id'] = $data['id'];
                } else if ($data['table'] == 'branch') {
                    $_SESSION['branch_id'] = $data['id'];
                }
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }

    public function addToCart($productSku)
    {
        if (isset($_SESSION['products'])) {
            $product = $this->model('Product_model')->getProductBySku($productSku);
            if ($product) {
                $_SESSION['cart'][] = $product;
                $_SESSION['products'] = array_filter($_SESSION['products'], function ($item) use ($productSku) {
                    return $item['sku'] !== $productSku;
                });
            }
        }
        header('Location: ' . BASEURL . 'purchaseorder/create');
        exit;
    }

    public function removeFromCart($productSku)
    {
        if (isset($_SESSION['cart'])) {
            $product = $this->model('Product_model')->getProductBySku($productSku);
            if ($product) {
                $_SESSION['products'][] = $product;
                $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productSku) {
                    return $item['sku'] !== $productSku;
                });
            }
        }
        header('Location: ' . BASEURL . 'purchaseorder/create');
        exit;
    }

    public function addQtyToCart($productSku, $qty)
    {
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['sku'] === $productSku) {
                    $item['qty'] = $qty;
                    $item['total'] = $item['hpp'] * $qty;
                    break;
                }
            }
        }
        header('Location: ' . BASEURL . 'purchaseorder/create');
        exit;
    }

    public function cancel()
    {
        unset($_SESSION['cart']);
        unset($_SESSION['supplier_id']);
        unset($_SESSION['branch_id']);
        unset($_SESSION['products']);
        unset($_SESSION['invoice_amount']);
        unset($_SESSION['invoice_number']);
        Flasher::setFlashMixin('info', 'Purchase Order cancelled');
        header('Location: ' . BASEURL . 'purchaseorder');
        exit;
    }

    public function proses()
    {
        if (!isset($_SESSION['supplier_id']) || !isset($_SESSION['branch_id'])) {
            Flasher::setFlashMixin('error', 'Please select supplier and branch first');
            header('Location: ' . BASEURL . 'purchaseorder/create');
            exit;
        } else {
            $data = [
                'invoice_number' => $_SESSION['invoice_number'],
                'supplier_id' => $_SESSION['supplier_id'],
                'branch_id' => $_SESSION['branch_id'],
                'invoice_date' => date('Y-m-d H:i:s'),
                'invoice_amount' => $_SESSION['invoice_amount'],
                'invoice_status' => 'draft',
                'created_at' => date('Y-m-d H:i:s'),
                'create_user_id' => $_SESSION['user']['id']
            ];

            if ($this->model('PurchaseOrder_model')->createPurchaseOrder($data) > 0) {
                $purchaseOrderId = $this->model('PurchaseOrder_model')->getLastInsertId();
            } else {
                Flasher::setFlashMixin('error', 'Failed to create Purchase Order');
                header('Location: ' . BASEURL . 'purchaseorder/create');
                exit;
            }

            foreach ($_SESSION['cart'] as $item) {
                $itemData = [
                    'invoice_id' => $purchaseOrderId,
                    'product_sku' => $item['sku'],
                    'quantity' => $item['qty'],
                    'unit_price' => $item['hpp'],
                    'total_price' => $item['total'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'create_user_id' => $_SESSION['user']['id']
                ];
                if ($this->model('PurchaseOrderItem_model')->createPurchaseOrderItem($itemData) > 0) {
                    ActivityLogger::log($_SESSION['user']['id'], 'Add Purchase Order!', 'Purchase Order #' . htmlspecialchars(ucwords($_SESSION['invoice_number'])) . ' Submitted Successfully');
                    Flasher::setFlashMixin('success', 'Purchase Order created successfully!');

                    $message = "Purchase Order *#" . htmlspecialchars(ucwords($_SESSION['invoice_number'])) . "* \nhas been created successfully. Please check the system for details.";
                    $this->model('Message_model')->sendMessage($_SESSION['user']['phone'], $message);

                    unset($_SESSION['cart']);
                    unset($_SESSION['supplier_id']);
                    unset($_SESSION['branch_id']);
                    unset($_SESSION['products']);
                    unset($_SESSION['invoice_amount']);
                    unset($_SESSION['invoice_number']);
                    header('Location: ' . BASEURL . 'purchaseorder');
                } else {
                    Flasher::setFlashMixin('error', 'Failed to create Purchase Order Item');
                    header('Location: ' . BASEURL . 'purchaseorder/create');
                    exit;
                }
            }
        }
        header('Location: ' . BASEURL . 'purchaseorder');
    }
}

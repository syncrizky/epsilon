<?php
class Product extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . 'auth/index');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Products';
        $_SESSION['menu'] = 'stock';
        $_SESSION['sub'] = 'products';

        $data['products'] = $this->model('Product_model')->getAllProducts();
        $data['brands'] = $this->model('Brand_model')->getAllBrands();

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('product/index', $data);
        $this->view('templates/footer');
    }

    public function checkProductSku()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $productSku = $data['productSku'];

        $product = $this->model('Product_model')->checkProductSku($productSku);
        if ($product) {
            echo json_encode(['status' => 'exists']);
        } else {
            echo json_encode(['status' => 'available']);
        }
    }

    public function add()
    {
        if ($this->model('Product_model')->addProduct($_POST) > 0) {
            ActivityLogger::log($_SESSION['user']['id'], 'Add Product', 'Product with SKU ' . $_POST['inputProductSku'] . ' added successfully');
            Flasher::setFlashMixin('success', 'Product added successfully');
            header('Location: ' . BASEURL . 'product');
            exit;
        } else {
            Flasher::setFlashMixin('error', 'Product added failed');
            header('Location: ' . BASEURL . 'product');
            exit;
        }
    }
}

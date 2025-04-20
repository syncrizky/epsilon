<?php
class Supplier extends Controller
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
        $data['title'] = 'Suppliers';
        $_SESSION['menu'] = 'purchasing';
        $_SESSION['sub'] = 'suppliers';

        $data['suppliers'] = $this->model('Supplier_model')->getAllSuppliers();

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('purchasing/suppliers', $data);
        $this->view('templates/footer');
    }

    public function add_supplier()
    {
        $user_id = $_SESSION['user']['id'];
        $create_time = date('Y-m-d H:i:s');
        if ($this->model('Supplier_model')->addSupplier($_POST, $user_id, $create_time) > 0) {
            ActivityLogger::log($_SESSION['user']['id'], 'Add Supplier!', 'Supplier with name ' . htmlspecialchars(ucwords($_POST['name'])) . ' added successfully');
            Flasher::setFlashMixin('success', 'Supplier added successfully');
            header('Location: ' . BASEURL . 'purchasing/suppliers');
            exit;
        } else {
            Flasher::setFlashMixin('error', 'Failed to add supplier');
            header('Location: ' . BASEURL . 'purchasing/suppliers');
            exit;
        }
    }

    public function update_supplier()
    {
        if ($this->model('Supplier_model')->updateSupplier($_POST) > 0) {
            ActivityLogger::log($_SESSION['user']['id'], 'Update Supplier!', 'Supplier with name ' . htmlspecialchars(ucwords($_POST['name'])) . ' updated successfully');
            Flasher::setFlashMixin('success', 'Supplier updated successfully');
            header('Location: ' . BASEURL . 'purchasing/suppliers');
            exit;
        } else {
            Flasher::setFlashMixin('error', 'Failed to update supplier');
            header('Location: ' . BASEURL . 'purchasing/suppliers');
            exit;
        }
    }

    public function supplier_detail($id)
    {
        $data['title'] = 'Supplier Detail';
        $_SESSION['menu'] = 'purchasing';
        $_SESSION['sub'] = 'suppliers';

        $data['supplier'] = $this->model('Supplier_model')->getSupplierById($id);
        $data['products'] = $this->model('Stock_model')->getAllStockBranchesBySupplier($id);

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('supplier/supplier_detail', $data);
        $this->view('templates/footer');
    }
}

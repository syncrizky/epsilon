<?php
class Stock extends Controller
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
        $data['main'] = 'Stock';
        $data['title'] = 'Dashboard';
        $_SESSION['menu'] = 'stock';
        $_SESSION['sub'] = 'dashboard stock';

        $data['product_count'] = $this->model('Product_model')->getAllProductsCount();
        $data['products'] = $this->model('Product_model')->getAllProductOrderStock();
        $data['logs'] = $this->model('Log_model')->getAllLogs();

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('stock/index', $data);
        $this->view('templates/footer');
    }
}

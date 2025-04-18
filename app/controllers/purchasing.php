<?php
class Purchasing extends Controller
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
        if (isset($_SESSION['user'])) {
            $_SESSION['auth'] = true;
        }

        $data['title'] = 'Dashboard';
        $_SESSION['menu'] = 'purchasing';
        $_SESSION['sub'] = 'dashboard';

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('purchasing/index', $data);
        $this->view('templates/footer');
    }

    public function purchase_order()
    {
        $data['title'] = 'Purchase Order';
        $_SESSION['menu'] = 'purchasing';
        $_SESSION['sub'] = 'purchase_order';

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('purchasing/purchase_order', $data);
        $this->view('templates/footer');
    }
}

<?php
class Authorization extends Controller
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
        $data['title'] = 'Authorization';
        $_SESSION['menu'] = 'authorization';
        $_SESSION['sub'] = 'dashboard auth';

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('authorization/index', $data);
        $this->view('templates/footer');
    }

    public function purchase_order()
    {
        $data['title'] = 'Purchase Order Auth';
        $_SESSION['menu'] = 'authorization';
        $_SESSION['sub'] = 'purchase_order_auth';

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('authorization/index', $data);
        $this->view('templates/footer');
    }
}

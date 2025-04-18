<?php
class Account extends Controller
{

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            Flasher::setFlash('error', 'Access Denied', 'Please log in to access this page.', 'auth/index', 'Login');
            header('Location: ' . BASEURL . 'auth/index');
            exit;
        }
    }

    public function index()
    {
        $_SESSION['menu'] = 'home';
        $_SESSION['sub'] = 'dashboard';
        $data['title'] = 'Home';
        $data['user'] = $this->model('User_model')->getUserById($_SESSION['user']['id']);
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('account/index', $data);
        $this->view('templates/footer');
    }
}

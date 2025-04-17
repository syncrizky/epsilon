<?php
class Home extends Controller
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
        if (isset($_SESSION['user'])) {
            $_SESSION['auth'] = true;
        }
        $data['title'] = 'Home';
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}

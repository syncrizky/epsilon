<?php
class Logout extends Controller
{

    public function index()
    {
        session_destroy();
        unset($_SESSION['auth']);
        setcookie('remember_token', '', time() - 3600, "/");
        header('Location: ' . BASEURL . 'auth');
        exit;
    }
}

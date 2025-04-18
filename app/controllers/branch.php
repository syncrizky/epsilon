<?php
class Branch extends Controller
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
        $data['title'] = 'Branches';
        $_SESSION['menu'] = 'stock';
        $_SESSION['sub'] = 'branches';

        $data['branches'] = $this->model('Branch_model')->getAllBranches();
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('branch/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Branch Detail';
        $_SESSION['menu'] = 'stock';
        $_SESSION['sub'] = 'branches';

        $data['branch'] = $this->model('Branch_model')->getBranchByName($id);
        $data['stock_branches'] = $this->model('Stock_model')->getAllStockBranches($data['branch']['id']);
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('branch/detail', $data);
        $this->view('templates/footer');
    }
}

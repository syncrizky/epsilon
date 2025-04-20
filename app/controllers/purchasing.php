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
        $_SESSION['sub'] = 'dashboard purchasing';

        $data['purchase_order_draft_count'] = $this->model('PurchaseOrder_model')->getPurchaseOrderCountByStatus('draft');
        $data['purchase_order_approve_count'] = $this->model('PurchaseOrder_model')->getPurchaseOrderCountByStatus('approve');
        $data['purchase_order_incoming_count'] = $this->model('PurchaseOrder_model')->getPurchaseOrderCountByStatus('incoming');

        $params = ['Add Supplier', 'Update Supplier', 'Delete Supplier'];
        $data['logs'] = $this->model('ActivityLog_model')->getAllLogsWithParams($params);

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar', $data);
        $this->view('purchasing/index', $data);
        $this->view('templates/footer');
    }
}

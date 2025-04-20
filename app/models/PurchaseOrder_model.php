<?php
class PurchaseOrder_model
{
    private $table = 'purchase_invoices';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getLastInsertId()
    {
        $this->db->query("SELECT LAST_INSERT_ID() as id");
        return $this->db->single()['id'];
    }

    public function getAllPurchaseOrders()
    {
        $this->db->query("SELECT 
                            po.id as id,
                            po.invoice_number as invoice_number,
                            po.invoice_date as invoice_date,
                            s.name as supplier_name,
                            b.name as branch_name,
                            po.invoice_amount as invoice_amount,
                            po.invoice_status as invoice_status
                         FROM {$this->table} po
                            JOIN suppliers s ON s.id = po.supplier_id
                            JOIN branches b ON b.id = po.branch_id
                            ");
        return $this->db->resultSet();
    }
    public function getPurchaseOrderByStatus($status)
    {
        $this->db->query("SELECT 
                            po.id as id,
                            po.invoice_number as invoice_number,
                            po.invoice_date as invoice_date,
                            s.name as supplier_name,
                            b.name as branch_name,
                            po.invoice_amount as invoice_amount,
                            po.invoice_status as invoice_status
                         FROM {$this->table} po
                            JOIN suppliers s ON s.id = po.supplier_id
                            JOIN branches b ON b.id = po.branch_id WHERE invoice_status = :status");
        $this->db->bind('status', $status);
        return $this->db->resultSet();
    }

    public function getPurchaseOrderCountByStatus($status)
    {
        $this->db->query("SELECT COUNT(*) as count FROM {$this->table} WHERE invoice_status = :status");
        $this->db->bind('status', $status);
        return $this->db->single()['count'];
    }

    public function getNextPONumber()
    {
        $this->db->query("SELECT MAX(CAST(SUBSTRING(invoice_number, 4) AS UNSIGNED)) as max_po_number FROM {$this->table}");
        $result = $this->db->single();
        return $result['max_po_number'] + 1;
    }

    public function createPurchaseOrder($data)
    {
        $this->db->query("INSERT INTO {$this->table} (invoice_number, supplier_id, branch_id, invoice_date, invoice_amount, invoice_status, created_at, create_user_id) VALUES (:invoice_number, :supplier_id, :branch_id, :invoice_date, :invoice_amount, :invoice_status, :created_at, :create_user_id)");
        $this->db->bind('invoice_number', $data['invoice_number']);
        $this->db->bind('supplier_id', $data['supplier_id']);
        $this->db->bind('branch_id', $data['branch_id']);
        $this->db->bind('invoice_date', $data['invoice_date']);
        $this->db->bind('invoice_amount', $data['invoice_amount']);
        $this->db->bind('invoice_status', $data['invoice_status']);
        $this->db->bind('created_at', $data['created_at']);
        $this->db->bind('create_user_id', $data['create_user_id']);

        $this->db->execute();
        return $this->db->rowCount();
    }
}

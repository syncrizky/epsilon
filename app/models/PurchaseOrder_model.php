<?php
class PurchaseOrder_model
{
    private $table = 'purchase_invoices';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPurchaseOrders()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        return $this->db->resultSet();
    }
    public function getPurchaseOrderByStatus($status)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE invoice_status = :status");
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
        $this->db->query("INSERT INTO {$this->table} (invoice_number, supplier_id, branch_id, invoice_date, invoice_amount, invoice_status) VALUES (:invoice_number, :supplier_id, :branch_id, :invoice_date, :invoice_amount, :invoice_status)");
        $this->db->bind('invoice_number', $data['invoice_number']);
        $this->db->bind('supplier_id', $data['supplier_id']);
        $this->db->bind('branch_id', $data['branch_id']);
        $this->db->bind('invoice_date', $data['invoice_date']);
        $this->db->bind('invoice_amount', $data['invoice_amount']);
        $this->db->bind('invoice_status', $data['invoice_status']);

        $this->db->execute();
        return $this->db->rowCount();
    }
}

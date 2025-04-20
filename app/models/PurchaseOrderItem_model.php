<?php
class PurchaseOrderItem_model
{
    private $table = 'purchase_invoice_items';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPurchaseOrderItems($po_id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE purchase_order_id = :po_id");
        $this->db->bind('po_id', $po_id);
        return $this->db->resultSet();
    }

    public function createPurchaseOrderItem($data)
    {
        $this->db->query("INSERT INTO {$this->table} (invoice_id, product_sku, quantity, unit_price, total_price, created_at, create_user_id) VALUES (:invoice_id, :product_sku, :quantity, :unit_price, :total_price, :created_at, :create_user_id)");
        $this->db->bind('invoice_id', $data['invoice_id']);
        $this->db->bind('product_sku', $data['product_sku']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('unit_price', $data['unit_price']);
        $this->db->bind('total_price', $data['total_price']);
        $this->db->bind('created_at', $data['created_at']);
        $this->db->bind('create_user_id', $data['create_user_id']);

        $this->db->execute();
        return $this->db->rowCount();
    }
}

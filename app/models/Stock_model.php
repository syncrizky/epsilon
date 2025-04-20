<?php
class Stock_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllStockBranches($id)
    {
        $this->db->query("SELECT * FROM stock_items 
        JOIN products ON stock_items.product_id = products.id
        WHERE branch_id = :branch_id");
        $this->db->bind('branch_id', $id);
        return $this->db->resultSet();
    }

    public function getAllStockBranchesBySupplier($id)
    {
        $this->db->query("SELECT brands.name as brand, products.name as name, products.sku as sku, stock_items.qty as stock FROM stock_items 
        JOIN products ON stock_items.product_id = products.id
        JOIN brands ON products.brand_id = brands.id
        WHERE supplier_id = :supplier_id");
        $this->db->bind('supplier_id', $id);
        return $this->db->resultSet();
    }
}

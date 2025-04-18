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
}

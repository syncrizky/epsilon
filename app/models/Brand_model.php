<?php
class Brand_model
{
    private $table = 'brands';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBrands()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }
}

<?php
class Branch_model
{
    private $table = 'branches';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBranches()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getBranchByName($slug)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE slug = :slug");
        $this->db->bind('slug', $slug);
        return $this->db->single();
    }
}

<?php
class Supplier_model
{
    private $table = 'suppliers';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllSuppliers()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        return $this->db->resultSet();
    }

    public function getSupplierById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addSupplier($data, $user_id, $create_time)
    {
        $query = "INSERT INTO {$this->table} (name, address, phone, email, create_time, create_user_id) VALUES (:name, :address, :phone, :email, :create_time, :create_user_id)";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('phone', $data['phone']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('create_user_id', $user_id);
        $this->db->bind('create_time', $create_time);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateSupplier($data)
    {
        $query = "UPDATE {$this->table} SET name = :name, address = :address, phone = :phone, email = :email WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('name', $data['name']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('phone', $data['phone']);
        $this->db->bind('email', $data['email']);

        return $this->db->execute();
    }
}

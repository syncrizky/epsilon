<?php
class Product_model
{
    private $table = 'products';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProducts()
    {
        $this->db->query("SELECT 
                      p.sku AS sku, 
                      p.name AS name, 
                      b.name AS brand, 
                      p.category AS category, 
                      p.grup AS `group`,
                        p.stock AS stock,
                        p.price AS price
                  FROM products p
                  JOIN brands b ON p.brand_id = b.id
                  ORDER BY p.id ASC");
        return $this->db->resultSet();
    }

    public function getAllProductOrderStock()
    {
        $this->db->query("SELECT 
                      p.sku AS sku, 
                      p.name AS name, 
                      b.name AS brand, 
                      p.category AS category, 
                      p.grup AS `group`,
                        p.stock AS stock,
                        p.price AS price
                  FROM products p
                  JOIN brands b ON p.brand_id = b.id
                  ORDER BY p.stock ASC LIMIT 10");
        return $this->db->resultSet();
    }

    public function checkProductSku($productSku)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE sku = :sku");
        $this->db->bind('sku', $productSku);
        return $this->db->single();
    }

    public function addProduct($data)
    {
        $this->db->query("INSERT INTO " . $this->table . " (sku, name, brand_id, category, grup) VALUES (:sku, :name, :brand_id, :category, :group)");
        $this->db->bind('sku', $data['inputProductSku']);
        $this->db->bind('name', $data['inputProductDesc']);
        $this->db->bind('brand_id', $data['inputBrand']);
        $this->db->bind('category', $data['inputCategory']);
        $this->db->bind('group', $data['inputGroup']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getAllProductsCount()
    {
        $this->db->query("SELECT COUNT(*) AS count FROM " . $this->table);
        return $this->db->single()['count'];
    }

    public function getAllProductBySupplierId($supplierId)
    {
        $this->db->query("SELECT 
                      p.sku AS sku, 
                      p.name AS name, 
                      b.name AS brand, 
                      p.category AS category, 
                      p.grup AS `group`,
                        p.stock AS stock,
                        p.price AS price,
                        p.discount AS discount,
                        p.hpp AS hpp,
                        p.het AS het
                  FROM products p
                  JOIN brands b ON p.brand_id = b.id
                  WHERE p.supplier_id = :supplier_id
                  ORDER BY p.id ASC");
        $this->db->bind('supplier_id', $supplierId);
        return $this->db->resultSet();
    }

    public function getProductBySku($sku)
    {
        $this->db->query("SELECT 
                      p.sku AS sku, 
                      p.name AS name, 
                      b.name AS brand, 
                      p.category AS category, 
                      p.grup AS `group`,
                        p.discount AS discount,
                        p.hpp AS hpp,
                        p.het AS het
                  FROM products p
                  JOIN brands b ON p.brand_id = b.id
                  WHERE p.sku = :sku
                  ORDER BY p.id ASC");
        $this->db->bind('sku', $sku);
        return $this->db->single();
    }
}

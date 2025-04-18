<?php
class Log_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllLogs()
    {
        $this->db->query("SELECT 
                          l.id AS id, 
                          l.user_id AS user_id, 
                          u.username AS username, 
                          l.action AS action, 
                          l.description AS description, 
                          l.created_at AS created_at
                    FROM activity_logs l
                    JOIN users u ON l.user_id = u.id
                    WHERE l.action = 'Add Product'
                    ORDER BY l.created_at DESC LIMIT 10");
        return $this->db->resultSet();
    }
}

<?php
class ActivityLog_model
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

    public function getAllLogsWithParams($params)
    {
        $placeholders = implode(',', array_fill(0, count($params), '?'));
        $this->db->query("SELECT 
                          l.id AS id, 
                          l.user_id AS user_id, 
                          u.username AS username, 
                          l.action AS action, 
                          l.description AS description, 
                          l.created_at AS created_at
                    FROM activity_logs l
                    JOIN users u ON l.user_id = u.id
                    WHERE l.action IN ($placeholders)
                    ORDER BY l.created_at DESC LIMIT 10");
        foreach ($params as $index => $param) {
            $this->db->bind($index + 1, $param);
        }
        return $this->db->resultSet();
    }
}

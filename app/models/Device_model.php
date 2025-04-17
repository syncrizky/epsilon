<?php
class Device_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(); // Assuming you have a Database class for DB connection
    }

    public function saveDevice($userId, $userAgent, $ip)
    {
        $query = "INSERT INTO user_devices (user_id, user_agent, ip_address) VALUES (:user_id, :user_agent, :ip_address)";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':user_agent', $userAgent);
        $this->db->bind(':ip_address', $ip);
        return $this->db->execute(); // Return true if the device was inserted successfully
    }

    public function isKnownDevice($userId, $userAgent, $ip)
    {
        $query = "SELECT * FROM user_devices WHERE user_id = :user_id AND user_agent = :user_agent AND ip_address = :ip_address";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':user_agent', $userAgent);
        $this->db->bind(':ip_address', $ip);
        return $this->db->single(); // Return the device if it exists, otherwise return false
    }
}

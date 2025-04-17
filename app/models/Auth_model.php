<?php
class Auth_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(); // Assuming you have a Database class for DB connection
    }

    public function checkUsername($username)
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $this->db->query($query);
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    public function checkPhone($phone)
    {
        $query = "SELECT * FROM users WHERE whatsapp = :phone";
        $this->db->query($query);
        $this->db->bind(':phone', $phone);
        return $this->db->single();
    }

    public function registerUser($data)
    {
        $query = "INSERT INTO users (first_name, last_name, username, password, whatsapp) VALUES (:first_name, :last_name, :username, :password, :whatsapp)";
        $this->db->query($query);
        $this->db->bind(':first_name', $data['inputFirstName']);
        $this->db->bind(':last_name', $data['inputLastName']);
        $this->db->bind(':username', $data['inputUsername']);
        $this->db->bind(':whatsapp', $data['inputPhone']);
        $this->db->bind(':password', password_hash($data['inputPassword'], PASSWORD_BCRYPT)); // Hash the password
        $this->db->execute();
        return  $this->db->rowCount(); // Return true if the user was inserted successfully
    }

    public function updateRememberToken($userId, $token)
    {
        $query = "UPDATE users SET remember_token = :remember_token WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':remember_token', $token);
        $this->db->bind(':id', $userId);
        return $this->db->execute(); // Return true if the token was updated successfully
    }

    public function getUserByToken($token)
    {
        $query = "SELECT * FROM users WHERE remember_token = :remember_token";
        $this->db->query($query);
        $this->db->bind(':remember_token', $token);
        return $this->db->single(); // Return the user associated with the token
    }

    public function updateIsActive($whatsapp)
    {
        $query = "UPDATE users SET is_active = 1 WHERE whatsapp = :whatsapp";
        $this->db->query($query);
        $this->db->bind(':whatsapp', $whatsapp);
        return $this->db->execute(); // Return true if the user was activated successfully
    }

    public function resetPasswordByPhone($phone, $password)
    {
        $query = "UPDATE users SET password = :password,  is_reset = 1 WHERE whatsapp = :whatsapp";
        $this->db->query($query);
        $this->db->bind(':whatsapp', $phone);
        $this->db->bind(':password', $password);
        return $this->db->single(); // Return the user associated with the phone number
    }

    public function getUserByPhone($phone)
    {
        $query = "SELECT * FROM users WHERE whatsapp = :whatsapp";
        $this->db->query($query);
        $this->db->bind(':whatsapp', $phone);
        return $this->db->single(); // Return the user associated with the phone number
    }

    public function updatePassword($userId, $password)
    {
        $query = "UPDATE users SET password = :password, is_reset = 0 WHERE whatsapp = :id";
        $this->db->query($query);
        $this->db->bind(':id', $userId);
        $this->db->bind(':password', password_hash($password, PASSWORD_BCRYPT)); // Hash the password
        return $this->db->execute(); // Return true if the password was updated successfully
    }
}

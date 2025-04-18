<?php

class ActivityLogger
{
  public static function log($user_id, $action, $description = '')
  {
    $db = new Database();
    date_default_timezone_set('Asia/Jakarta'); // Set your desired timezone
    $query = "INSERT INTO activity_logs (user_id, action, description, created_at) 
        VALUES (:user_id, :action, :description, :created_at)";
    $db->query($query);
    $db->bind(':user_id', $user_id);
    $db->bind(':action', $action);
    $db->bind(':description', $description);
    $db->bind(':created_at', $created_at = date('Y-m-d H:i:s'));
    $db->execute();
  }
}

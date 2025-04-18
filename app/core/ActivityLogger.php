<?php

class ActivityLogger
{
    public static function log($user_id, $action, $description = '')
    {
        $db = new Database();
        $query = "INSERT INTO activity_logs (user_id, action, description) 
          VALUES (:user_id, :action, :description)";
        $db->query($query);
        $db->bind(':user_id', $user_id);
        $db->bind(':action', $action);
        $db->bind(':description', $description);
        $db->execute();
    }
}

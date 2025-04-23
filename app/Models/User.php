<?php


class User {
    use Model;

    protected $table = "users";

    protected $Allowedcolumns = [
        'user_id',
        'title',
        'firstName',
        'lastName',
        'email',
        'phoneNumber',
        'gender',
        'dob',
        'nic',
        'password',
        'address',
        'age',
        'photo_path',
        'user_role',
        'last_login',
    ];

   

    public function updatePhotoPath($id, $photoPath)
{
    // Build the query to update only the photo_path field
    $query = "UPDATE {$this->table} SET photo_path = :photo_path WHERE id = :id";

    // Execute the query with parameters
    $params = [
        'photo_path' => $photoPath,
        'id' => $id,
    ];

    return $this->query($query, $params);
}

    public function getUserById($userId)
        {
            $sql = "SELECT * FROM users WHERE user_id = :user_id";
            return $this->query($sql, ['user_id' => $userId])[0] ?? null;
        }

        public function getLastUserId()
        {
            $sql = "SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1";
            $result = $this->query($sql);
             show($result[0]['user_id']);
            return $result[0]['user_id'] ?? null;
        }
        
        
}
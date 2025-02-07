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
        'nic',
        'password',
        'address',
        'age',
        'photo_path',
        'user_role'
    ];

    // public function validate($data){
    //     $this->errors = [];

    //     if(empty($data['NIC'])){
    //         $this->errors['NIC'] = "NIC is required";
    //     }
    //     if(empty($data['Password'])){
    //         $this->errors['Password'] = "Password is required";
    //     }

    //     if(empty($this->errors)){
    //         return true;
    //     }
    //     return false;
    // }

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

}
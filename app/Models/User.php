<?php


class User {
    use Model;

    protected $table = "users";

    protected $Allowedcolumns = [
        "title",
        "firstName",
        "lastName",
        "gender",
        "dob",
        "nic",
        "address",
        "photo_path",
        "phoneNumber",
        "email"
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

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        return $this->query($sql, ['user_id' => $userId])[0] ?? null;
    }
}
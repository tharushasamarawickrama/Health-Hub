<?php


class User {
    use Model;

    protected $table = "users";

    protected $Allowedcolumns = [
        'Title',
        'FirstName',
        'LastName',
        'Email',
        'PhoneNumber',
        'Gender',
        'NIC',
        'Password',
        'Address',
        'Age',
        'ProfilePic'
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
}
<?php


class Admin {
    use Model;

    protected $table = "admin";

    protected $Allowedcolumns = [
        'admin_id',
        'firstName',
        'lastName',
        'password',
        'phoneNumber',
        'email',
        'gender',
        'dob',
        'nic',
        'address',
        'photo_path',
        'created_at'
        
    ];

    public function findAlldata()
    {

        $query = "select * from $this->table ";

        return $this->query($query);
    }


}
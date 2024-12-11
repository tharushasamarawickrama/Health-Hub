<?php


class Pharmacist {
    use Model;

    protected $table = "pharmacists";

    protected $Allowedcolumns = [
       
        'user_id',
        'firstName',
        'lastName',
        'password',
        'phoneNumber',
        'email',
        'gender',
        'dob',
        'slmcNo',
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
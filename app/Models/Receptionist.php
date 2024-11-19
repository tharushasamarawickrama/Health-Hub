<?php


class Receptionist {
    use Model;

    protected $table = "receptionists";

    protected $Allowedcolumns = [
        'receptionist_id',
        'firstName',
        'lastName',
        'password',
        'phoneNumber',
        'email',
        'gender',
        'dob',
        'employeeNo',
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
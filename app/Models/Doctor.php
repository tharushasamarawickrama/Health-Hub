<?php


class Doctor {
    use Model;

    protected $table = "doctors";

    protected $Allowedcolumns = [
        'doctor_id',
        'firstName',
        'lastName',
        'password',
        'phoneNumber',
        'email',
        'specialization',
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
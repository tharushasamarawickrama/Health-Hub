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

    public function delete($id)
    {
        $query = "delete from $this->table where doctor_id = :doctor_id";
        $data = ['doctor_id' => $id];
        return $this->query($query, $data);
    }

}
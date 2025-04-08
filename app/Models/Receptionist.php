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

        $query = "SELECT u.*, r.*
                  FROM users u
                  INNER JOIN receptionists r ON u.user_id = r.receptionist_id;";

        return $this->query($query);
    }


    public function searchReceptionists($searchTerm) {
        $query = "SELECT u.*, r.*
                  FROM users u
                  INNER JOIN receptionists r ON u.user_id = r.receptionist_id
                  WHERE u.firstName LIKE :term 
                     OR u.lastName LIKE :term 
                     OR r.employeeNo LIKE :term";
        $data = ['term' => "%$searchTerm%"];
        return $this->query($query, $data);
    }

    
}
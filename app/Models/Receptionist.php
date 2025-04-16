<?php


class Receptionist {
    use Model;

    protected $table = "receptionists";

    protected $Allowedcolumns = [
        'receptionist_id',
        'employeeNo'
        
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
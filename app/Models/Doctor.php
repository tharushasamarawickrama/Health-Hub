<?php

require_once "../app/core/Model.php";

class Doctor
{
    use Model;

    protected $table = "doctors"; // Database table name
    protected $Allowedcolumns = [
        "slmcNo",
        "doctor_id",
        "description",
        "experience",
        "specialization",
        "certifications",
        "availability",
        "type",
    ];

    public function findAlldata()
    {

        $query = "SELECT u.*, d.*
                  FROM users u
                  INNER JOIN doctors d ON u.user_id = d.doctor_id;";

        return $this->query($query);
    }

    public function searchDoctors($searchTerm) {
        $query = "SELECT u.*, d.*
                  FROM users u
                  INNER JOIN doctors d ON u.user_id = d.doctor_id
                  WHERE u.firstName LIKE :term 
                     OR u.lastName LIKE :term 
                     OR d.slmcNo LIKE :term";
        $data = ['term' => "%$searchTerm%"];
        return $this->query($query, $data);
    }
    
   

    public function findDoctors($arr) {
        if($arr['firstName'] == '' && $arr['lastName'] == '' && $arr['specialization'] == '') {
            return [];
        }
        if (empty($arr['firstName']) && empty($arr['lastName'])) {
            $query = "SELECT * FROM doctors 
                      JOIN users ON doctors.doctor_id = users.user_id 
                      WHERE doctors.specialization = :specialization";
            $data = [
                'specialization' => $arr['specialization']
            ];
            return $this->query($query, $data);
        }
        if (empty($arr['specialization'])) {
            $query = "SELECT * FROM doctors 
                      JOIN users ON doctors.doctor_id = users.user_id 
                      WHERE users.firstName = :firstName OR users.lastName = :lastName";
            $data = [
                'firstName' => $arr['firstName'],
                'lastName' => $arr['lastName']
            ];
            return $this->query($query, $data);
        }
        if (!empty($arr['firstName']) && !empty($arr['lastName']) && !empty($arr['specialization'])) {
            $query = "SELECT * FROM doctors 
                      JOIN users ON doctors.doctor_id = users.user_id 
                      WHERE users.firstName = :firstName 
                      AND users.lastName = :lastName 
                      AND doctors.specialization = :specialization";
            $data = [
                'firstName' => $arr['firstName'],
                'lastName' => $arr['lastName'],
                'specialization' => $arr['specialization']
            ];
            return $this->query($query, $data);
        }

    }

    public function getDoctorTypeById($doctor_id){
        $query = "select type from $this->table where doctor_id = :doctor_id";
        return $this->query($query, ['doctor_id' => $doctor_id]);
    }

}

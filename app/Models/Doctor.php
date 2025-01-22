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
        'created_at',
        'profile_pic',
        'experience',
        'certifications',
        'description'
        
    ];

    public function findAlldata()
    {

        $query = "select * from $this->table ";

        return $this->query($query);
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

    
    
    

    
}
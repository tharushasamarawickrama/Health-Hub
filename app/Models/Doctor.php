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
        if($arr['firstName'] == '' && $arr['lastName'] == '') {
            $query = "SELECT * FROM doctors WHERE specialization = :specialization";
            $data = [
                'specialization' => $arr['specialization']
            ];
            return $this->query($query, $data);
        }
        if($arr['specialization'] == '') {
            $query = "SELECT * FROM doctors WHERE firstName = :firstName OR lastName = :lastName";
            $data = [
                'firstName' => $arr['firstName'],
                'lastName' => $arr['lastName']
            ];
            return $this->query($query, $data);
        }
        if(!$arr['firstName'] == '' && !$arr['lastName'] == '' && !$arr['specialization'] == '') {
            $query = "SELECT * FROM doctors WHERE firstName = :firstName AND lastName = :lastName AND specialization = :specialization";
            $data = [
                'firstName' => $arr['firstName'],
                'lastName' => $arr['lastName'],
                'specialization' => $arr['specialization']
            ];
            return $this->query($query, $data);
        }

    }

    
    
    

    
}
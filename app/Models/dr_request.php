<?php


class dr_request {
    use Model;

    protected $table = "dr_requests";

    protected $Allowedcolumns = [
        'req_id',
        'title',
        'firstName',
        'lastName',
        'email',
        'phoneNumber',
        'gender',
        'dob',
        'nic',
        'address',
        'age',
        'photo_path',
        'user_role',
        'slmcNo',
        'experience',
        'specialization',
        'certifications',
        'description',
        'type',
        'slmc_photo'
        
    ];

    public function findAlldata() {
        $query = "SELECT * FROM dr_requests;";
        return $this->query($query);
    }

    public function getRequestCount() {
        $query = "SELECT COUNT(*) AS request_count FROM dr_requests;";
        $result = $this->query($query);
        return $result[0]['request_count'] ?? 0;
    }


    public function emailExists($email) {
        $query = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $result = $this->query($query, ['email' => $email]);
        return !empty($result);
    }

    public function nicExists($nic) {
        $query = "SELECT * FROM {$this->table} WHERE nic = :nic LIMIT 1";
        $result = $this->query($query, ['nic' => $nic]);
        return !empty($result);
    }

    public function slmcExists($slmcNo) {
        $query = "SELECT * FROM {$this->table} WHERE slmcNo = :slmcNo LIMIT 1";
        $result = $this->query($query, ['slmcNo' => $slmcNo]);
        return !empty($result);
    }

    
    // public function searchReceptionists($searchTerm) {
    //     $query = "SELECT u.*, r.*
    //               FROM users u
    //               INNER JOIN receptionists r ON u.user_id = r.receptionist_id
    //               WHERE u.firstName LIKE :term 
    //                  OR u.lastName LIKE :term 
    //                  OR r.employeeNo LIKE :term";
    //     $data = ['term' => "%$searchTerm%"];
    //     return $this->query($query, $data);
    // }
}
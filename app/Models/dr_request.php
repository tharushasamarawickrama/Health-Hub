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

    public function findAlldata()
    {

        $query = "SELECT *
                  FROM dr_requests;";
                  

        return $this->query($query);
    }

    public function getRequestCount() {
        $query = "SELECT COUNT(*) AS request_count FROM dr_requests;";
        $result = $this->query($query);
        return $result[0]['request_count'] ?? 0;
        // if (empty($result) || !isset($result[0]['request_count'])) {
        //     return 0;
        // }
    
        // return $result[0]['request_count'];
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
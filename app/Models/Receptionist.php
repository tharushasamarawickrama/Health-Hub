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

    public function getReceptionistsCount() {
        $query = "SELECT COUNT(*) AS receptionists_count FROM receptionists;";
        $result = $this->query($query);
        return $result[0]['receptionists_count'] ?? 0;
    }

    public function getappointmentsbyreceptionist($appointment_id ) {
        $query = "SELECT a.appointment_id, 
                        a.patient_id,
                        a.nic,
                        a.doctor_id,
                        TIME(a.created_at) AS created_at,
                        DATE (a.created_at) AS created_date
                  FROM appointments a
                  JOIN receptionists r ON a.patient_id = r.receptionist_id
                  Join users d ON a.doctor_id = d.user_id
                  WHERE DATE(a.created_at) = CURDATE()";
        
        if ($appointment_id) {
            $query .= " WHERE a.appointment_id = :appointment_id";
            return $this->query($query, ['appointment_id' => $appointment_id]);
        }
    
        return $this->query($query); // Fetch all appointments if no ID is provided
    }
    public function getappdetailsbyreceptionist($appointment_id ) {
        $query = "SELECT a.appointment_id, 
                        a.title,
                        a.patient_id,
                        CONCAT(a.p_firstName, ' ',a.p_lastName) as patient_name,
                        a.phoneNumber,
                        a.age,
                        a.gender,
                        a.email,
                        a.address,
                        a.appointment_date, 
                        a.appointment_time, 
                        a.doctor_id,          
                        CONCAT(d.firstName, ' ', d.lastName) as doctor_name,
                        a.nic,
                        TIME(a.created_at) AS created_at,
                        DATE (a.created_at) AS created_date
                  FROM appointments a
                  JOIN receptionists r ON a.patient_id = r.receptionist_id
                  Join users d ON a.doctor_id = d.user_id
                  WHERE DATE(a.created_at) = CURDATE() AND a.appointment_id = :appointment_id";
        
        
    
        return $this->query($query,['appointment_id' => $appointment_id]); // Fetch all appointments if no ID is provided
    }
}


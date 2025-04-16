<?php


class LabAssistant {
    use Model;

    protected $table = "labassistants";

    protected $Allowedcolumns = [
        'lab_assistant_id',
        'employeeNo'
        
    ];

    public function findAlldata()
    {

        $query = "SELECT u.*, l.*
                  FROM users u
                  INNER JOIN labassistants l ON u.user_id = l.lab_assistant_id;";

        return $this->query($query);
    }


    public function searchLabAssistants($searchTerm) {
        $query = "SELECT u.*, l.*
                  FROM users u
                  INNER JOIN labassistants l ON u.user_id = l.lab_assistant_id
                  WHERE u.firstName LIKE :term 
                     OR u.lastName LIKE :term 
                     OR l.employeeNo LIKE :term";
        $data = ['term' => "%$searchTerm%"];
        return $this->query($query, $data);
    }

    public function getLabAppointments() {
        $query = "SELECT a.appointment_id, 
                         a.appointment_date, a.appointment_time, a.status, u.nic
                  FROM appointments a
                  JOIN users u ON a.patient_id = u.user_id
                  WHERE a.status = 'planned'
                  ORDER BY a.appointment_date DESC";
                  
        return $this->query($query);
    }
    

    public function getLabPrescriptionDetails($appointment_id) {
        $query = "SELECT 
            a.appointment_id, 
            u.nic,
            a.doctor_id,
            a.appointment_date,
            CONCAT(d.firstName, ' ', d.lastName) as doctor_name,
            u.gender,
            u.age,
            alt.labtest_type
        FROM appointments a
        JOIN users u ON a.patient_id = u.user_id
        JOIN users d ON a.doctor_id = d.user_id
        LEFT JOIN appointment_labtests alt ON a.labtest_id = alt.labtest_id
        WHERE a.appointment_id = :appointment_id";
        
        return $this->query($query, ['appointment_id' => $appointment_id]);
    }
      

    public function getCompletedLabAppointments() {
        $query = "SELECT 
                    a.appointment_id, u.nic, a.appointment_date
                    FROM appointments a,
                    users u
                    WHERE a.status = 'Completed' ORDER BY a.appointment_date DESC";
        return $this->query($query);
    }
    



    public function getAppointmentDetails($appointment_id) {
        $query = "SELECT 
                a.appointment_id, 
                a.appointment_date,
                a.appointment_time, 
                a.status,
                u.nic, 
                u.firstName AS patient_first_name, 
                u.lastName AS patient_last_name, 
                u.age, u.gender, u.phoneNumber,
                d.doctor_id, 
                CONCAT(d.firstName,' ', d.lastName) AS doctor_name,
                alt.labtest_id, 
                alt.labtest_type, 
                alt.labtest_report,
                alt.labtest_pdfname
            FROM appointments a
            LEFT JOIN users u ON a.patient_id = u.user_id
            LEFT JOIN doctors d ON a.doctor_id = d.doctor_id
            LEFT JOIN appointment_labtests alt ON a.labtest_id = alt.labtest_id
            WHERE a.appointment_id = :appointment_id;
        ";
        return $this->query($query, ['appointment_id' => $appointment_id]);
    }
    
    public function deleteLabTestReport($labtest_id) {
        try {
            $query = "UPDATE appointment_labtests
                      SET labtest_report = NULL, 
                          labtest_pdfname = NULL 
                      WHERE labtest_id = :labtest_id";
            
            $result = $this->query($query, ['labtest_id' => $labtest_id]);
            return true;
        } catch (Exception $e) {
            error_log("Error deleting report: " . $e->getMessage());
            return false;
        }
    }
    
    public function searchLabAppointments($appointment_id){
        $query = "SELECT 
            a.appointment_id, 
            a.status, 
            u.nic 
          FROM appointments a
          JOIN users u ON a.patient_id = u.user_id 
          WHERE a.appointment_id = :appointment_id AND a.status = 'planned'";
          
return $this->query($query, ['appointment_id' => $appointment_id]);

    }
}

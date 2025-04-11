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

        $query = "select * from $this->table ";

        return $this->query($query);
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
            l.labtest_name
        FROM appointments a
        JOIN users u ON a.patient_id = u.user_id
        JOIN users d ON a.doctor_id = d.user_id
        JOIN appointment_labtests alt ON a.appointment_id = alt.appointment_id
        JOIN labtests l ON l.labtest_id = alt.labtest_id
        WHERE a.appointment_id = :appointment_id";
        
        return $this->query($query, ['appointment_id' => $appointment_id]);
    }
    
    public function getCompletedLabAppointments($appointment_id) {
        $query = "SELECT 
                    a.appointment_id, 
                    u.nic, 
                    a.appointment_date,
                    u.age,
                    u.gender,
                    a.doctor_id,
                    CONCAT(d.firstName, ' ', d.lastName) as doctor_name,
                    GROUP_CONCAT(l.labtest_name) AS labtest_name 
                    FROM appointments a
                    JOIN appointment_labtests alt ON a.appointment_id = alt.appointment_id
                    JOIN labtests l ON l.labtest_id = alt.labtest_id
                    JOIN users u ON a.patient_id = u.user_id
                    JOIN users d ON a.doctor_id = d.user_id
                    WHERE a.status = 'Completed' AND a.appointment_id = :appointment_id ORDER BY a.appointment_date DESC";
        return $this->query($query, ['appointment_id' => $appointment_id]);
    }
    
    public function getAppointmentsByDate($date) {
        $query = "SELECT 
                    a.appointment_id, u.nic, a.appointment_date
                    FROM appointments a
                    JOIN users u ON a.patient_id = u.user_id
                    WHERE a.status = 'Completed' AND a.appointment_date = :appointment_date
                    ORDER BY a.appointment_date DESC";
        return $this->query($query, ['appointment_date' => $date]);
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
          WHERE a.appointment_id = :appointment_id AND a.status = 'Planned'";
          
return $this->query($query, ['appointment_id' => $appointment_id]);

    }

    public function getAppointmentDetails($appointment_id) {
        $query = "SELECT 
                a.appointment_id, 
                a.appointment_date,
                a.appointment_time, 
                a.status,
                a.patient_id,
                u.nic, 
                u.age, u.gender, u.phoneNumber,
                a.doctor_id, 
                CONCAT(d.firstName,' ', d.lastName) AS doctor_name,
                alt.labtest_id, 
                GROUP_CONCAT(l.labtest_name) AS labtest_name, 
                alt.labtest_report,
                alt.labtest_pdfname
            FROM appointments a
            JOIN users u ON a.patient_id = u.user_id
            JOIN users d ON a.doctor_id = d.user_id
            JOIN appointment_labtests alt ON a.appointment_id = alt.appointment_id 
            JOIN labtests l ON l.labtest_id = alt.labtest_id
            WHERE a.appointment_id = :appointment_id";

        return $this->query($query, ['appointment_id' => $appointment_id]);
    }

}

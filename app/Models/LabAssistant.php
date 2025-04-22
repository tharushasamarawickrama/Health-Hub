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
                         a.appointment_date, a.appointment_time, a.lab_status, u.nic
                  FROM appointments a
                  JOIN users u ON a.patient_id = u.user_id
                  WHERE a.lab_status = 'planned'
                  ";
                  
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
                    GROUP_CONCAT(alt.labtest_id) AS labtest_id,
                    GROUP_CONCAT(l.labtest_name) AS labtest_name,
                    GROUP_CONCAT(alt.labtest_pdfname) AS labtest_pdfname,
                    GROUP_CONCAT(alt.labtest_report) AS labtest_report
                    FROM appointments a
                    JOIN appointment_labtests alt ON a.appointment_id = alt.appointment_id
                    JOIN labtests l ON l.labtest_id = alt.labtest_id
                    JOIN users u ON a.patient_id = u.user_id
                    JOIN users d ON a.doctor_id = d.user_id
                    WHERE a.lab_status = 'Completed' AND a.appointment_id = :appointment_id 
                    GROUP BY a.appointment_id
                    ORDER BY a.appointment_date DESC";
        return $this->query($query, ['appointment_id' => $appointment_id]);
    }
    
    public function getLabTestReport($appointment_id, $labtest_id) {
        $query = "SELECT labtest_report, labtest_pdfname
                  FROM appointment_labtests
                  WHERE appointment_id = :appointment_id AND labtest_id = :labtest_id";
        return $this->query($query, ['appointment_id' => $appointment_id, 'labtest_id' => $labtest_id])[0] ?? null;
    }

    public function removeLabTestReportPath($appointment_id, $labtest_id) {
        $query = "UPDATE appointment_labtests
                  SET labtest_report = NULL, labtest_pdfname = NULL
                  WHERE appointment_id = :appointment_id AND labtest_id = :labtest_id";
        return $this->query($query, ['appointment_id' => $appointment_id, 'labtest_id' => $labtest_id]);
    }

    public function getAppointmentsByDate($date) {
        $query = "SELECT 
                    a.appointment_id, u.nic, a.appointment_date
                    FROM appointments a
                    JOIN users u ON a.patient_id = u.user_id
                    WHERE a.lab_status = 'Completed' AND a.appointment_date = :appointment_date
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
            a.lab_status, 
            u.nic 
          FROM appointments a
          JOIN users u ON a.patient_id = u.user_id 
          WHERE a.appointment_id = :appointment_id AND a.lab_status = 'Planned'";
          
return $this->query($query, ['appointment_id' => $appointment_id]);

    }

    public function getAppointmentDetails($appointment_id) {
        $query = "SELECT 
                a.appointment_id, 
                a.appointment_date,
                a.appointment_time, 
                a.lab_status,
                a.patient_id,
                u.nic, 
                u.age, u.gender, u.phoneNumber,
                a.doctor_id, 
                CONCAT(d.firstName,' ', d.lastName) AS doctor_name,
                alt.labtest_id, 
                l.labtest_name,
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

    public function uploadReport($appointment_id, $labtest_id, $reportPath, $pdfName) {
        $query = "UPDATE appointment_labtests
                  SET labtest_report = :reportPath, labtest_pdfname = :pdfName
                  WHERE appointment_id = :appointment_id AND labtest_id = :labtest_id";
        $params = [
            'reportPath' => $reportPath,
            'pdfName' => $pdfName,
            'appointment_id' => $appointment_id,
            'labtest_id' => $labtest_id
        ];
        return $this->query($query, $params);
        
    }

    public function updateAppointmentStatus($appointment_id,$lab_status){
        $query = "UPDATE appointments 
                    SET lab_status = :lab_status
                    WHERE appointment_id = :appointment_id";
        return $this->query($query, [
                'appointment_id' => $appointment_id, 
                'lab_status' => $lab_status]);
    }

    
public function getPendingLabAppointments($appointment_id) {
    $query = "SELECT 
                a.appointment_id, 
                u.nic, 
                a.appointment_date,
                u.age,
                u.gender,
                a.doctor_id,
                CONCAT(d.firstName, ' ', d.lastName) as doctor_name,
                alt.labtest_id,
                l.labtest_name,
                alt.labtest_pdfname,
                alt.labtest_report
              FROM appointments a
              JOIN appointment_labtests alt ON a.appointment_id = alt.appointment_id
              JOIN labtests l ON l.labtest_id = alt.labtest_id
              JOIN users u ON a.patient_id = u.user_id
              JOIN users d ON a.doctor_id = d.user_id
              WHERE a.lab_status = 'Pending' ";
            $params = [];  
    if ($appointment_id !== null) {
        $query .= " AND a.appointment_id = :appointment_id";
        $params['appointment_id'] = $appointment_id;
    }

    $query .= " ORDER BY a.appointment_date DESC";
    return $this->query($query, $params);
}
public function setAppointmentStatus($appointment_id, $lab_status) {
    $query = "UPDATE appointments 
              SET lab_status = :lab_status
              WHERE appointment_id = :appointment_id";
    return $this->query($query, [
        'appointment_id' => $appointment_id, 
        'lab_status' => $lab_status
    ]);
}

}
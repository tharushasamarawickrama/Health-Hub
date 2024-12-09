<?php


class LabAssistant {
    use Model;

    protected $table = "labassistants";

    protected $Allowedcolumns = [
        
        'lab_assistant_id',
        'user_id',
        'firstName',
        'lastName',
        'password',
        'phoneNumber',
        'email',
        'gender',
        'dob',
        'employeeNo',
        'nic',
        'address',
        'photo_path',
        'created_at'
        
    ];

    public function findAlldata()
    {

        $query = "select * from $this->table ";

        return $this->query($query);
    }
    public function getLabAppointments() {
        $query = "SELECT a.appointment_id, a.nic, 
                         a.appointment_date, a.appointment_time, a.status
                  FROM appointments a
                  WHERE a.status = 'pending'
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
            lt.labtest_type
        FROM appointments a
        JOIN doctors d ON a.doctor_id = d.doctor_id 
        JOIN users u ON a.user_id = u.id
        LEFT JOIN labtest lt ON a.labtest_id = lt.labtest_id
        WHERE a.appointment_id = :appointment_id";
    
        return $this->query($query, ['appointment_id' => $appointment_id]);
    }    

    public function getCompletedLabAppointments() {
        $query = "SELECT 
                    a.appointment_id, a.nic, a.appointment_date
                    FROM appointments a
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
                lt.labtest_id, 
                lt.labtest_type, 
                lt.labtest_report,
                lt.labtest_pdfname
            FROM appointments a
            LEFT JOIN users u ON a.user_id = u.id
            LEFT JOIN doctors d ON a.doctor_id = d.doctor_id
            LEFT JOIN labtest lt ON a.labtest_id = lt.labtest_id
            WHERE a.appointment_id = :appointment_id;
        ";
        return $this->query($query, ['appointment_id' => $appointment_id]);
    }
    
/*
    public function deleteLabTestReport($labtest_id) {
        $query = "DELETE FROM labtest WHERE labtest_id = :labtest_id";
        return $this->query($query, ['labtest_id' => $labtest_id]);
    }*/
    public function deleteLabTestReport($labtest_id) {
        $query = "UPDATE labtest SET labtest_report = NULL, labtest_pdfname = NULL WHERE labtest_id = :labtest_id";
        return $this->query($query, ['labtest_id' => $labtest_id]);
    }
    
    
}
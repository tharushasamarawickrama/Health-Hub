<?php


class LabAssistant {
    use Model;

    protected $table = "labassistants";

    protected $Allowedcolumns = [
        'lab_assistant_id',
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
    
}
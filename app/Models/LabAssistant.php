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
        $query = "SELECT a.*, p.firstName as p_firstName, p.lastName as p_lastName, 
                         p.phoneNumber, p.emailaddress, d.firstName as doctor_name
                  FROM appointments a
                  JOIN patients p ON a.nic = p.nic
                  JOIN doctors d ON a.doctor_id = d.doctor_id
                  WHERE a.appointment_id = :appointment_id";
                  
        return $this->query($query, ['appointment_id' => $appointment_id]);
    }
    
    
}

<?php


class Pharmacist {
    use Model;

    protected $table = "pharmacists";

    protected $Allowedcolumns = [
        'pharmacist_id',
        'firstName',
        'lastName',
        'password',
        'phoneNumber',
        'email',
        'gender',
        'dob',
        'slmcNo',
        'nic',
        'address',
        'photo_path',
        'created_at'
        
    ];

    public function findAlldata(){
        $query = "select * from $this->table ";

        return $this->query($query);
    }

    public function getPhAppointments() {
        $query = "SELECT a.appointment_id, 
                         a.appointment_date, a.appointment_time, a.status, u.nic
                  FROM appointments a
                  JOIN users u ON a.patient_id = u.user_id
                  WHERE a.status = 'planned'
                  ORDER BY a.appointment_date DESC";
                  
        return $this->query($query);
    }
    

    public function searchPhAppointments($appointment_id){
        $query = "SELECT a.appointment_id, 
                         a.status,
                         u.nic
                         FROM appointments a
                         JOIN users u ON a.patient_id = u.user_id
                         WHERE a.appointment_id = :appointment_id AND a.status = 'Planned'";
                        
        return $this->query($query , ['appointment_id' => $appointment_id]);
    }
}
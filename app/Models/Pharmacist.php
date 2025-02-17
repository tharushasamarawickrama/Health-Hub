<?php


class Pharmacist {
    use Model;

    protected $table = "pharmacists";

    protected $Allowedcolumns = [
        'pharmacist_id',
        'slmcNo'
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

    public function getPrescriptionDetails($appointment_id){
        $query = "SELECT 
                    a.appointment_id, 
                    a.doctor_id, 
                    a.patient_id, 
                    a.prescription_id,
                    a.appointment_date, 
                    a.appointment_time,
                    p.nic as nic, 
                    p.age as age, 
                    p.gender as gender,
                    CONCAT('Dr. ', d.firstName, ' ', d.lastName) as doctor_name,
                    pm.name as medication_name, 
                    pm.quantity, 
                    pm.measurement,
                    pm.duration, 
                    pm.sig_codes
                    FROM appointments a
                    JOIN users p ON a.patient_id = p.user_id
                    JOIN users d ON a.doctor_id = d.user_id
                    LEFT JOIN prescribed_medications pm ON a.prescription_id = pm.prescription_id
                    WHERE a.appointment_id = :appointment_id";
    
    return $this->query($query, ['appointment_id' => $appointment_id]);
}

}
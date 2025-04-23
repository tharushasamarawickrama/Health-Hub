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
                         a.appointment_date, a.appointment_time, a.ph_status, u.nic
                  FROM appointments a
                  JOIN users u ON a.patient_id = u.user_id
                  WHERE a.ph_status = 'planned' ";
                  
        return $this->query($query);
    }
    

    public function searchPhAppointments($appointment_id){
        $query = "SELECT a.appointment_id, 
                         a.ph_status,
                         u.nic
                         FROM appointments a
                         JOIN users u ON a.patient_id = u.user_id
                         WHERE a.appointment_id = :appointment_id AND a.ph_status = 'Planned'";
                        
        return $this->query($query , ['appointment_id' => $appointment_id]);
    }

    public function getPrescriptionDetails($appointment_id){
        $query = "SELECT 
                    a.appointment_id, 
                    a.appointment_date, 
                    a.doctor_id, 
                    u.nic,
                    u.age, 
                    u.gender,
                    CONCAT('Dr. ', d.firstName, ' ', d.lastName) as doctor_name,
                    pm.name as medication_name, 
                    pm.quantity, 
                    pm.measurement,
                    pm.duration, 
                    pm.sig_codes
                    FROM appointments a
                    JOIN users u ON a.patient_id = u.user_id
                    JOIN users d ON a.doctor_id = d.user_id
                    JOIN prescribed_medications pm ON a.prescription_id = pm.prescription_id
                    WHERE a.appointment_id = :appointment_id";
    
        return $this->query($query, ['appointment_id' => $appointment_id]);
        return $result ?: []; // Return an empty array if no data is found

    }

    public function updateAppointmentStatus($appointment_id,$ph_status){
        $query = "UPDATE appointments 
                    SET ph_status = :ph_status
                    WHERE appointment_id = :appointment_id";
        return $this->query($query, [
                'appointment_id' => $appointment_id, 
                'ph_status' => $ph_status]);
    }

    public function getCompletedPhAppointments($appointment_id){
        $query = "SELECT 
                    a.appointment_id, 
                    a.appointment_date, 
                    a.doctor_id, 
                    u.nic,
                    u.age, 
                    u.gender,
                    CONCAT('Dr. ', d.firstName, ' ', d.lastName) as doctor_name,
                    pm.name as medication_name, 
                    pm.quantity, 
                    pm.measurement,
                    pm.duration, 
                    pm.sig_codes
                    FROM appointments a
                    JOIN users u ON a.patient_id = u.user_id
                    JOIN users d ON a.doctor_id = d.user_id
                    JOIN prescribed_medications pm ON a.prescription_id = pm.prescription_id
                    WHERE a.ph_status = 'Completed' AND a.appointment_id = :appointment_id

                    ORDER BY a.appointment_date DESC";
        return $this->query($query, ['appointment_id' => $appointment_id]);

    }

    public function getAppointmentsByDate($date) {
        $query = "SELECT 
                    a.appointment_id, u.nic, a.appointment_date
                    FROM appointments a
                    JOIN users u ON a.patient_id = u.user_id
                    WHERE a.ph_status = 'Completed' AND a.appointment_date = :appointment_date
                    ORDER BY a.appointment_date DESC";
        return $this->query($query, ['appointment_date' => $date]);
    }
    
    public function updateUnitsIssued($appointment_id,$name,$units_issued){
        $prescriptionquery = "SELECT prescription_id FROM appointments WHERE appointment_id = :appointment_id";
        $result = $this->query($prescriptionquery, ['appointment_id' => $appointment_id]);
        if (!$result) {
            return false; // No prescription found for the given appointment ID
        }
        $prescription_id = $result[0]['prescription_id'];
        $updatequery = "UPDATE prescribed_medications 
                    SET units_issued = :units_issued
                    WHERE prescription_id = :prescription_id AND name = :name";
        return $this->query($updatequery, [
                'prescription_id' => $prescription_id, 
                'name' => $name,
                'units_issued' => ceil($units_issued)]);
    }
    
    public function getUsageByDate($issued_date) {
        $query = "SELECT issued_date
                    FROM prescribed_medications
                    WHERE  issued_date = :issued_date
                    ORDER BY issued_date DESC";
        return $this->query($query, ['issued_date' => $issued_date]);
    }

    public function getphusagedate($issued_date) {
        $query = "SELECT 
                    pm.name, 
                    SUM(pm.units_issued) As totalUnitsIssued, 
                    pm.issued_date
                    FROM prescribed_medications pm
                    WHERE pm.issued_date = :issued_date
                    GROUP BY pm.name";
        return $this->query($query, ['issued_date' => $issued_date]);
    }
}
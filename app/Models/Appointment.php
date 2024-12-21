<?php

class Appointment {
    use Model;

    protected $table = "appointments";

    protected $Allowedcolumns = [
        'appointment_id',
        'doctor_id',
        'patient_id',
        'p_firstName',
        'p_lastName',
        'nic',
        'phoneNumber',
        'email',
        'address',
        'appointment_date',
        'appointment_time',
        'status',
        'add_service',
        'created_at',
        'updated_at',
        'prescription_id',
        'labtest_id',
        
    ];

    public function getAppointmentById($appointmentId) {
        return $this->first(['appointment_id' => $appointmentId]);
    }

    public function getAppointmentsByDoctorId($doctorId)
    {
        $sql = "SELECT appointment_id, patient_id, appointment_date FROM appointments WHERE doctor_id = :doctor_id";
        return $this->query($sql, ['doctor_id' => $doctorId]);
    }

    public function getPatientByAppointmentId($appointmentId)
    {
        $sql = "SELECT patient_id FROM appointments WHERE appointment_id = :appointment_id";
        return $this->query($sql, ['appointment_id' => $appointmentId]);
    }

    public function getTodaysAppointments($doctorId)
    {
        // Format today's date in 'Y-m-d' format
        $today = (new DateTime())->format('Y-m-d');
        
        // SQL query with a placeholder for the date
        $sql = "SELECT appointment_id, patient_id 
                FROM appointments 
                WHERE doctor_id = :doctor_id 
                AND appointment_date = :appointment_date";
        
        // Execute the query and return the results
        return $this->query($sql, [
            'doctor_id' => $doctorId,
            'appointment_date' => $today,
        ]);
    }

    public function getLimitedPastAppointments($doctorId)
    {
        // Format today's date in 'Y-m-d' format
        $today = (new DateTime())->format('Y-m-d');
        
        // SQL query with a placeholder for the date
        $sql = "SELECT appointment_id, patient_id 
                FROM appointments 
                WHERE doctor_id = :doctor_id 
                AND appointment_date < :appointment_date";
        
        // Execute the query and return the results
        return $this->query($sql, [
            'doctor_id' => $doctorId,
            'appointment_date' => $today,
        ]);
    }

    public function getLabTestIdsByAppointmentId($appointmentId){
        $sql = "SELECT labtest_id FROM appointments WHERE appointment_id = :appointment_id";
        return $this->query($sql, ['appointment_id' => $appointmentId] );
    }

    public function getLastAppointment($doctorId, $patientId){
        $today = (new DateTime())->format('Y-m-d');
        $sql = "SELECT appointment_id FROM appointments
                WHERE doctor_id = :doctor_id AND patient_id = :patient_id AND appointment_date < :appointment_date
                ORDER BY appointment_date DESC LIMIT 1";
       $result = $this->query($sql, ['doctor_id' => $doctorId, 'patient_id' => $patientId, 'appointment_date' => $today] );

        return $result ? $result : null;
    }


}
?>
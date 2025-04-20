<?php

class Appointment
{
    use Model;

    protected $table = "appointments";

    protected $Allowedcolumns = [
        'appointment_id',
        'doctor_id',
        'patient_id',
        'referal_id',
        'appointment_No',
        'p_firstName',
        'p_lastName',
        'nic',
        'phoneNumber',
        'email',
        'address',
        'appointment_date',
        'appointment_time',
        'status',
        'payment_status',
        'add_service',
        'created_at',
        'updated_at',
        'prescription_id',
        'labtest_id',

    ];

    public function getAppointmentsByUserId($user_id)
    {
        // Write the query to fetch appointments for the specified user_id
        $query = "SELECT * FROM $this->table WHERE patient_id = :patient_id";

        // Execute the query with the user_id parameter and return the results
        return $this->query($query, ['patient_id' => $user_id]);
    }

    public function getLastAppointmentByUserId($user_id)
    {
        // Query using a subquery to get the row with the maximum appointment_id
        $query = "SELECT * FROM $this->table 
                  WHERE patient_id = :patient_id 
                  AND appointment_id = (SELECT MAX(appointment_id) FROM $this->table WHERE patient_id = :patient_id)";

        $result = $this->query($query, ['patient_id' => $user_id]);

        // Return the single row if found, otherwise return null
        return $result ? $result[0] : null;
    }

    public function getAppointmentById($appointment_id)
    {
        $query = "SELECT * FROM appointments WHERE appointment_id = :appointment_id";
        return $this->query($query, ['appointment_id' => $appointment_id])[0] ?? null;
    }

    public function getAppointmentsByDoctorId($doctorId)
    {
        $sql = "SELECT appointment_id, appointment_No, patient_id, appointment_date, appointment_time, status FROM appointments WHERE doctor_id = :doctor_id
                ORDER BY appointment_date ASC, appointment_time ASC, appointment_No ASC"; 
        return $this->query($sql, ['doctor_id' => $doctorId]);
    }

    public function getPatientAndDateByAppointmentId($appointmentId)
    {
        $sql = "SELECT patient_id, appointment_date FROM appointments WHERE appointment_id = :appointment_id";
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

    // public function getLimitedPastAppointments($doctorId)
    // {
    //     // Format today's date in 'Y-m-d' format
    //     $today = (new DateTime())->format('Y-m-d');

    //     // SQL query with a placeholder for the date
    //     $sql = "SELECT appointment_id, patient_id 
    //             FROM appointments 
    //             WHERE doctor_id = :doctor_id 
    //             AND appointment_date < :appointment_date";

    //     // Execute the query and return the results
    //     return $this->query($sql, [
    //         'doctor_id' => $doctorId,
    //         'appointment_date' => $today,
    //     ]);
    // }

    public function getLimitedPastAppointments($doctorId)
    {
        // Format today's date in 'Y-m-d' format
        $today = (new DateTime())->format('Y-m-d');

        // SQL query with a placeholder for the date
        $sql = "SELECT appointment_date, COUNT(appointment_id) AS appointment_count 
                FROM appointments 
                WHERE doctor_id = :doctor_id 
                AND appointment_date < :appointment_date
                GROUP BY appointment_date ORDER BY appointment_date DESC LIMIT 4";

        // Execute the query and return the results
        return $this->query($sql, [
            'doctor_id' => $doctorId,
            'appointment_date' => $today,
        ]);
    }

    public function getLabTestIdsByAppointmentId($appointmentId)
    {
        $sql = "SELECT labtest_id FROM appointments WHERE appointment_id = :appointment_id";
        return $this->query($sql, ['appointment_id' => $appointmentId]);
    }

    public function getLastAppointment($doctorId, $patientId)
    {
        $today = (new DateTime())->format('Y-m-d');
        $sql = "SELECT appointment_id FROM appointments
                WHERE doctor_id = :doctor_id AND patient_id = :patient_id AND appointment_date < :appointment_date
                ORDER BY appointment_date DESC LIMIT 1";
        $result = $this->query($sql, ['doctor_id' => $doctorId, 'patient_id' => $patientId, 'appointment_date' => $today]);

        return $result ? $result : null;
    }

    public function getPrevAppointment($doctorId, $patientId, $appointmentDate)
    {
        $sql = "SELECT * FROM appointments
                WHERE doctor_id = :doctor_id AND patient_id = :patient_id AND appointment_date < :appointment_date
                ORDER BY appointment_date DESC LIMIT 1";
        $result = $this->query($sql, ['doctor_id' => $doctorId, 'patient_id' => $patientId, 'appointment_date' => $appointmentDate]);

        return $result ? $result : null;
    }

    public function getDistinctReferalAndUserDetails($user_id)
    {
        // SQL query to retrieve distinct referal_id and user details
        $sql = "SELECT referal_id, p_firstName, p_lastName, nic, phoneNumber, email, address
            FROM $this->table
            WHERE patient_id = :user_id
            GROUP BY referal_id";

        // Execute the query and return the results
        return $this->query($sql, ['user_id' => $user_id]);
    }

    public function updateCompleteStatus($appointmentId)
    {
        // SQL query to update the status of an appointment
        $sql = "UPDATE $this->table SET status = 'completed' WHERE appointment_id = :appointment_id";

        // Execute the query with the provided parameters
        return $this->query($sql, [
            'appointment_id' => $appointmentId,
        ]);
    }
}

<?php

class Appointment {
    use Model;

    protected $table = "appointments";

    protected $Allowedcolumns = [
        'appointment_id',
        'doctor_id',
        'user_id',
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
        'add_service',
        'created_at',
        'updated_at'
        
    ];

    public function getAppointmentsByUserId($user_id)
    {
        // Write the query to fetch appointments for the specified user_id
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id";
        
        // Execute the query with the user_id parameter and return the results
        return $this->query($query, ['user_id' => $user_id]);
    }

    public function getLastAppointmentByUserId($user_id)
    {
        // Query using a subquery to get the row with the maximum appointment_id
        $query = "SELECT * FROM $this->table 
                  WHERE user_id = :user_id 
                  AND appointment_id = (SELECT MAX(appointment_id) FROM $this->table WHERE user_id = :user_id)";
        
        $result = $this->query($query, ['user_id' => $user_id]);

        // Return the single row if found, otherwise return null
        return $result ? $result[0] : null;
    }

}
?>
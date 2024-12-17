<?php

class Appointment {
    use Model;

    protected $table = "appointments";

    protected $Allowedcolumns = [
        'appointment_id',
        'doctor_id',
        'user_id',
        'prescription_id',
        'labtest_id',
        'appointment_date',
        'appointment_time',
        'status'
    ];

    

}
?>
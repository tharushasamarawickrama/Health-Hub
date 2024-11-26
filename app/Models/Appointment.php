<?php

class  {
    use Model;

    protected $table = "s";

    protected $Allowedcolumns = [
        'appointment_id',
        'doctor_id',
        'user_id',
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

    

}
?>
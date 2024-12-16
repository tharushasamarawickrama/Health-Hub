<?php


class Patient {
    use Model;

    protected $table = "patients";

    protected $Allowedcolumns = [
        'patient_id',
        'user_id',
       

        
    ];

}
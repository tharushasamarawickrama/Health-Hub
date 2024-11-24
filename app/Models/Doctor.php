<?php

require_once "../app/core/Model.php";

class Doctor
{
    use Model;

    protected $table = "doctors"; // Database table name
    protected $Allowedcolumns = [
        "firstName",
        "lastName",
        "gender",
        "slmcNo",
        "dob",
        "nic",
        "address",
        "profile_pic",
        "created_at",
        "description",
        "experience",
        "specialties",
        "certifications",
        "phoneNumber",
        "email"
    ];
}

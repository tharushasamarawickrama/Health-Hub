<?php

require_once "../app/core/Model.php";

class Doctor
{
    use Model;

    protected $table = "doctors"; // Database table name
    protected $Allowedcolumns = [
        "name",
        "description",
        "experience",
        "specialties",
        "certifications",
        "availability",
        "phone",
        "email"
    ];
}

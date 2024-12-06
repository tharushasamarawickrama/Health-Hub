<?php

require_once "../app/core/Model.php";

class Doctor
{
    use Model;

    protected $table = "doctors"; // Database table name
    protected $Allowedcolumns = [
        "slmcNo",
        "description",
        "experience",
        "specialization",
        "certifications",
        "availability",
        "type",
    ];
}

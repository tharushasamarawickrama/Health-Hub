<?php

require_once "../app/core/Model.php";

class Prescription
{
    use Model;

    protected $table = "prescriptions"; // Database table name
    protected $Allowedcolumns = [
        "diagnosis",
    ];
}

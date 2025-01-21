<?php

require_once "../app/core/Model.php";

class Prescription
{
    use Model;

    protected $table = "prescriptions"; // Database table name
    protected $Allowedcolumns = [
        "diagnosis",
    ];

    public function insertAndGetId($data)
    {
        // Use the connection to insert and fetch the last inserted ID
        $con = $this->connect();

        // Perform the insert operation
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (" . implode(",", $keys) . ") VALUES (:" . implode(",:", $keys) . ")";
        
        // Prepare and execute the query
        $stm = $con->prepare($query);
        $stm->execute($data);

        // Check if the insert was successful
        if ($stm->rowCount() > 0) {
            // Return the last inserted ID
            return $con->lastInsertId();
        } else {
            // Handle error if insertion fails
            error_log("Insert failed: No rows affected.");
            return false; // or handle error appropriately
        }
    }
    
}

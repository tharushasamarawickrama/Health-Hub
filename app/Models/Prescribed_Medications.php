<?php

require_once "../app/core/Model.php";

class Prescribed_Medications
{
    use Model;

    protected $table = "prescribed_medications"; // Database table name
    protected $Allowedcolumns = [
        "prescription_id",
        "name",
        "quantity",
        "measurement",
        "sig_codes",
        "duration",
        "units_issued"
    ];

    // Method to find medications by prescription_id
    public function findWhere($conditions) {
        // Build the SQL query based on conditions
        $query = "SELECT * FROM " . $this->table . " WHERE prescription_id = :prescription_id";
        $data = ['prescription_id' => $conditions['prescription_id']];
    
        // Fetch the medications from the database
        $result = $this->query($query, $data);
    
        if ($result) {
            // Format the result in the required format
            $medications = [];
            foreach ($result as $medication) {
                $medications[] = [
                    "prescription_id" => $medication['prescription_id'],
                    "name" => $medication['name'],
                    "quantity" => $medication['quantity'],
                    "measurement" => $medication['measurement'],
                    "sig_codes" => $medication['sig_codes'],
                    "duration" => $medication['duration']
                ];
            }
            return $medications; // Return the formatted medications array
        }
    
        return false; // Return false if no medications found
    }

    public function deleteWhere($conditions) {
        // Check if the table is empty or if rows matching the conditions exist
        $keys = array_keys($conditions);
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE ";
        foreach ($keys as $key) {
            $query .= "$key = :$key AND ";
        }
        $query = rtrim($query, " AND ");
    
        try {
            $result = $this->query($query, $conditions);
    
            // Proceed to delete only if rows exist
            if ($result && $result[0]['count'] > 0) {
                $deleteQuery = "DELETE FROM $this->table WHERE ";
                foreach ($keys as $key) {
                    $deleteQuery .= "$key = :$key AND ";
                }
                $deleteQuery = rtrim($deleteQuery, " AND ");
    
                // Execute the delete query
                $this->query($deleteQuery, $conditions);
                return true; // Deletion successful
            }
    
            return true; // No rows to delete
        } catch (Exception $e) {
            error_log("Error in deleteWhere: " . $e->getMessage());
            return false; // Return false if query execution fails
        }
    } 
    
    public function getmedicatesInprescription($prescription_id){
        $query = "SELECT * FROM $this->table WHERE prescription_id = :prescription_id";
        $result = $this->query($query, ['prescription_id' => $prescription_id]);
        return $result;
    }
}    

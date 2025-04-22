<?php


class Medications {
    use Model;

    protected $table = "medications";

    protected $Allowedcolumns = [
        'med_id',
        'med_name',
        'quantity'
        
    ];

    public function findAlldata($medication_name)
    {

        $query = "select * from $this->table ";

        return $this->query($query, ['med_name' => $medication_name]);
    }
    public function getMedicationDetails($med_name) {
        $query = "SELECT quantity FROM $this->table WHERE name = :name";
        return $this->query($query, ['name' => $med_name]);
    }
    
    
}
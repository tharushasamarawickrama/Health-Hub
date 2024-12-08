<?php

require_once "../app/core/Model.php";

class Opd_Timeslot
{
    use Model;

    protected $table = "opd_timeslots"; // Database table name
    protected $Allowedcolumns = [
        "day",
        "from_time",
        "to_time",
    ];

    public function findColumns($columns = '*', $order_column = null, $order_type = 'ASC') {
        $query = "SELECT $columns FROM $this->table";
    
        if ($order_column) {
            $query .= " ORDER BY $order_column $order_type";
        }
    
        if ($this->limit) {
            $query .= " LIMIT $this->limit";
        }
    
        if ($this->offset) {
            $query .= " OFFSET $this->offset";
        }
    
        return $this->query($query);
    }
}

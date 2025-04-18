<?php


class Receptionist {
    use Model;

    protected $table = "receptionists";

    protected $Allowedcolumns = [
        'receptionist_id',
        'employeeNo',        
    ];

    public function findAlldata()
    {

        $query = "select * from $this->table ";

        return $this->query($query);
    }


}
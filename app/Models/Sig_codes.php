<?php


class Sig_codes {
    use Model;

    protected $table = "sig_codes";

    protected $Allowedcolumns = [
        'sigcode',
        'frequencyperday'
        
    ];

    public function findAlldata()
    {

        $query = "select * from $this->table ";

        return $this->query($query);
    }

    public function getFrequencyBySigCode($sig_code) {
        $query = "SELECT frequencyperday FROM $this->table WHERE sigcode = :sigcode";
        return $this->query($query, ['sigcode' => $sig_code]);
    }
}
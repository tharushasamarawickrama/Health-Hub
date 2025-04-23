<?php

class PhUsageDate {
    use Controller;
    private $phramacistModel;
    
    public function __construct() {
        $this->phramacistModel = new Pharmacist();
    }
    
    public function index(){
        $this->view('phusagedate');
    }
}
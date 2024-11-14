<?php

class DrPrescription {
    use Controller;
    public function index(){
        $this->view('drPrescription');
    }
}
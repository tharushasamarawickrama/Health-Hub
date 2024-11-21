<?php

class LabPrescriptions {
    use Controller;
    public function index(){
        $this->view('labprescriptions');
    }
}
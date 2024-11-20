<?php
class LabPendingPrescriptions{
    use Controller;
    public function index(){
        $this->view('labpendingprescriptions');
    }
}
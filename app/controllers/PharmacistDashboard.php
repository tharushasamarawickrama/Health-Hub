<?php

class PharmacistDashboard {
    use Controller;
    public function index(){
        $this->view('pharmacistdashboard');
    }
}
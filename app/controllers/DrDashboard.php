<?php

class DrDashboard {
    use Controller;
    public function index(){
        $this->view('drDashboard');
    }
}
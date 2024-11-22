<?php

class AdminDashboard{
    use Controller;
    public function index(){
        // echo "This is AdminDashboard Controller";
        $this->view('Admindashboard');
    }
    
}
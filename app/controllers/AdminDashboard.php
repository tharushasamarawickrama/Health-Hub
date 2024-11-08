<?php

class AdminDashboard{
    use Controller;
    public function index(){
        // echo "This is Home Controller";
        $this->view('admindashboard');
    }
    
}
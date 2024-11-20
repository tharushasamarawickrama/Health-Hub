<?php
class LabDashboard {
    use Controller;
    public function index(){
        $this->view('labdashboard');
    }
}
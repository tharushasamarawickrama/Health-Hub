<?php

class PhDashboard {
    use Controller;
    public function index(){
        $this->view('phdashboard');
    }
}
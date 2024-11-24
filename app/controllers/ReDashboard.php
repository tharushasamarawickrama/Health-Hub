<?php

class ReDashboard{
    use Controller;
    public function index(){
        $this->view('redashboard');
    }
}
<?php
class PhPrescription {
    use Controller;
    public function index(){
        $this->view('phprescriptions');
    }
}
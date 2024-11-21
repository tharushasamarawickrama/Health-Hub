<?php

class PhProcessedPrescriptions {
    use Controller;
    public function index(){
        $this->view('phprocessedprescriptions');
    }


public function getAppointmentData() {
    $date = $_GET['date'] ?? date('Y-m-d');
    $data = [
        'appointment_id' => '123', // Replace with actual database query
        'nic' => 'ABC123' // Replace with actual database query
    ];
    echo json_encode($data);
}
}
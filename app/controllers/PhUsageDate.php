<?php

class PhUsageDate {
    use Controller;
    private $pharmacistModel;
    
    public function __construct() {
        $this->pharmacistModel = new Pharmacist();
    }
    
    public function index() {
        // Use 'date' instead of 'issued_date'
        $issued_date = $_GET['date'] ?? null;
    
        if (!$issued_date) {
            die("Error: 'date' parameter is missing.");
        }
    
        $appointmentDetails = $this->pharmacistModel->getphusagedate($issued_date);
    
        if (!$appointmentDetails) {
            $appointmentDetails = []; // Prevent errors if no data is found
        }
    
        $this->view('phusagedate', [
            'issued_date' => $issued_date,
            'medications' => $appointmentDetails,
        ]);
    }
}
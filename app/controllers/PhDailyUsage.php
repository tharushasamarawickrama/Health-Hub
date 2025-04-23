<?php

class PhDailyUsage {
    use Controller;
    private $pharmacistModel;

    public function __construct() {
        $this->pharmacistModel = new Pharmacist();
    }
    public function index($issued_date = null) {
     $appointments = $this->pharmacistModel->getUsageByDate($issued_date);
     $data = [
        'appointments' => $appointments
    ];
        $this->view('phdailyusage',$data);
    }
    public function getUsageByDate() {
        $issued_date = $_GET['date'] ?? date('Y-m-d');
        $appointments = $this->pharmacistModel->getUsageByDate($issued_date);
        echo json_encode($appointments);
    }
    
}
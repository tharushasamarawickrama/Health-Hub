<?php

class PhDailyUsage {
    use Controller;
    public function index(){
        $this->view('phdailyusage');
    }
    public function details($date) {
        // Load the daily usage details view for the specific date
        $this->view('phusagedate', ['date' => $date]);
    }
}
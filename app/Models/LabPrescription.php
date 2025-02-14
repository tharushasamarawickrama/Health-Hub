<?php
class LabPrescription {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    

    public function getAllAppointments() {
        $this->db->query('SELECT appointment_id, nic FROM appointments');
        return $this->db->resultSet();
    }
}

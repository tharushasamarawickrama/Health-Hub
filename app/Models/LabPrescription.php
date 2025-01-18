<?php
class LabPrescription {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function searchAppointments($appointmentId) {
        $this->db->query('SELECT appointment_id, nic FROM appointments WHERE appointment_id LIKE :appointment_id');
        $this->db->bind(':appointment_id', $appointmentId);
        return $this->db->resultSet();
    }

    public function getAllAppointments() {
        $this->db->query('SELECT appointment_id, nic FROM appointments');
        return $this->db->resultSet();
    }
}

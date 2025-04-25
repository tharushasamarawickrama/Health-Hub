<?php

class SpecialistNotificationDetails {
    use Controller;

    public function index() {
        // Get schedule_id and doctor_id from the URL
        $schedule_id = $_GET['schedule_id'] ?? null;
        $doctor_id = $_GET['doctor_id'] ?? null;

        if (!$schedule_id || !$doctor_id) {
            echo "Invalid request. Missing schedule_id or doctor_id.";
            return;
        }

        // Fetch appointments that match the schedule_id and doctor_id
        $appointment = new Appointment;
        $data = $appointment->getAppointmentsByScheduleAndDoctor($schedule_id, $doctor_id);

        // Load the view and pass the data
        $this->view('SpecialistNotificationDetails', $data);
    }
}
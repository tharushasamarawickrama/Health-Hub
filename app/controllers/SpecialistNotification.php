<?php

class SpecialistNotification {
    use Controller;

    public function index() {
        $Specialist_Notifications = new Specialist_Notifications;
        $data = $Specialist_Notifications->findAlldata();

        $this->view('SpecialistNotification', $data);
    }

    public function delete() {
        $schedule_id = $_GET['schedule_id'];
        $doctor_id = $_GET['doctor_id'];
        $Specialist_Notifications = new Specialist_Notifications;

        // Delete the record from the specialist_notifications table
        if ($Specialist_Notifications->delete($schedule_id, $doctor_id)) {
            redirect('SpecialistNotification'); // Redirect back to the list after deletion
        } else {
            echo "Failed to delete the record.";
        }
    }
}
?>
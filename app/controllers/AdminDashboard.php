<?php

class AdminDashboard {
    use Controller;

    public function index() {
        $dr_request = new dr_request();
        $doctor = new Doctor();
        $receptionist = new Receptionist();
        $lab_assistant = new LabAssistant();
        $pharmacist = new Pharmacist();
        $dr_upd_req = new Doctor_Profile_Update();

       
        $data['doctor_requests_count'] = $dr_request->getRequestCount();
        $data['doctors_count'] = $doctor->getDoctorsCount();
        $data['receptionists_count'] = $receptionist->getReceptionistsCount();
        $data['lab_assistants_count'] = $lab_assistant->getLabAssistantsCount();
        $data['pharmacists_count'] = $pharmacist->getPharmacistsCount();
        $data['doctor_profile_update_count'] = $dr_upd_req->getDoctorsProfileUpdateRequestCount();

        
        $this->view('Admindashboard', $data);
    }
}
?>
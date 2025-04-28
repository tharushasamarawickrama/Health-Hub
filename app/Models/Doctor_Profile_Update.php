<?php


class Doctor_Profile_Update {
    use Model;

    protected $table = "doctor_profile_update";

    protected $Allowedcolumns = [
        'doctor_id',
        'firstName',
        'lastName',
        'description',
        'experience',
        'certifications',
        'certification_path',
        'photo_path'
    ];

    public function findAlldata()
    {

        $query = "SELECT *
                  FROM doctor_profile_update;";
                  

        return $this->query($query);
    }

    public function delete($id, $id_column = 'doctor_id') {
        $query = "DELETE FROM {$this->table} WHERE $id_column = :id";
        $params = ['id' => $id];
    
        return $this->query($query, $params);
    }

    public function getDoctorsProfileUpdateRequestCount() {
        $query = "SELECT COUNT(*) AS doctors_profile_update_request_count FROM doctor_profile_update;";
        $result = $this->query($query);
        return $result[0]['doctors_profile_update_request_count'] ?? 0;
    }

    public function checkRequestExists($doctorId) {
        $query = "SELECT COUNT(*) AS request_exists FROM $this->table WHERE doctor_id = :doctorId";
        $params = ['doctorId' => $doctorId];
        $result = $this->query($query, $params);
        return $result[0]['request_exists'] > 0;
    }

}
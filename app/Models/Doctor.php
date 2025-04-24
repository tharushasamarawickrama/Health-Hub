<?php

require_once "../app/core/Model.php";

class Doctor
{
    use Model;

    protected $table = "doctors"; // Database table name
    protected $Allowedcolumns = [
        "slmcNo",
        "description",
        "experience",
        "specialization",
        "certifications",
        "availability",
        "type",
    ];

    public function findAlldata()
    {

        $query = "select * from $this->table ";

        return $this->query($query);
    }




    public function findDoctors($arr)
    {
        if ($arr['firstName'] == '' && $arr['lastName'] == '' && $arr['specialization'] == '') {
            return [];
        }
        if (empty($arr['firstName']) && empty($arr['lastName'])) {
            $query = "SELECT * FROM doctors 
                      JOIN users ON doctors.doctor_id = users.user_id 
                      WHERE doctors.specialization = :specialization";
            $data = [
                'specialization' => $arr['specialization']
            ];
            return $this->query($query, $data);
        }
        if (empty($arr['specialization'])) {
            $query = "SELECT * FROM doctors 
                      JOIN users ON doctors.doctor_id = users.user_id 
                      WHERE users.firstName = :firstName OR users.lastName = :lastName";
            $data = [
                'firstName' => $arr['firstName'],
                'lastName' => $arr['lastName']
            ];
            return $this->query($query, $data);
        }
        if (!empty($arr['firstName']) && !empty($arr['lastName']) && !empty($arr['specialization'])) {
            $query = "SELECT * FROM doctors 
                      JOIN users ON doctors.doctor_id = users.user_id 
                      WHERE users.firstName = :firstName 
                      AND users.lastName = :lastName 
                      AND doctors.specialization = :specialization";
            $data = [
                'firstName' => $arr['firstName'],
                'lastName' => $arr['lastName'],
                'specialization' => $arr['specialization']
            ];
            return $this->query($query, $data);
        }
    }

    public function getDoctorTypeById($doctor_id)
    {
        $query = "select type from $this->table where doctor_id = :doctor_id";
        return $this->query($query, ['doctor_id' => $doctor_id]);
    }
    public function getAllAvailabilitySlots($doctor_id)
    {
        $query = "SELECT availability FROM $this->table where doctor_id != :doctor_id";
        return $this->query($query, ['doctor_id' => $doctor_id]);
    }

    public function findDoctorsByDay($day)
    {
        $query = "SELECT * FROM doctors 
                  JOIN users ON doctors.doctor_id = users.user_id 
                  JOIN schedule_time ON doctors.doctor_id = schedule_time.doctor_id 
                  WHERE schedule_time.weekday = :day";

        $result = $this->query($query, ['day' => $day]);
        return $result ?: []; // Return an empty array if no results are found
    }

    public function findDoctorsBySpecializationAndDay($specialization, $day)
    {
        $query = "SELECT * FROM doctors 
                  JOIN users ON doctors.doctor_id = users.user_id 
                  JOIN schedule_time ON doctors.doctor_id = schedule_time.doctor_id 
                  WHERE schedule_time.weekday = :day AND doctors.specialization = :specialization";

        $result = $this->query($query, ['day' => $day, 'specialization' => $specialization]);
        return $result ?: []; // Return an empty array if no results are found
    }

    public function findDoctorsByNameAndDay($arr, $day)
    {
        $query = "SELECT * FROM doctors 
                  JOIN users ON doctors.doctor_id = users.user_id 
                  JOIN schedule_time ON doctors.doctor_id = schedule_time.doctor_id 
                  WHERE schedule_time.weekday = :day AND (users.firstName = :firstName OR users.lastName = :lastName)";

        $data = [
            'day' => $day,
            'firstName' => $arr['firstName'],
            'lastName' => $arr['lastName']
        ];
        $result = $this->query($query, $data);
        return $result ?: []; // Return an empty array if no results are found
    }
}

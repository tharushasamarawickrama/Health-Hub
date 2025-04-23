<?php


class Patient {
    use Model;

    protected $table = "patients";

    protected $Allowedcolumns = [
        'patient_id',
        "medical_history"
    ];

    public function getMedicalHistoryByPatientId($patientId){
        $sql = ("SELECT medical_history FROM $this->table WHERE patient_id = :patient_id");
        return $this->query($sql, ['patient_id' => $patientId] );
    }

}
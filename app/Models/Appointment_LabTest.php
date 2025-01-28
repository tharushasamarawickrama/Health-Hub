<?php

require_once "../app/core/Model.php";

class Appointment_Labtest
{
    use Model;

    protected $table = "appointment_labtest"; // Database table name
    protected $Allowedcolumns = [
        "appointment_id",
        "labtest_id",
        'labtest_report',
        'labtest_pdfname',
    ];

    public function getLabTestsByAppointmentId($appointmentId){
        $sql = "SELECT lt.labtest_name 
            FROM {$this->table} alt
            INNER JOIN labtests lt ON alt.labtest_id = lt.labtest_id
            WHERE alt.appointment_id = :appointment_id";
        return $this->query($sql, ['appointment_id' => $appointmentId] );
    }

    // public function insertLabTest($appointmentId, $testName) {
    //     $sql = "INSERT INTO appointment_labtest (appointment_id, labtest_name) VALUES (:appointment_id, :labtest_name)";
    //     $this->query($sql);
    //     $this->bind(':appointment_id', $appointmentId);
    //     $this->bind(':labtest_name', $testName);
    //     $this->execute();
    // }
    

}

<?php

require_once "../app/core/Model.php";

class Appointment_Labtest
{
    use Model;

    protected $table = "appointment_labtests"; // Database table name
    protected $Allowedcolumns = [
        "appointment_id",
        "labtest_id",
        'labtest_report',
        'labtest_pdfname',
    ];

    public function getLabTestNamesByAppointmentId($appointmentId)
    {
        $sql = "SELECT lt.labtest_name 
            FROM {$this->table} alt
            INNER JOIN labtests lt ON alt.labtest_id = lt.labtest_id
            WHERE alt.appointment_id = :appointment_id";
        return $this->query($sql, ['appointment_id' => $appointmentId]);
    }

    public function updateLabTestsForAppointment($appointmentId, $newLabTestIds)
    {
        $deleteSql = "DELETE FROM appointment_labtest WHERE appointment_id = :appointment_id";

        $deleteResult = $this->query($deleteSql, ['appointment_id' => $appointmentId]);
        if (!$deleteResult) {
            return false;
        }

        $insertSql = "INSERT INTO appointment_labtest (appointment_id, labtest_id) VALUES (:appointment_id, :labtest_id)";
        foreach ($newLabTestIds as $labtestId) {
            $insertResult = $this->query($insertSql, ['appointment_id' => $appointmentId, 'labtest_id' => $labtestId]);
            if (!$insertResult) {
                return false;
            }
        }

        return true; // Return success
    }

    public function getLabReportDetailsByAppointmentId($appointmentId)
    {
        $sql = "SELECT lt.labtest_name, alt.labtest_report
            FROM {$this->table} alt
            INNER JOIN labtests lt ON alt.labtest_id = lt.labtest_id
            WHERE alt.appointment_id = :appointment_id";
        return $this->query($sql, ['appointment_id' => $appointmentId]);
    }

    public function getLabTestByAppointmentId($appointmentId)
    {
        $query = "SELECT * FROM $this->table WHERE appointment_id = :appointment_id";
        $params = ['appointment_id' => $appointmentId];
        return $this->query($query, $params);
    }
}

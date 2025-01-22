<?php

class LabTest {
    use Model;

    protected $table = "appointment_labtests";

    protected $Allowedcolumns = [
        'appointment_id',
        'labtest_id',
        'labtest_type',
        'labtest_report',
        'labtest_pdfname',
        
    ];
}
?>
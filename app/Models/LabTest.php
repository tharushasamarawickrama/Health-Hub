<?php

class LabTest {
    use Model;

    protected $table = "labtests";

    protected $Allowedcolumns = [
        'labtest_id',
        'labtest_type',
        'labtest_report',
        'labtest_pdfname',
        
    ];
}
?>
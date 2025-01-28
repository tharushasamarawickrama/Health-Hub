<?php

require_once "../app/core/Model.php";

class Labtest
{
    use Model;

    protected $table = "labtests"; // Database table name
    protected $Allowedcolumns = [
        "labtest_name",
        "labtest_category",
        "description",
    ];

    public function getLabTestsByCategory() {
        $sql = ("SELECT labtest_category, GROUP_CONCAT(labtest_name SEPARATOR '|') AS tests 
                          FROM labtests 
                          WHERE labtest_category IS NOT NULL 
                          GROUP BY labtest_category");
        return $this->query($sql);
    }

    public function getUncategorizedLabTests() {
        $sql = ("SELECT labtest_name FROM labtests WHERE labtest_category IS NULL");
        return $this->query($sql);
    }

    public function getLabTestsByIds(string $idsString){
        $sql = "SELECT labtest_name FROM labtests WHERE labtest_id IN ($idsString)";
        return $this->query($sql);
    }

    public function getLabTestIdsAsCommaString(string $idsString) {
        $testNames = explode(',', $idsString);
        $placeholders = implode(',', array_fill(0, count($testNames), '?'));
    
        $sql = "SELECT labtest_id FROM labtests WHERE labtest_name IN ($placeholders)";
        $result = $this->query($sql, $testNames);
    
        // Convert the result to a comma-separated string
        $idArray = array_map(function ($row) {
            return $row['labtest_id'];
        }, $result);
    
        return implode(',', $idArray);
    }

}

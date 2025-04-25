<?php

class Patient_Referal
{
    use Model;

    protected $table = "patient-referal";

    protected $Allowedcolumns = [
        'referal_id',
        'user_id',
        'medical_history'
    ];

    public function getReferalByUserId($user_id)
    {
        // Write the query to fetch referals for the specified user_id
        $query = "SELECT * FROM `$this->table` WHERE user_id = :user_id";

        // Execute the query with the user_id parameter and return the results
        return $this->query($query, ['user_id' => $user_id]);
    }

    public function getLastReferalByUserId($user_id)
    {
        // Query to fetch the last referal_id for the given user_id
        $query = "SELECT referal_id 
                  FROM `$this->table` 
                  WHERE user_id = :user_id 
                  ORDER BY referal_id DESC 
                  LIMIT 1";

        // Execute the query with the user_id parameter and return the result
        $result = $this->query($query, ['user_id' => $user_id]);

        return $result ? $result[0]['referal_id'] : null; // Return the referal_id or null if no result
    }

    public function insertReferal($user_id)
    {
        // Dynamically build the SQL query
        $query = "INSERT INTO `$this->table` (user_id) VALUES (:user_id)";

        // Execute the query with the provided data
        return $this->query($query, ['user_id' => $user_id]);
    }

    public function getMedicalHistory($userId, $referalId){
        $sql = ("SELECT medical_history FROM `$this->table` WHERE user_id = :user_id AND referal_id = :referal_id");
        return $this->query($sql, ['user_id' => $userId, 'referal_id' => $referalId] );
    }

    public function updateMedicalHistory($userId, $referalId, $medicalHistory)
    {
        $sql = "UPDATE `$this->table` SET medical_history = :medical_history WHERE user_id = :user_id AND referal_id = :referal_id";
        return $this->query($sql, ['medical_history' => $medicalHistory, 'user_id' => $userId, 'referal_id' => $referalId]);
    }
    public function delete1($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        // show($data);
        $query = "delete from `$this->table` where $id_column = :$id_column";

        $this->query($query, $data);
        return true;
    }
}

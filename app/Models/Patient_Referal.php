<?php

class Patient_Referal
{
    use Model;

    protected $table = "patient-referal";

    protected $Allowedcolumns = [
        'referal_id',
        'user_id'
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
}

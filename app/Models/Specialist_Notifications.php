<?php


class Specialist_Notifications {
    use Model;

    protected $table = "specialist_notifications";

    protected $Allowedcolumns = [
        'schedule_id',
        'doctor_id',
        
    ];

    public function findAlldata()
    {

        $query = "SELECT *
                  FROM specialist_notifications;";
                  

        return $this->query($query);
    }

    public function getSpecialistNitificationsCount() {
        $query = "SELECT COUNT(*) AS notifications_count FROM specialist_notifications;";
        $result = $this->query($query);
        return $result[0]['notifications_count'] ?? 0;
        // if (empty($result) || !isset($result[0]['request_count'])) {
        //     return 0;
        // }
    
        // return $result[0]['request_count'];
    }

    public function delete($schedule_id, $doctor_id) {
        $query = "DELETE FROM {$this->table} WHERE schedule_id = :schedule_id AND doctor_id = :doctor_id";
        $params = [
            ':schedule_id' => $schedule_id,
            ':doctor_id' => $doctor_id,
        ];
    
        return $this->query($query, $params);
    }
}
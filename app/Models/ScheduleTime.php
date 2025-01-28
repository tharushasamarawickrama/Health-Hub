<?php

class ScheduleTime{
    use Model;

    protected $table = "schedule_time";

    protected $Allowedcolumns = [
        'schedule_id',
        'doctor_id',
        'date',
        'start_time',
        'end_time',
        'total_slots',
        'filled_slots',
        'created_at',
        'updated_at'
        
    ];

    public function getSchedule($doctor_id,$date){
        $query = "select * from $this->table where doctor_id = :doctor_id AND date = :date";
        return $this->query($query, ['doctor_id' => $doctor_id, 'date' => $date]);
    }

    public function getScheduleByDoctor($doctor_id){
        $query = "select * from $this->table where doctor_id = :doctor_id";
        return $this->query($query, ['doctor_id' => $doctor_id]);
    }

    public function getPastSchedulesByDoctor($doctor_id){
        // Format today's date in 'Y-m-d' format
        $today = (new DateTime())->format('Y-m-d');
        
        // SQL query with a placeholder for the date
        $sql = "SELECT date, start_time, end_time, filled_slots
                FROM $this->table 
                WHERE doctor_id = :doctor_id 
                AND date < :date
                ORDER BY date DESC LIMIT 4";
        
        // Execute the query and return the results
        return $this->query($sql, [
            'doctor_id' => $doctor_id,
            'date' => $today,
        ]);
    }
}
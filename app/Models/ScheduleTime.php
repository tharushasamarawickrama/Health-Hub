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
}
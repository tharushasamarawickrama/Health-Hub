<?php

class ScheduleTime
{
    use Model;

    protected $table = "schedule_time";

    protected $Allowedcolumns = [
        'schedule_id',
        'doctor_id',
        'weekday',
        'start_time',
        'end_time',
        'total_slots',
        'filled_slots',
        'is_cancelled',
        'created_at',
        'updated_at'

    ];

    public function getSchedule($doctor_id, $weekday)
    {
        $query = "SELECT * FROM $this->table WHERE doctor_id = :doctor_id AND weekday = :weekday";
        return $this->query($query, ['doctor_id' => $doctor_id, 'weekday' => $weekday]);
    }

    // public function getScheduleByDoctor($doctor_id, $start_date, $end_date){
    //     $query = "SELECT * FROM $this->table WHERE doctor_id = :doctor_id AND date >= :start_date AND date <= :end_date";
    //     return $this->query($query, ['doctor_id' => $doctor_id, 'start_date' => $start_date, 'end_date' => $end_date]);
    // }

    public function getScheduleByDoctor($doctor_id)
    {
        $query = "SELECT * FROM $this->table WHERE doctor_id = :doctor_id";
        return $this->query($query, ['doctor_id' => $doctor_id]);
    }

    public function getPastSchedulesByDoctor($doctor_id)
    {
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

    public function getTodaysSlotsByDoctor($doctor_id)
    {
        $today = (new DateTime())->format('Y-m-d');

        $sql = "SELECT start_time, end_time, filled_slots FROM $this->table WHERE doctor_id = :doctor_id AND date = :date ORDER BY start_time ASC";
        return $this->query($sql, ['doctor_id' => $doctor_id, 'date' => $today]);
    }

    public function getOccupiedSlots($doctor_id, $start_date, $end_date)
    {
        $query = "SELECT date, start_time, end_time
                  FROM $this->table 
                  WHERE date >= :start_date AND date <= :end_date AND doctor_id != :doctor_id
                  GROUP BY date, start_time, end_time
                  HAVING COUNT(schedule_id) = 3";  // Only fetch sets where count is 3

        return $this->query($query, ['start_date' => $start_date, 'end_date' => $end_date, 'doctor_id' => $doctor_id]);
    }

    public function deleteBeforeUpdate($doctor_id, $start_date, $end_date)
    {
        $query = "DELETE FROM $this->table 
                  WHERE doctor_id = :doctor_id AND date >= :start_date AND date <= :end_date";

        return $this->query($query, ['doctor_id' => $doctor_id, 'start_date' => $start_date, 'end_date' => $end_date]);
    }
}

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

    public function getScheduleByDoctor($doctor_id)
    {
        $query = "SELECT * FROM $this->table WHERE doctor_id = :doctor_id";
        return $this->query($query, ['doctor_id' => $doctor_id]);
    }

    public function getPastSchedulesByDoctor($doctor_id)
    {
        $today = date('l');
        if($today == 'Sunday' || $today == 'Saturday'){
            $today = 'Friday';
        }

        // Get today's schedule_id
        $sql = "SELECT schedule_id FROM schedule_time WHERE weekday = :weekday ORDER BY start_time ASC LIMIT 1";
        $todaySchedule = $this->query($sql, ['weekday' => $today]);

        if (empty($todaySchedule)) {
            return []; // No matching schedule found
        }

        $todayScheduleId = $todaySchedule[0]['schedule_id'];

        // Get past schedules
        $sql = "SELECT *
                FROM $this->table 
                WHERE doctor_id = :doctor_id 
                AND schedule_id < :todayScheduleId AND is_cancelled != 'true'
                ORDER BY schedule_id DESC, start_time DESC LIMIT 4";

        // Execute the query and return the results
        return $this->query($sql, [
            'doctor_id' => $doctor_id,
            'todayScheduleId' => $todayScheduleId,
        ]);
    }

    public function getTodaysSlotsByDoctor($doctor_id)
    {
        $today = date('l');

        $sql = "SELECT * FROM $this->table
                WHERE doctor_id = :doctor_id
                AND weekday = :today AND is_cancelled != 'true' 
                ORDER BY start_time ASC";
        return $this->query($sql, ['doctor_id' => $doctor_id, 'today' => $today]);
    }

    public function getValidSlotsByDoctor($doctor_id)
    {
        $query = "SELECT * FROM $this->table WHERE doctor_id = :doctor_id AND is_cancelled != 'true'";
        return $this->query($query, ['doctor_id' => $doctor_id]);
    }

    public function getAvailableSlots()
    {
        $sql = "SELECT * FROM $this->table WHERE doctor_id = 0";
        return $this->query($sql);
    }

    public function getScheduleBySlot($doctorId, $weekday, $startTime, $endTime)
    {
        $query = "SELECT * FROM $this->table 
                  WHERE weekday = :weekday
                  AND start_time = :startTime AND end_time = :endTime
                  AND (doctor_id = 0 OR doctor_id = :doctorId)
                  LIMIT 1";

        return $this->query($query, ['doctorId' => $doctorId, 'weekday' => $weekday, 'startTime' => $startTime, 'endTime' => $endTime]);
    }

    public function updateSomeField($scheduleId, $doctorId, $field, $newVal)
    {
        $query = "UPDATE $this->table SET $field = :newVal WHERE schedule_id = :scheduleId AND doctor_id = :doctorId";

        return $this->query($query, [
            'newVal' => $newVal,
            'scheduleId' => $scheduleId,
            'doctorId' => $doctorId
        ]);
    }

    public function getDoctorCountBySlot($scheduleId){
        $query = "SELECT COUNT(*) AS total FROM $this->table WHERE schedule_id = :scheduleId";
        return $this->query($query, ['scheduleId' => $scheduleId]);
    }

    public function handleAddedSchedules($doctorId, $dayName, $startTime, $endTime, $noSchedules)
    {
        $scheduleDetails = $this->getScheduleBySlot($doctorId, $dayName, $startTime, $endTime)[0] ?? null;
        if (!$scheduleDetails) return false;

        $scheduleId = $scheduleDetails['schedule_id'];

        if ($scheduleDetails['is_cancelled'] === 'optional') {
            // Claim an optional slot for the doctor if currently unassigned
            $query1 = "UPDATE $this->table SET doctor_id = :doctorId WHERE schedule_id = :scheduleId AND doctor_id = 0";
            $updated = $this->query($query1, ['doctorId' => $doctorId, 'scheduleId' => $scheduleId]);
            if (!$updated) return false;

            // Ensure at most 3 entries per schedule slot
            // $query2 = "SELECT COUNT(*) AS total FROM $this->table WHERE schedule_id = :scheduleId";
            // $countResult = $this->query($query2, ['scheduleId' => $scheduleId]);
            $count = $this->getDoctorCountBySlot($scheduleId)[0]['total'] ?? 0;

            if ($count < 3) {
                $inserted = $this->insert([
                    'doctor_id' => 0,
                    'schedule_id' => $scheduleId,
                    'weekday' => $dayName,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'is_cancelled' => 'optional'
                ]);
                if (!$inserted) return false;
            }
        } else {
            // Reactivate a previously cancelled slot or take over if available
            if ($noSchedules) {
                $query3 = "UPDATE $this->table SET doctor_id = :doctorId
                           WHERE schedule_id = :scheduleId AND doctor_id = 0";
                $updated = $this->query($query3, [
                    'doctorId' => $doctorId,
                    'scheduleId' => $scheduleId
                ]);
                if (!$updated) return false;

                $count = $this->getDoctorCountBySlot($scheduleId)[0]['total'] ?? 0;

                if ($count < 3) {
                    $inserted = $this->insert([
                        'doctor_id' => 0,
                        'schedule_id' => $scheduleId,
                        'weekday' => $dayName,
                        'start_time' => $startTime,
                        'end_time' => $endTime
                    ]);
                    if (!$inserted) return false;
                }
            } else {
                $query3 = "UPDATE $this->table 
                   SET is_cancelled = :is_cancelled WHERE schedule_id = :scheduleId AND doctor_id = :doctorId";
                $updated = $this->query($query3, [
                    'doctorId' => $doctorId,
                    'is_cancelled' => 'false',
                    'scheduleId' => $scheduleId
                ]);
            }
            if (!$updated) return false;
        }

        return true;
    }


    public function deleteOptionalSlot($doctorId, $scheduleId)
    {
        $query = "delete from $this->table where doctor_id = :doctorId and schedule_id = :scheduleId";

        return $this->query($query, [
            'doctorId' => $doctorId,
            'scheduleId' => $scheduleId
        ]);
    }
}

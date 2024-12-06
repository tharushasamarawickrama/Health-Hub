<?php

class DrAvailability {
    use Controller;

    public function index() {
        $doctorId = 8; // Hardcoded for demonstration purposes
        $doctorModel = new Doctor();
        $timeslotModel = new Opd_Timeslot();

        if (isset($_SESSION['success_message'])) {
            echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
            unset($_SESSION['success_message']);
        }

        // Handle POST request to save updated timeslots
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updatedTimeslots = isset($_POST['selectedTimeslots']) ? (array) $_POST['selectedTimeslots'] : [];
            if (!empty($updatedTimeslots)) {
                $updatedTimeslotIds = explode(',', $updatedTimeslots[0]);
                // Fetch all OPD timeslots to map days to their respective timeslot IDs
                $opdTimeslots = $timeslotModel->findColumns('timeslot_id, day');

                // Initialize an array to store the corresponding timeslot IDs
                $timeslotIds = [];

                // Loop through the selected days to find the corresponding timeslot IDs
                foreach ($updatedTimeslotIds as $dayName) {
                    foreach ($opdTimeslots as $timeslot) {
                        // Match the day name (Mon, Tue, etc.) with the day in the timeslot
                        if (substr($timeslot['day'], 0, 3) === $dayName) {
                            $timeslotIds[] = $timeslot['timeslot_id'];  // Add the matched timeslot ID
                        }
                    }
                }

                // Convert selected timeslot IDs to a comma-separated string
                $timeslotIdsString = implode(',', $timeslotIds);

                $doctorModel->update($doctorId, ['availability' => $timeslotIdsString], 'doctor_id');

                // Redirect to avoid re-submission of the form
                $_SESSION['success_message'] = 'Availability updated successfully!';
                redirect('drAvailability');
            }
        }

        // Fetch doctor's current data
        $doctorData = $doctorModel->first(['doctor_id' => $doctorId]);

        $currentDay = date('l'); // Current day name (e.g., 'Thursday')
        $currentDate = new DateTime();
        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        // Find tomorrow's day and all remaining days in the current week
        $remainingDays = [];
        $startIndex = array_search($currentDay, $weekdays) + 1;
        for ($i = $startIndex; $i < count($weekdays); $i++) {
            $remainingDays[] = $weekdays[$i];
        }

        // Fetch the doctor's availability from the database
        $doctorAvailability = $doctorData['availability']; // Fetch from `doctors.availability`
        $doctorAvailabilityIds = explode(',', $doctorAvailability); // Array of timeslot IDs

        // Fetch all OPD timeslots
        $opdTimeslots = $timeslotModel->findAll('timeslot_id');

        // Fetch all doctors' availability and merge into an array
        $allDoctors = $doctorModel->findAll('doctor_id');
        $occupiedTimeslotIDs = [];
        foreach ($allDoctors as $doc) {
            if (!empty($doc['availability'])) {
                $occupiedTimeslotIDs = array_merge($occupiedTimeslotIDs, explode(',', $doc['availability']));
            }
        }
        $occupiedTimeslotIDs = array_unique($occupiedTimeslotIDs); // Remove duplicates

        // Initialize arrays for timeslots
        $fetchedTimeslots = [];
        $allTimeslots = [];
        $occupiedTimeslots = [];

        foreach ($opdTimeslots as $slot) {
            $day = $slot['day'];
            if (in_array($day, $remainingDays)) {
                // Calculate the date for the day
                $date = clone $currentDate;
                $daysToAdd = (array_search($day, $weekdays) - array_search($currentDay, $weekdays) + 7) % 7;
                $date->modify("+$daysToAdd days");

                // Format the timeslot string
                $daySuffix = date('jS', $date->getTimestamp()); // Get the day with the suffix (e.g., 6th, 23rd)
                $monthYear = $date->format('M Y'); // Format to "Dec 2024"
                $timeslotStr = $daySuffix . " " . $monthYear . "\n" . substr($day, 0, 3) . " " . $slot['from_time'] . " - " . $slot['to_time'];

                // Add to `allTimeslots`
                $allTimeslots[] = $timeslotStr;

                // Check if this timeslot is occupied
                if (in_array($slot['timeslot_id'], $occupiedTimeslotIDs)) {
                    $occupiedTimeslots[] = $timeslotStr;
                }

                // Check if this timeslot is fetched for the current doctor
                if (in_array($slot['timeslot_id'], $doctorAvailabilityIds)) {
                    $fetchedTimeslots[] = $timeslotStr;
                }
            }
        }

        // Pass data to the view
        $data = [
            'fetchedTimeslots' => $fetchedTimeslots,
            'allTimeslots' => $allTimeslots,
            'occupiedTimeslots' => $occupiedTimeslots // Pass formatted strings
        ];
        $this->view('drAvailability', $data);
    }
}
?>

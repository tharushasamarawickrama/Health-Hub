<?php

require_once APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
require_once APPROOT . '/libraries/PHPMailer/src/SMTP.php';
require_once APPROOT . '/libraries/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class PatientChannel {
    use Controller;

    public function index() {
        // Initialize models
        $appointment = new Appointment;
        $doctor = new Doctor;
        $user = new User;
        $schedule = new ScheduleTime;

        // Get user and doctor IDs from session
        $userId = $_SESSION['user']['user_id'];
        $doctorId = $_SESSION['appointment']['doctor_id'];

        // Fetch doctor and user details
        $arr['doctor_id'] = $doctorId;
        $arr1['user_id'] = $doctorId; // Assuming this is correct based on your logic
        $data = $doctor->first($arr);
        $data1 = $user->first($arr1);

        if ($data1) {
            $data = array_merge($data, $data1);
        }

        // Fetch schedule details
        $arr['schedule_id'] = $_SESSION['sch_id'];
        $scheduleData = $schedule->first($arr);

        if ($scheduleData) {
            $data = array_merge($data, $scheduleData);
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmbtn'])) {
            // Update filled slots in the schedule
            $data['filled_slots'] = $data['filled_slots'] + 1;
            $schedule->update($data['schedule_id'], $data, 'schedule_id');

            // Insert appointment data into the database
            $appointment->insert($_SESSION['appointment']);

            // Fetch the latest appointment data
            $appointmentdata = $appointment->getLastAppointmentByUserId($userId);
            $_SESSION['appo_id'] = $appointmentdata['appointment_id'];

            // Prepare email content
            $patientName = $_SESSION['appointment']['p_firstName'] . " " . $_SESSION['appointment']['p_lastName'];
            $nic = $_SESSION['appointment']['nic'];
            $phoneNumber = $_SESSION['appointment']['phoneNumber'];
            $email = $_SESSION['appointment']['email'];
            $doctorName = "Dr. " . $data['firstName'] . " " . $data['lastName'];
            $specialization = $data['specialization'];
            $slmcNo = $data['slmcNo'];
            $date = $data['date'];
            $time = $data['start_time'];
            $appointmentNo = $_SESSION['appointment']['appointment_No'];

            $emailBody = "
            <html>
            <body>
                <h1>Appointment Confirmation</h1>
                <p><strong>Patient's Name:</strong> $patientName</p>
                <p><strong>NIC:</strong> $nic</p>
                <p><strong>Phone Number:</strong> $phoneNumber</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Doctor's Name:</strong> $doctorName</p>
                <p><strong>Specialization:</strong> $specialization</p>
                <p><strong>SLMC NO:</strong> $slmcNo</p>
                <p><strong>Session Date:</strong> $date</p>
                <p><strong>Session Time:</strong> $time</p>
                <p><strong>Appointment No:</strong> $appointmentNo</p>
            </body>
            </html>
            ";

            // Send confirmation email
            if ($this->sendEmail($email, "Appointment Confirmation", $emailBody)) {
                echo "Email sent successfully!";
                echo $emailBody;
            } else {
                echo "Failed to send email.";
            }

            // Redirect to payment details page
            redirect('patientpaymentdetails');
        }

        // Render the view
        $this->view('PatientChannel', $data);
    }

    /**
     * Sends an email using PHPMailer
     *
     * @param string $to Recipient email address
     * @param string $subject Email subject
     * @param string $message Email body (HTML)
     * @return bool True if email is sent successfully, false otherwise
     */
    private function sendEmail($to, $subject, $message) {
        // require 'vendor/autoload.php'; // Load PHPMailer
        include 'http://localhost/Health-Hub/vendor/autoload.php';


        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'akh8130@gmail.com'; // Replace with your email
            $mail->Password   = 'doun vgzr dpfj rhal'; // Replace with your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('akh8130@gmail.com', 'healthhub'); // Replace with your app name
            $mail->addAddress($to); // Add recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}
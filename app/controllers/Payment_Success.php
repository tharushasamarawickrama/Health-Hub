<?php


require_once APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
require_once APPROOT . '/libraries/PHPMailer/src/SMTP.php';
require_once APPROOT . '/libraries/PHPMailer/src/Exception.php';

// include 'http://localhost:8081/Health-Hub/vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Payment_Success {
    use Controller;

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
    public function index(){

        

        // Initialize models
        $appointment = new Appointment;
        $doctor = new Doctor;
        $user = new User;
        $schedule = new ScheduleTime;

        // Get user and doctor IDs from session
        // $userId = $_SESSION['user']['user_id'];
        $appo_id = $_GET['appo_id'];
        $appo_data = $appointment->first(['appointment_id' => $appo_id]);
        $doctorId = $appo_data['doctor_id'];
        // $doctorId = $_SESSION['appointment']['doctor_id'];

        // Fetch doctor and user details
        $arr['doctor_id'] = $doctorId;
        $arr1['user_id'] = $doctorId; // Assuming this is correct based on your logic
        $data = $doctor->first($arr);
        $data1 = $user->first($arr1);

        if ($data1) {
            $data = array_merge($data, $data1);
        }

        // Fetch schedule details
        // $arr['schedule_id'] = $_SESSION['sch_id'];
        $arr['schedule_id'] = $appo_data['schedule_id'];
        $scheduleData = $schedule->first($arr);

        if ($scheduleData) {
            $data = array_merge($data, $scheduleData);
        }

        // show($scheduleData);
        // $appo_id = $_SESSION['appo_id'];
        // $appointmentdata = $appointment->first(['appointment_id' => $appo_id]);
        $arr['payment_status'] = 'paid';
        $appointment->update($appo_id, $arr, 'appointment_id');
        
        // Prepare email content
        // $patientName = $_SESSION['appointment']['p_firstName'] . " " . $_SESSION['appointment']['p_lastName'];
        // $nic = $_SESSION['appointment']['nic'];
        // $phoneNumber = $_SESSION['appointment']['phoneNumber'];
        // $email = $_SESSION['appointment']['email'];
        // $doctorName = "Dr. " . $data['firstName'] . " " . $data['lastName'];
        // $specialization = $data['specialization'];
        // $slmcNo = $data['slmcNo'];
        // $date = $data['date'];
        // $time = $data['start_time'];
        // $appointmentNo = $_SESSION['appointment']['appointment_No'];

        $appointmentId = $appo_id;
        $patientName = $appo_data['p_firstName'] . " " . $appo_data['p_lastName'];
        $nic = $appo_data['nic'];
        $phoneNumber = $appo_data['phoneNumber'];
        $email = $appo_data['email'];
        $doctorName = "Dr. " . $data['firstName'] . " " . $data['lastName'];
        $specialization = $data['specialization'];
        $slmcNo = $data['slmcNo'];
        $date = date('l, j F Y', strtotime($appo_data['appointment_date']));
        $time = $data['start_time'];
        $appointmentNo = $appo_data['appointment_No'];

        $emailBody = "
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Appointment Confirmation</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }
    .email-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .header {
        background-color: #007bff;
        color: #ffffff;
        text-align: center;
        padding: 20px;
    }
    .header h1 {
        margin: 0;
        font-size: 24px;
    }
    .content {
        padding: 20px;
    }
    .content p {
        margin: 10px 0;
        line-height: 1.6;
    }
    .content strong {
        color: #333333;
    }
    .footer {
        background-color: #f4f4f9;
        text-align: center;
        padding: 15px;
        font-size: 12px;
        color: #666666;
    }
    .footer a {
        color: #007bff;
        text-decoration: none;
    }
    .footer a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
<div class='email-container'>
    <!-- Header -->
    <div class='header'>
        <h1>Appointment Confirmation</h1>
    </div>

    <!-- Content -->
    <div class='content'>
        <p>Dear $patientName,</p>
        <p>Thank you for booking an appointment with us. Below are the details of your appointment:</p>
        <p><strong>Appointment ID:</strong> $appointmentId</p>
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
        <p>If you have any questions or need to reschedule, please contact us at <a href='mailto:support@healthhub.com'>support@healthhub.com</a>.</p>
    </div>

    <!-- Footer -->
    <div class='footer'>
        <p>&copy; 2023 HealthHub. All rights reserved.</p>
        <p><a href='https://healthhub.com'>Visit our website</a> | <a href='https://healthhub.com/privacy-policy'>Privacy Policy</a></p>
    </div>
</div>
</body>
</html>
";

        // Send confirmation email
        if ($this->sendEmail($email, "Appointment Confirmation", $emailBody)) {
            // echo "Email sent successfully!";
            
        } else {
            // echo "Failed to send email.";
        }

        // Redirect to payment details page
    

        $this->view('payment_success');
    }

     

    
    
}




<?php

class PatientRegister
{
    use Controller;

    public function index()
    {
        $data = [];
        $userrole = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['login'])) {
                // Login logic
                $user = new User;
                $arr['Email'] = $_POST['logEmail'] ?? '';
                $row = $user->first($arr);

                if (!$row) {
                    $user->errors['Email'] = "Invalid Email or Password";
                    $data['errors'] = $user->errors;
                    $this->view('patientregister', $data);
                    exit();
                } else {
                    $userrole = $row['user_role'];
                    $data['userrole'] = $userrole;
                }

                switch ($userrole) {
                    case "patient":
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('home'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    // Other user roles...
                    case "doctor":
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('drDashboard'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case "admin":
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('AdminDashboard'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case "labassistant":
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('labdashboard'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case "receptionist":
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('ReDashboard'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case 'pharmacist':
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('phdashboard'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    default:
                        $user->errors['Email'] = "Invalid Email or Password";
                        $data['errors'] = $user->errors;
                        $this->view('patientregister', $data);
                        break;
                }
            }if (isset($_POST['sendOtp'])) {
                echo "Forgot Password logic triggered";
                // Forgot Password logic with PHPMailer
                $email = $_POST['email'] ?? '';

                if (empty($email)) {
                    $data['error'] = "Email is required.";
                    $this->view('patientregister', $data);
                    return;
                }

                $user = new User();
                $row = $user->first(['Email' => $email]);
                $_SESSION['fpid'] = $row['user_id'];

                if (!$row) {
                    $data['error'] = "Email not found.";
                    $this->view('patientregister', $data);
                    return;
                }

                // Generate OTP
                $otp = rand(100000, 999999);

                // Save OTP in the session or database
                $_SESSION['otp'] = $otp;
                $_SESSION['otp_email'] = $email;
                $_SESSION['otp_time'] = time(); // For expiry checking

                // Send OTP using PHPMailer
                require_once APPROOT . '/libraries/PHPMailer/src/Exception.php';
                require_once APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
                require_once APPROOT . '/libraries/PHPMailer/src/SMTP.php';

                $mail = new PHPMailer\PHPMailer\PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';  // Change to your SMTP host
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'akh8130@gmail.com';  // Change to your email
                    $mail->Password   = 'tozb ptde lwrx psll';     // App password for Gmail
                    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    //Recipients
                    $mail->setFrom('your-email@gmail.com', 'HealthHub');
                    $mail->addAddress($email);

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = "Your OTP for Password Reset";
                    $mail->Body    = "
                        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 5px;'>
                            <div style='text-align: center; padding: 10px; background-color: #3498db; color: white; border-radius: 5px 5px 0 0;'>
                                <h1>HealthHub Password Reset</h1>
                            </div>
                            <div style='padding: 20px; background-color: #f9f9f9;'>
                                <p>Dear User,</p>
                                <p>You have requested to reset your password. Please use the following OTP to complete the process:</p>
                                <div style='text-align: center; padding: 15px; margin: 20px 0; background-color: #eeeeee; font-size: 24px; font-weight: bold; letter-spacing: 5px;'>
                                    $otp
                                </div>
                                <p>This OTP will expire in 10 minutes for security reasons.</p>
                                <p>If you did not request this password reset, please ignore this email.</p>
                                <p>Best regards,<br>The HealthHub Team</p>
                            </div>
                            <div style='text-align: center; padding: 10px; font-size: 12px; color: #777;'>
                                <p>This is an automated email. Please do not reply.</p>
                            </div>
                        </div>
                    ";
                    $mail->AltBody = "Your OTP for password reset is: $otp";

                    $mail->send();
                    $data['send'] = true;
                } catch (Exception $e) {
                    $data['error'] = "Failed to send OTP. Error: {$mail->ErrorInfo}";
                }

                $this->view('patientregister', $data);
            }if (isset($_POST['verifyOTP'])) {
                // Verify OTP logic
                $enteredOTP = $_POST['otp'] ?? '';
                
                // Check if OTP session exists
                if (!isset($_SESSION['otp']) || !isset($_SESSION['otp_email'])) {
                    $data['error'] = "OTP session expired. Please request a new OTP.";
                    $data['send'] = true;
                    $this->view('patientregister', $data);
                    return;
                }
                
                // Check if OTP has expired (10 minutes)
                if (time() - $_SESSION['otp_time'] > 600) {
                    $data['error'] = "OTP has expired. Please request a new OTP.";
                    unset($_SESSION['otp']);
                    unset($_SESSION['otp_email']);
                    unset($_SESSION['otp_time']);
                    $data['send'] = true;
                    $this->view('patientregister', $data);
                    return;
                }
                
                // Verify OTP
                if ($_SESSION['otp'] != $enteredOTP) {
                    $data['error'] = "Invalid OTP. Please try again.";
                    $data['send'] = true;
                    $this->view('patientregister', $data);
                    return;
                }
                
                // OTP is valid, mark as verified
                $_SESSION['otp_verified'] = true;
                $data['otp_verified'] = true;
                $data['send'] = true;
                // $data['check'] = true;
                $data['success'] = "OTP verified successfully. Please set your new password.";
                
                $this->view('patientregister', $data);
            }if (isset($_POST['resetPassword'])) {
                // Reset password logic
                $data['check'] = true;
                $data['reset'] = true;
                // Check if OTP verification was completed
                if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
                    $data['error'] = "Please verify your OTP first.";
                    $this->view('patientregister', $data);
                    return;
                }
                
                $newPassword = $_POST['newPassword'] ?? '';
                $confirmPassword = $_POST['confirmPassword'] ?? '';
                
                // Validate passwords
                if (empty($newPassword) || empty($confirmPassword)) {
                    $data['error'] = "Both password fields are required.";
                    $this->view('patientregister', $data);
                    return;
                }
                
                if ($newPassword !== $confirmPassword) {
                    $data['error'] = "Passwords do not match.";
                    $data['send'] = true;
                    $data['otp_verified'] = true;
                    $this->view('patientregister', $data);
                    return;
                }
                
                // Update password in the database
                $user = new User();
                $email = $_SESSION['otp_email'];
                $fpid = $_SESSION['fpid'];
                
                // Here, we would ideally hash the password, but following your existing pattern
                // Important: In a production environment, passwords should always be hashed!
                $user->update($fpid,['password' => $newPassword], 'user_id');
                
                // Mark password reset as successful
                $_SESSION['password_reset_success'] = true;
                $data['send'] = true;
                $data['check'] = false;
                $data['otp_verified'] = false;
                $data['reset'] = false;
                // Clear OTP session variables
                unset($_SESSION['otp']);
                unset($_SESSION['otp_email']);
                unset($_SESSION['otp_time']);
                unset($_SESSION['otp_verified']);
                unset($_SESSION['fpid']);
                
                $data['success'] = "Password reset successful!";
                $data['show_success_only'] = true;
                $this->view('patientregister', $data);
            }else {
                // Registration logic
                $user = new User;
                $patient = new Patient;
                $data = [
                    'Title' => $_POST['Title'] ?? '',
                    'FirstName' => $_POST['FirstName'] ?? '',
                    'LastName' => $_POST['LastName'] ?? '',
                    'Email' => $_POST['Email'] ?? '',
                    'PhoneNumber' => $_POST['PhoneNumber'] ?? '',
                    'NIC' => $_POST['NIC'] ?? '',
                    'Gender' => $_POST['gender'] ?? '',
                    'Password' => $_POST['Password'], // Should hash password (see security note below)
                    'Address' => $_POST['Address'] ?? '',
                    'Age' => $_POST['Age'] ?? '',
                    'user_role' => 'patient'
                ];

                $arr['Email'] = $_POST['Email'] ?? '';
                $row = $user->first($arr);

                if ($row) {
                    $user->errors['Email'] = "Email already exists, please login";
                    $data['errors'] = $user->errors;
                } else {
                    $user->insert($data);
                    $login = $user->first($arr);
                    $patientData = ['patient_id' => $login['user_id']];
                    $patient->insert($patientData);
                    $data['registration_success'] = true; // Set the success flag
                }

                $this->view('patientregister', $data);
            }
        } else {
            $this->view('patientregister', $data);
        }
    }
}
<?php

// Start the session to enable session management
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION['user'] = $_SESSION['user'] ?? null;
}

// Logout functionality
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Unset all of the session variables
    unset($_SESSION['user']);
    unset($_SESSION['appointment_date']);
    // Destroy the session
    session_destroy();

    // Redirect to the login page or homepage
    // header("Location: " . URLROOT . "/Prevlog");
    redirect('/Prevlog');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/components/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/homepage.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/components/doctorcard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/appoinment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/channel.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/components/timeslot.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/setappoinment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/searchappoinment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/Patientpaymentdetails.css">

    <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/home.css"> -->

    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/patientregister.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/Patientprofile.css">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/admindashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/drDashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/fonts.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/drViewAppointments.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/components/drNavbar.css?v=<?php echo time(); ?>">

    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/components/AdminNavbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/AdminDrRegister.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/ViewAllProfile.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/Profiledetails.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/PrevLog.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Ewert&family=Protest+Guerrilla&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/DrProfiledetails.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/PatientChannel.css">



    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/phdashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/phprescriptions.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/phprocessedprescriptions.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/phdailyusage.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/phprescriptionappointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/components/phnavbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/phprocessedappointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/phusagedate.css">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/labprescriptionappointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/components/labnavbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/labprescriptions.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/labprocessedappointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/labprocessedprescriptions.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/labpendingprescriptions.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/labpendingappointment.css">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/components/renavbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/redashboard.css">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/rechannel.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/rescheduleappointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/reappointmentdetails.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/pages/repaymentdetails.css">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/drDashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/fonts.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/drViewAppointments.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/drProfile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/drMedicalHistory.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/drPrescription.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/drLabTests.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/drAvailability.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/drAppointment.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/drAvailability2.css?v=<?php echo time(); ?>">

</head>

<body>

<?php
// Start the session to enable session management
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Logout functionality
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or homepage
    header("Location: " . URLROOT . "/patientregister?id=2");
    exit; // Ensure no further code is executed after redirect
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Hub</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/fonts.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/components/drNavbar.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="drNavbar">
    <a href="#">
        <img src="<?php echo URLROOT;?>/assets/images/12345.png"  class="drlogo">
    </a>
    
    <a href="#" class="drNavitems">Dashboard</a>
    <a href="#" class="drNavitems">Update Availability</a>
    <a href="#" class="drNavitems">View Appointments</a>

    <?php if(isset($_SESSION['user'])): ?>
        <a href="#" class="logname dropdown-toggle">
        
        <img src="<?php echo URLROOT . '/' . htmlspecialchars($_SESSION['user']['photo_path']); ?>"  class="loginlogo">
    </a> 
    <?php else: ?>
        <img src="<?php echo URLROOT;?>/assets/images/loginlogo.jpg"  class="drloginlogo"> 
    <?php endif; ?>
    <?php if (isset($_SESSION['user'])): ?>
        <!-- User dropdown -->
        <div class="dropdown">
            <p class="username"><?php echo htmlspecialchars($_SESSION['user']['firstName']); ?></p>
            <div class="dropdown-content">
                <a href="<?php echo URLROOT; ?>doctorprofile">Profile</a>
                <a href="?action=logout">Logout</a>
            </div>
        </div>
    <?php else: ?>
    <a href="<?php echo URLROOT; ?>/patientregister" class="drlogin">Login</a>
    <?php endif; ?>
</div>

</body>
</html>
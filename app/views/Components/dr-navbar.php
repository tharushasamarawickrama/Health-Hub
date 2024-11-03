<?php
if (!defined('URLROOT')) {
    define('URLROOT', 'http://localhost/healthHub');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Hub</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/fonts.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/components/dr-navbar.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="Navbar">
    <a href="#">
        <img src="<?php echo URLROOT;?>/public/assets/images/12345.png"  class="logo">
    </a>
    
    <a href="#" class="navitems">Dashboard</a>
    <a href="#" class="navitems">Update Availability</a>
    <a href="#" class="navitems">View Appointments</a>

    <a href="#">
        <img src="<?php echo URLROOT;?>/public/assets/images/loginlogo.jpg"  class="loginlogo">
    </a>
    <a href="#" class="login">Login</a>
</div>

</body>
</html>

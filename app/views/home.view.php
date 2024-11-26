<?php require APPROOT . '/views/Components/header.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>./assets/css/pages/home.css">
</head>

<body class="body">
    <div class="Navbar">
        <a href="#">
            <img src="<?php echo URLROOT; ?>/assets/images/logohealth.png" class="logo">
        </a>

        <a href="#" class="navitems">Home</a>
        <a href="#" class="navitems">About</a>
        <a href="#" class="navitems">Contact</a>

        <?php if (isset($_SESSION['user'])): ?>
            <a href="#" class="logname dropdown-toggle">

                <img src="<?php echo URLROOT . '/' . htmlspecialchars($_SESSION['user']['ProfilePic']); ?>" class="loginlogo">
            </a>
        <?php else: ?>
            <img src="<?php echo URLROOT; ?>/assets/images/loginlogo.jpg" class="loginlogo">
        <?php endif; ?>
        <?php if (isset($_SESSION['user'])): ?>
            <!-- User dropdown -->
            <div class="dropdown">


                <p class="username"><?php echo htmlspecialchars($_SESSION['user']['FirstName']); ?></p>

                <div class="dropdown-content">
                    <a href="<?php echo URLROOT; ?>patientprofile">Profile</a>
                    <a href="?action=logout">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <!-- Show "Login" link if no user is logged in -->
            <a href="<?php echo URLROOT; ?>/Prevlog" class="login">Login</a>
        <?php endif; ?>
    </div>

    <div class="home-parent">
        <div class="home-child1">
            <img src="<?php echo URLROOT; ?>/assets/images/image 37.svg" class="home-image">
            <div class="headline">
                <h1 class="headline-h1">“Empowering Your Health, One Click at a Time”</h1>
                <button class="headline-button">Make An Appointment</button>
            </div>
        </div>

        <div class="home-child2">
            <h1 class="home-child2-h1">Welcome to Health HUB</h1>
            <p class="home-child2-p1">
                Health Hub brings quality healthcare to your fingertips. Connect with certified medical professionals, schedule appointments, access digital health records, and more—all in one secure platform. Our mission is to make healthcare accessible, efficient, and reliable.
            </p>
            <h1 class="home-child2-h2">Our Doctors...</h1>
            <div class="home-child2-subdiv">
                <div>
                    <p class="home-child2-p2">
                        Compassionate, skilled, and dedicated to your well-being. Our doctors bring expertise and care to every patient interaction, ensuring you feel supported and valued.
                    </p>
                </div>
                <div class="home-child2-img-div">
                    <img src="<?php echo URLROOT; ?>/assets/images/image 43.png" class="home-child2-image">
                </div>
            </div>
        </div>
        <div class="home-child3">

        </div>

    </div>

</body>

</html>
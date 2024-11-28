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

        <a href="<?php echo URLROOT; ?>home" class="navitems">Home</a>
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
                <a href="<?php if (isset($_SESSION['user'])): ?> <?php echo URLROOT; ?>searchappoinment <?php else: ?> <?php echo URLROOT; ?>Prevlog <?php endif; ?>">
                    <button class=" headline-button">Make An Appointment</button>
                </a>

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
            <div>
                <div class="home-child3-subdiv">
                    <div class="home-child3-div1">
                        <div class="home-child3-div1-1">
                            <img src="<?php echo URLROOT; ?>assets/images/mach.png">

                        </div>

                    </div>

                    <div class="home-child3-div1">
                        <div class="home-child3-div1-1">
                            <img src="<?php echo URLROOT; ?>assets/images/healthrecord.png">
                        </div>
                    </div>
                </div>
            </div>
            <div class="asdf">
                <div>
                    <h1 class="home-child3-subdiv-h1">Specialized Care Matching</h1>
                    <p class="home-child3-subdiv-p">Find the right specialist based on your<br>unique needs for the best<br> personalized care.</p>
                </div>
                <div>
                    <h1 class="home-child3-subdiv-h1">Personalized Health Records</h1>
                    <p class="home-child3-subdiv-p">Secure, organized, and accessible— <br>your medical history, prescriptions,<br> and test results in one place.</p>
                </div>
            </div>
            <h1 class="ourservices">Our Services...</h1>
            <div class="asdf">
                <div>
                    <div class="home-child3-div1">
                        <div class="home-child3-div1-1">
                            <img src="<?php echo URLROOT; ?>assets/images/appointmentbook.png">
                        </div>
                    </div>
                    <h1 class="home-child3-subdiv-h1">Easy Appointment Booking</h1>
                    <p class="home-child3-subdiv-p">Seamlessly schedule, manage,<br> and track your appointments with <br>just a few clicks.</p>
                </div>

                <div>
                    <div class="home-child3-div1">
                        <div class="home-child3-div1-1">
                            <img src="<?php echo URLROOT; ?>assets/images/labreport.png">
                        </div>
                    </div>
                    <h1 class="home-child3-subdiv-h1">Digital Prescriptions<br> & Lab Reports</h1>
                    <p class="home-child3-subdiv-p">Receive prescriptions and lab results<br> directly on your device—no more<br> paperwork.</p>
                </div>
            </div>


        </div>
        <div class="home-child4">
            <h1 class="home-child4-h1">Get in Touch With Us</h1>
            <p class="home-child4-p">We're here to help! Reach out with any questions, feedback, or support needs. Our<br> dedicated team is available to provide assistance and ensure a smooth experience on<br> Health Hub.</p>
            <div class="home-child4-div1">
                <div class="home-child4-div2">
                    <img src="<?php echo URLROOT; ?>/assets/images/call.png" class="home-child4-image1">
                    <h3>011-2242312</h3>
                </div>

            </div>
            <div class="home-child4-div1">
                <div class="home-child4-div2">
                    <img src="<?php echo URLROOT; ?>/assets/images/email.png" class="home-child4-image1">
                    <h3>healthhub@gmail.com</h3>
                </div>

            </div>
            <div class="home-child4-div1">
                <div class="home-child4-div2">
                    <img src="<?php echo URLROOT; ?>/assets/images/location.png" class="home-child4-image1">
                    <h3>No.14, Inner Flower Road, Colombo.</h3>
                </div>

            </div>
        </div>
        <div class="home-child5">
            <div class="home-child5-div1">
                <img src="<?php echo URLROOT; ?>/assets/images/socialmedia.png" class="home-child5-image">

            </div>
            <div class="home-child5-div2">
                <h2 class="">
                    2024 HealthHub All Rights Reserved.
                </h2>
            </div>

        </div>

    </div>

</body>

</html>
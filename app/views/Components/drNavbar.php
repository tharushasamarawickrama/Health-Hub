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
    
    <a href="<?php echo URLROOT;?>/drDashboard" class="drNavitems">Dashboard</a>
    <a href="<?php echo URLROOT;?>/drAvailability" class="drNavitems">Update Availability</a>
    <a href="<?php echo URLROOT;?>/drViewAppointments" class="drNavitems">View Appointments</a>

    <div class="dr-profile-dropdown">
        <a onclick="toggleDropdown()" class="dr-profile-link">
            <img src="<?php echo URLROOT;?>/assets/images/loginlogo.jpg"  class="drloginlogo">
            <span class="drlogin">Login</span>
        </a>
        <div id="drDropdownMenu" class="dr-dropdown-content">
            <a href="<?php echo URLROOT;?>/drProfile">View Profile</a>
            <a href="#">Logout</a>
        </div>
    </div>
</div>

<script>
    function toggleDropdown() {
        document.getElementById("drDropdownMenu").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dr-profile-link') && !event.target.matches('.drloginlogo') && !event.target.matches('.drlogin')) {
            var dropdowns = document.getElementsByClassName("dr-dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>

</body>
</html>

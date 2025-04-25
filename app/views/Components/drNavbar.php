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

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Unset all of the session variables
    unset($_SESSION['user']);
    //unset($_SESSION['appointment_date']);
    // Destroy the session
    session_destroy();

    // Redirect to the login page or homepage
    // header("Location: " . URLROOT . "/Prevlog");
    redirect('/patientregister');
}
?>

<div class="drNavbar">
    <a href="<?php echo URLROOT; ?>Home">
        <img src="<?php echo URLROOT; ?>assets/images/logohealth.png"  class="drlogo">
    </a>

    <?php
        $current_page = basename($_SERVER['REQUEST_URI']);
    ?>

    <a href="<?php echo URLROOT; ?>drDashboard" class="drNavitems <?php echo strpos($current_page, 'drDashboard') === 0 ? 'active' : ''; ?>">Dashboard</a>
    <a href="<?php echo URLROOT; ?>drSchedules" 
        class="drNavitems <?php echo preg_match(
            '/^dr(Schedules|Availability|Availability2)/', 
            $current_page
        ) ? 'active' : ''; ?>">
        Schedules
        </a>
    <a href="<?php echo URLROOT; ?>drViewAppointments" 
        class="drNavitems <?php echo preg_match(
            '/^dr(ViewAppointments|Appointment|Prescription|EditPrescription|MedicalHistory|LabTests)/', 
            $current_page
        ) ? 'active' : ''; ?>">
        View Appointments
        </a>

    <div class="dr-profile-dropdown">
        <a onclick="toggleDropdown()" class="dr-profile-link">
            <?php if(isset($_SESSION['user'])): ?>
                <img 
                src="<?php echo URLROOT; ?>assets/<?php echo !empty($_SESSION['user']['photo_path']) ? htmlspecialchars($_SESSION['user']['photo_path']) : 'images/doctor.png'; ?>" 
                class="drloginlogo"
                >
                <span class="drlogin"><?php echo htmlspecialchars($_SESSION['user']['firstName']); ?></span>
            <?php else: ?>
                <img src="<?php echo URLROOT; ?>assets/images/loginlogo.jpg"  class="drloginlogo">
                <span class="drlogin">Login</span>
            <?php endif; ?>  
        </a>
        <div id="drDropdownMenu" class="dr-dropdown-content">
            <a href="<?php echo URLROOT;?>drProfile">View Profile</a>
            <a href="?action=logout">Logout</a>
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

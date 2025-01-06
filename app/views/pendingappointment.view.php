<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>

<div class="pt-pending-maindiv">
    <div class="pt-pending-div1">
        <p class="pt-pending-div1-h1 pt-thick-underline">Pending Appointments</p>
    </div>
    <div class="pt-pending-div1">
        <p class="pt-pending-div1-h1">Past Appointments</p>
    </div>
</div>

<?php
// Get the current date
$currentDate = new DateTime();
?>

<!-- Pending Appointments Section -->
<div id="pending-appointments-section">
    <?php foreach ($appointments as $appointment): ?>
        <?php
        // Convert the appointment date from string to DateTime object
        $appointmentDate = new DateTime($appointment['appointment']['appointment_date']);
        
        // Check if current date is greater than the appointment date (for pending appointments)
        if ( $currentDate < $appointmentDate): ?>
            <div class="pt-pending-div2-main">
                <div class="pt-pending-div2">
                    <span class="pt-pending-span">Dr.<?php echo $appointment['user']['firstName'] . ' ' . $appointment['user']['lastName']; ?></span>
                    <span class="pt-pending-span"><?php echo $appointment['doctor']['specialization']; ?></span>
                    <span class="pt-pending-span"><?php echo $appointment['appointment']['appointment_date']; ?></span>
                    <button class="pt-pending-button">View</button>
                    <button class="pt-pending-button">Cancel</button>
                    <div class="pt-pending-div2-upload">
                        <button class="pt-pending-button2">Upload Document</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<!-- Past Appointments Section -->
<div id="past-appointments-section" style="display: none;">
    <?php foreach ($appointments as $appointment): ?>
        <?php
        // Convert the appointment date from string to DateTime object
        $appointmentDate = new DateTime($appointment['appointment']['appointment_date']);
        
        // Check if current date is greater than the appointment date (for past appointments)
        if ( $currentDate > $appointmentDate): ?>
            <div class="pt-pending-div3-main">
                <div class="pt-pending-div2">
                    <span class="pt-pending-span">Dr.<?php echo $appointment['user']['firstName'] . ' ' . $appointment['user']['lastName']; ?></span>
                    <span class="pt-pending-span"><?php echo $appointment['doctor']['specialization']; ?></span>
                    <span class="pt-pending-span"><?php echo $appointment['appointment']['appointment_date']; ?></span>
                    <button class="pt-pending-button">View</button>
                    <div class="pt-pending-div2-upload">
                        <button class="pt-pending-button2">Upload Document</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sections = document.querySelectorAll(".pt-pending-div1");
        const pendingSection = document.getElementById("pending-appointments-section");
        const pastSection = document.getElementById("past-appointments-section");

        // Default visibility
        pendingSection.style.display = "block";
        pastSection.style.display = "none";

        sections.forEach((section) => {
            section.addEventListener("click", function () {
                // Remove thick underline from all sections
                sections.forEach((sec) => {
                    sec.querySelector(".pt-pending-div1-h1").classList.remove("pt-thick-underline");
                });

                // Add thick underline to the clicked section
                this.querySelector(".pt-pending-div1-h1").classList.add("pt-thick-underline");

                // Show or hide content based on clicked section
                if (this.querySelector(".pt-pending-div1-h1").textContent.trim() === "Pending Appointments") {
                    pendingSection.style.display = "block";
                    pastSection.style.display = "none";
                } else if (this.querySelector(".pt-pending-div1-h1").textContent.trim() === "Past Appointments") {
                    pendingSection.style.display = "none";
                    pastSection.style.display = "block";
                }
            });
        });
    });
</script>

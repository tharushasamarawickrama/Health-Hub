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
        
        // Check if the appointment status is 'pending' or 'paid'
        $appointmentStatus = $appointment['appointment']['status'];
        
        // Display appointments only if the current date is less than the appointment date
        if ($currentDate < $appointmentDate): ?>
            <div class="pt-pending-div2-main">
                <div class="pt-pending-div2">
                    <span class="pt-pending-span">Dr.<?php echo $appointment['user']['firstName'] . ' ' . $appointment['user']['lastName']; ?></span>
                    <span class="pt-pending-span"><?php echo $appointment['doctor']['specialization']; ?></span>
                    <span class="pt-pending-span"><?php echo $appointment['appointment']['appointment_date']; ?></span>
                    
                    <?php if ($appointmentStatus === 'pending'): ?>
                        <button class="pt-pending-button">Pay</button>
                        
                            <button class="pt-pending-button" onclick="showDeleteModal()">Cancel</button>
                        
                    <?php elseif ($appointmentStatus === 'paid'): ?>
                        <button class="pt-pending-button">View</button>
                        <a href="?appointment_id=<?php echo $appointment['appointment']['appointment_id']; ?>">
                            <button class="pt-pending-button">Cancel</button>
                        </a>
                        <div class="pt-pending-div2-upload">
                            <button class="pt-pending-button2">Upload Document</button>
                        </div>
                    <?php endif; ?>
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
        $app_id = $appointment['appointment']['appointment_id'];
        
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

<div id="deleteconfirmation-modal" class="updatemodal" style="display: none;">
    <div class="updatemodal-content">
        <h2>Are you sure?</h2>
        <p>Do you really want to delete this appointment? This process cannot be undone.</p>
        <div class="updatemodal-buttons">
            <button onclick="confirmDelete(event)" class="updateyes-btn">Yes</button>
            <button onclick="closeModal()" class="updateno-btn">No</button>
        </div>
    </div>
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

    function showDeleteModal() {
        const modal = document.getElementById('deleteconfirmation-modal');
        modal.style.display = 'flex';
    }

    // Close the modal
    function closeModal() {
        const modal = document.getElementById('deleteconfirmation-modal');
        modal.style.display = 'none';
    }

    // Handle "Yes" button click
    function confirmDelete(event) {
        closeModal();
        // window.location.href='<?php echo URLROOT; ?>pendingappointment?app_id=<?php echo $app_id; ?>' // Close the modal first

        // Perform delete logic here
        console.log('Appointment deleted successfully!');
        // Optionally, redirect or refresh the page
    }
</script>

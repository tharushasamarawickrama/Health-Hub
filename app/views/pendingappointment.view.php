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
<script>
    // Pass all appointment data to the frontend as a JavaScript object
    const appointmentsData = <?php echo json_encode($appointments); ?>;
</script>
<!-- Pending Appointments Section -->
<div id="pending-appointments-section">
    <?php if (!$appointments): ?>
        <span class="pendingpastnoappo">No Pending Appointments yet</span>
    <?php endif; ?>
    <?php foreach ($appointments as $appointment): ?>
        <?php
        // Convert the appointment date from string to DateTime object
        $appointmentDate = new DateTime($appointment['appointment']['appointment_date']);

        // Check if the appointment status is 'pending' or 'paid'
        $appointmentStatus = $appointment['appointment']['payment_status'];

        // Display appointments only if the current date is less than the appointment date
        if ($currentDate < $appointmentDate && $appointmentStatus == 'paid'): ?>
            <div class="pt-pending-div2-main">
                <div class="pt-pending-div2">
                    <span class="pt-pending-span">Dr.<?php echo $appointment['user']['firstName'] . ' ' . $appointment['user']['lastName']; ?></span>
                    <span class="pt-pending-span"><?php echo $appointment['doctor']['specialization']; ?></span>
                    <span class="pt-pending-span"><?php echo $appointment['appointment']['appointment_date']; ?></span>
                    <button
                        class="pt-pending-button view-btn"
                        data-appointment-id="<?php echo $appointment['appointment']['appointment_id']; ?>">View</button>
                    <button
                        class="pt-pending-button cancel-btn"
                        data-appointment-id="<?php echo $appointment['appointment']['appointment_id']; ?>">
                        Cancel
                    </button>

                    <!-- <div class="pt-pending-div2-upload">
                        <button class="pt-pending-button">Upload Document</button>
                    </div> -->
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>


<!-- Past Appointments Section -->
<div id="past-appointments-section" style="display: none;">
    <?php if (!$appointments): ?>
        <span class="pendingpastnoappo">No Past Appointments yet</span>
    <?php endif; ?>
    <?php foreach ($appointments as $appointment): ?>
        <?php
        // Convert the appointment date from string to DateTime object
        $appointmentDate = new DateTime($appointment['appointment']['appointment_date']);
        $app_id = $appointment['appointment']['appointment_id'];

        // Check if current date is greater than the appointment date (for past appointments)
        if ($currentDate > $appointmentDate): ?>
            <div class="pt-pending-div3-main">
                <div class="pt-pending-div2">
                    <span class="pt-pending-span">Dr.<?php echo $appointment['user']['firstName'] . ' ' . $appointment['user']['lastName']; ?></span>
                    <span class="pt-pending-span"><?php echo $appointment['doctor']['specialization']; ?></span>
                    <span class="pt-pending-span"><?php echo $appointment['appointment']['appointment_date']; ?></span>
                    <button
                        class="pt-pending-button view-btn"
                        data-appointment-id="<?php echo $appointment['appointment']['appointment_id']; ?>">View</button>

                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<div id="deleteconfirmation-modal" class="pending-updatemodal" style="display: none;">
    <div class="pending-updatemodal-content">
        <h2>Are you sure?</h2>
        <p>Do you really want to cancel this appointment? This process cannot be undone.</p>
        <form id="delete-form" method="POST">
            
            <div class="pending-updatemodal-buttons">
                <button type="button" id="confirm-delete-btn" class="pending-updateyes-btn">Yes</button>
                <button type="button" onclick="closeModal()" class="pending-updateno-btn">No</button>
            </div>
        </form>
    </div>
</div>

<form action="" method="POST">
<div id="success-modal" class="pending-updatemodal" style="display: none;">
<input type="hidden" name="appointment_id" id="appointment-id-input" value="">
    <div class="pending-updatemodal-content">
    <h2>Appointment Cancelled</h2>
    <p>Your appointment fee is refunded within 24 hours.</p>
        <button type="submit" id="success-ok-btn" class="pending-updateyes-btn" name="confirm-ok">OK</button>
    </div>
</div>
</form>




<div id="details-modal" class="modal" style="display: none;">
    <div class="view-modal-content">
        <span class="close-btn" onclick="closeModalone()">&times;</span>
        <div class="modal-details">
            <h1>Channel Details</h1>
            <form method="POST">
                <div class="pending-view-div">
                    <span class="pending-view-span">Patient's Name :</span> <span id="modal-patient-name"></span>
                </div>
                <div class="pending-view-div">
                    <span class="pending-view-span">NIC :</span> <span id="modal-nic"></span>
                </div>
                <div class="pending-view-div">
                    <span class="pending-view-span">Phone Number :</span> <span id="modal-phone"></span>
                </div>
                <div class="pending-view-div">
                    <span class="pending-view-span">Email :</span> <span id="modal-email"></span>
                </div>
                <div class="pending-view-div">
                    <span class="pending-view-span">Doctor's Name : </span><span id="modal-doctor-name"></span>
                </div>
                <div class="pending-view-div">
                    <span class="pending-view-span">Specialization :</span> <span id="modal-specialization"></span>
                </div>
                <div class="pending-view-div">
                    <span class="pending-view-span">SLMC NO :</span> <span id="modal-slmc"></span>
                </div>
                <div class="pending-view-div">
                    <span class="pending-view-span">Session Date :</span> <span id="modal-session-date"></span>
                </div>
                <div class="pending-view-div">
                    <span class="pending-view-span">Session Time :</span> <span id="modal-session-time"></span>
                </div>
                <div class="pending-view-div">
                    <span class="pending-view-span">Appointment No :</span> <span id="modal-appointment-no"></span>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sections = document.querySelectorAll(".pt-pending-div1");
        const pendingSection = document.getElementById("pending-appointments-section");
        const pastSection = document.getElementById("past-appointments-section");

        // Default visibility
        pendingSection.style.display = "block";
        pastSection.style.display = "none";

        sections.forEach((section) => {
            section.addEventListener("click", function() {
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

    let selectedAppointmentId = null;

    document.addEventListener('DOMContentLoaded', () => {
        // Attach click event to all cancel buttons
        document.querySelectorAll('.cancel-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                // Get the appointment ID from the button's data attribute
                selectedAppointmentId = event.target.getAttribute('data-appointment-id');

                // Set the value of the hidden input field in the modal
                document.getElementById('appointment-id-input').value = selectedAppointmentId;

                // Show the confirmation modal
                showModal();
            });
        });

        // Handle "Yes" button click in the confirmation modal
        document.getElementById('confirm-delete-btn').addEventListener('click', (e) => {
            e.preventDefault(); // Prevent the default form submission

            // Simulate deletion logic
            deleteAppointment(selectedAppointmentId);

            // Close the confirmation modal
            closeModal();

            // Show the success modal
            showSuccessModal();
        });

        // Handle "OK" button click in the success modal
        document.getElementById('success-ok-btn').addEventListener('click', () => {
            closeSuccessModal();
        });
    });

    // Function to simulate appointment deletion
    function deleteAppointment(appointmentId) {
        // Find the appointment element and remove it from the DOM
        const appointmentElement = document.querySelector(`[data-appointment-id="${appointmentId}"]`).closest('.pt-pending-div2-main');
        if (appointmentElement) {
            appointmentElement.remove();
        }
        console.log(`Appointment with ID ${appointmentId} deleted.`);
    }

    // Show the confirmation modal
    function showModal() {
        const modal = document.getElementById('deleteconfirmation-modal');
        modal.style.display = 'flex';
    }

    // Close the confirmation modal
    function closeModal() {
        const modal = document.getElementById('deleteconfirmation-modal');
        modal.style.display = 'none';
        selectedAppointmentId = null; // Reset the selected appointment ID
    }

    // Show the success modal
    function showSuccessModal() {
        const modal = document.getElementById('success-modal');
        modal.style.display = 'flex';
    }

    // Close the success modal and refresh the page
    function closeSuccessModal() {
        const modal = document.getElementById('success-modal');
        modal.style.display = 'none';
        location.reload(); // Reload the page to update the appointments list
    }

    document.addEventListener("DOMContentLoaded", () => {
        // Add event listener to all "View" buttons
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                // Get the appointment ID from the button's data attribute
                const appointmentId = event.target.getAttribute('data-appointment-id');

                // Find the matching appointment from the JSON data
                const appointment = appointmentsData.find(app => app.appointment.appointment_id == appointmentId);

                if (appointment) {
                    // Populate modal details
                    document.getElementById('modal-patient-name').textContent = `${appointment.appointment.p_firstName} ${appointment.appointment.p_lastName}`;
                    document.getElementById('modal-nic').textContent = appointment.appointment.nic;
                    document.getElementById('modal-phone').textContent = appointment.appointment.phoneNumber;
                    document.getElementById('modal-email').textContent = appointment.appointment.email;
                    document.getElementById('modal-doctor-name').textContent = `Dr. ${appointment.user.firstName} ${appointment.user.lastName}`;
                    document.getElementById('modal-specialization').textContent = appointment.doctor.specialization;
                    document.getElementById('modal-slmc').textContent = appointment.doctor.slmcNo;
                    document.getElementById('modal-session-date').textContent = appointment.appointment.appointment_date;
                    document.getElementById('modal-session-time').textContent = appointment.appointment.appointment_time;
                    document.getElementById('modal-appointment-no').textContent = appointment.appointment.appointment_No;

                    // Show the modal
                    document.getElementById('details-modal').style.display = 'block';
                }
            });
        });
    });

    // Function to close the modal
    function closeModalone() {
        document.getElementById('details-modal').style.display = 'none';
    }
</script>
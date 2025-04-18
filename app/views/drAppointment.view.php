<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

?>
    <div class="dr-appointments-container">
        <a href="<?php echo URLROOT; ?>drViewAppointments" class="appointment-back-arrow"><img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back"></a>
        <div class="appointment-container">
            
            <div class="appointment-details">
                <h2>Appointment: <?php echo $data['id']; ?></h2>
                <p><strong>Patient Information:</strong></p>
                <ul>
                    <li>Full name - <?php echo $data['patient_name']; ?></li>
                    <li>Age/Gender - <?php echo $data['gender']; ?>/<?php echo $data['age']; ?></li>
                    <li>Contact Information</li>
                    <ul>
                        <li>Phone: <?php echo $data['phone']; ?></li>
                        <li>Email: <?php echo $data['email']; ?></li>
                    </ul>
                    <li>Medical History Overview</li>
                    <ul>
                        <li>Overview - <?php echo $data['medical_history']; ?></li>
                        <li><a href="<?php echo URLROOT; ?>drMedicalHistory?appointment_id=<?php echo $data['id']; ?>">Link to Full Medical History</a></li>
                    </ul>
                </ul>
            </div>

            <div class="appointment-actions">
                <a href="<?php echo URLROOT; ?>drPrescription?appointment_id=<?php echo $data['id']; ?>" class="appointment-action">Prescription &rarr;</button>
                <a href="<?php echo URLROOT; ?>drLabTests?appointment_id=<?php echo $data['id']; ?>" class="appointment-action">Lab Tests &rarr;</button>
            </div>
        </div>
    </div>

<?php require APPROOT . '/views/Components/footer.php' ?>
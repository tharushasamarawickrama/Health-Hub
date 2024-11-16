<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';


$appointment = [
    'id' => '0001',
    'patient_name' => 'Gemini Peiris',
    'age' => 29,
    'gender' => 'Female',
    'phone' => '0711234567',
    'email' => 'sarah.johnson@email.com',
    'medical_history' => 'Asthma, Mild Allergies, Previous Surgery for Appendicitis (2023)',
    'full_medical_history_link' => '#',
    'reason_for_visit' => 'Routine Check-Up and Asthma Management'
];
?>
    <div class="dr-appointment-container">
        <a href="#" class="back-arrow"><img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back"></a>
        <div class="appointment-container">
            
            <div class="appointment-details">
                <h2>Appointment: <?php echo $appointment['id']; ?></h2>
                <p><strong>Patient Information:</strong></p>
                <ul>
                    <li>Full name - <?php echo $appointment['patient_name']; ?></li>
                    <li>Age/Gender - <?php echo $appointment['gender']; ?>/<?php echo $appointment['age']; ?></li>
                    <li>Contact Information</li>
                    <ul>
                        <li>Phone: <?php echo $appointment['phone']; ?></li>
                        <li>Email: <?php echo $appointment['email']; ?></li>
                    </ul>
                    <li>Medical History Overview</li>
                    <ul>
                        <li>Overview - <?php echo $appointment['medical_history']; ?></li>
                        <li><a href="<?php echo $appointment['full_medical_history_link']; ?>">Link to Full Medical History</a></li>
                    </ul>
                    <li>Reason for Visit - <?php echo $appointment['reason_for_visit']; ?></li>
                </ul>
            </div>

            <div class="action-buttons">
                <button class="drButton">Prescription &rarr;</button>
                <button class="drButton">Order Lab Tests &rarr;</button>
            </div>
        </div>
    </div>

<?php require APPROOT . '/views/Components/footer.php' ?>
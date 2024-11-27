<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/labNavbar.php'; ?>
<div class="lab-pres-app-appcontent">
        <div class="lab-pres-app-back-button-container">
            <a href="<?php echo URLROOT; ?>/labprescriptions" class="lab-pres-app-back-button">
            <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
            Back
            </a>
        </div>
        <div class="lab-pres-app-prescription-details">
            <div class="lab-pres-app-details-left">
                <p><strong>Appointment ID:</strong> <?php echo $data['prescription']->appointment_id; ?></p>
                <p><strong>Patient NIC:</strong> <?php echo $data['prescription']->nic; ?></p>
                <p><strong>Age:</strong> <?php echo $data['prescription']->age; ?></p>
                <p><strong>Gender:</strong> <?php echo $data['prescription']->gender; ?></p>
                <p><strong>Tests Required:</strong></p>
                <ul>
                    <li><?php echo $data['prescription']->labtest_type; ?></li>
                </ul>
            </div>
            <div class="lab-pres-app-details-right">
                <p><strong>Date:</strong> <?php echo $data['prescription']->appointment_date; ?></p>
                <p><strong>Doctor ID:</strong> <?php echo $data['prescription']->doctor_id; ?></p>
                <p><strong>Doctor Name:</strong> Dr. <?php echo $data['prescription']->doctor_name; ?></p>
            </div>
        </div>
        <div class="lab-pres-app-file-upload">
            <p>You can drag and drop files here to add them</p>
            <button class="lab-pres-app-upload-btn">Upload reports</button>
        </div>
    </div>
</body>
<?php require APPROOT . '/views/Components/footer.php'; ?>

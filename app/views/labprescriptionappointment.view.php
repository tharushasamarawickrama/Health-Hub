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
            <p><strong>Appointment ID:</strong> <?php echo htmlspecialchars($data[0]['appointment_id']?? 'N/A'); ?></p>
            <p><strong>Patient NIC:</strong> <?php echo htmlspecialchars($data[0]['nic'] ?? 'N/A'); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($data[0]['age'] ?? 'N/A'); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($data[0]['gender'] ?? 'N/A'); ?></p>
            <p><strong>Tests Required:</strong></p>
            <ul>
                <li><?php echo htmlspecialchars($data[0]['labtest_type'] ?? 'No test required'); ?></li>
            </ul>
        </div>
        <div class="lab-pres-app-details-right">
            <p><strong>Date:</strong> <?php echo htmlspecialchars($data[0]['appointment_date'] ?? 'N/A'); ?></p>
            <p><strong>Doctor ID:</strong> <?php echo htmlspecialchars($data[0]['doctor_id'] ?? 'N/A'); ?></p>
            <p><strong>Doctor Name:</strong> Dr. <?php echo htmlspecialchars($data[0]['doctor_name'] ?? 'N/A'); ?></p>
        </div>
    </div>
    <div class="lab-pres-app-file-upload">
        <p>You can drag and drop files here to add them</p>
        <button class="lab-pres-app-upload-btn">Upload reports</button>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php'; ?>

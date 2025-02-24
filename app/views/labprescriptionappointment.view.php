<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/labNavbar.php'; ?>
<div class="lab-pres-app-appcontent">
    <div class="lab-pres-app-back-button-container">
        <a href="<?php echo URLROOT; ?>/labprescriptions" class="lab-pres-app-back-button">
            <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
            Back
        </a>
    </div>
    <?php if(isset($data['appointment_id'])): ?>
    <div class="lab-pres-app-prescription-details">
        <div class="lab-pres-app-details-left">
            <p><strong>Appointment ID:</strong> <?php echo htmlspecialchars($data['appointment_id']?? 'N/A'); ?></p>            
            <p><strong>Patient NIC:</strong> <?php echo htmlspecialchars($data['nic']); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($data['age']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($data['gender']); ?></p>
            <p><strong>Tests Required:</strong></p>
            <ul>
                <?php foreach($data['lab_tests'] as $test): ?>
                    <li><?php echo htmlspecialchars($test['prescription']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="lab-pres-app-details-right">
            <p><strong>Date:</strong> <?php echo htmlspecialchars($data['appointment_date']); ?></p>
            <p><strong>Doctor ID:</strong> <?php echo htmlspecialchars($data['doctor_id']); ?></p>
            <p><strong>Doctor Name:</strong> Dr. <?php echo htmlspecialchars($data['doctor_name']); ?></p>
        </div>
    </div>
    <?php else: ?>
        <div class="error-message">No prescription found for this appointment ID.</div>
    <?php endif; ?>
    
    <div class="lab-pres-app-file-upload">
        <p>You can drag and drop files here to add them</p>
        <button class="lab-pres-app-upload-btn">Upload reports</button>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php'; ?>

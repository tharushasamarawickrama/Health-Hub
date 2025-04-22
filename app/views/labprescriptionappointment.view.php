<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/labNavbar.php'; ?>
<div class="lab-pres-app-appcontent">
<div class="lab-pres-app-header">

    <div class="lab-pres-app-back-button-container">
        <a href="<?php echo URLROOT; ?>/labprescriptions" class="lab-pres-app-back-button">
            <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
            Back
        </a>
    </div>
    <div class="lab-pres-app-action-buttons">
        <form method="POST" action="<?php echo URLROOT; ?>/labprescriptionappointment/markPending" style="display:inline;">
            <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($data['appointment_id']); ?>">
            <button type="submit" class="lab-pres-app-action-btn lab-pres-app-proceed-btn">Proceed</button>
        </form>

        <form method="POST" action="<?php echo URLROOT; ?>/labprescriptionappointment/markCompleted" style="display:inline;">
            <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($data['appointment_id']); ?>">
            <button type="submit" class="lab-pres-app-action-btn lab-pres-app-complete-btn">Mark as Completed</button>
        </form>
    </div>
</div>
    <?php if(isset($data['appointment_id'])): ?>
        <div class="lab-pres-app-prescription-details">
            <div class="lab-pres-app-details-left">
                <p><strong>Appointment ID:</strong> <?php echo htmlspecialchars($data['appointment_id']?? 'N/A'); ?></p>            
                <p><strong>Patient NIC:</strong> <?php echo htmlspecialchars($data['nic']?? 'N/A'); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($data['age']?? 'N/A'); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($data['gender']?? 'N/A'); ?></p>
                <p><strong>Tests Required:</strong></p>
                <ul>
                    <?php foreach ($data['labtests'] as $test): ?>
                    <li><?php echo htmlspecialchars($test['labtest_name']); ?></li>
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
    
        <?php foreach ($data['labtests'] as $test): ?>
        <div class="lab-pres-app-file-upload">
            <p><strong>Test:</strong> <?php echo htmlspecialchars($test['labtest_name']); ?></p>

            <?php if (!empty($test['labtest_report'])): ?>
            <!-- Show the uploaded PDF link -->
                <p><strong>Uploaded Report:</strong> 
                <a href="<?php echo URLROOT . '/' . htmlspecialchars($test['labtest_report']); ?>" target="_blank">
                    <?php echo htmlspecialchars($test['labtest_pdfname']); ?>

                </a>

                <button onclick="confirmDelete('<?php echo htmlspecialchars($test['labtest_id']); ?>', '<?php echo htmlspecialchars($data['appointment_id']); ?>')">Delete</button>

                </p>
                
            <?php else: ?>
            <!-- Show the upload button if no report is uploaded -->
                <form action="<?php echo URLROOT; ?>/labprescriptionappointment/uploadReport" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($data['appointment_id']); ?>">
                    <input type="hidden" name="labtest_id" value="<?php echo htmlspecialchars($test['labtest_id']); ?>">
                    <label for="reportFile_<?php echo $test['labtest_id']; ?>" class="lab-pres-app-upload-btn" style="cursor: pointer;">Upload Report</label>
                    <input type="file" name="reportFile" id="reportFile_<?php echo $test['labtest_id']; ?>" accept="application/pdf" style="display: none;" onchange="this.form.submit()">
                </form>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
</div>
<script>
    const URLROOT = "<?php echo URLROOT; ?>";
</script>
<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/LabPrescriptionAppointment.js"></script>
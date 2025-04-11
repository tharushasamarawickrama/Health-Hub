<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/labNavbar.php'; ?>
<div class="lab-proc-app-container">
    <div class="lab-proc-app-content">
        <div class="lab-proc-app-prescription-details">
            <div class="lab-proc-app-back-button-container">
                <a href="<?php echo URLROOT; ?>/labprocessedprescriptions" class="lab-proc-app-back-button">
                    <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
                    Back
                </a>
            </div> 
            <div class="lab-proc-app-details">
                <div class="lab-proc-app-left">
                    <p><strong>Appointment ID:</strong> <?php echo htmlspecialchars($data['appointment_id']); ?></p>
                    <p><strong>Patient NIC:</strong> <?php echo htmlspecialchars($data['nic']); ?></p>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($data['age']); ?></p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($data['gender']); ?></p>
                    <p><strong>Tests:</strong></p>
                    <ul>
                        <?php foreach (explode(',', $data['labtest_name']) as $test): ?>
                            <li><?php echo $test; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    
                </div>
                <div class="lab-proc-app-right">
                    <p><strong><?php echo htmlspecialchars($data['appointment_date']); ?></strong></p>
                    <p><strong>Doc ID:</strong> <?php echo htmlspecialchars($data['doctor_id']); ?></p>
                    <p><strong>Doc name:</strong> <?php echo htmlspecialchars($data['doctor_name']); ?></p>
                </div>
            </div>
            <div class="lab-proc-app-uploaded-reports">
                <h3>Uploaded reports</h3>
                <?php if (!empty($data['labtest_pdfname'])): ?>
                <div class="lab-proc-app-report" id="report-<?php echo $data['labtest_id']; ?>">
                    <img src="<?php echo URLROOT; ?>/assets/images/pdf-icon.png" alt="PDF Icon"> 
                    <span><?php echo htmlspecialchars($data['labtest_pdfname']); ?></span>
                    <a href="<?php echo URLROOT; ?>/labprocessedappointment/view/<?php echo $data['labtest_id']; ?>">View</a>
                    <a href="<?php echo URLROOT; ?>/LabDeleteLabReport" class="delete" onclick="deleteReport(<?php echo $data['labtest_id']; ?>)">Delete</a>
                </div>
                <?php else: ?>
                    <p>No reports uploaded.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
<!-- script src="<?php echo URLROOT;?>/assets/js/LabProcessedAppointment.js"></script>
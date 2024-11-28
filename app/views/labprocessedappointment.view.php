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
                    <p><strong>Appointment ID:</strong> <?php echo htmlspecialchars($data[0]['appointment_id']?? 'N/A'); ?></p>
                    <p><strong>Patient NIC:</strong> <?php echo htmlspecialchars($data[0]['nic']?? 'N/A'); ?></p>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($data[0]['age']?? 'N/A'); ?></p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($data[0]['gender']?? 'N/A'); ?></p>
                    <p><strong>Tests:</strong></p>
                    <ul>
                        <?php foreach (explode(',', $data[0]['labtest_type']) as $test): ?>
                            <li><?php echo $test; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="lab-proc-app-right">
                    <p><strong><?php echo htmlspecialchars($data[0]['appointment_date']?? 'N/A'); ?></strong></p>
                    <p><strong>Doc ID:</strong> <?php echo htmlspecialchars($data[0]['doctor_id']?? 'N/A'); ?></p>
                    <p><strong>Doc name:</strong> <?php echo htmlspecialchars($data[0]['doctor_name']?? 'N/A'); ?></p>
                </div>
            </div>
            <div class="lab-proc-app-uploaded-reports">
                <h3>Uploaded reports</h3>
                <?php if (!empty($data[0]['labtest_pdfname'])): ?>
                <div class="lab-proc-app-report" id="report-<?php echo $data[0]['labtest_id']; ?>">
                    <img src="<?php echo URLROOT; ?>/assets/images/pdf-icon.png" alt="PDF Icon"> 
                    <span><?php echo htmlspecialchars($data[0]['labtest_pdfname']); ?></span>
                    <a href="<?php echo URLROOT; ?>/labprocessedappointment/view/<?php echo $data[0]['labtest_id']; ?>">View</a>
                    <a href="javascript:void(0);" class="delete" onclick="deleteReport(<?php echo $data[0]['labtest_id']; ?>)">Delete</a>
                </div>
                <?php else: ?>
                    <p>No reports uploaded.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/LabProcessedAppointment.js"></script>
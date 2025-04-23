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
            <form action="<?php echo URLROOT; ?>/labprocessedappointment/markAsPending" method="POST">
                <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($data['appointment_id']); ?>">
                <button type="submit" class="btn btn-warning">Mark as Pending</button>
            </form>

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
                    <?php if (!empty($data['labtest_pdfname']) && !empty($data['labtest_report'])): ?>
                    <?php 
                    $pdfNames = explode(',', $data['labtest_pdfname']);
                    $pdfPaths = explode(',', $data['labtest_report']);
                    $labtest_id = explode(',', $data['labtest_id']);
                    ?>
                <?php foreach ($pdfNames as $index => $pdfName): ?>
                    <div class="lab-proc-app-report" id="report-<?php echo $index; ?>">
                    <img src="<?php echo URLROOT; ?>/assets/images/pdf-icon.png" alt="PDF Icon"> 
                    <span><?php echo htmlspecialchars($pdfName); ?></span>
                    <a href="<?php echo URLROOT; ?>/<?php echo htmlspecialchars($pdfPaths[$index]); ?>" target="_blank">View</a>                </div>
                    <button onclick="confirmDelete('<?php echo $labtest_id[$index]; ?>', '<?php echo $data['appointment_id']; ?>')">Delete</button>                    
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No reports uploaded.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    const URLROOT = "<?php echo URLROOT; ?>";
</script>
<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/LabProcessedAppointments.js"></script>
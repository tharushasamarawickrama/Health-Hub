<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/labNavbar.php'; ?>
<div class="lab-pend-app-container">
    <div class="lab-pend-app-content">
        <div class="lab-pend-app-prescription-details">
        <div class="lab-pend-app-back-button-container">
            <a href="<?php echo URLROOT; ?>/labpendingprescriptions" class="lab-pend-app-back-button">
                <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
                Back
            </a>
        </div> 
        <div class="mark-as-completed-container">
            <form action="<?php echo URLROOT; ?>/labpendingappointment/markAsCompleted" method="POST">
            <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($data['appointment_id']); ?>">
            <button type="submit" class="mark-as-completed-btn">Mark as Completed</button>
            </form>
        </div>
        <div class="lab-pend-app-details">
            <div class="lab-pend-app-left">
                <p><strong>Appointment ID:</strong> <?php echo htmlspecialchars($data['appointment_id']); ?></p>
                <p><strong>Patient NIC:</strong> <?php echo htmlspecialchars($data['nic']); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($data['age']); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($data['gender']); ?></p>
                <p><strong>Tests:</strong></p>
                <ul>
                    <?php foreach ($data['labtests'] as $test): ?>
                    <li><?php echo htmlspecialchars($test['labtest_name']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="lab-pend-app-right">
                <p><strong>Date: </strong><?php echo htmlspecialchars($data['appointment_date']); ?></strong></p>
                <p><strong>Doc ID:</strong> <?php echo htmlspecialchars($data['doctor_id']); ?></p>
                <p><strong>Doc name:</strong> <?php echo htmlspecialchars($data['doctor_name']); ?></p>
            </div>
        </div>

        <div class="lab-pend-app-uploaded-reports">
            <?php if (!empty($data['labtests']) && is_array($data['labtests'])): ?>
            <?php foreach ($data['labtests'] as $test): ?>
            <div class="lab-pres-app-file-upload">
                <p><strong>Test:</strong> <?php echo htmlspecialchars($test['labtest_name']); ?></p>

                <?php if (!empty($test['labtest_report'])): ?>
                    <!-- Show the uploaded PDF link -->
                    <p><strong>Uploaded Report:</strong> 
                    <a href="<?php echo URLROOT . '/' . htmlspecialchars($test['labtest_report']); ?>" target="_blank">
                        <?php echo htmlspecialchars($test['labtest_pdfname']); ?>
                    </a>
                    </p>
                <?php else: ?>
                    <!-- Show the upload button if no report is uploaded -->
                    <form action="<?php echo URLROOT; ?>/labpendingappointment/uploadReport" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($data['appointment_id']); ?>">
                    <input type="hidden" name="labtest_id" value="<?php echo htmlspecialchars($test['labtest_id']); ?>">
                    <label for="reportFile_<?php echo $test['labtest_id']; ?>" class="lab-pres-app-upload-btn" style="cursor: pointer;">Upload Report</label>
                    <input type="file" name="reportFile" id="reportFile_<?php echo $test['labtest_id']; ?>" accept="application/pdf" style="display: none;" onchange="this.form.submit()">
                    </form>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
                <p>No lab tests available for this appointment.</p>
            <?php endif; ?>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php'; ?>
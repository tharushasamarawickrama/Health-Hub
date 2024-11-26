<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/labNavbar.php'; ?>
<div class="lab-pres-app-appcontent">
    <div class="lab-pres-app-back-button-container">
        <a href="<?php echo URLROOT; ?>/labprescriptions" class="lab-pres-app-back-button">
            <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
            Back
        </a>
    </div>
    <<!-- ... existing code ... -->
<div class="lab-pres-app-prescription-details">
    <div class="lab-pres-app-details-left">
        <p><strong>Appointment ID:</strong> <?php echo $data['prescription']->appointment_id; ?></p>
        <p><strong>Patient Name:</strong> <?php echo $data['prescription']->p_firstName . ' ' . $data['prescription']->p_lastName; ?></p>
        <p><strong>Patient NIC:</strong> <?php echo $data['prescription']->nic; ?></p>
        <p><strong>Phone:</strong> <?php echo $data['prescription']->phoneNumber; ?></p>
        <p><strong>Email:</strong> <?php echo $data['prescription']->emailaddress; ?></p>
        <p><strong>Tests:</strong></p>
        <ul>
            <?php 
            $tests = explode(',', $data['prescription']->labtest);
            $test_ids = explode(',', $data['prescription']->test_ids);
            $test_reports = explode(',', $data['prescription']->test_reports);
            foreach($tests as $index => $test): ?>
                <li>
                    <?php echo $test; ?>
                    <form class="report-upload-form" data-testid="<?php echo $test_ids[$index]; ?>">
                        <input type="file" accept=".pdf" name="report" class="report-file-input" required>
                        <button type="submit" class="lab-pres-app-upload-btn">Upload Report</button>
                    </form>
                    <?php if (!empty($test_reports[$index])): ?>
                        <a href="<?php echo URLROOT; ?>/uploads/labreports/<?php echo $test_reports[$index]; ?>" target="_blank" class="view-report-btn">View Report</a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- ... rest of the existing code ... -->
</div>

        <div class="lab-pres-app-details-right">
            <p><strong><?php echo date('F d, Y', strtotime($data['prescription']->appointment_date)); ?></strong></p>
            <p><strong>Time:</strong> <?php echo $data['prescription']->appointment_time; ?></p>
            <p><strong>Doctor:</strong> <?php echo $data['prescription']->doctor_name; ?></p>
            <p><strong>Status:</strong> <?php echo $data['prescription']->status; ?></p>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.report-upload-form').forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('report', e.target.report.files[0]);
        formData.append('labtest_id', e.target.dataset.testid);

        try {
            const response = await fetch('<?php echo URLROOT; ?>/labprescriptionappointment/uploadReport', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            if(data.success) {
                alert('Report uploaded successfully');
            }
        } catch(err) {
            alert('Error uploading report');
        }
    });
});
</script>

<?php require APPROOT . '/views/Components/footer.php'; ?>

<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/labNavbar.php'; ?>
<div class="lab-pend-app-container">
    <div class="lab-pend-app-content">
        <div class="lab-pend-app-prescription-details">
        <div class="lab-pend-app-back-button-container">
            <a href="<?php echo URLROOT; ?>/labpendingprescriptions" class="lab-proc-app-back-button">
            <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
            Back
            </a>
        </div> 
            <div class="lab-pend-app-details">
                <div class="lab-pend-app-left">
                    <p><strong>Appointment ID:</strong> 4565</p>
                    <p><strong>Patient NIC:</strong> 200213288759</p>
                    <p><strong>Age:</strong> 22</p>
                    <p><strong>Gender:</strong> Female</p>
                    <p><strong>Tests:</strong></p>
                    <ul>
                        <li>Full blood count</li>
                        <li>Urine test</li>
                    </ul>
                </div>
                <div class="lab-pend-app-right">
                    <p><strong>August 18, 2024 14:25</strong></p>
                    <p><strong>Doc ID:</strong> 103</p>
                    <p><strong>Doc name:</strong> Dr. Krishantha Perera</p>
                </div>
            </div>
            <div class="lab-pend-app-uploaded-reports">
                <h3>Uploaded reports</h3>
                <div class="lab-pend-app-report">
                    <img src="assets/images/pdf-icon.png" alt="PDF Icon"> <!-- Replace with your PDF icon -->
                    <span>FBC.pdf</span>
                    <a href="#">View</a>
                    <a href="#" class="delete">Delete</a>
                </div>
                <div class="lab-pend-app-report">
                    <img src="assets/images/pdf-icon.png" alt="PDF Icon">
                    <span>UrineTest.pdf</span>
                    <a href="#">View</a>
                    <a href="#" class="delete">Delete</a>
                </div>
                <a href="<?php echo URLROOT; ?>/labprescriptionappointment" class="lab-pend-app-upload-btn">Upload report</a>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php'; ?>
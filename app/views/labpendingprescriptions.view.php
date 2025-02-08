<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/labNavbar.php' ?>
<div class="lab-pend-pres-container">
    <div class="lab-pend-pres-content">
        <div class="lab-pend-pres-prescriptions">
            <div class="lab-pend-pres-card">
            <div class="lab-pend-pres-card-left">
                <a href="<?php echo URLROOT; ?>/labpendingappointment">   
                    <div>01.</div>
                    <p><strong>Appointment ID:</strong> 3465</p>
                    <p><strong>NIC:</strong> 200397482759</p>
                    </a>
                </div>
                
                <div class="lab-pend-pres-card-right">
                    <p><strong>Tests remaining</strong></p>
                    <p>Complete Blood Count</p>
                    <p>Lipid Profile</p>
                </div>
            </div>
            <div class="lab-pend-pres-card">
                <div class="lab-pend-pres-card-left">
                <div>02.</div>
                    <p><strong>Appointment ID:</strong> 8765</p>
                    <p><strong>NIC:</strong> 2001132688659</p>
                </div>
                <div class="lab-pend-pres-card-right">
                    <p><strong>Tests remaining</strong></p>
                    <p>Liver Function Test</p>
                </div>
            </div>
            <div class="lab-pend-pres-card">
                <div class="lab-pend-pres-card-left">
                    <div>03.</div>
                    <p><strong>Appointment ID:</strong> 2398</p>
                    <p><strong>NIC:</strong> 200254302856</p>
                </div>
                <div class="lab-pend-pres-card-right">
                    <p><strong>Tests remaining</strong></p>
                    <p>Kidney Function Test</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php' ?>
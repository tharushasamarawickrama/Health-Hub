<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/labNavbar.php' ?>
<div class="lab-pend-pres-container">
    <div class="lab-pend-pres-content">
        <div class="lab-pend-pres-prescriptions">
            <?php if (!empty($data['appointments'])): ?>
            <?php foreach ($data['appointments'] as $appointment): ?>
            <div class="lab-pend-pres-card">
                <div class="lab-pend-pres-card-left">
                    <a href="<?php echo URLROOT; ?>/labpendingappointment?appointment_id=<?php echo $appointment['appointment_id']; ?>" >
                        <div ><p><strong>Appointment ID: </strong><?php echo $appointment['appointment_id']; ?></p></div>
                        <div><p><strong>NIC: </strong><?php echo $appointment['nic']; ?></p></div>
                </div> 

                <div class="lab-pend-pres-card-right">
                    <div><p><strong>Tests remaining:</strong></p>
                    <ul>
                        <?php foreach ($appointment['labtests'] as $test): ?>
                            <li><?php echo $test; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    </div>
                    </a>
                </div>

            </div>
            <?php endforeach; ?>
            <?php else: ?>
                <div class="no-appointments">No pending appointments found</div>
            <?php endif; ?>  
        </div>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php' ?>

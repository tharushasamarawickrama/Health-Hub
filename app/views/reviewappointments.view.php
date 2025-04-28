<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/ReNavbar.php' ?>

<div class="re-view-app-container">
<div class = "re-view-app-content">
        <?php if (!empty($data['appointments'])):?>
            <?php foreach ($data['appointments'] as $appointment): ?>
                <div class = "re-view-app-card">
                <div class="re-view-app-card-left">
                    <a href = "<?php echo URLROOT; ?>/reviewappointmentdetails?appointment_id=<?php echo $appointment['appointment_id']; ?>">
                        <div><p><strong>Appointment ID: </strong><?php echo $appointment['appointment_id']; ?></p></div>
                        <div><p><strong>NIC: </strong><?php echo $appointment['nic']; ?></p></div>
                </div>
                <div class="re-view-app-card-right">
                     <div><p><strong>Appointment time: </strong><?php echo $appointment['created_at']; ?></p></div>
                </div>
                    </a>
                </div>

            <?php endforeach; ?>
            <?php else: ?>
                <div></div>
            <?php endif; ?>
</div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>
<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<?php require APPROOT . '/views/Components/AdminSidebar.php' ?>

<div class="ViewProfile-body">
    <div class="ViewProfile-container">

        <h1>Specialists Schedule Cancel Notifications List</h1>
        
        <?php if (empty($data)): ?>
            <p>No specialist notifications available.</p>
        <?php else: ?>
            <?php foreach ($data as $spe_she_not): ?>
            <div class="ViewProfile-doctor-card">
                <span class="ViewProfile-doctor-info">Schedule ID - <?php echo $spe_she_not['schedule_id'] ?> , Doctor ID <?php echo $spe_she_not['doctor_id']  ?></span>
                <div class="ViewProfile-button-group">
                <a href="<?php echo URLROOT; ?>SpecialistNotificationDetails?schedule_id=<?php echo $spe_she_not['schedule_id']; ?>&doctor_id=<?php echo $spe_she_not['doctor_id']; ?>">
                    <button class="ViewProfile-view-btn" id="dr-req-btn-left">VIEW</button>
                </a>
                    <a href="<?php echo URLROOT;?>SpecialistNotification/delete?schedule_id=<?php echo $spe_she_not['schedule_id'] ?>&doctor_id=<?php echo $spe_she_not['doctor_id'] ?>"><button class="ViewProfile-delete-btn" id="dr-req-btn-left">DELETE</button></a>
                </div>
            </div>
            <?php endforeach ?> 
        <?php endif; ?>
        
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>


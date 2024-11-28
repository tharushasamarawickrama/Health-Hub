<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/labNavbar.php' ?>
<div class="lab-pres-container">
    <div class = "lab-pres-search-box">
        <input type="text" id="lab-pres-searchInput" placeholder="Type Appointment Id...">
            <button onclick=searchAppointment()>
            <img src ="<?php echo URLROOT; ?>/assets/images/search.png" alt="Search Icon" class="lab-pres-search-icon">
            </button>
        <div class="lab-pres-search-result">
            <div id="lab-pres-resultContainer">
                <?php if(!empty($data['appointments'])): ?>
                <?php foreach($data['appointments'] as $appointment): ?>
                <a href="<?php echo URLROOT; ?>labprescriptionappointment" class="lab-pres-result-item">
                    <div>Appointment ID: <?php echo $appointment['appointment_id']; ?></div>
                    <div>NIC: <?php echo $appointment['nic']; ?></div>
                </a>
                <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-appointments">No pending appointments found</div>
                <?php endif; ?>
            </div>
         </div>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php' ?>
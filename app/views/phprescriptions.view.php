<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>
<div class = "search-box">
    <input type="text" id="searchInput" placeholder="Type Appointment Id...">
    <button onclick=searchAppointment()>
        <img src ="<?php echo URLROOT; ?>/assets/images/search.png" alt="Search Icon" class="search-icon">
    </button>
</div>
<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/PhPrescriptions.js"></script>
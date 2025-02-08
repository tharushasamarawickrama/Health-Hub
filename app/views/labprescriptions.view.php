<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/labNavbar.php' ?>
<div class="lab-pres-container">
    <div class = "lab-pres-search-box">
        <input type="text" id="lab-pres-searchInput" placeholder="Type Appointment Id...">
            <button onclick=searchLabAppointment()>
                <img src ="<?php echo URLROOT; ?>/assets/images/search.png" alt="Search Icon" class="lab-pres-search-icon">
            </button>
        <div class="lab-pres-search-result">
            <div id="lab-pres-resultContainer">
                
            </div>
        </div>
    </div>
</div>
<script>
    const URLROOT = "<?php echo URLROOT; ?>";
</script>

<script src="<?php echo URLROOT; ?>/assets/js/LabPrescriptions.js"></script>
<?php require APPROOT . '/views/Components/footer.php' ?>

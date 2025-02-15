<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>
<div class="ph-pres-dashboard">
    <div class = "ph-pres-search-box">
        <input type="text" id="ph-pres-searchInput" placeholder="Type Appointment Id...">
        <button onclick=searchPhAppointment()>
            <img src ="<?php echo URLROOT; ?>/assets/images/search.png" alt="Search Icon" class="ph-pres-search-icon">
        </button>
        <div class="ph-pres-search-result">
            <div id="ph-pres-resultContainer">
                
            </div>
        </div>
    </div>
</div>
<script>
    const URLROOT = "<?php echo URLROOT; ?>";
</script>

<script src="<?php echo URLROOT;?>/assets/js/PhPrescriptions.js"></script>
<?php require APPROOT . '/views/Components/footer.php'; ?>

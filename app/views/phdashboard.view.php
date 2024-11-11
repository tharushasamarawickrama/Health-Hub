<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>
<div class="dashboard">

    <div class="dashboard-content">
        <div class="dashboard-section">
            <a href="<?php echo URLROOT; ?>/phprescription" class="section-card">Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/pharmacist/processed" class="section-card">Processed Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/pharmacist/dailyusage" class="section-card">Inventory</a>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
<!--<script src="<?php echo URLROOT;?>/assets/js/PhDashboard.js"></script>-->


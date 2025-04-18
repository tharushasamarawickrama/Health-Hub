<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>
<div class="dashboard">

    <div class="dashboard-content">
        <div class="dashboard-section">
            <a href="<?php echo URLROOT; ?>/phprescriptions" class="section-card">Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/phprocessedprescriptions" class="section-card">Processed Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/phdailyusage" class="section-card">Daily Usage</a>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/PhDashboard.js"></script>


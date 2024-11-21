<?php require APPROOT . '/views/Components/labNavbar.php' ?>
<?php require APPROOT . '/views/Components/header.php' ?>
<div class="dashboard">

    <div class="dashboard-content">
        <div class="dashboard-section">
            <a href="<?php echo URLROOT; ?>/labprescriptions" class="section-card">Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/labprocessedprescriptions" class="section-card">Processed Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/labpendingprescriptions" class="section-card">Pending Prescriptions</a>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>
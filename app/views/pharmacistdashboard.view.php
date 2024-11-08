<?php require APPROOT . '/views/Components/header.php'; ?>


<div class="dashboard">
    <div class="dashboard-header">
        <div class="logo-section">
            <img src="<?php echo URLROOT; ?>/assets/images/logohealth.png" alt="Health Hub Logo" class="dashboard-logo">
        </div>
        <div class="menu">
            <a href="<?php echo URLROOT; ?>/pharmacistdashboard">Dashboard</a> 
            <a href="<?php echo URLROOT; ?>/pharmacist/inbox">Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/pharmacist/processed">Processed Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/pharmacist/dailyusage">Inventory</a>
        </div>
        <div class="user-info">
            <span>Pharmacist</span>
            <img src="<?php echo URLROOT; ?>/assets/images/loginlogo.jpg" alt="User Icon" class="user-icon">
        </div>
    </div>

    <div class="dashboard-content">
        <div class="dashboard-section">
            <a href="<?php echo URLROOT; ?>/pharmacist/inbox" class="section-card">Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/pharmacist/processed" class="section-card">Processed Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/pharmacist/dailyusage" class="section-card">Inventory</a>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/PharmacistDashboard.js"></script>


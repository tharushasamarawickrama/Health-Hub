<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>
<div class="usage-content">
    <div class="date-picker">
        <span>Date</span>
        <button id="today-btn"></button>
        <input type="date" id="date-input" value="<?php echo date('Y-m-d'); ?>">
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/PhDailyUsage.js"></script>
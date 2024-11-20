<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/labNavbar.php' ?>
<div class="processed-content">
    <div class="date-picker">
        <span>Date</span>
        <button id="today-btn"></button>
        <input type="date" id="date-input" value="<?php echo date('Y-m-d'); ?>">
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php' ?>
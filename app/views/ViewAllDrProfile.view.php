<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div class="ViewProfile-body">
    <div class="ViewProfile-container">
            <h1>Doctors List</h1>
            <?php foreach ($data as $doctor): ?>
            <div class="ViewProfile-doctor-card">
                <span class="ViewProfile-doctor-info">SLMC <?php echo $doctor['slmcNo'] ?> - Mr.<?php echo $doctor['firstName'] ?></span>
                <div class="ViewProfile-button-group">
                    <a href="<?php echo URLROOT;?>DrProfiledetails?id=<?php echo $doctor['doctor_id'] ?>"><button class="ViewProfile-view-btn" >VIEW</button></a>
                    <a href="<?php echo URLROOT;?>ViewAllDrProfile/delete?id=<?php echo $doctor['doctor_id'] ?>"><button class="ViewProfile-delete-btn"  >DELETE</button></a>
                </div>
            </div>
            <?php endforeach ?>            
    </div>

    </div>


<?php require APPROOT . '/views/Components/footer.php' ?>

<?php if (isset($data['success'])): ?>
<script>
    alert("<?php echo $data['success']; ?>");
</script>
<?php endif; ?>
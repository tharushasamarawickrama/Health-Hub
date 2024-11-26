<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div class="ViewProfile-body">
    <div class="ViewProfile-container">
            <h1>Pharmacists List</h1>
            <?php foreach ($data as $pharmacist): ?>
            <div class="ViewProfile-doctor-card">
                <span class="ViewProfile-doctor-info">SLMC <?php echo $pharmacist['slmcNo'] ?> - Mr.<?php echo $pharmacist['firstName'] ?></span>
                <div class="ViewProfile-button-group">
                    <a href="<?php echo URLROOT;?>PhProfiledetails?id=<?php echo $pharmacist['pharmacist_id'] ?>"><button class="ViewProfile-view-btn" >VIEW</button></a>
                    <a href="<?php echo URLROOT;?>ViewAllPharmProfile/delete?id=<?php echo $pharmacist['pharmacist_id'] ?>"><button class="ViewProfile-delete-btn" >DELETE</button></a>
                </div>
            </div>
            <?php endforeach ?>
    </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>


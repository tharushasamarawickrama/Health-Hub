<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>

<div class="slmc-all-body">
    <div class="slmc-image-view-body">
        <div class="slmc-image-view-container">
            <div class="slmc-image-view-header">
                <h1>SLMC Certificate</h1>
            </div>
            <div class="slmc-image-display">
                <img src="<?php echo URLROOT; ?>/<?php echo $data['certification_path']?>" alt="Image" class="slmc-display-image">
            </div>
            <!-- <div class="slmc-image-details">
                <h2>slmc certificste of Doctor<?php echo $data['firstName']?></h2>
                <p><?php echo $data['description']?></p>
            </div> -->
            <div class="slmc-image-actions">
                <a href="<?php echo URLROOT;?>/DrUpdateReq?id=<?php echo $data['doctor_id'] ?>" class="slmc-back-btn">Back</a>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>
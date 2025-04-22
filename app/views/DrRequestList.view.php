<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div class="ViewProfile-body">
    <div class="ViewProfile-container">

           
            <h1>Doctor's Requests List</h1>
            
            <?php foreach ($data as $dr_request): ?>
            <div class="ViewProfile-doctor-card">
                <span class="ViewProfile-doctor-info">SLMC NO <?php echo $dr_request['slmcNo'] ?> - <?php echo $dr_request['firstName']  ?> <?php echo $dr_request['lastName']  ?></span>
                <div class="ViewProfile-button-group">
                    <a href="<?php echo URLROOT;?>DrReqProfile?id=<?php echo $dr_request['req_id'] ?>"><button class="ViewProfile-view-btn" >VIEW</button></a>
                    <a href="<?php echo URLROOT;?>DrRequestList/delete?id=<?php echo $dr_request['req_id'] ?>"><button class="ViewProfile-delete-btn" >DONE</button></a>
                </div>
            </div>
            <?php endforeach ?> 
            
    </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>


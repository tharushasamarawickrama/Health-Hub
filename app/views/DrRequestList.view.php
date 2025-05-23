<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<?php require APPROOT . '/views/Components/AdminSidebar.php' ?>

<div class="ViewProfile-body">
    <div class="ViewProfile-container">

        <h1>Doctor's Requests List</h1>
        <?php if (empty($data)): ?>
            <p>No doctor's requests available.</p>
        <?php else: ?>
            <?php foreach ($data as $dr_request): ?>
            <div class="ViewProfile-doctor-card">
                <span class="ViewProfile-doctor-info">SLMC NO <?php echo $dr_request['slmcNo'] ?> - <?php echo $dr_request['firstName']  ?> <?php echo $dr_request['lastName']  ?></span>
                <div class="ViewProfile-button-group">
                    <a href="<?php echo URLROOT;?>DrReqProfile?id=<?php echo $dr_request['req_id'] ?>"><button class="ViewProfile-view-btn" id="dr-req-btn-left">VIEW</button></a>
                    <a href="<?php echo URLROOT;?>DrRequestList/delete?id=<?php echo $dr_request['req_id'] ?>"><button class="ViewProfile-delete-btn" id="dr-req-btn-right">DONE</button></a>
                </div>
            </div>
            <?php endforeach ?> 
        <?php endif; ?>
        
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>


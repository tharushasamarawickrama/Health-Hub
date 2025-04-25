<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<?php require APPROOT . '/views/Components/AdminSidebar.php' ?>

<div class="ViewProfile-body">
    <div class="ViewProfile-container">

        <h1>Doctor's Profile Update Requests List</h1>
        
        <?php if (empty($data)): ?>
            <p>No doctor's profile update requests available.</p>
        <?php else: ?>
            <?php foreach ($data as $dr_prop_req): ?>
            <div class="ViewProfile-doctor-card">
                <span class="ViewProfile-doctor-info"> DR : <?php echo $dr_prop_req['firstName']  ?> <?php echo $dr_prop_req['lastName']  ?></span>
                <div class="ViewProfile-button-group">
                    <a href="<?php echo URLROOT;?>DrUpdateReq?id=<?php echo $dr_prop_req['doctor_id'] ?>"><button class="ViewProfile-view-btn" >VIEW</button></a>
                    <a href="<?php echo URLROOT;?>DrProfileUpdate/delete?id=<?php echo $dr_prop_req['doctor_id'] ?>"><button class="ViewProfile-delete-btn" >DONE</button></a>
                </div>
            </div>
            <?php endforeach ?> 
        <?php endif; ?>
        
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>


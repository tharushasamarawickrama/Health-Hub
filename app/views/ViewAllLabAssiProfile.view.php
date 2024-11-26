<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div class="ViewProfile-body">
    <div class="ViewProfile-container">
            <h1>Lab Assistants List</h1>
            
            <?php foreach ($data as $labassistant): ?>
            <div class="ViewProfile-doctor-card">
                <span class="ViewProfile-doctor-info">EMPLOYEE No <?php echo $labassistant['employeeNo'] ?> - Mr.<?php echo $labassistant['firstName'] ?></span>
                <div class="ViewProfile-button-group">
                    <a href="<?php echo URLROOT;?>LAProfiledetails?id=<?php echo $labassistant['lab_assistant_id'] ?>"><button class="ViewProfile-view-btn" >VIEW</button></a>
                    <a href="<?php echo URLROOT;?>ViewAllLabAssiProfile/delete?id=<?php echo $labassistant['lab_assistant_id'] ?>"><button class="ViewProfile-delete-btn" >DELETE</button></a>
                </div>
            </div>
            <?php endforeach ?>
            
            
            
    </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>


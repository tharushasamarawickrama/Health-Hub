<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div class="ViewProfile-body">
    <div class="ViewProfile-container">
            <h1>Lab Assistants List</h1>
            
            <?php foreach ($data as $labassistant): ?>
            <div class="ViewProfile-doctor-card">
                <span class="ViewProfile-doctor-info">EMPLOYEE No <?php echo $labassistant['employeeNo'] ?> - Mr.<?php echo $labassistant['firstName'] ?></span>
                <div class="ViewProfile-button-group">
                    <button class="ViewProfile-view-btn" onclick="viewProfile(1)">VIEW</button>
                    <button class="ViewProfile-delete-btn" onclick="deleteProfile(1)">DELETE</button>
                </div>
            </div>
            <?php endforeach ?>
            
            
            
    </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>

<script>
        function viewProfile(id) {
            window.location.href = `view_profile.php?id=${id}`;
        }
        function deleteProfile(id) {
            if (confirm("Are you sure you want to delete this doctor?")) {
                window.location.href = `delete_doctor.php?id=${id}`;
            }
        }
</script>
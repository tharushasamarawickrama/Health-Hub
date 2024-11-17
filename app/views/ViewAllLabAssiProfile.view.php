<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div class="ViewProfile-body">
    <div class="ViewProfile-container">
            <h1>Lab Assistants List</h1>
            
            <?php require APPROOT.'/views/Components/ViewProfileCard.php' ?>
            <?php require APPROOT.'/views/Components/ViewProfileCard.php' ?>
            <?php require APPROOT.'/views/Components/ViewProfileCard.php' ?>
            <?php require APPROOT.'/views/Components/ViewProfileCard.php' ?>
            
            
            
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
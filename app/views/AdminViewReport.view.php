<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div>
<div class="admin-card">
                <h3>Doctors</h3>
                <p>Add new doctors to the system.</p>
                <a href="<?php echo URLROOT;?>AdminDrRegister">
                    <button onclick="window.location.href='add_doctor.php'">Add Doctor</button>
                </a>
                
            </div>
</div>
<?php require APPROOT . '/views/Components/footer.php' ?>
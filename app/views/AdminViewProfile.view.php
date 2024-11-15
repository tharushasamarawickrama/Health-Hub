<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>
<div class="dashboard-container">
    <div class="up-row">
        <!-- Doctor Card -->
        <div class="admin-card">
            <h3>Doctors</h3>
            <p>View Doctors' Profiles.</p>
            <a href="<?php echo URLROOT;?>AdminDrRegister">
                <button onclick="window.location.href='add_doctor.php'">View Doctors</button>
            </a>
            
        </div>

        <!-- Receptionist Card -->
        <div class="admin-card">
            <h3>Receptionists</h3>
            <p>View Receptionists' Profiles.</p>
            <a href="<?php echo URLROOT;?>AdminRecepRegister">
            <button onclick="window.location.href='add_receptionist.php'">View Receptionists</button>
            </a>
        </div>

    </div>
   <div class="up-row">
        <!-- Lab Assistant Card -->
        <div class="admin-card">
            <h3>Lab Assistants</h3>
            <p>View Lab Assistants' Profiles.</p>
            <a href="<?php echo URLROOT;?>AdminLabRegister">
            <button onclick="window.location.href='add_lab_assistant.php'">View Lab Assistants</button>
            </a>
        </div>

        <!-- Pharmacist Card -->
        <div class="admin-card">
            <h3>Pharmacists</h3>
            <p>View Pharmacists' Profiles.</p>
            <a href="<?php echo URLROOT;?>AdminPhRegister">
            <button onclick="window.location.href='add_pharmacist.php'">View Pharmacists</button>
            </a>
        </div>
   </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>
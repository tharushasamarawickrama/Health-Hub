<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>
<div class="dashboard-container">
    <div class="up-row">
        <!-- Doctor Card -->
        <div class="admin-card">
            <h3>Doctors</h3>
            <p>Add new doctors to the system.</p>
            <a href="<?php echo URLROOT;?>AdminDrRegister">
                <button onclick="window.location.href='add_doctor.php'">Add Doctor</button>
            </a>
            
        </div>

        <!-- Receptionist Card -->
        <div class="admin-card">
            <h3>Receptionists</h3>
            <p>Add new receptionists to the system.</p>
            <a href="<?php echo URLROOT;?>AdminResepRegister">
            <button onclick="window.location.href='add_receptionist.php'">Add Receptionist</button>
            </a>
        </div>

    </div>
   <div class="up-row">
        <!-- Lab Assistant Card -->
        <div class="admin-card">
            <h3>Lab Assistants</h3>
            <p>Add new lab assistants to the system.</p>
            <a href="<?php echo URLROOT;?>AdminLabRegister">
            <button onclick="window.location.href='add_lab_assistant.php'">Add Lab Assistant</button>
            </a>
        </div>

        <!-- Pharmacist Card -->
        <div class="admin-card">
            <h3>Pharmacists</h3>
            <p>Add new pharmacists to the system.</p>
            <a href="<?php echo URLROOT;?>AdminPhRegister">
            <button onclick="window.location.href='add_pharmacist.php'">Add Pharmacist</button>
            </a>
        </div>
   </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>
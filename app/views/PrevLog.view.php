<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>
<div class="admin-dashboard">
    <div class="dashboard-container">
        <div class="up-row">
            <!-- Doctor Card -->
            <div class="admin-card">
                <h3>Patients</h3>
                <p>Login as a Patient.</p>
                <a href="<?php echo URLROOT;?>patientregister">
                    <button > Go </button>
                </a>
                
            </div>

            <!-- Receptionist Card -->
            <div class="admin-card">
                <h3>Doctors</h3>
                <p>Login as a Doctor.</p>
                <a href="<?php echo URLROOT;?>patientregister">
                <button > Go </button>
                </a>
            </div>

            <!-- Receptionist Card -->
            <div class="admin-card">
                <h3>Admin</h3>
                <p>Login as a Admin.</p>
                <a href="<?php echo URLROOT;?>patientregister">
                <button > Go </button>
                </a>
            </div>

        </div>
        <div class="up-row">
                <!-- Lab Assistant Card -->
                <div class="admin-card">
                    <h3>Lab Assistants</h3>
                    <p>Login as a Lab Assistant.</p>
                    <a href="<?php echo URLROOT;?>patientregister">
                    <button> Go </button>
                    </a>
                </div>

                <!-- Pharmacist Card -->
                <div class="admin-card">
                    <h3>Receptionists</h3>
                    <p>Login as a Receptionist.</p>
                    <a href="<?php echo URLROOT;?>patientregister">
                    <button > Go </button>
                    </a>
                </div>

                <!-- Pharmacist Card -->
                <div class="admin-card">
                    <h3>Pharmacists</h3>
                    <p>Login as a Pharmacist.</p>
                    <a href="<?php echo URLROOT;?>patientregister">
                    <button > Go </button>
                    </a>
                </div>

        </div>
    </div>

</div>

<?php require APPROOT . '/views/Components/footer.php' ?>
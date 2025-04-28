<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<?php require APPROOT . '/views/Components/AdminSidebar.php' ?> 

<div class="admin-dashboard">
    <div class="dashboard-container">
        <div class="up-row">
            <!-- Doctor Card -->
            <div class="admin-card">
                <h3>Doctors</h3>
                <p>View Doctors' Profiles.</p>
                <a href="<?php echo URLROOT;?>ViewAllDrProfile">
                    <button id="dr-req-btn-left">View Doctors</button>
                </a>
                
            </div>

            <!-- Receptionist Card -->
            <div class="admin-card">
                <h3>Receptionists</h3>
                <p>View Receptionists' Profiles.</p>
                <a href="<?php echo URLROOT;?>ViewAllRecepProfile">
                <button id="dr-req-btn-left">View Receptionists</button>
                </a>
            </div>

        </div>
    <div class="up-row">
            <!-- Lab Assistant Card -->
            <div class="admin-card">
                <h3>Lab Assistants</h3>
                <p>View Lab Assistants' Profiles.</p>
                <a href="<?php echo URLROOT;?>ViewAllLabAssiProfile">
                <button id="dr-req-btn-left">View Lab Assistants</button>
                </a>
            </div>

            <!-- Pharmacist Card -->
            <div class="admin-card">
                <h3>Pharmacists</h3>
                <p>View Pharmacists' Profiles.</p>
                <a href="<?php echo URLROOT;?>ViewAllPharmProfile">
                <button id="dr-req-btn-left">View Pharmacists</button>
                </a>
            </div>
    </div>
    </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>
<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<?php require APPROOT . '/views/Components/AdminSidebar.php' ?>

<div class="admin-dashboard">
    <div class="dashboard-header">
        <h1>Admin Dashboard</h1>
        <p>Welcome to the Health Hub Admin Panel</p>
    </div>

    <div class="dashboard-container">
        <div class="dashboard-card">
            <h3>Doctor Requests</h3>
            <p>Total Pending Requests</p>
            <div class="count"><?php echo $data['doctor_requests_count']; ?></div>
        </div>

        <div class="dashboard-card">
            <h3>Doctors</h3>
            <p>Total Registered Doctors</p>
            <div class="count"><?php echo $data['doctors_count']; ?></div>
        </div>

        <div class="dashboard-card">
            <h3>Receptionists</h3>
            <p>Total Registered Receptionists</p>
            <div class="count"><?php echo $data['receptionists_count']; ?></div>
        </div>

        <div class="dashboard-card">
            <h3>Lab Assistants</h3>
            <p>Total Registered Lab Assistants</p>
            <div class="count"><?php echo $data['lab_assistants_count']; ?></div>
        </div>

        <div class="dashboard-card">
            <h3>Pharmacists</h3>
            <p>Total Registered Pharmacists</p>
            <div class="count"><?php echo $data['pharmacists_count']; ?></div>
        </div>

       
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>
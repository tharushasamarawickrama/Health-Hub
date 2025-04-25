<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<?php require APPROOT . '/views/Components/AdminSidebar.php' ?>

<div class="ViewProfile-body">
    <div class="ViewProfile-container">

        <h1>Specialist Notification Details</h1>

        <?php if (empty($data)): ?>
            <p>No appointments found for this schedule and doctor.</p>
        <?php else: ?>
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $appointment): ?>
                        <tr>
                            <td><?php echo $appointment['appointment_id']; ?></td>
                            <td><?php echo $appointment['p_firstName']; ?></td>
                            <td><?php echo $appointment['p_lastName']; ?></td>
                            <td><?php echo $appointment['phoneNumber']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="<?php echo URLROOT; ?>SpecialistNotification" class="back-btn"><button class="save-btn">Back</button></a>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>
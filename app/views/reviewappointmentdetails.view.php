<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/ReNavbar.php' ?>
<?php if(isset($data['appointment_id'])): ?>
        <div class="re-view-app-det-container">
            <div class="re-view-app-det-left">
                <p><strong>Appointment ID:</strong> <?php echo htmlspecialchars($data['appointment_id']); ?></p>            
                <p><strong>Patient NIC:</strong> <?php echo htmlspecialchars($data['nic']?? 'N/A'); ?></p>
                <p><strong>Patient name:</strong> <?php echo htmlspecialchars($data['patient_name']?? 'N/A'); ?><p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($data['age']?? 'N/A'); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($data['gender']?? 'N/A'); ?></p>
                <p><strong>Phone number:</strong> <?php echo htmlspecialchars($data['phoneNumber']?? 'N/A'); ?></p>
                <p><strong>Email address:</strong> <?php echo htmlspecialchars($data['email']?? 'N/A'); ?></p>

            </div>
            <div class="re-view-app-det-right">
                <p><strong>Date:</strong> <?php echo htmlspecialchars($data['created_date']); ?></p>
                <p><strong>Doctor ID:</strong> <?php echo htmlspecialchars($data['doctor_id']); ?></p>
                <p><strong>Doctor Name:</strong> Dr. <?php echo htmlspecialchars($data['doctor_name']); ?></p>
            </div>
        </div>
        <?php else: ?>
            <div class="error-message">No prescription found for this appointment ID.</div>
        <?php endif; ?>
    
<?php require APPROOT . '/views/Components/footer.php' ?>
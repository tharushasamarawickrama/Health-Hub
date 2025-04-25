<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>
<div class="ph-proc-app-dashboard">
    <div class="ph-proc-app-appcontent">
        <div class="ph-proc-app-back-button-container">
            <a href="<?php echo URLROOT; ?>/phprocessedprescriptions" class="ph-proc-app-back-button">
                <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
                Back
            </a>
        </div> 
        <?php if(isset($data['appointment_id'])): ?>

        <div class="ph-proc-app-prescription-details">
            <div class ="ph-proc-app-details-left">
                <p><strong>Appointment ID: </strong> <?php echo htmlspecialchars($data['appointment_id']?? 'N/A'); ?></p>            
                <p><strong>Patient NIC: </strong><?php echo htmlspecialchars($data['nic']) ?? 'N/A'; ?></p>
                <p><strong>Age: </strong><?php echo htmlspecialchars($data['age']) ?? 'N/A'; ?></p>
                <p><strong>Gender: </strong><?php echo htmlspecialchars($data['gender']) ?? 'N/A'; ?></p>
            </div>
            <div class ="ph-pres-app-details-right">
                <p><strong>Date:</strong> <?php echo htmlspecialchars($data['appointment_date']); ?></p>
                <p><strong>Doc ID: </strong><?php echo htmlspecialchars($data['doctor_id']) ??'N/A'; ?></p>
                <p><strong>Doc Name: </strong><?php echo htmlspecialchars($data['doctor_name']) ?? 'N/A'; ?></p>
            </div>
        <?php else: ?>
            <div class="error-message">No prescription found for this appointment ID.</div>
        <?php endif; ?>
        
        <table class="ph-proc-app-prescription-table">
            <tr>
                <th>Name</th>
                <th>Qty</th>
                <th>Measurement</th>
                <th>Sig codes</th>
                <th>Duration</th>
                <th>No.of units Issued</th>
            </tr>
        
            <?php if (!empty($medications)): ?>
            <?php foreach ($medications as $medication): ?>
            <tr>
                <td><?php echo htmlspecialchars($medication['medication_name'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($medication['quantity'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($medication['measurement'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($medication['sig_codes'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars(str_replace(',', '/',$medication['duration'] ?? 'N/A')); ?></td>
                <td><?php echo htmlspecialchars($medication['units_issued'] ?? 'N/A'); ?></td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No medications found</td></tr>
            <?php endif; ?>
                
            
        </table>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php'; ?>

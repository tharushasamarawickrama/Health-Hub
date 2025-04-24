<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>

<div class="ph-pres-app-dashboard">
    <div class="ph-pres-app-appcontent">
        <div class="ph-pres-app-back-button-container">
            <a href="<?php echo URLROOT; ?>/phprescriptions" class="ph-pres-app-back-button">
                <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
                Back
            </a>
        </div> 
        <form method="POST" action="<?php echo URLROOT; ?>/phprescriptionappointment/markCompleted">
            <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($data['appointment_id']); ?>">
            <button type="submit" class="btn">Mark as Completed</button>
        </form>
                 
        <?php if(isset($data['appointment_id'])): ?>

        <div class="ph-pres-app-prescription-details">
            <div class ="ph-pres-app-details-left">
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
        
        <table class="ph-pres-app-prescription-table">
            <tr>
                <th>Medicine</th>
                <th>Qty</th>
                <th>Measurement</th>
                <th>Sig codes</th>
                <th>Duration</th>
            </tr>
            <?php if (!empty($data['medications']) && is_array($data['medications'])): ?>
    <?php foreach ($data['medications'] as $medication): ?>
        <tr>
            <td><?php echo htmlspecialchars($medication['medication_name'] ?? 'N/A'); ?></td>
            <td><?php echo htmlspecialchars($medication['quantity'] ?? 'N/A'); ?></td>
            <td><?php echo htmlspecialchars($medication['measurement'] ?? 'N/A'); ?></td>
            <td><?php echo htmlspecialchars($medication['sig_codes'] ?? 'N/A'); ?></td>
            <td><?php echo htmlspecialchars(str_replace(',', '/',$medication['duration'] ?? 'N/A')); ?></td>
            </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="5">No medications found</td></tr>
<?php endif; ?>
        </table>
        </div>
        <br>
        <br>

        <div >
            <h2>Calculate no.of units to be issued</h2>
        </div>
        <!-- Only one form, not nested -->
        <form method="POST" action="<?php echo URLROOT; ?>/phprescriptionappointment/issuedMedication">
            <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($data['appointment_id']); ?>">
            <table class="ph-pres-app-prescription-table">
                <tr>
                    <th>Medicine</th>
                    <th>Qty</th>
                    <th>Measurement</th>
                    <th>Sig Code</th>
                    <th>Prescribed Duration</th>
                    <th>preferred duration(days)</th>
                    <th>No.of units to be issued</th>
                </tr>
                <?php if (!empty($data['medications']) && is_array($data['medications'])): ?>
    <?php foreach ($data['medications'] as $index => $medication): ?>
        <tr>
            <td>
                <?php echo htmlspecialchars($medication['medication_name']); ?>
                <input type="hidden" name="medications[<?php echo $index; ?>][name]" value="<?php echo htmlspecialchars($medication['medication_name']); ?>">
            </td>
            <td>
                <?php echo htmlspecialchars($medication['quantity']); ?>
                <input type="hidden" name="medications[<?php echo $index; ?>][quantity]" value="<?php echo htmlspecialchars($medication['quantity']); ?>">
            </td>
            <td>
                <?php echo htmlspecialchars($medication['measurement']); ?>
                <input type="hidden" name="medications[<?php echo $index; ?>][measurement]" value="<?php echo htmlspecialchars($medication['measurement']); ?>">
            </td>
            <td>
                <?php echo htmlspecialchars($medication['sig_codes']); ?>
                <input type="hidden" name="medications[<?php echo $index; ?>][sig_codes]" value="<?php echo htmlspecialchars($medication['sig_codes']); ?>">
            </td>
            <td>
                <?php echo htmlspecialchars($medication['duration']); ?>
            </td>
            <td>
                <input type="number" name="medications[<?php echo $index; ?>][preferred_duration]" min="1" required 
                value="<?php echo isset($medication['preferred_duration']) ? htmlspecialchars($medication['preferred_duration']) : ''; ?>">
            </td>
            
            <td>
                <?php if (isset($data['noofunits'][$index])): ?>
                    <?php echo $data['noofunits'][$index]['amount']; ?>
                <?php else: ?>
                    <span id="calculated_<?php echo $index; ?>"></span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="7">No medications found</td></tr>
<?php endif; ?>
            </table>

            <div class="ph-pres-app-buttons-container">
                <button type="submit">Calculate</button>
            </div>
        </form>
    </div>
</div>


<?php require APPROOT . '/views/Components/footer.php'; ?>

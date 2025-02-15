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

        <?php 
            $appointment = $data['appointment_details'] ?? []; 
            $medications = $data['medications'] ?? [];
        ?>

        <div class="ph-pres-app-prescription-header">
            <p>Appointment ID: <b><?php echo isset($appointment['appointment_id']) ? htmlspecialchars($appointment['appointment_id']) : 'N/A'; ?></b></p>
            <p>Patient NIC: <b><?php echo isset($appointment['nic']) ? htmlspecialchars($appointment['nic']) : 'N/A'; ?></b></p>
            <p>Age: <b><?php echo isset($appointment['age']) ? htmlspecialchars($appointment['age']) : 'N/A'; ?></b></p>
            <p>Gender: <b><?php echo isset($appointment['gender']) ? htmlspecialchars($appointment['gender']) : 'N/A'; ?></b></p>
            <p>Date: <b><?php echo isset($appointment['appointment_date']) ? date('F j, Y', strtotime($appointment['appointment_date'])) : 'N/A'; ?></b>
            Time: <b><?php echo isset($appointment['appointment_time']) ? date('H:i', strtotime($appointment['appointment_time'])) : 'N/A'; ?></b></p>
            <p>Doc ID: <b><?php echo isset($appointment['doctor_id']) ? htmlspecialchars($appointment['doctor_id']) : 'N/A'; ?></b></p>
            <p>Doc Name: <b><?php echo isset($appointment['doctor_name']) ? htmlspecialchars($appointment['doctor_name']) : 'N/A'; ?></b></p>
        </div>

        <table class="ph-pres-app-prescription-table">
            <tr>
                <th>Name</th>
                <th>Qty</th>
                <th>Measurement</th>
                <th>Sig codes</th>
                <th>Duration</th>
            </tr>
            <?php if (!empty($medications)): ?>
                <?php foreach ($medications as $medication): ?>
                <tr>
                    <td><?php echo htmlspecialchars($medication['medication_name'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($medication['quantity'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($medication['measurement'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($medication['sig_codes'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($medication['duration'] ?? 'N/A'); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No medications found</td></tr>
            <?php endif; ?>
        </table>

        <form class="ph-pres-app-inventory-form">
            <div class="ph-pres-app-inventory-row">
                <input type="text" placeholder="Medicine Name" name="medicineName">
                <input type="number" name="qty" placeholder="Quantity" min="0" required>
                <select name="measurement">
                    <option value="Tablet">Tablet</option>
                    <option value="ml">ml</option>
                    <option value="mg">mg</option>
                </select>
                <input type="text" name="sig" placeholder="Sig (Dosage Instructions)" required>
                <select name="code">
                    <option value="BD">BD</option>
                    <option value="TID">TDS</option>
                    <option value="Daily">Daily</option>
                    <option value="SOS">SOS</option>
                </select>
                <input type="number" name="durationDays" placeholder="Days" min="0" required>
            </div>

            <div class="ph-pres-app-buttons-container">
                <div class="ph-pres-app-buttons">
                    <button type="button" onclick="addRow()">Add more...</button>
                    <button type="reset">Clear</button>
                    <button type="submit">Done</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>

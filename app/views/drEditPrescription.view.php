<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

?>

<div class="dr-prescription-container">
    <div class="prescription-header">
        <a href="<?php echo URLROOT; ?>drPrescription?appointment_id=<?= $appointment_id; ?>" class="prescription-back-arrow"><img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back"></a>
        <h2>Edit Prescription Details</h2>
    </div>
    <form action="<?php echo URLROOT; ?>drEditPrescription?appointment_id=<?= $appointment_id; ?>" method="POST" class="doctor-prescription-form" id="doctor-prescription-form">
        <div class="prescription-container">
            <h2>Diagnosis</h2>
            <textarea name="diagnosis-text" id="diagnosis-text" rows="5" placeholder="Type in the diagnosis."><?php echo isset($prescription['diagnosis']) ? htmlspecialchars($prescription['diagnosis']) : ''; ?></textarea>



            <div id="medications-container">
                <h2>Medications</h2>
                <table class="medications-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Measurement</th>
                            <th>Sig Codes</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="medications-list">
                        <?php
                        // Normalize medications array for loop
                        if (empty($medications)) {
                            $medications = [[
                                'name' => '',
                                'quantity' => '',
                                'measurement' => '',
                                'sig_codes' => '',
                                'duration' => ','
                            ]];
                        }

                        foreach ($medications as $medication):
                            $sig_codes = explode(',', $medication['sig_codes']);
                            $duration_parts = explode(',', $medication['duration']);
                        ?>
                            <tr>
                                <td>
                                    <input type="text" name="medication_name" value="<?= htmlspecialchars($medication['name']); ?>">
                                </td>
                                <td>
                                    <input type="number" name="medication_qty" value="<?= $medication['quantity']; ?>">
                                </td>
                                <td>
                                    <select name="medication_measurement">
                                        <option value=""></option>
                                        <option value="mg" <?= $medication['measurement'] === 'mg' ? 'selected' : ''; ?>>mg</option>
                                        <option value="ml" <?= $medication['measurement'] === 'ml' ? 'selected' : ''; ?>>ml</option>
                                        <option value="tab" <?= $medication['measurement'] === 'tab' ? 'selected' : ''; ?>>tab</option>
                                        <option value="cap" <?= $medication['measurement'] === 'cap' ? 'selected' : ''; ?>>cap</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="sig-codes">
                                        <?php if (empty($sig_codes[0])) $sig_codes = ['']; ?>
                                        <?php foreach ($sig_codes as $sig_code): ?>
                                            <select name="sig_codes[]">
                                                <option value=""></option>
                                                <?php foreach ($stored_sig_codes as $code): ?>
                                                    <option value="<?= $code ?>" <?= $sig_code === $code ? 'selected' : '' ?>><?= $code ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endforeach; ?>
                                        <button type="button" class="add-sig-code">+</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="duration">
                                        <input type="number" name="duration_value" value="<?= $duration_parts[0]; ?>"> /
                                        <select name="duration_period">
                                            <option value=""></option>
                                            <option value="12" <?= $duration_parts[1] === '12' ? 'selected' : ''; ?>>12</option>
                                            <option value="52" <?= $duration_parts[1] === '52' ? 'selected' : ''; ?>>52</option>
                                            <option value="365" <?= $duration_parts[1] === '365' ? 'selected' : ''; ?>>365</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="delete-medication">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                <div class="medication-actions">
                    <button type="button" id="add-medication">Add Medication</button>
                    <button type="button" id="clear-medications">Clear</button>
                </div>
            </div>
            <hr>
            <!-- Hidden input for formatted data -->
            <input type="hidden" name="formatted_prescription_data" id="formatted_prescription_data">
            <div class="prescription-actions-container">
                <button type="submit" class="prescription-actions">Save</button>
                <a href="<?php echo URLROOT; ?>drPrescription?appointment_id=<?= $appointment_id; ?>" class="prescription-actions">Cancel</a>
            </div>
        </div>
    </form>
</div>

<script>
    const storedSigCodes = <?= json_encode($stored_sig_codes ?? ['po', 'mane', 'bid']); ?>;
</script>
<script src="<?php echo URLROOT; ?>js/drEditPrescription.js?v=<?php echo time(); ?>"></script>
<?php require APPROOT . '/views/Components/footer.php'; ?>
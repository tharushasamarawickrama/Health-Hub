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
                        if (empty($medications)) {
                            // If no medications, still show empty rows
                            echo '<tr>
                                    <td><input type="text" name="medication_name" id="name" value=""></td>
                                    <td><input type="number" name="medication_qty" value=""></td>
                                    <td>
                                        <select name="medication_measurement">
                                            <option value=""></option>
                                            <option value="mg">mg</option>
                                            <option value="ml">ml</option>
                                            <option value="tab">tab</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="sig-codes">
                                            <select name="sig_codes[]">
                                                <option value=""></option>
                                                <option value="po">po</option>
                                                <option value="mane">mane</option>
                                                <option value="bid">bid</option>
                                            </select>
                                            <button type="button" class="add-sig-code">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="duration">
                                            <input type="number" name="duration_value" value=""> /
                                            <select name="duration_period">
                                                <option value=""></option>
                                                <option value="12">12</option>
                                                <option value="52">52</option>
                                                <option value="365">365</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="delete-medication">Delete</button>
                                    </td>
                                  </tr>';
                        } else {
                            // If medications exist, show each medication
                            foreach ($medications as $medication) {
                                // Split the sig_codes into an array
                                $sig_codes = explode(',', $medication['sig_codes']);
                                // Format the duration (e.g., 7/365)
                                $duration = $medication['duration'];
                                $duration_parts = explode(',', $duration);
                        ?>
                        <tr>
                            <td>
                                <input type="text" name="medication_name" id="name" value="<?php echo htmlspecialchars($medication['name']); ?>">
                            </td>
                            <td>
                                <input type="number" name="medication_qty" value="<?php echo $medication['quantity']; ?>">
                            </td>
                            <td>
                                <select name="medication_measurement">
                                    <option value=""></option>
                                    <option value="mg" <?php echo ($medication['measurement'] == 'mg' ? 'selected' : ''); ?>>mg</option>
                                    <option value="ml" <?php echo ($medication['measurement'] == 'ml' ? 'selected' : ''); ?>>ml</option>
                                    <option value="tab" <?php echo ($medication['measurement'] == 'tab' ? 'selected' : ''); ?>>tab</option>
                                </select>
                            </td>
                            <td>
                                <div class="sig-codes">
                                    <?php foreach ($sig_codes as $sig_code): ?>
                                        <select name="sig_codes[]">
                                            <option value=""></option>
                                            <option value="po" <?php echo ($sig_code == 'po' ? 'selected' : ''); ?>>po</option>
                                            <option value="mane" <?php echo ($sig_code == 'mane' ? 'selected' : ''); ?>>mane</option>
                                            <option value="bid" <?php echo ($sig_code == 'bid' ? 'selected' : ''); ?>>bid</option>
                                        </select>
                                    <?php endforeach; ?>
                                    <button type="button" class="add-sig-code">+</button>
                                </div>
                            </td>
                            <td>
                                <div class="duration">
                                    <input type="number" name="duration_value" value="<?php echo $duration_parts[0]; ?>"> / 
                                    <select name="duration_period">
                                        <option value=""></option>
                                        <option value="12" <?php echo ($duration_parts[1] == '12' ? 'selected' : ''); ?>>12</option>
                                        <option value="52" <?php echo ($duration_parts[1] == '52' ? 'selected' : ''); ?>>52</option>
                                        <option value="365" <?php echo ($duration_parts[1] == '365' ? 'selected' : ''); ?>>365</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="delete-medication">Delete</button>
                            </td>
                        </tr>
                        <?php 
                            }
                        }
                        ?>
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

<script src="<?php echo URLROOT; ?>js/drEditPrescription.js?v=<?php echo time();?>"></script>
<?php require APPROOT . '/views/Components/footer.php'; ?>

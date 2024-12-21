<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';
?>

<div class="medical-history-container">
    <a href="<?php echo URLROOT; ?>drAppointment" class="history-back-arrow">
        <img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back">
    </a>
    <div class="history-container">
        <h2>Medical History</h2>
        <button id="edit-btn" class="edit-button">Edit</button>

        <form id="history-form" method="post" action="<?php echo URLROOT; ?>drMedicalHistory?appointment_id=<?php echo $appointmentId; ?>">
            <!-- Allergies -->
            <div class="section-header">
                <p><strong>Allergies:</strong></p>
                <div class="edit-mode" hidden><button type="button" class="add-item-button" data-section="allergies" hidden>+</button></div>
            </div>
            <ul id="allergies-list">
                <?php if (!empty($history['allergies'])) : ?>
                    <?php foreach ($history['allergies'] as $allergy => $description) : ?>
                        <li>
                            <span class="display-mode"><?php echo $allergy; ?>: <?php echo $description; ?></span>
                            <div class="edit-mode" hidden>
                                <input type="text" name="allergies_keys[]" value="<?php echo $allergy; ?>">
                                <input type="text" name="allergies_values[]" value="<?php echo $description; ?>">
                                <button type="button" class="delete-icon" data-section="allergies">🗑</button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>No details available</li>
                <?php endif; ?>
            </ul>

            <!-- Chronic Conditions -->
            <div class="section-header">
                <p><strong>Chronic Conditions:</strong></p>
                <div class="edit-mode" hidden><button type="button" class="add-item-button" data-section="chronic_conditions" hidden>+</button></div>
            </div>
            <ul id="chronic_conditions-list">
                <?php if (!empty($history['chronic_conditions'])) : ?>
                    <?php foreach ($history['chronic_conditions'] as $condition => $treatment) : ?>
                        <li>
                            <span class="display-mode"><?php echo $condition; ?>: <?php echo $treatment; ?></span>
                            <div class="edit-mode" hidden>
                                <input type="text" name="chronic_conditions_keys[]" value="<?php echo $condition; ?>">
                                <input type="text" name="chronic_conditions_values[]" value="<?php echo $treatment; ?>">
                                <button type="button" class="delete-icon" data-section="chronic_conditions">🗑</button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>No details available</li>
                <?php endif; ?>
            </ul>

            <!-- Past Surgeries -->
            <div class="section-header">
                <p><strong>Past Surgeries:</strong></p>
                <div class="edit-mode" hidden><button type="button" class="add-item-button" data-section="surgeries" hidden>+</button></div>
            </div>
            <ul id="surgeries-list">
                <?php if (!empty($history['past_surgeries'])) : ?>
                    <?php foreach ($history['past_surgeries'] as $surgery => $date) : ?>
                        <li>
                            <span class="display-mode"><?php echo $surgery; ?>: <?php echo $date; ?></span>
                            <div class="edit-mode" hidden>
                                <input type="text" name="surgeries_keys[]" value="<?php echo $surgery; ?>">
                                <input type="text" name="surgeries_values[]" value="<?php echo $date; ?>">
                                <button type="button" class="delete-icon" data-section="surgeries">🗑</button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>No details available</li>
                <?php endif; ?>
            </ul>

            <!-- Immunizations -->
            <div class="section-header">
                <p><strong>Immunizations:</strong></p>
                <div class="edit-mode" hidden><button type="button" class="add-item-button" data-section="immunizations" hidden>+</button></div>
            </div>
            <ul id="immunizations-list">
                <?php if (!empty($history['immunizations'])) : ?>
                    <?php foreach ($history['immunizations'] as $immunization => $status) : ?>
                        <li>
                            <span class="display-mode"><?php echo $immunization; ?>: <?php echo $status; ?></span>
                            <div class="edit-mode" hidden>
                                <input type="text" name="immunizations_keys[]" value="<?php echo $immunization; ?>">
                                <input type="text" name="immunizations_values[]" value="<?php echo $status; ?>">
                                <button type="button" class="delete-icon" data-section="immunizations">🗑</button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>No details available</li>
                <?php endif; ?>
            </ul>

            <!-- Family Medical History -->
            <div class="section-header">
                <p><strong>Family Medical History:</strong></p>
                <div class="edit-mode" hidden><button type="button" class="add-item-button" data-section="family_medical_history" hidden>+</button></div>
            </div>
            <ul id="family_medical_history-list">
                <?php if (!empty($history['family_medical_history'])) : ?>
                    <?php foreach ($history['family_medical_history'] as $relative => $conditions) : ?>
                        <li>
                            <span class="display-mode"><?php echo $relative; ?>: <?php echo $conditions; ?></span>
                            <div class="edit-mode" hidden>
                                <input type="text" name="family_medical_history_keys[]" value="<?php echo $relative; ?>">
                                <input type="text" name="family_medical_history_values[]" value="<?php echo $conditions; ?>">
                                <button type="button" class="delete-icon" data-section="family_medical_history">🗑</button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>No details available</li>
                <?php endif; ?>
            </ul>

            <button id="save-btn" class="save-button" hidden>Save</button>

            <hr>

            <!-- Last Appointment -->
            <?php if (!empty($lastAppointmentData)) : ?>
                <p><strong>Last Appointment: <?php echo $lastAppointmentData['appointment_date']; ?></strong></p>
                <ul>
                    <li><strong>Diagnosis:</strong> <?php echo $lastAppointmentData['diagnosis']; ?></li>
                    <li><strong>Medications:</strong></li>
                    <ul>
                        <?php foreach ($lastAppointmentData['medications'] as $medication) : ?>
                            <li>
                                <?php echo "{$medication['name']} - {$medication['quantity']} {$medication['measurement']} - {$medication['sig_codes']} ({$medication['duration']})"; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </ul>
            <?php else : ?>
                <p><strong>Last Appointment:</strong> No details available</p>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT; ?>js/drMedicalHistory.js"></script>

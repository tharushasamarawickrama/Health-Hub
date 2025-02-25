<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';
?>

<div class="medical-history-container">
    <a href="<?php echo URLROOT; ?>drAppointment?appointment_id=<?php echo $appointmentId; ?>" class="history-back-arrow">
        <img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back">
    </a>
    <div class="history-container">
        <h2>Medical History</h2>
        <div>
            <button id="edit-btn" class="edit-button">Edit</button>
            <button id="cancel-btn" class="cancel-button" hidden onclick="window.location.href='<?php echo URLROOT; ?>drMedicalHistory?appointment_id=<?php echo $appointmentId; ?>'">Cancel</button>
        </div>


        <form id="history-form" method="post" action="<?php echo URLROOT; ?>drMedicalHistory?appointment_id=<?php echo $appointmentId; ?>">
            <!-- Allergies -->
            <div>
                <div class="section-header">
                    <button type="button" class="delete-item-button" data-section="allergies">-</button>
                    <p><strong>Allergies:</strong></p>
                </div>
                <ul id="allergies-list">
                    <?php if (!empty($history['allergies'])) : ?>
                        <?php foreach ($history['allergies'] as $allergy => $description) : ?>
                            <li>
                                <span class="display-mode"><?php echo $allergy; ?>: <?php echo $description; ?></span>
                                <div class="edit-mode" hidden>
                                    <input type="text" name="allergies_keys[]" value="<?php echo $allergy; ?>">
                                    <input type="text" name="allergies_values[]" value="<?php echo $description; ?>">
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>No details available</li>
                    <?php endif; ?>
                </ul>
                <button type="button" class="add-item-button" data-section="allergies">+</button>
            </div>

            <!-- Chronic Conditions -->
            <div>
                <div class="section-header">
                    <button type="button" class="delete-item-button" data-section="chronic_conditions">-</button>
                    <p><strong>Chronic Conditions:</strong></p>
                </div>
                <ul id="chronic_conditions-list">
                    <?php if (!empty($history['chronic_conditions'])) : ?>
                        <?php foreach ($history['chronic_conditions'] as $condition => $treatment) : ?>
                            <li>
                                <span class="display-mode"><?php echo $condition; ?>: <?php echo $treatment; ?></span>
                                <div class="edit-mode" hidden>
                                    <input type="text" name="chronic_conditions_keys[]" value="<?php echo $condition; ?>">
                                    <input type="text" name="chronic_conditions_values[]" value="<?php echo $treatment; ?>">
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>No details available</li>
                    <?php endif; ?>
                </ul>
                <button type="button" class="add-item-button" data-section="chronic_conditions">+</button>
            </div>

            <!-- Past Surgeries -->
            <div>
                <div class="section-header">
                    <button type="button" class="delete-item-button" data-section="past_surgeries">-</button>
                    <p><strong>Past Surgeries:</strong></p>
                </div>
                <ul id="past_surgeries-list">
                    <?php if (!empty($history['past_surgeries'])) : ?>
                        <?php foreach ($history['past_surgeries'] as $surgery => $date) : ?>
                            <li>
                                <span class="display-mode"><?php echo $surgery; ?>: <?php echo $date; ?></span>
                                <div class="edit-mode" hidden>
                                    <input type="text" name="past_surgeries_keys[]" value="<?php echo $surgery; ?>">
                                    <input type="text" name="past_surgeries_values[]" value="<?php echo $date; ?>">
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>No details available</li>
                    <?php endif; ?>
                </ul>
                <button type="button" class="add-item-button" data-section="past_surgeries">+</button>
            </div>

            <!-- Immunizations -->
            <div>
                <div class="section-header">
                    <button type="button" class="delete-item-button" data-section="immunizations">-</button>
                    <p><strong>Immunizations:</strong></p>
                </div>
                <ul id="immunizations-list">
                    <?php if (!empty($history['immunizations'])) : ?>
                        <?php foreach ($history['immunizations'] as $immunization => $status) : ?>
                            <li>
                                <span class="display-mode"><?php echo $immunization; ?>: <?php echo $status; ?></span>
                                <div class="edit-mode" hidden>
                                    <input type="text" name="immunizations_keys[]" value="<?php echo $immunization; ?>">
                                    <input type="text" name="immunizations_values[]" value="<?php echo $status; ?>">
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>No details available</li>
                    <?php endif; ?>
                </ul>
                <button type="button" class="add-item-button" data-section="immunizations">+</button>
            </div>

            <!-- Family Medical History -->
            <div>
                <div class="section-header">
                    <button type="button" class="delete-item-button" data-section="family_medical_history">-</button>
                    <p><strong>Family Medical History:</strong></p>
                </div>
                <ul id="family_medical_history-list">
                    <?php if (!empty($history['family_medical_history'])) : ?>
                        <?php foreach ($history['family_medical_history'] as $relative => $conditions) : ?>
                            <li>
                                <span class="display-mode"><?php echo $relative; ?>: <?php echo $conditions; ?></span>
                                <div class="edit-mode" hidden>
                                    <input type="text" name="family_medical_history_keys[]" value="<?php echo $relative; ?>">
                                    <input type="text" name="family_medical_history_values[]" value="<?php echo $conditions; ?>">
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>No details available</li>
                    <?php endif; ?>
                </ul>
                <button type="button" class="add-item-button" data-section="family_medical_history">+</button>
            </div>

            <!-- Other -->
            <div>
                <div class="section-header">
                    <button type="button" class="delete-item-button" data-section="other">-</button>
                    <p><strong>Others:</strong></p>
                </div>
                <ul id="others-list">
                    <?php if (!empty($history['others'])) : ?>
                        <?php foreach ($history['others'] as $heading => $description) : ?>
                            <li>
                                <span class="display-mode"><?php echo $heading; ?>: <?php echo $description; ?></span>
                                <div class="edit-mode" hidden>
                                    <input type="text" name="others_keys[]" value="<?php echo $heading; ?>">
                                    <input type="text" name="others_values[]" value="<?php echo $description; ?>">
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>No details available</li>
                    <?php endif; ?>
                </ul>
                <button type="button" class="add-item-button" data-section="others">+</button>
            </div>

            <button id="save-btn" class="save-button" hidden>Save</button>

            <hr>

            <!-- Previous Appointment -->
            <?php if (!empty($prevAppointmentData)) : ?>
                <p><strong>Previous Appointment: <?php echo $prevAppointmentData['appointment_date']; ?></strong></p>
                <ul>
                    <li><strong>Diagnosis:</strong> <?php echo $prevAppointmentData['diagnosis']; ?></li>
                    <li><strong>Medications:</strong></li>
                    <ul>
                    <?php if (!empty($prevAppointmentData['medications'])) : ?>
                        <?php foreach ($prevAppointmentData['medications'] as $medication) : ?>
                            <li>
                                <?php echo "{$medication['name']} - {$medication['quantity']} {$medication['measurement']} - {$medication['sig_codes']} ({$medication['duration']})"; ?>
                            </li>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <li>No medications available.</li>
                        <?php endif; ?>
                    </ul>
                </ul>
                <a 
                    href="<?php echo URLROOT; ?>drAppointment?appointment_id=<?php echo $prevAppointmentData['prev_appointment_id']; ?>">
                    Click to view
                </a>
            <?php else : ?>
                <p><strong>Previous Appointment:</strong> No details available.</p>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT; ?>js/drMedicalHistory.js?v=<?php echo time(); ?>"></script>

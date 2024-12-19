<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

// Sample data for demonstration
$history = [
    'patient_name' => 'Mrs. Gemini Peiris',
    'allergies' => [
        'Peanuts' => 'Causes mild anaphylaxis.',
        'Pollen' => 'Triggers mild hay fever.'
    ],
    'chronic_conditions' => [
        'Asthma' => 'Albuterol Inhaler as needed, Montelukast (10mg daily).',
        'Allergic Rhinitis' => 'Cetirizine (10mg daily).'
    ],
    'past_surgeries' => [
        'Appendectomy' => 'June 2018'
    ],
    'immunizations' => [
        'Tetanus' => 'Last booster in March 2021.',
        'Influenza' => 'Annual vaccination, last received in October 2023.',
        'COVID-19' => 'Completed primary series and booster (June 2023).'
    ],
    'family_medical_history' => [
        'Father' => 'Hypertension, Type 2 Diabetes.',
        'Mother' => 'Asthma, Osteoarthritis.',
        'Siblings' => 'None known with chronic conditions.'
    ],
    'last_appointment' => [
        'date' => 'November 15, 2024',
        'diagnosis' => 'Mild Bronchitis',
        'medications' => [
            ['name' => 'Paracetamol', 'type' => 'Tablet', 'dose' => '500mg', 'duration' => '7 days'],
            ['name' => 'Cough Syrup', 'type' => 'Liquid', 'dose' => '10ml', 'duration' => '5 days']
        ]
    ]
];
?>

<div class="medical-history-container">
    <a href="<?php echo URLROOT; ?>drAppointment" class="history-back-arrow">
        <img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back">
    </a>
    <div class="history-container">
        <h2><?php echo $history['patient_name']; ?></h2>
        <button id="edit-btn" class="edit-button">Edit</button>

        <form id="history-form" method="post">
            <!-- Allergies -->
            <div class="section-header">
                <p><strong>Allergies:</strong></p>
                <button type="button" class="add-item-button" data-section="allergies">+</button>
            </div>
            <ul id="allergies-list">
                <?php foreach ($history['allergies'] as $allergy => $description) : ?>
                    <li>
                        <span class="display-mode"><?php echo $allergy; ?>: <?php echo $description; ?></span>
                        <div class="edit-mode" hidden>
                            <input type="text" name="allergies_keys[]" value="<?php echo $allergy; ?>">
                            <input type="text" name="allergies_values[]" value="<?php echo $description; ?>">
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Chronic Conditions -->
            <div class="section-header">
                <p><strong>Chronic Conditions:</strong></p>
                <button type="button" class="add-item-button" data-section="chronic">+</button>
            </div>
            <ul id="chronic-list">
                <?php foreach ($history['chronic_conditions'] as $condition => $treatment) : ?>
                    <li>
                        <span class="display-mode"><?php echo $condition; ?>: <?php echo $treatment; ?></span>
                        <div class="edit-mode" hidden>
                            <input type="text" name="chronic_keys[]" value="<?php echo $condition; ?>">
                            <input type="text" name="chronic_values[]" value="<?php echo $treatment; ?>">
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Past Surgeries -->
            <div class="section-header">
                <p><strong>Past Surgeries:</strong></p>
                <button type="button" class="add-item-button" data-section="surgeries">+</button>
            </div>
            <ul id="surgeries-list">
                <?php foreach ($history['past_surgeries'] as $surgery => $date) : ?>
                    <li>
                        <span class="display-mode"><?php echo $surgery; ?>: <?php echo $date; ?></span>
                        <div class="edit-mode" hidden>
                            <input type="text" name="surgeries_keys[]" value="<?php echo $surgery; ?>">
                            <input type="text" name="surgeries_values[]" value="<?php echo $date; ?>">
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Immunizations -->
            <div class="section-header">
                <p><strong>Immunizations:</strong></p>
                <button type="button" class="add-item-button" data-section="immunization">+</button>
            </div>
            <ul id="immunization-list">
                <?php foreach ($history['immunizations'] as $immunization => $status) : ?>
                    <li>
                        <span class="display-mode"><?php echo $immunization; ?>: <?php echo $status; ?></span>
                        <div class="edit-mode" hidden>
                            <input type="text" name="immunizations_keys[]" value="<?php echo $immunization; ?>">
                            <input type="text" name="immunizations_values[]" value="<?php echo $status; ?>">
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Family Medical History -->
            <div class="section-header">
                <p><strong>Family Medical History:</strong></p>
                <button type="button" class="add-item-button" data-section="family">+</button>
            </div>
            <ul id="family-list">
                <?php foreach ($history['family_medical_history'] as $relative => $conditions) : ?>
                    <li>
                        <span class="display-mode"><?php echo $relative; ?>: <?php echo $conditions; ?></span>
                        <div class="edit-mode" hidden>
                            <input type="text" name="family_keys[]" value="<?php echo $relative; ?>">
                            <input type="text" name="family_values[]" value="<?php echo $conditions; ?>">
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <button id="save-btn" class="save-button" hidden>Save</button>

            <hr>

            <!-- Last Appointment -->
            <p><strong>Last Appointment - <?php echo $history['last_appointment']['date']; ?></strong></p>
            <ul>
                <li><strong>Diagnosis:</strong> <?php echo $history['last_appointment']['diagnosis']; ?></li>
                <li><strong>Medications:</strong></li>
                <ul>
                    <?php foreach ($history['last_appointment']['medications'] as $medication) : ?>
                        <li>
                            <?php echo $medication['name']; ?> (<?php echo $medication['type']; ?>) - <?php echo $medication['dose']; ?> - <?php echo $medication['duration']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </ul>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT; ?>js/drMedicalHistory.js"></script>

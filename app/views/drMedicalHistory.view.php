<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

$history = [
    'patient_name' => 'Mrs. Gemini Peiris',
    'allergies' => [
        'Peanuts' => 'Causes mild anaphylaxis.',
        'Pollen' => 'Triggers mild hay fever.'
    ],
    'chronic_conditions' => [
        'Asthma' => [
            'Diagnosis Date' => 'April 2010',
            'Current Treatment' => 'Albuterol Inhaler as needed, Montelukast (10mg daily).'
        ],
        'Allergic Rhinitis' => [
            'Diagnosis Date' => 'May 2015',
            'Current Treatment' => 'Cetirizine (10mg daily).'
        ]
    ],
    'past_surgeries' => [
        'Appendectomy' => [
            'Date' => 'June 2018',
            'Surgeon' => 'Dr. Emily Carter',
            'Complications' => 'None'
        ]
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
    ]
];
?>

    <div class="container">
        <a href="#" class="back-arrow"><img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back"></a>
        <div class="history-container">
            <h2><?php echo $history['patient_name']; ?></h2>

            <p><strong>Allergies:</strong></p>
            <ul>
                <?php foreach ($history['allergies'] as $allergy => $description) : ?>
                    <li><?php echo $allergy; ?>: <?php echo $description; ?></li>
                <?php endforeach; ?>
            </ul>

            <p><strong>Chronic Conditions:</strong></p>
            <ul>
                <?php foreach ($history['chronic_conditions'] as $condition => $details) : ?>
                    <li><?php echo $condition; ?>:
                        <ul>
                            <?php foreach ($details as $key => $value) : ?>
                                <li><?php echo $key; ?>: <?php echo $value; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>

            <p><strong>Past Surgeries:</strong></p>
            <ul>
                <?php foreach ($history['past_surgeries'] as $surgery => $details) : ?>
                    <li><?php echo $surgery; ?>:
                        <ul>
                            <?php foreach ($details as $key => $value) : ?>
                                <li><?php echo $key; ?>: <?php echo $value; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>

            <p><strong>Immunizations:</strong></p>
            <ul>
                <?php foreach ($history['immunizations'] as $immunization => $status) : ?>
                    <li><?php echo $immunization; ?>: <?php echo $status; ?></li>
                <?php endforeach; ?>
            </ul>

            <p><strong>Family Medical History:</strong></p>
            <ul>
                <?php foreach ($history['family_medical_history'] as $relative => $conditions) : ?>
                    <li><?php echo $relative; ?>: <?php echo $conditions; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

<?php require APPROOT . '/views/Components/footer.php' ?>
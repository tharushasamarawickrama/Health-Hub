<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

$today = date('Y-m-d');
$isPastAppointment = strtotime($appointment_date) < strtotime($today);

?>

<div class="dr-prescription-container">
    <div class="prescription-header">
        <a href="<?php echo URLROOT; ?>drAppointment?appointment_id=<?= $appointment_id; ?>" class="prescription-back-arrow"><img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back"></a>
        <h2>Prescription Details</h2>
    </div>
    <div class="prescription-container">
        <h2>Diagnosis</h2>

        <?php if (empty($prescription['diagnosis'])): ?>
            <p>No diagnosis available</p>
        <?php else: ?>
            <textarea id="diagnosis-text" readonly><?php echo $prescription['diagnosis']; ?></textarea>
        <?php endif; ?>

        <div id="medications-container">
            <h2>Medications</h2>
            <?php if (empty($medications)): ?>
                <p>No medications prescribed</p>
            <?php else: ?>
                <table class="medications-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Measurement</th>
                            <th>Sig Codes</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($medications as $medication) {
                            $duration = $medication['duration'];
                            $duration_parts = explode(',', $duration);
                            $formatted_duration = $duration_parts[0] . '/' . $duration_parts[1];
                        ?>
                        <tr>
                            <td><?php echo $medication['name']; ?></td>
                            <td><?php echo $medication['quantity']; ?></td>
                            <td><?php echo $medication['measurement']; ?></td>
                            <td><?php echo $medication['sig_codes']; ?></td>
                            <td><?php echo $formatted_duration; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <?php if(!$isPastAppointment): ?>
            <a href="<?php echo URLROOT; ?>drEditPrescription?appointment_id=<?php echo $appointment_id; ?>"><button class="prescription-actions">Edit</button></a>
        <?php endif; ?>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>

<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

// Simulated fetched data (commented out for example)
// $prescription = [
//     'diagnosis' => 'Patient suffering from severe back pain due to muscle strain.',
// ];

// $medications = [
//     ["name" => "Paracetamol", "quantity" => 1000, "measurement" => "mg", "sig_codes" => "po,mane", "duration" => "7,365"],
//     ["name" => "Ibuprofen", "quantity" => 300, "measurement" => "mg", "sig_codes" => "bid", "duration" => "5,365"],
// ];

?>

<div class="dr-prescription-container">
    <div class="prescription-header">
        <a href="<?php echo URLROOT; ?>drAppointment" class="prescription-back-arrow"><img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back"></a>
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
        <a href="<?php echo URLROOT ; ?>drEditPrescription"><button class="prescription-actions">Edit</button></a>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>

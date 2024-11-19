<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

// Simulated fetched data
$diagnosis = "No diagnosis available.";
$medications = [
    ["name" => "Panadol 500 mg", "qty" => 2, "measurement" => "tab", "sig_code1" => "po", "sig_code2" => "mane", "duration_num" => 5, "duration_period" => 365],
    ["name" => "Timolol", "qty" => 2, "measurement" => "gtt", "sig_code1" => "bd", "sig_code2" => "", "duration_num" => 1, "duration_period" => 52],
];

?>

<div class="dr-prescription-container">
    <a href="#" class="prescription-back-arrow"><img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back"></a>
    <div class="prescription-container">
        <h2>Diagnosis</h2>
        <textarea id="diagnosis-text" readonly><?php echo htmlspecialchars($diagnosis); ?></textarea>

        <h2>Medications</h2>
        <div id="medications-container">
            <?php foreach ($medications as $index => $medication): ?>
                <div class="medication-row" data-index="<?php echo $index; ?>">
                    <input type="text" value="<?php echo $medication['name']; ?>" class="med-name" readonly>
                    <input type="number" value="<?php echo $medication['qty']; ?>" class="med-qty" readonly>
                    <select class="med-measurement" disabled>
                        <option <?php echo $medication['measurement'] === "mg" ? "selected" : ""; ?>>mg</option>
                        <option <?php echo $medication['measurement'] === "ml" ? "selected" : ""; ?>>ml</option>
                        <option <?php echo $medication['measurement'] === "gtt" ? "selected" : ""; ?>>gtt</option>
                        <option <?php echo $medication['measurement'] === "tab" ? "selected" : ""; ?>>tab</option>
                        <option <?php echo $medication['measurement'] === "cap" ? "selected" : ""; ?>>cap</option>
                    </select>
                    <select class="med-sig-code1" disabled>
                        <option <?php echo $medication['sig_code1'] === "qd" ? "selected" : ""; ?>>qd</option>
                        <option <?php echo $medication['sig_code1'] === "bd" ? "selected" : ""; ?>>bd</option>
                        <option <?php echo $medication['sig_code1'] === "tds" ? "selected" : ""; ?>>tds</option>
                        <option <?php echo $medication['sig_code1'] === "qid" ? "selected" : ""; ?>>qid</option>
                        <option <?php echo $medication['sig_code1'] === "po" ? "selected" : ""; ?>>po</option>
                        <option <?php echo $medication['sig_code1'] === "IV" ? "selected" : ""; ?>>IV</option>
                        <option <?php echo $medication['sig_code1'] === "ou" ? "selected" : ""; ?>>ou</option>
                        <option <?php echo $medication['sig_code1'] === "od" ? "selected" : ""; ?>>od</option>
                        <option <?php echo $medication['sig_code1'] === "mane" ? "selected" : ""; ?>>mane</option>
                        <option <?php echo $medication['sig_code1'] === "nocte" ? "selected" : ""; ?>>nocte</option>
                    </select>
                    <input type="number" value="<?php echo $medication['duration_num']; ?>" class="med-duration-num" readonly>
                    <select class="med-duration-period" disabled>
                        <option <?php echo $medication['duration_period'] === 365 ? "selected" : ""; ?>>365</option>
                        <option <?php echo $medication['duration_period'] === 52 ? "selected" : ""; ?>>52</option>
                        <option <?php echo $medication['duration_period'] === 12 ? "selected" : ""; ?>>12</option>
                    </select>
                    <button class="delete-medication-btn" style="display: none;">Delete</button>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="add-medication" style="display: none;">
            <input type="text" placeholder="Medication Name" class="med-name">
            <input type="number" placeholder="Qty" class="med-qty">
            <select class="med-measurement">
                <option>mg</option>
                <option>ml</option>
                <option>gtt</option>
                <option>tab</option>
                <option>cap</option>
            </select>
            <select class="med-sig-code1">
                <option>qd</option>
                <option>bd</option>
                <option>tds</option>
                <option>qid</option>
                <option>po</option>
                <option>IV</option>
                <option>ou</option>
                <option>od</option>
                <option>mane</option>
                <option>nocte</option>
            </select>
            <input type="number" placeholder="Duration (Num)" class="med-duration-num">
            <select class="med-duration-period">
                <option>365</option>
                <option>52</option>
                <option>12</option>
            </select>
            <button id="add-medication-btn">Add</button>
        </div>

        <div class="prescription-actions">
            <button id="edit-button">Edit</button>
            <button id="save-button" style="display: none;">Save</button>
        </div>
    </div>
</div>



<script src="<?php echo URLROOT; ?>/assets/js/drPrescription.js"></script>
<?php require APPROOT . '/views/Components/footer.php'; ?>

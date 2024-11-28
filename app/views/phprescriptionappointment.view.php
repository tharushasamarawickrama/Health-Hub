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
            <div class="ph-pres-app-prescription-header">
                <p>Appointment ID: <b>6465</b></p>
                <p>Patient NIC: <b>200268300728</b></p>
                <p>Age: <b>22</b></p>
                <p>Gender: <b>Female</b></p>
                <p>Date: <b>August 18, 2024</b> | Time: <b>14:25</b></p>
                <p>Doc ID: <b>103</b></p>
                <p>Doc Name: <b>Dr. Krishantha Perera</b></p>
            
            <table class="ph-pres-app-prescription-table">
                <tr>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Measurement</th>
                    <th>Sig codes</th>
                    <th>Duration</th>
                </tr>
                <tr>
                    <td>Panadol 500mg - Tab</td>
                    <td>10</td>
                    <td>Tablet</td>
                    <td>po</td>
                    <td>5/365</td>
                </tr>
                <tr>
                    <td>Timolol - Syr</td>
                    <td>1</td>
                    <td>Syrup</td>
                    <td>TID</td>
                    <td>1/7</td>
                </tr>
            </table>
            </div>
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

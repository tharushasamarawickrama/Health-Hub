<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>
<div class="ph-pres-app-dashboard">
        <div class="ph-pres-app-appcontent">
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
                    <th>Medicine name</th>
                    <th>Dosage</th>
                    <th>Duration</th>
                </tr>
                <tr>
                    <td>Panadol 500mg - Tab</td>
                    <td>3 times a day before meal</td>
                    <td>5/365</td>
                </tr>
                <tr>
                    <td>Timolol - Syr</td>
                    <td>2 times a day after meal</td>
                    <td>1/7</td>
                </tr>
            </table>
        </div>
            <form class="ph-pres-app-inventory-form">
                <div class="ph-pres-app-inventory-row">
                    <label><input type="radio" name="medType" value="Sy"> Syrup</label>
                    <label><input type="radio" name="medType" value="Tablet" checked> Tablet</label>
                    <input type="text" placeholder="Medicine Name" name="medicineName">
                    <select name="code">
                        <option value="BD">BD</option>
                        <option value="TID">TDS</option>
                        <option value="TID">Daily</option>
                        <option value="TID">SOS</option>
                    </select>
                    <input type="number" name="dose" placeholder="Dose" min="0" required>
                    <input type="number" name="durationDays" placeholder="Days" min="0"  required>
                    <input type="number" name="durationTotal" placeholder="Total" min="0" required>
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

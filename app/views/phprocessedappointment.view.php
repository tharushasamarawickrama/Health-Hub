<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>
<div class="ph-proc-app-dashboard">
    <div class="ph-proc-app-appcontent">
        <div class="ph-proc-app-back-button-container">
            <a href="<?php echo URLROOT; ?>/phprocessedprescriptions" class="ph-proc-app-back-button">
            <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
            Back
            </a>
        </div> 
        <div class="ph-proc-app-prescription-header">
            <p>Appointment ID: <b>6465</b></p>
            <p>Patient NIC: <b>200268300728</b></p>
            <p>Age: <b>22</b></p>
            <p>Gender: <b>Female</b></p>
            <p>Date: <b>August 18, 2024</b> | Time: <b>14:25</b></p>
            <p>Doc ID: <b>103</b></p>
            <p>Doc Name: <b>Dr. Krishantha Perera</b></p>
         
            <table class="ph-proc-app-prescription-table">
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
                    <td>100</td>
                    <td>ml</td>
                    <td>TID</td>
                    <td>1/7</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php'; ?>

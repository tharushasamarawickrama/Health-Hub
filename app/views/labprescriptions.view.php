<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/labNavbar.php' ?>
<div class = "lab-pres-search-box">
        <input type="text" id="lab-pres-searchInput" placeholder="Type Appointment Id...">
        <button onclick=searchAppointment()>
            <img src ="<?php echo URLROOT; ?>/assets/images/search.png" alt="Search Icon" class="lab-pres-search-icon">
        </button>
        <div class="lab-pres-search-result">
            <div id="lab-pres-resultContainer">
                <a href="<?php echo URLROOT; ?>/labprescriptionappointment" class="lab-pres-result-item">
                    <div>01. </div>
                    <div>Appointment ID: 6465</div>
                    <div>NIC:200268300728</div></a>
                <a href="#" class="lab-pres-result-item">
                    <div>02. </div>
                    <div>Appointment ID: 6352</div>
                    <div>NIC:200173756237</div></a>
                <a href="#" class="lab-pres-result-item">
                    <div>03. </div>
                    <div>Appointment ID: 6673</div>
                    <div>NIC:200171724272</div></a>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/Components/footer.php' ?>
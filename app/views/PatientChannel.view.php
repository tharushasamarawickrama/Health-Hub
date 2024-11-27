<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>
<div class="PatientChannel-body">
    <h1>Patient Details</h1>
    <div class="PatientChannel-details">
        <div class="PatientChannel-card-div">
            <div class="PatientChannel-card">
                <h2>Patient Details</h2>
                <p class="PatientChannel-card-p"><strong>Name:</strong> Ashan Kavinda</p>
                <p class="PatientChannel-card-p"><strong>NIC:</strong> 200221104405</p>
                <p class="PatientChannel-card-p"><strong>Phone Number:</strong> 714596238</p>
                <p class="PatientChannel-card-p"><strong>Email:</strong> ashan@gmail.com</p>
            </div>
        </div>

        <div class="PatientChannel-card-div2">
            <div class="PatientChannel-card">
                <h2>Doctor Details</h2>
                <p class="PatientChannel-card-d"><strong>Name:</strong> Dr. Abewardhane</p>
                <p class="PatientChannel-card-d"><strong>Specialization:</strong> Gastrologist</p>
                <p class="PatientChannel-card-d"><strong>MBBS No:</strong> MB-6523</p>
            </div>
        </div>


    </div>
    <div class="patientchannel-card2-div">
        <div class="PatientChannel-card2-div2">
            <div class="PatientChannel-card">
                <img src="<?php echo URLROOT; ?>assets/images/hospital.png" alt="Hospital" class="PatientChannel-hospital-icon">
                <p class="PatientChannel-card-d"><strong>Session Date:</strong> 13 August 2024</p>
                <p class="PatientChannel-card-d"><strong>Session Time:</strong> 5.30 P.M</p>
                <p class="PatientChannel-card-d"><strong>Appointment No:</strong> 10</p>
            </div>
        </div>

    </div>

    <div class="PatientChannel-actions">
        <a href="<?php echo URLROOT; ?>setappoinment">
            <button class="btn_edit">Edit Details</button>
        </a>

        <a href="<?php echo URLROOT; ?>patientpaymentdetails">
            <button class="btn_continue">Continue</button>
        </a>

    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>
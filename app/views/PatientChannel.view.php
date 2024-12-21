<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>
<div class="PatientChannel-body">
    <h1>Patient Details</h1>
    <div class="PatientChannel-details">
        <div class="PatientChannel-card-div">
            <div class="PatientChannel-card">
                <h2>Patient Details</h2>
                <p class="PatientChannel-card-p"><strong>Name:</strong><?php echo $_SESSION['appointment']['p_firstName']." ".$_SESSION['appointment']['p_lastName'] ?></p>
                <p class="PatientChannel-card-p"><strong>NIC:</strong><?php echo $_SESSION['appointment']['nic'] ?></p>
                <p class="PatientChannel-card-p"><strong>Phone Number:</strong><?php echo $_SESSION['appointment']['phoneNumber'] ?></p>
                <p class="PatientChannel-card-p"><strong>Email:</strong><?php echo $_SESSION['appointment']['email'] ?></p>
            </div>
        </div>

        <div class="PatientChannel-card-div2">
            <div class="PatientChannel-card">
                <h2>Doctor Details</h2>
                <p class="PatientChannel-card-d"><strong>Name:</strong> Dr.<?php echo $data['firstName']." ".$data['lastName']; ?></p>
                <p class="PatientChannel-card-d"><strong>Specialization:</strong> <?php echo $data['specialization'] ; ?></p>
                <p class="PatientChannel-card-d"><strong>MBBS No:</strong> <?php echo  $data['slmcNo'] ?></p>
            </div>
        </div>


    </div>
    <div class="patientchannel-card2-div">
        <div class="PatientChannel-card2-div2">
            <div class="PatientChannel-card">
                <img src="<?php echo URLROOT; ?>assets/images/hospital.png" alt="Hospital" class="PatientChannel-hospital-icon">
                <p class="PatientChannel-card-d"><strong>Session Date:</strong><?php echo $data['date'] ?></p>
                <p class="PatientChannel-card-d"><strong>Session Time:</strong><?php echo $data['start_time'] ?></p>
                <p class="PatientChannel-card-d"><strong>Appointment No:</strong><?php echo $data['filled_slots'] ?></p>
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
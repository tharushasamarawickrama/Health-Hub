<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/reNavbar.php' ?>
<div class="re-app-det-container">
<div class="re-app-det-back-button-container">
    <a href="<?php echo URLROOT; ?>/rescheduleappointment" class="re-app-det-back-button">
    <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
            Back
            </a>
        </div> 
<div class="re-app-det-details-section">
            <div class="re-app-det-details-card">
                <h2>Patient Details</h2>
                <p><strong>Name:</strong> Ashan Kavinda</p>
                <p><strong>NIC:</strong> 200212104405</p>
                <p><strong>Phone Number:</strong> 714596238</p>
                <p><strong>Email:</strong> ashan@gmail.com</p>
            </div>

            <div class="re-app-det-details-card">
                <h2>
                    Session Details
                </h2>
                <p><strong>Session Date:</strong> 13 August 2024</p>
                <p><strong>Session Time:</strong> 5.30 P.M</p>
                <p><strong>Appointment No:</strong> 10</p>
            </div>
        </div>

        <div class="re-app-det-details-card re-app-det-doctor-card">
            <h2>Doctor Details</h2>
            <p><strong>Name:</strong> Dr. Abewardhane</p>
            <p><strong>Specialization:</strong> Gastrologist</p>
            <p><strong>MBBS No:</strong> MB-6523</p>
        </div>

        <div class="re-app-det-button-row">
            <a href="<?php echo URLROOT; ?>/rescheduleappointment" class="re-app-det-btn re-app-det-edit-btn">Edit details</a>
            <a href="<?php echo URLROOT; ?>/repaymentdetails" class="re-app-det-btn re-app-det-continue-btn">Continue</a>
        </div>
    </div>
<?php require APPROOT . '/views/Components/footer.php' ?>
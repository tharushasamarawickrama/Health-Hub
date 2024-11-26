<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/reNavbar.php' ?>
<div class="re-ch-container">
    <div class="re-ch-content">
    <div class="re-ch-back-button-container">
    <a href="<?php echo URLROOT; ?>/redashboard" class="re-ch-back-button">
    <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
            Back
            </a>
        </div> 
            <div class="re-ch-doctor-profile">
                <div class="re-ch-avatar">
                    <img src="<?php echo URLROOT; ?>/assets/images/profile-men.png" alt="Doctor Avatar">
                </div>
                <h2>Doctor Name</h2>
                <p>Gender</p>
                <p>Specialization</p>
                <button class="re-ch-view-profile-btn">View Profile</button>
            </div>

            <div class="re-ch-appointment-times">
                <h2>Available Times</h2>
                <div class="re-ch-appointment-card">
                    <p class="re-ch-date">Sunday, 17 Aug 2024</p>
                    <p class="re-ch-slots">15 of 25 slots available</p>
                    <p class="re-ch-time">5.30 P.M</p>
                    <a href="<?php echo URLROOT; ?>/rescheduleappointment" class="re-ch-schedule-btn">Schedule Appointment</a>
                    </div>
                <div class="re-ch-appointment-card">
                    <p class="re-ch-date">Monday, 19 Aug 2024</p>
                    <p class="re-ch-slots">18 of 25 slots available</p>
                    <p class="re-ch-time">8.30 P.M</p>
                    <a href="<?php echo URLROOT; ?>/rescheduleappointment" class="re-ch-schedule-btn">Schedule Appointment</a>
                </div>
                <div class="re-ch-appointment-card">
                    <p class="re-ch-date">Wednesday, 21 Aug 2024</p>
                    <p class="re-ch-slots">10 of 25 slots available</p>
                    <p class="re-ch-time">10.30 A.M</p>
                    <a href="<?php echo URLROOT; ?>/rescheduleappointment" class="re-ch-schedule-btn">Schedule Appointment</a>
                </div>
                <p class="re-ch-see-more">see more >></p>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/Components/footer.php' ?>
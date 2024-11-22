<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>
<div class="PatientChannel-body">
            <h1>Patient Details</h1>
            <div class="PatientChannel-details">
                <div class="PatientChannel-card">
                    <h2>Patient Details</h2>
                    <p><strong>Name:</strong> Ashan Kavinda</p>
                    <p><strong>NIC:</strong> 200221104405</p>
                    <p><strong>Phone Number:</strong> 714596238</p>
                    <p><strong>Email:</strong> ashan@gmail.com</p>
                </div>
                <div class="PatientChannel-card">
                    <img src="hospital-icon.png" alt="Hospital" class="PatientChannel-hospital-icon">
                    <p><strong>Session Date:</strong> 13 August 2024</p>
                    <p><strong>Session Time:</strong> 5.30 P.M</p>
                    <p><strong>Appointment No:</strong> 10</p>
                </div>
                <div class="PatientChannel-card">
                    <h2>Doctor Details</h2>
                    <p><strong>Name:</strong> Dr. Abewardhane</p>
                    <p><strong>Specialization:</strong> Gastrologist</p>
                    <p><strong>MBBS No:</strong> MB-6523</p>
                </div>
            </div>
            <div class="PatientChannel-actions">
                <button class="btn_edit">Edit Details</button>
                <button class="btn_continue">Continue</button>
            </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>
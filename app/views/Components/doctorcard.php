<div class="frame">
    <div class="card">
        <img src="<?php echo URLROOT; ?>/<?php echo $doctor['photo_path'] ?>" class="doctorpic">
    </div>

    <span class="doctorname">Dr.<?php echo $doctor['firstName'] . " " . $doctor['lastName'] ?></span>
    <span class="gender"><?php echo $doctor['gender'] ?></span>
    <span class="specialization"><?php echo $doctor['specialization'] ?></span>

    <div class="pt-button-div">
        <a href="<?php echo URLROOT; ?>channel?id=<?php echo $doctor['doctor_id'] ?>">
            <button class="channelbutton" name="channelnowbtn">Channel Now</button>
        </a>
        <button class="viewbutton" onclick="openDoctorProfileModal(<?php echo htmlspecialchars(json_encode($doctor)); ?>)">View Profile</button>
    </div>
</div>

<!-- Doctor Profile Modal -->
<div id="doctorProfileModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeDoctorProfileModal()">&times;</span>
        <h2>Doctor Profile</h2>
        <div class="modal-body">
            <img id="modalDoctorPhoto" src="" class="modal-doctor-pic" alt="Doctor Photo">
            <p><strong>Name:</strong> <span id="modalDoctorName"></span></p>
            <p><strong>Gender:</strong> <span id="modalDoctorGender"></span></p>
            <p><strong>Specialization:</strong> <span id="modalDoctorSpecialization"></span></p>
            <p><strong>Experience:</strong> <span id="modalDoctorExperience"></span></p>
            <p><strong>Certifications:</strong> <span id="modalDoctorCertifications"></span></p>
            <p><strong>Contact:</strong></p>
            <ul class="dr-contact-info">
                <li>Phone: <span id="modalDoctorPhone"></span></li>
                <li>Email: <a href="#" id="modalDoctorEmailLink"><span id="modalDoctorEmail"></span></a></li>
            </ul>
        </div>
    </div>
</div>

<script>
    // Open the modal and populate it with doctor data
    function openDoctorProfileModal(doctor) {
        document.getElementById('modalDoctorPhoto').src = "<?php echo URLROOT; ?>/" + doctor.photo_path;
        document.getElementById('modalDoctorName').textContent = "Dr. " + doctor.firstName + " " + doctor.lastName;
        document.getElementById('modalDoctorGender').textContent = doctor.gender;
        document.getElementById('modalDoctorSpecialization').textContent = doctor.specialization;
        document.getElementById('modalDoctorExperience').textContent = doctor.experience || "N/A";
        document.getElementById('modalDoctorCertifications').textContent = doctor.certifications || "N/A";
        document.getElementById('modalDoctorPhone').textContent = doctor.phoneNumber || "N/A";
        document.getElementById('modalDoctorEmail').textContent = doctor.email || "N/A";
        document.getElementById('modalDoctorEmailLink').href = "mailto:" + doctor.email;

        document.getElementById('doctorProfileModal').style.display = 'block';
    }

    // Close the modal
    function closeDoctorProfileModal() {
        document.getElementById('doctorProfileModal').style.display = 'none';
    }

    // Close the modal if the user clicks outside the modal content
    window.onclick = function(event) {
        const modal = document.getElementById('doctorProfileModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
</script>


<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

// Fetch doctor's data from the database (example data here)
// $doctorData = [
//     "name" => "Dr. R. S. Peiris",
//     "description" => "Dr. Peiris is a highly experienced physician with over 5 years of practice in providing exceptional medical care. He is deeply committed to the well-being and health of his patients, offering comprehensive care across various medical specialties. Dr. Peiris is skilled in diagnosing and treating a wide range of conditions, ensuring that each patient receives personalized and effective care.",
//     "experience" => "5+ years of medical practice",
//     "specialties" => [
//         "General Medicine", 
//         "Family Medicine", 
//         "Preventive Care", 
//         "Chronic Disease Management", 
//         "Pediatric Care", 
//         "Geriatric Care"
//     ],
//     "certifications" => [
//         "Board Certified in Family Medicine",
//         "Certified in Advanced Cardiac Life Support (ACLS)",
//         "Certified in Basic Life Support (BLS)"
//     ],
//     "availability" => "Monday to Friday, 8 AM - 6 PM",
//     "phone" => "(123) 456-7890",
//     "email" => "drpeiris@gmail.com"
// ];

$doctorData = $doctorData ?? [];
?>

<div class="dr-profile-content">
    <div class="doctor-header">
        <a href="./dr-dashboard.php" class="profile-back-arrow">
            <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back">
        </a>
        <img src="<?php echo URLROOT; ?>/assets/images/doctor.png" alt="Doctor Avatar" class="doctor-pic">
        <h1 id="doctorName"><?php echo htmlspecialchars($doctorData['name'] ?? ''); ?></h1>
    </div>
    <div class="doctor-profile-container">
        <form id="profileForm">
            <div class="doctor-description">
                <textarea name="description" readonly><?php echo htmlspecialchars($doctorData['description'] ?? ''); ?></textarea>
            </div>

            <div class="doctor-details">
                <!-- Hardcoded doctor ID -->
                <input type="hidden" name="id" value="123">
                
                <p><strong>Experience:</strong>
                    <input type="text" name="experience" value="<?php echo htmlspecialchars($doctorData['experience'] ?? ''); ?>" readonly>
                </p>
                <p><strong>Specialties:</strong>
                    <input type="text" name="specialties" value="<?php echo htmlspecialchars($doctorData['specialties'] ?? ''); ?>" readonly>
                </p>
                <p><strong>Certifications:</strong>
                    <input type="text" name="certifications" value="<?php echo htmlspecialchars($doctorData['certifications'] ?? ''); ?>" readonly>
                </p>
                <p><strong>Availability:</strong>
                    <input type="text" name="availability" value="<?php echo htmlspecialchars($doctorData['availability'] ?? ''); ?>" readonly>
                </p>
                <p><strong>Contact:</strong></p>
                <ul class="dr-contact-info">
                    <li>
                        Phone: <input type="text" name="phone" value="<?php echo htmlspecialchars($doctorData['phone'] ?? ''); ?>" readonly>
                    </li>
                    <li>
                        Email: <input type="text" name="email" value="<?php echo htmlspecialchars($doctorData['email'] ?? ''); ?>" readonly>
                    </li>
                </ul>
                <button type="button" id="editProfileBtn" class="dr-profile-btn">Edit Profile</button>
                <button type="button" id="saveProfileBtn" class="dr-profile-btn" style="display: none;">Save Profile</button>
                <button type="button" id="cancelEditBtn" class="dr-profile-btn" style="display: none;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>
<script src="<?php echo URLROOT; ?>/assets/js/drProfile.js"></script>
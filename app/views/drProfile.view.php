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
$userData = $userData ?? [];
?>

<div class="dr-profile-content">
            <div class="doctor-header">
                <a href="<?php echo URLROOT; ?>drDashboard" class="profile-back-arrow"><img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back"></a>
                <img src="<?php echo URLROOT; ?>assets/<?php echo !empty($userData['photo_path']) ? htmlspecialchars($userData['photo_path']) : 'images/doctor.png'; ?>" class="doctor-pic">
                <h1>Dr. <?php echo $userData['firstName'] . ' ' . $userData['lastName']; ?></h1>
            </div>
        <div class="doctor-profile-container">
            <div class="doctor-description">
                <p><?php echo $doctorData['description']; ?></p>
            </div>

            <!-- Doctor Details -->
            <div class="doctor-details">
                <p><strong>Experience:</strong> <?php echo $doctorData['experience']; ?></p>
                <p><strong>Specialization:</strong> <?php echo htmlspecialchars($doctorData['specialization'] ?? ''); ?></p>
                <p><strong>Certifications:</strong> <?php echo htmlspecialchars($doctorData['certifications'] ?? ''); ?></p>
                
                <!-- Contact Information -->
                <p><strong>Contact:</strong></p>
                <ul class="dr-contact-info">
                    <li>Phone: <?php echo $userData['phoneNumber']; ?></li>
                    <li>Email: <a href="mailto:<?php echo $userData['email']; ?>"><?php echo $userData['email']; ?></a></li>
                </ul>
                <a href="<?php echo URLROOT; ?>drEditProfile"><button class="dr-profile-btn">Edit Profile</button></a>
            </div>
        </div>
    </div>

<?php require APPROOT . '/views/Components/footer.php' ?>
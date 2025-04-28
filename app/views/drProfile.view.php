<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

$doctorData = $doctorData ?? [];
$userData = $userData ?? [];
?>

<div class="dr-profile-content">
            <div class="doctor-header">
                <a href="<?php echo URLROOT; ?>drDashboard" class="profile-back-arrow"><img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back"></a>
                <img src="<?php echo URLROOT; ?><?php echo !empty($userData['photo_path']) ? htmlspecialchars($userData['photo_path']) : 'assets/images/doctor.png'; ?>" class="doctor-pic">
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
                <?php if(!$requestExists): ?>
                <a href="<?php echo URLROOT; ?>drEditProfile"><button class="dr-profile-btn">Edit Profile</button></a>
                <?php else: ?>
                <button class="dr-request-btn">Request Sent</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php require APPROOT . '/views/Components/footer.php' ?>
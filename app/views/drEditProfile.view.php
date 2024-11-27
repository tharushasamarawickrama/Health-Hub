<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

$doctorData = $doctorData ?? [];
?>

<div class="dr-profile-content">
    <div class="doctor-header">
        <a href="<?php echo URLROOT; ?>drProfile" class="profile-back-arrow">
            <img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back">
        </a>
        
        <!-- Profile Picture Form -->
        <form action="<?php echo URLROOT; ?>DrEditProfilePic" method="POST" enctype="multipart/form-data" class="profile-pic-form">
            <label for="profile-pic-upload" class="profile-pic-label">
                <img src="<?php echo URLROOT; ?>assets/<?php echo !empty($doctorData['profile_pic']) ? 'uploads/' . htmlspecialchars($doctorData['profile_pic']) : 'images/doctor.png'; ?>" 
                    alt="Doctor Avatar" class="doctor-pic">
                <div class="camera-overlay">
                    <img src="<?php echo URLROOT;?>assets/images/camera-icon.png" alt="Camera">
                </div>
                <input type="file" name="profile_pic" id="profile-pic-upload" class="profile-pic-input" style="display:none;" onchange="this.form.submit()">
            </label>
        </form>


        
    </div>

    <div class="doctor-profile-container">
        <!-- Display Error or Success Messages -->
        <?php if (!empty($error)): ?>
            <div class="dr-error-message">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="dr-success-message">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <!-- Profile Update Form -->
        <form action="<?php echo URLROOT; ?>drEditProfile" method="POST" class="doctor-profile-form">
            <h1>Dr. 
                <input type="text" name="firstName" id="firstName" value="<?php echo $doctorData['firstName']; ?>">
                <input type="text" name="lastName" id="lastName" value="<?php echo $doctorData['lastName'];?>">
            </h1>
            <div class="doctor-description">
                <label for="description"><strong>Description:</strong></label>
                <textarea name="description" id="description" rows="5" class="doctor-form-control"><?php echo htmlspecialchars($doctorData['description']); ?></textarea>
            </div>

            <!-- Doctor Details -->
            <div class="doctor-details">
                <label for="experience"><strong>Experience:</strong></label>
                <input type="text" name="experience" id="experience" class="form-control" value="<?php echo htmlspecialchars($doctorData['experience']); ?>">

                <label for="specialization"><strong>Specialization:</strong></label>
                <input type="text" name="specialization" id="specialization" class="form-control" value="<?php echo htmlspecialchars($doctorData['specialization'] ?? ''); ?>">

                <label for="certifications"><strong>Certifications:</strong></label>
                <input type="text" name="certifications" id="certifications" class="form-control" value="<?php echo htmlspecialchars($doctorData['certifications'] ?? ''); ?>">

                <!-- Contact Information -->
                <strong>Contact:</strong><br>
                <label for="phoneNumber">Phone:</label>
                <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" value="<?php echo htmlspecialchars($doctorData['phoneNumber']); ?>">

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($doctorData['email']); ?>">
            </div>

            <button type="submit" class="dr-profile-btn">Save Changes</button>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>

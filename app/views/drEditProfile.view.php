<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

$doctorData = $doctorData ?? [];
$userData = $userData ?? [];
?>

<div class="dr-profile-content">
    <div class="doctor-header">
        <a href="<?php echo URLROOT; ?>drProfile" class="profile-back-arrow">
            <img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back">
        </a>
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
        <form action="<?php echo URLROOT; ?>drEditProfile" method="POST" enctype="multipart/form-data" class="doctor-profile-form">
            <label for="profile-pic-upload" class="profile-pic-label">
                <img id="preview-img" src="<?php echo URLROOT; ?>assets/<?php echo !empty($userData['photo_path']) ? htmlspecialchars($userData['photo_path']) : 'images/doctor.png'; ?>"
                    alt="Doctor Avatar" class="doctor-pic">
                <div class="camera-overlay">
                    <img src="<?php echo URLROOT; ?>assets/images/camera-icon.png" alt="Camera">
                </div>
                <input type="file" name="profile_pic" id="profile-pic-upload" class="profile-pic-input" style="display:none;" onchange="previewProfilePic(event)">
            </label>

            <h1>Dr.
                <input type="text" name="firstName" id="firstName" value="<?php echo $userData['firstName']; ?>" required>
                <input type="text" name="lastName" id="lastName" value="<?php echo $userData['lastName']; ?>" required>
            </h1>

            <div class="doctor-details">
                <div class="doctor-description">
                    <label for="description"><strong>Description:</strong></label>
                    <textarea name="description" id="description" rows="5" class="doctor-form-control"><?php echo htmlspecialchars($doctorData['description']); ?></textarea>
                </div>

                <label for="experience"><strong>Experience:</strong></label>
                <input type="text" name="experience" id="experience" class="form-control" value="<?php echo htmlspecialchars($doctorData['experience']); ?>" required>

                <label for="certifications"><strong>Certifications:</strong></label>
                <input type="text" name="certifications" id="certifications" class="form-control" value="<?php echo htmlspecialchars($doctorData['certifications'] ?? ''); ?>" required>

                <label for="certification_path"><strong>Certification_Image:</strong></label>
                <input type="file" name="certification_path" id="certification_path" class="form-control" value="">

                <label for="address"><strong>Address:</strong></label>
                <input type="text" name="address" id="address" class="form-control" value="<?php echo htmlspecialchars($userData['address']); ?>" required>

                <strong>Contact:</strong><br>
                <label for="phoneNumber">Phone:</label>
                <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" value="<?php echo htmlspecialchars($userData['phoneNumber']); ?>" pattern="\d{10}" title="Phone number must be 10 digits" required>

            </div>

            <div class="dr-profile-actions">
                <button type="button" class="dr-profile-cancel-btn" onclick="window.location.href='<?php echo URLROOT; ?>drProfile'">Cancel</button>
                <button type="submit" class="dr-profile-save-btn">Send Request</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewProfilePic(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('preview-img');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?php require APPROOT . '/views/Components/footer.php'; ?>
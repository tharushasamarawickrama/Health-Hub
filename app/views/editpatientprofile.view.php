<?php require APPROOT . '/views/Components/header.php' ?>

<?php require APPROOT . '/views/Components/header.php' ?>



<div class="profiletopicdiv">
    <h1 class="profiletopic">Patient Profile</h1>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <div class="line-image-div">
        <div>
            <div>
                <input type="file" id="file" name="ProfilePic" accept="image/*" style="display: none;">
                <img src="<?php echo isset($_SESSION['user']['ProfilePic']) && !empty($_SESSION['user']['ProfilePic'])
                                ? htmlspecialchars($_SESSION['user']['ProfilePic'])
                                : URLROOT . '/assets/images/profile-men.png'; ?>"
                    class="profileimg" id="profileImage"
                    alt="Profile" style="cursor: pointer;">

            </div>
            <h1 class="profilename"><?php echo htmlspecialchars($_SESSION['user']['FirstName']); ?></h1>
        </div>
        <div class="line-div"></div>
        <?php if (isset($_SESSION['user'])): ?>
            <div>

                <div class="patientinfo-first-div">
                    <span class="patientdetails-name">
                        <?php
                        // Assuming the selected title is stored in $_SESSION['user']['Title']
                        $selectedTitle = isset($_SESSION['user']['Title']) ? $_SESSION['user']['Title'] : '';
                        ?>
                        <span class="patientdetails">Name :</span>
                        <select class="edittitlebox" name="Title" required>
                            <option value="" disabled <?php echo empty($selectedTitle) ? 'selected' : ''; ?>>Select Title</option>
                            <option value="Mr" <?php echo ($selectedTitle === 'Mr') ? 'selected' : ''; ?>>Mr</option>
                            <option value="Mrs" <?php echo ($selectedTitle === 'Mrs') ? 'selected' : ''; ?>>Mrs</option>
                            <option value="Ms" <?php echo ($selectedTitle === 'Ms') ? 'selected' : ''; ?>>Miss</option>
                            <option value="Dr" <?php echo ($selectedTitle === 'Dr') ? 'selected' : ''; ?>>Dr</option>
                        </select>
                        <input type="text" name="FirstName" class="updatefield" value="<?php echo htmlspecialchars($_SESSION['user']['FirstName']); ?>">
                        <input type="text" name="LastName" class="updatefield" value="<?php echo htmlspecialchars($_SESSION['user']['LastName']); ?>">
                    </span><br>
                </div>
                <div class="patientinfo-div">
                    <span class="patientdetails">Email :
                        <input type="email" name="Email" class="updatefield" value="<?php echo htmlspecialchars($_SESSION['user']['Email']); ?>">
                    </span><br>
                </div>
                <div class="patientinfo-div">
                    <span class="patientdetails">Phone Number :
                        <input type="text" name="PhoneNumber" class="updatefield" value="<?php echo htmlspecialchars($_SESSION['user']['PhoneNumber']); ?>">
                    </span><br>
                </div>
                <div class="patientinfo-div">
                    <span class="patientdetails">NIC :
                        <input type="text" name="NIC" class="updatefield" value="<?php echo htmlspecialchars($_SESSION['user']['NIC']); ?>">
                    </span><br>
                </div>
                <?php
                // Assuming the selected gender is stored in $_SESSION['user']['Gender']
                $gender = isset($_SESSION['user']['Gender']) ? $_SESSION['user']['Gender'] : '';
                ?>
                <div class="patientinfo-div">
                    <span class="patientdetails">Gender:
                        <input type="radio" name="Gender" value="Male" <?php echo ($gender === 'Male') ? 'checked' : ''; ?> required>
                        <span class="gender-lable">Male</span>
                        <input type="radio" name="Gender" value="Female" <?php echo ($gender === 'Female') ? 'checked' : ''; ?> required>
                        <span class="gender-lable">Female</span>
                    </span><br>
                </div>
                <div class="patientinfo-div">
                    <span class="patientdetails">Age :
                        <input type="text" name="Age" class="updatefield" value="<?php echo htmlspecialchars($_SESSION['user']['Age']); ?>">
                    </span><br>
                </div>
                <div class="patientinfo-div">
                    <span class="patientdetails">Address :
                        <input type="text" name="Address" class="updatefield" value="<?php echo htmlspecialchars($_SESSION['user']['Address']); ?>">
                    </span><br>
                </div>
            </div>
        <?php endif; ?>

        <div>

            <button class="updatebtn" name="update" type="submit">Update Profile</button>
        </div>
    </div>
</form>




<?php require APPROOT . '/views/Components/footer.php' ?>
<script src="<?php echo URLROOT; ?>assets/js/patientprofile.js"></script>
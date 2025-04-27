<?php require APPROOT . '/views/Components/header.php' ?>


<div class="DrProfiledetails-body">
    <div class="DrProfiledetails-profile-container">
        <div class="DrProfiledetails-profile-header">
            <h1>Edit Lab Assistant Profile</h1>
            <!-- <div>
                <input class="AdminFileInput" type="file" id="file" name="photo_path" accept="image/*" style="display: none;" >
                <img src="<?php echo URLROOT; ?>/<?php echo $data['photo_path']?>" alt="Profile" class="DrProfiledetails-profile-photo" style="cursor: pointer;" id="profileImage">
            </div> -->
          
        </div>
        <form class="DrProfiledetails-profile-details-form" method="POST"  enctype="multipart/form-data">
            <div>
                <input class="AdminFileInput" type="file" id="file" name="photo_path" accept="image/*" style="display: none;" >
                <img src="<?php echo URLROOT; ?>/<?php echo $data['photo_path']?>" alt="Profile" class="DrProfiledetails-profile-photo" style="cursor: pointer;" id="profileImage">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="firstName">First Name</label>
                    <input class="DrProfiledetails-input" type="text" id="firstName" name="firstName" value="<?php echo $data['firstName']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="lastName">Last Name</label>
                    <input class="DrProfiledetails-input" type="text" id="lastName" name="lastName" value="<?php echo $data['lastName']?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="email">Email</label>
                    <input class="DrProfiledetails-input" type="email" id="email" name="email" value="<?php echo $data['email']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="phoneNumber">Phone Number</label>
                    <input class="DrProfiledetails-input" type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $data['phoneNumber']?>" style="background-color:#8ec6ed">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="gender">Gender</label>
                    <input class="DrProfiledetails-input" type="text" id="gender" name="gender" value="<?php echo $data['gender']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="age">Date of Birth</label>
                    <input class="DrProfiledetails-input" type="text" id="age" name="age" value="<?php echo $data['dob']?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="employeeNo">SLMC No</label>
                    <input class="DrProfiledetails-input" type="text" id="employeeNo" name="employeeNo" value="<?php echo $data['employeeNo']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="nic">NIC</label>
                    <input class="DrProfiledetails-input" type="text" id="nic" name="nic" value="<?php echo $data['nic']?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="address">Address</label>
                    <input class="DrProfiledetails-input" type="text" id="address" name="address" value="<?php echo $data['address']?>" style="background-color:#8ec6ed">
                </div>
            </div>
            <div class="form-actions">
            <a href="<?php echo URLROOT; ?>/LAProfiledetails?id=<?php echo $data['user_id'] ?>" class="back-btn"><button type="button" class="save-btn" id="dr-req-btn-left">BACK</button></a>
                <button type="submit" class="save-btn" name="rebutton" id="dr-req-btn-left">Update Profile</button>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>
<script src="<?php echo URLROOT; ?>assets/js/patientprofile.js"></script>

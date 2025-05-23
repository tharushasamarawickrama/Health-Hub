<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<?php require APPROOT . '/views/Components/AdminSidebar.php' ?>

<div class="DrProfiledetails-body">
    <div class="DrProfiledetails-profile-container">
        <div class="DrProfiledetails-profile-header">
            <h1>Doctor Profile</h1>
           
          <!-- <?php show($data) ?> -->
        </div>
        <form class="DrProfiledetails-profile-details-form">
            <div class="DrProfiledetails-profile-div">
                <img src="<?php echo URLROOT; ?>/<?php echo $data['photo_path']?>" alt="Doctor's Photo" class="DrProfiledetails-profile-photo">
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
                    <input class="DrProfiledetails-input" type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $data['phoneNumber']?>" readonly>
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
                    <label class="DrProfiledetails-lable" for="slmcNo">SLMC No</label>
                    <input class="DrProfiledetails-input" type="text" id="slmcNo" name="slmcNo" value="<?php echo $data['slmcNo']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="nic">NIC</label>
                    <input class="DrProfiledetails-input" type="text" id="nic" name="nic" value="<?php echo $data['nic']?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="address">Address</label>
                    <input class="DrProfiledetails-input" type="text" id="address" name="address" value="<?php echo $data['address']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="address">Specialization</label>
                    <input class="DrProfiledetails-input" type="text" id="specialization" name="specialization" value="<?php echo $data['specialization']?>" readonly>
                </div>
            </div>
            <div class="form-actions">
                <a href="<?php echo URLROOT;?>ViewAllDrProfile">
                    <button type="button" class="save-btn" id="dr-req-btn-left">Back</button>
                </a>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>

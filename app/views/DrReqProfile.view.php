<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div class="DrProfiledetails-body">
    <div class="DrProfiledetails-profile-container">
        <div class="DrProfiledetails-profile-header">
            <h1>Doctor's Request Details</h1>
            <div>
                <img src="<?php echo URLROOT; ?>/<?php echo $data['photo_path']?>" alt="Requested Doctor's Photo" class="DrProfiledetails-profile-photo">
            </div>
          
        </div>
        <form class="DrProfiledetails-profile-details-form">
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="firstName">First Name</label>
                    <input class="DrProfiledetails-input" type="text" id="firstName" name="firstName" value="<?php echo $data['firstName']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="lastName">Last Name</label>
                    <input class="DrProfiledetails-input" type="text" id="lastName" name="lastName" value="<?php echo $data['lastName']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="gender">Gender</label>
                    <input class="DrProfiledetails-input" type="text" id="gender" name="gender" value="<?php echo $data['gender']?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="email">Email</label>
                    <input class="DrProfiledetails-input" type="email" id="email" name="email" value="<?php echo $data['email']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="age">Age</label>
                    <input class="DrProfiledetails-input" type="text" id="age" name="age" value="<?php echo $data['age']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="type">Specialist or OPD</label>
                    <input class="DrProfiledetails-input" type="text" id="type" name="type" value="<?php echo $data['type']?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="address">Address</label>
                    <input class="DrProfiledetails-input" type="text" id="address" name="address" value="<?php echo $data['address']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="specialization">Specialization</label>
                    <input class="DrProfiledetails-input" type="text" id="specialization" name="specialization" value="<?php echo $data['specialization']?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="slmcNo">SLMC NO</label>
                    <input class="DrProfiledetails-input" type="text" id="slmcNo" name="slmcNo" value="<?php echo $data['slmcNo']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="nic">NIC</label>
                    <input class="DrProfiledetails-input" type="text" id="nic" name="nic" value="<?php echo $data['nic']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="phoneNumber">Phone Number</label>
                    <input class="DrProfiledetails-input" type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $data['phoneNumber']?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="experience">Experience</label>
                    <input class="DrProfiledetails-input" type="text" id="experience" name="experience" value="<?php echo $data['experience']?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="certifications">Certifications</label>
                    <input class="DrProfiledetails-input" type="text" id="certifications" name="certifications" value="<?php echo $data['certifications']?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="description">Description</label>
                    <input class="DrProfiledetails-input" type="text" id="description" name="description" value="<?php echo $data['description']?>" readonly>
                </div>
            </div>
            <div class="form-actions">
                    <a href="<?php echo URLROOT;?>AdminDrRegister?id=<?php echo $data['req_id'] ?>">
                        <button type="button" class="save-btn" id="dr-req-btn-left">Add Doctor</button>
                    </a>
                    <a href="<?php echo URLROOT;?>SLMC?id=<?php echo $data['req_id'] ?>">
                        <button type="button" class="save-btn" id="dr-req-btn-right">SLMC Certificate</button>
                    </a>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>

<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div class="DrProfiledetails-body">
    <div class="DrProfiledetails-profile-container">
        <div class="DrProfiledetails-profile-header">
            <h1>Doctor's Profile Update Request Details</h1>
            <div>
                <img src="<?php echo URLROOT; ?>/<?php echo $data['photo_path']?>" alt="Requested Doctor's Photo" class="DrProfiledetails-profile-photo">
            </div>
          
        </div>
        <form class="DrProfiledetails-profile-details-form" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="doctor_id">Doctor ID</label>
                    <input class="DrProfiledetails-input" type="text" id="doctor_id" name="doctor_id" value="<?php echo $data['doctor_id']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="firstName">First Name</label>
                    <input class="DrProfiledetails-input" type="text" id="firstName" name="firstName" value="<?php echo $data['firstName']?>" required>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="lastName">Last Name</label>
                    <input class="DrProfiledetails-input" type="text" id="lastName" name="lastName" value="<?php echo $data['lastName']?>" required>
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="experience">Experience</label>
                    <input class="DrProfiledetails-input" type="text" id="experience" name="experience" value="<?php echo $data['experience']?>" required>
                </div>
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="certifications">Certifications</label>
                    <input class="DrProfiledetails-input" type="text" id="certifications" name="certifications" value="<?php echo $data['certifications']?>" required>
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="DrProfiledetails-lable" for="description">Description</label>
                    <input class="DrProfiledetails-input" type="text" id="description" name="description" value="<?php echo $data['description']?>" required>
                </div>
            </div>
            
            
            <div class="form-actions">
                    <!-- <a href="<?php echo URLROOT;?>AdminDrRegister?id=<?php echo $data['req_id'] ?>">
                        <button type="button" class="save-btn">Add Doctor</button>
                    </a> -->
                    <a href="<?php echo URLROOT;?>/DrProfileUpdate" class="save-btn">Back</a>

                    <button type="submit" class="save-btn">Update Doctor</button>
                    
                    <a href="<?php echo URLROOT;?>SLMCUPD?id=<?php echo $data['doctor_id'] ?>">
                        <button type="button" class="save-btn">SLMC Certificate</button>
                    </a>
                    
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>

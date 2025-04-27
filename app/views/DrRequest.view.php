<?php require APPROOT . '/views/Components/header.php' ?>

<div class="AdminRegister-body">
    <div class="AdminRegister-form-container">
        <h1>Request Form</h1>

        <?php if (isset($data['error'])): ?>
            <div class="error-message" id="error-message">
                <p><?php echo $data['error']; ?></p>
            </div>
        <?php endif; ?>

        <form class="AdminRegister-form" id="addDoctorForm" action="" method="POST" enctype="multipart/form-data" >
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="firstName">First Name</label>
                    <input class="AdminInput" type="text" id="firstName" name="firstName"  pattern="[A-Za-z]+"  title="First name can only contain letters (A-Z, a-z)" required>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="lastName">Last Name</label>
                    <input class="AdminInput" type="text" id="lastName" name="lastName"  pattern="[A-Za-z]+"  title="First name can only contain letters (A-Z, a-z)" >
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="email">Email</label>
                    <input class="AdminInput" type="email" id="email" name="email" pattern="[a-z0-9]+@gmail\.com" title="Email must be in the format: anystring@gmail.com (lowercase letters and numbers only)" >
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="phoneNumber">Phone Number</label>
                    <input class="AdminInput" type="text" id="phoneNumber" name="phoneNumber" pattern="07[0-9]{8}" title="Phone number must start with '07' and have exactly 10 digits." >
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="gender">Gender</label>
                    <select class="AdminSelect" id="gender" name="gender" >
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="dob">Date of Birth</label>
                    <input class="AdminInput" type="date" id="dob" name="dob" max="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="nic">NIC</label>
                    <input class="AdminInput" type="text" id="nic" name="nic" pattern="^([0-9]{9}[V]|[0-9]{12})$" title="NIC must be 9 digits followed by 'V', or exactly 12 digits." >
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="specialization">Specialization</label>
                    <select class="AdminSelect" id="specialization" name="specialization" >
                        <option value="Cardiologist">Cardiologist</option>
                        <option value="Neurologist">Neurologist </option>
                        <option value="Dermatologist">Dermatologist</option>
                        <option value="Gastroenterologist">Gastroenterologist </option>
                        <option value="Endocrinologist">Endocrinologist</option>
                        <option value="Pulmonologist">Pulmonologist</option>
                        <option value="None">None</option>
                    </select>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="description">Bio</label>
                    <input class="AdminInput" type="text" id="description" name="description" >
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="address">Address</label>
                    <input class="AdminInput" type="text" id="address" name="address" >
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="certifications">Certifications</label>
                    <input class="AdminInput" type="text" id="certifications" name="certifications" >
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="type">Doctor's Type</label>
                    <select class="AdminSelect" id="type" name="type" >
                        <option value="specialist">Specialist</option>
                        <option value="opd">OPD </option>
                        
                    </select>

                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="experience">Experience</label>
                    <input class="AdminInput" type="text" id="experience" name="experience" >
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="slmcNo">SlmcNo</label>
                    <input class="AdminInput" type="text" id="slmcNo" name="slmcNo" pattern="^SLMC[0-9]{5}$"   title="SLMC number must start with 'SLMC' followed by exactly 5 digits." >
                </div>
                
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group-full-width">
                    <label class="AdminLabel" for="slmc_photo">SLMC Certificate</label>
                    <input class="AdminFileInput" type="file" id="slmc_photo" name="slmc_photo" accept="image/*" required>
                    
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group-full-width">
                    <label class="AdminLabel" for="photo">Doctor's Profile Photo</label>
                    <input class="AdminFileInput" type="file" id="photo" name="photo_path" accept="image/*"  required>
                    
                </div>
            </div>
            <div class="AdminRegister-form-row">
                    <a href="<?php echo URLROOT;?>patientregister"><button  class="add-doctor-btn" type="button" id="dr-req-btn-left">BACK</button></a>
                    <!-- <button type="button" class="add-doctor-btn" id="dr-req-btn-left" onclick="window.location.href='<?php echo URLROOT; ?>/patientregister';">BACK</button> -->
                    <button type="submit"  class="add-doctor-btn" id="dr-req-btn-right">Send Request</button>
            </div>
        </form>
        
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php' ?>

<?php if (isset($data['success'])): ?>
    <script>
        alert("<?php echo $data['success']; ?>");
    </script>
<?php endif; ?>

<?php if (isset($data['error'])): ?>
    <script>
        alert("<?php echo $data['error']; ?>");
    </script>
<?php endif; ?>
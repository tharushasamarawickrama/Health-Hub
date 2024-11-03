<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>
<div class="screen">
    <div class="mainblock">
        <div class="mainblockleft">
            <div class="reghealthlogodiv">
                <img src="<?php echo URLROOT; ?>/assets/images/logohealth.png" class="reghealthlogo">
                <span class="reghealthlogotext">Health HUB</span>
                <span class="regwelcometext">Welcome to Health Hub</span>
                
            </div>
        </div>
        <div class="form-section active" id="loginSection">
            <form action="" method="post">
                <div class="logindiv">
                    <span class="reglogintext">Login</span>
                    <div class="loginemaildiv">
                        <span class="regpname">NIC</span><br>
                        <input type="text" class="regemailinput" placeholder="Enter Email">
                    </div>
                    <div class="loginpassworddiv">
                        <span class="regpname">Password</span><br>
                        <input type="password" class="regemailinput" placeholder="Enter Password">
                    </div>
                        <a href="#" class="forgotpassword">Forgot Password?</a>
                    <div>
                        <button class="regnewuserbutton" onclick="event.preventDefault(); nextSection('loginSection','personalInfoSection')" id="newUserButton">New User</button>
                    </div>
                </div>
            
           
            
                <div class="regbuttondiv">
                    <button class="regbutton">Login</button>
                </div>
            </form>
        </div>
        <form action="" method="post" id="registrationForm">
    <div class="mainblockright form-section" id="personalInfoSection">
        <span class="registertext">Personal Information</span>
        
        <div class="selecttitlediv">
            <div>
                <span class="selecttitle">Title</span><br>
                <select class="titlebox" name="Title" required>
                    <option value="" disabled selected hidden>Select Title</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Miss</option>
                    <option value="Dr">Dr</option>
                </select>
                <span class="error" id="titleError"></span>
            </div>
            <div>
                <span class="regpname">First Name</span><br>
                <input type="text" class="regpnameinput" placeholder="Enter First Name" name="FirstName" required>
                <span class="error" id="firstNameError"></span>
            </div>
            <div>
                <span class="regpname">Last Name</span><br>
                <input type="text" class="regpnameinput" placeholder="Enter Last Name" name="LastName" required>
                <span class="error" id="lastNameError"></span>
            </div>
        </div>
        
        <div class="emaildiv">
            <div>
                <span class="regpname">Email</span><br>
                <input type="email" class="regemailinput" placeholder="Enter Email" name="Email" required>
                <span class="error" id="emailError"></span>
            </div>
            <div>
                <span class="regnum">Phone Number</span><br>
                <input type="text" class="regnuminput" placeholder="Enter Mobile" name="PhoneNumber" required>
                <span class="error" id="phoneError"></span>
            </div>
        </div>
        
        <div class="nicdiv">
            <span class="regnic">NIC</span><br>
            <input type="text" class="regnicinput" placeholder="Enter NIC Number" name="NIC" required>
            <span class="error" id="nicError"></span>
        </div>
        
        <div class="genderdiv">
            <div class="subgenderdiv">
                <input type="radio" class="gender" name="gender" value="male" required>
                <span class="reggender">Male</span>
            </div>
            <div class="subgenderdiv">
                <input type="radio" class="gender" name="gender" value="female" required>
                <span class="reggender">Female</span>
            </div>
            <span class="error" id="genderError"></span>
        </div>
        
        <div class="emaildiv">
            <div>
                <span class="regpname">Password</span><br>
                <input type="password" class="regemailinput" placeholder="Enter Password" name="Password" required>
                <span class="error" id="passwordError"></span>
            </div>
            <div>
                <span class="regnum">Confirm Password</span><br>
                <input type="password" class="regnuminput" placeholder="Confirm Password" required>
                <span class="error" id="confirmPasswordError"></span>
            </div>
        </div>

        <div class="regprenextbuttondiv">
            <button class="regbutton" onclick="event.preventDefault(); prevSection('loginSection')">Previous</button>
            <button class="regbutton" onclick="event.preventDefault(); nextSection('personalInfoSection', 'additionalInfoSection')">Next</button>
        </div>
    </div>

    <div class="form-section" id="additionalInfoSection">
        <span class="registertext">Additional Information</span>
        <div class="regaddressdiv">
            <span class="regaddress">Address</span><br>
            <input type="text" class="regaddressinput" placeholder="Enter Address" name="Address" required>
            <span class="error" id="addressError"></span>
        </div>
        <div class="regaddressdiv">
            <span class="regaddress">Age</span><br>
            <input type="text" class="regaddressinput" placeholder="Enter Age" name="Age" required>
            <span class="error" id="ageError"></span>
        </div>
        
        <div class="regprenextbuttondiv">
            <button class="regbutton" onclick="event.preventDefault(); prevSection('personalInfoSection')">Previous</button>
            <button type="submit" class="regbutton" name="action">Submit</button>
        </div>
    </div>
</form>
        <div class="form-section" id="successSection">
            <div class="successlogodiv">
                <img src="<?php echo URLROOT; ?>/assets/images/check-mark.png" class="success">
                <span class="registersuccesstext">Registration Successfully</span>
                <p>Thank you for registering. Your information has been successfully submitted.</p>
            </div>
           
            <div class="regbuttondiv">
                <a href="/" class="reggohomebutton">Home</a>
            </div>
        </div>

    </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>

<script src="<?php echo URLROOT;?>/assets/js/PatientRegister.js"></script>

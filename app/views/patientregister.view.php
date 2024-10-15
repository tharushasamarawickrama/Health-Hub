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
                    <button class="regnewuserbutton" onclick="nextSection('personalInfoSection')">New User</button>
                </div>
            </div>
            
            <div class="regbuttondiv">
                <button class="regbutton">Login</button>
            </div>
        </div>
        <div class="mainblockright form-section " id="personalInfoSection">
            <span class="registertext">Personal Information</span>
            <div class="selecttitlediv">
                <div>
                    <span class="selecttitle">Title</span><br>
                        <select class="titlebox">
                            <option value="" disabled selected hidden>Select Title</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Ms">Miss</option>
                            <option value="Dr">Dr</option>
                        </select>
                </div>
                <div>
                        <span class="regpname">First Name</span><br>
                        <input type="text" class="regpnameinput" placeholder="Enter First Name">
                </div>
                <div>
                        <span class="regpname">Last Name</span><br>
                        <input type="text" class="regpnameinput" placeholder="Enter Last Name">
                </div>
                
            </div>
            <div class="emaildiv">
                <div>
                            <span class="regpname">Email</span><br>
                            <input type="email" class="regemailinput" placeholder="Enter Email">
                </div>
                <div>
                            <span class="regnum">Phone Number</span><br>
                            <input type="text" class="regnuminput" placeholder="Enter Mobile">
                </div>
            </div>
            <div class="nicdiv">
                        <span class="regnic">NIC</span><br>
                        <input type="text" class="regnicinput" placeholder="Enter NIC Number">
            </div>
            <div class="genderdiv">
                <div class="subgenderdiv">
                    <input type="radio" class="gender" name="gender" value="male">
                    <span class="reggender">Male</span>
                </div>
                <div class="subgenderdiv">
                    <input type="radio" class="gender" name="gender" value="female">
                    <span class="reggender">Female</span>
                </div>
            </div> 
            <div class="emaildiv">
                <div>
                            <span class="regpname">Password</span><br>
                            <input type="password" class="regemailinput" placeholder="Enter Password">
                </div>
                <div>
                            <span class="regnum">Confirm Password</span><br>
                            <input type="password" class="regnuminput" placeholder="Confirm Password">
                </div>
            </div>
            <div class="regprenextbuttondiv">
                <button class="regbutton" onclick="prevSection('loginSection')">Previous</button>
                <button class="regbutton" onclick="nextSection('additionalInfoSection')">Next</button>
            </div>
        </div>
        <div class="form-section" id="additionalInfoSection">
            <span class="registertext">Additional Information</span>
            <!-- Add any additional fields for this section -->
            <div class="regaddressdiv">
                <span class="regaddress">Address</span><br>
                <input type="text" class="regaddressinput" placeholder="Enter Address">
            </div>
            <div class="regaddressdiv">
                <span class="regaddress">Age</span><br>
                <input type="text" class="regaddressinput" placeholder="Enter Age">
            </div>
            <!-- Add a 'Previous' button to go back and 'Next' button to proceed -->
            <div class="regprenextbuttondiv">
                <button class="regbutton" onclick="prevSection('personalInfoSection')">Previous</button>
                <button class="regbutton" onclick="nextSection('successSection')">Next</button>
            </div>
        </div>
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

<script src="<?php echo URLROOT; ?>assets/js/RegisterScript.js"></script>
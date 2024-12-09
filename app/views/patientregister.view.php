<?php require APPROOT . '/views/Components/header.php' ?>

<div class="maindiv">

    <div class="screen">

        <div class="mainblock">
            <div class="mainblockleft">
                <div class="reghealthlogodiv">
                    <img src="<?php echo URLROOT; ?>/assets/images/logohealth.png" class="reghealthlogo">
                    <span class="reghealthlogotext">Health HUB</span>
                    <span class="regwelcometext">Welcome to Health Hub</span>

                </div>
            </div>
            <div class="form-section <?= empty($data['registration_success']) ? 'active' : '' ?>" id="loginSection">
                <form action="" method="post">
                    <div class="logindiv">
                        <span class="reglogintext">Login</span>
                        <div class="loginemaildiv">

                            <?php if (!empty($errors)): ?>
                                <div class="errordiv">
                                    <?= implode("<br>", $errors) ?>
                                </div>
                            <?php endif; ?>

                            <span class="regpname">Email</span><br>
                            <input type="text" class="regemailinput" placeholder="Enter Email" name="logEmail" required>
                        </div>
                        <div class="loginpassworddiv">
                            <span class="regpname">Password</span><br>
                            <input type="password" class="regemailinput" placeholder="Enter Password" name="logPassword" required>
                        </div>
                        <a href="#" class="forgotpassword">Forgot Password?</a>
                        <div>
                            
                                <a href="<?php echo URLROOT; ?>DrRequest">
                                    <div role="button" class="pt-regnewuserbutton">New Doctor</div>
                                </a>

                            
                                <div role="button" class="pt-regnewuserbutton" onclick="event.preventDefault(); nextSection('loginSection','personalInfoSection')">New User</div>
                            
                        </div>

                    </div>



                    <div class="regbuttondiv">
                        <button class="regbutton" name="login">Login</button>
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
            <div class="form-section <?= !empty($data['registration_success']) ? 'active' : '' ?>" id="successSection">
                <div class="successlogodiv">
                    <img src="<?php echo URLROOT; ?>/assets/images/check-mark.png" class="success">
                    <span class="registersuccesstext">Registration Successfully</span>
                    <p>Thank you for registering. Your information has been successfully submitted.</p>
                </div>

                <div class="regbuttondiv">
                    <a href="<?php echo URLROOT; ?>patientregister" class="reggohomebutton">Login</a>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- <div id="toast-container" class="toast-container"></div>
<script src="<?php echo URLROOT; ?>/assets/js/Toast.js"></script> -->


<?php require APPROOT . '/views/Components/footer.php' ?>

<script src="<?php echo URLROOT; ?>/assets/js/Patientregister.js"></script>
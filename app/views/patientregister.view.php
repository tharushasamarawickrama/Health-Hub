<?php require APPROOT . '/views/Components/header.php' ?>

<div class="maindiv">

    <div class="screen">

        <div class="mainblock">
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
                        <a href="#" id="forgotPasswordLink" class="forgotpassword">Forgot Password?</a>
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

            <!-- Registration Form -->
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
                            <span class="error1" id="titleError"></span>
                        </div>
                        <div>
                            <span class="regpname">First Name</span><br>
                            <input type="text" class="regpnameinput" placeholder="Enter First Name" name="FirstName" required>
                            <span class="error1" id="firstNameError"></span>
                        </div>
                        <div>
                            <span class="regpname">Last Name</span><br>
                            <input type="text" class="regpnameinput" placeholder="Enter Last Name" name="LastName" required>
                            <span class="error1" id="lastNameError"></span>
                        </div>
                    </div>

                    <div class="emaildiv">
                        <div>
                            <span class="regpname">Email</span><br>
                            <input type="email" class="regemailinput" placeholder="Enter Email" name="Email" required>
                            <span class="error1" id="emailError"></span>
                        </div>
                        <div>
                            <span class="regnum">Phone Number</span><br>
                            <input type="text" class="regnuminput" placeholder="Enter Mobile" name="PhoneNumber" required>
                            <span class="error1" id="phoneError"></span>
                        </div>
                    </div>

                    <div class="nicdiv">
                        <span class="regnic">NIC</span><br>
                        <input type="text" class="regnicinput" placeholder="Enter NIC Number" name="NIC" required>
                        <span class="error1" id="nicError"></span>
                    </div>

                    <div class="genderdiv">
                        <div class="subgenderdiv">
                            <input type="radio" class="gender" name="gender" value="Male" required>
                            <span class="reggender">Male</span>
                        </div>
                        <div class="subgenderdiv">
                            <input type="radio" class="gender" name="gender" value="Female" required>
                            <span class="reggender">Female</span>
                        </div>
                        <span class="error1" id="genderError"></span>
                    </div>

                    <div class="emaildiv">
                        <div>
                            <span class="regpname">Password</span><br>
                            <input type="password" class="regemailinput" placeholder="Enter Password" name="Password" required>
                            <span class="error1" id="passwordError"></span>
                        </div>
                        <div>
                            <span class="regnum">Confirm Password</span><br>
                            <input type="password" class="regnuminput" placeholder="Confirm Password" required>
                            <span class="error1" id="confirmPasswordError"></span>
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
                        <span class="error1" id="addressError"></span>

                    </div>
                    <div class="regaddressdiv">
                        <span class="regaddress">Date Of Birth</span><br>
                        <input type="date" class="regaddressinput" placeholder="Select DOB" name="dob" max="<?php echo date('Y-m-d'); ?>" required>
                        <span class="error1" id="ageError"></span>
                    </div>

                    <div class="regprenextbuttondiv">
                        <button class="regbutton" onclick="event.preventDefault(); prevSection('personalInfoSection')">Previous</button>
                        <button type="submit" class="regbutton" name="action">Submit</button>
                    </div>
                </div>
            </form>

            <!-- Success Section -->
            <div class="form-section <?= !empty($data['registration_success']) ? 'active' : '' ?>" id="successSection">
                <div class="successlogodiv">
                    <img src="<?php echo URLROOT; ?>/assets/images/check-mark.png" class="success">
                    <span class="registersuccesstext">Registration Successfully</span>
                    <p>Thank you for registering. Your information has been successfully submitted.</p>
                </div>

                <div class="regbuttondiv">
                    <a href="<?php echo URLROOT; ?>patientregister?id=1" class="reggohomebutton">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div id="forgotPasswordModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="fph2">Forgot Password</h2>

        <?php if (isset($data['error'])): ?>
            <div class="alert alert-danger"><?= $data['error'] ?></div>
        <?php endif; ?>

        <?php if (isset($data['success'])): ?>
            <div class="alert alert-success"><?= $data['success'] ?></div>
        <?php endif; ?>

        <!-- Step 1: Enter Email -->
        <?php if (empty($data['show_success_only'])): ?>
        <div id="emailStep" style="display: <?= isset($data['send']) ? 'none' : 'block' ?>;">
            <form method="POST" action="">
                <label for="email" class="fplable">Enter your email:</label>
                <input type="email" id="email" name="email" class="fpemail" required>
                <button type="submit" name="sendOtp">Send OTP</button>
            </form>
        </div>

        <!-- Step 2: Enter OTP -->
        <div id="otpStep" style="display: <?= isset($data['send']) && !isset($data['otp_verified']) ? 'block' : 'none' ?>;">
            <form method="POST" action="">
                <label for="otp" class="fplable">Enter OTP sent to your email:</label>
                <input type="text" id="otp" name="otp" class="fpotp" required>
                <button type="submit" name="verifyOTP">Verify OTP</button>
            </form>
        </div>

        <!-- Step 3: Reset Password -->
        <div id="resetPasswordStep" style="display: <?= isset($data['otp_verified'])  ? 'block' : 'none' ?>;">
            
            <form method="POST" action="">
                <label for="newPassword" class="fplable">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" class="fppassword" required>
                <label for="confirmPassword" class="fplable">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="fppassword" required>
                <button type="submit" name="resetPassword" id="savechange" class="fpbutton">Save Changes</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Styles -->
<style>
    /* Modal Background */
    /* Modal Background */
    /* Modal Background */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background: linear-gradient(to bottom right, #1e3c72, #2a5298);
        backdrop-filter: blur(12px);
    }

    /* Modal Content */
    .modal-content {
        background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
        margin: 5% auto;
        padding: 35px;
        border: none;
        width: 100%;
        max-width: 480px;
        border-radius: 18px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        animation: fadeIn 0.5s ease-in-out;
    }

    /* Close Button */
    .close {
        color: #999;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .close:hover,
    .close:focus {
        color: #f44336;
        transform: rotate(90deg) scale(1.3);
    }

    /* Headings */
    .fph2 {
        font-family: 'Poppins', sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 25px;
        text-align: center;
    }

    /* Labels */
    .fplable {
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 500;
        color: #333;
        display: block;
        margin-bottom: 8px;
    }

    /* Inputs */
    .fpemail,
    .fpotp,
    .fppassword {
        width: 100%;
        padding: 14px 16px;
        margin-bottom: 20px;
        border: none;
        border-radius: 12px;
        background-color: #f0f0f0;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .fpemail:focus,
    .fpotp:focus,
    .fppassword:focus {
        background-color: #fff;
        border: 1px solid #1e88e5;
        box-shadow: 0 0 12px rgba(30, 136, 229, 0.2);
        outline: none;
    }

    /* Buttons */
    .fpbutton {
        width: 100%;
        padding: 14px 20px;
        background: linear-gradient(to right, #1e88e5, #42a5f5);
        color: white;
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .fpbutton:hover {
        background: linear-gradient(to right, #1565c0, #1e88e5);
        transform: scale(1.03);
    }

    /* Alerts */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        text-align: center;
        letter-spacing: 0.5px;
    }

    .alert-danger {
        background-color: #ffe5e5;
        color: #d32f2f;
        border-left: 5px solid #d32f2f;
    }

    .alert-success {
        background-color: #e6f4ea;
        color: #2e7d32;
        border-left: 5px solid #2e7d32;
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Modal Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("forgotPasswordModal");
        const link = document.getElementById("forgotPasswordLink");
        const close = document.querySelector(".close");
        const savechange = document.querySelector("savechange");

        // Show modal when "Forgot Password?" link is clicked
        link.addEventListener("click", function(e) {
            e.preventDefault();
            modal.style.display = "block";
        });

        // Close modal when "x" is clicked
        close.addEventListener("click", function() {
            modal.style.display = "none";
        });



        // Close modal when clicking outside the modal
        window.addEventListener("click", function(e) {
            if (e.target === modal) {
                modal.style.display = "none";
            }
        });

        <?php if (isset($data['send']) || isset($data['error']) || isset($data['otp_verified']) || isset($data['success'])): ?>
            // Show modal if any password reset steps were initiated
            modal.style.display = "block";
        <?php endif; ?>
    });
</script>

<!-- Modal Styles -->
<!--  -->

<?php require APPROOT . '/views/Components/footer.php' ?>

<script src="<?php echo URLROOT; ?>/assets/js/Patientregister.js"></script>
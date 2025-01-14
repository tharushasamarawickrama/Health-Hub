<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>

<div class="screen">
    <div class="outrectangle">
        <div>
            <a href="<?php echo URLROOT; ?>searchappoinment">
                <img src="<?php echo URLROOT; ?>/assets/images/backarrow.png" class="backimg">
            </a>

        </div>
        <form action="" method="POST" id="channelform">
            <div class="channeltextdiv">
                <span class="channeldoctortext">Channel Your Doctor</span>
            </div>
            <?php show($_SESSION['user']) ?>
            <div class="middlediv">
                <div>
                    <div class="checkdiv">
                        <div>
                            <input type="checkbox" id="isloggeduser" name="isloggeduser" />
                        </div>
                        <label>
                            Click here to add the details of the logged in user (This feature can only be used if the logged in user is the patient).
                        </label>
                    </div>

                    <div class="div1">
                        <div>
                            <span class="titletext">Title</span><br>
                            <select class="titleselect" name="Title" id="Title" required>
                                <option value="" disabled selected hidden>Select Title</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Miss</option>
                                <option value="Dr">Dr</option>
                            </select>
                        </div>
                        <div>
                            <span class="pname">Patient's First Name</span><br>
                            <input type="text" class="pnameinput" placeholder="Enter First Name" name="p_firstName" id="pfirstname" required>
                        </div>
                        <div>
                            <span class="pname">Patient's Last Name</span><br>
                            <input type="text" class="pnameinput" placeholder="Enter Last Name" name="p_lastName" id="plastname" required>
                        </div>
                    </div>
                    <div class="div2">
                        <div>
                            <span class="pnic">Patient's NIC</span><br>
                            <input type="text" class="pnicinput" placeholder="Enter NIC" name="nic" id="nic" required>
                        </div>
                        <div>
                            <span class="pnumber">Patient's Contact Number</span><br>
                            <input type="text" class="pnumberinput" placeholder="Enter Contact Number" name="phoneNumber" id="phoneNumber" required>
                        </div>
                    </div>
                    <div class="div2">
                        <div>
                            <span class="pnic">Patient's Address</span><br>
                            <input type="text" class="pnicinput" placeholder="Enter Address" name="address" id="address" required>
                        </div>
                        <div>
                            <span class="pnumber">Patient's Email</span><br>
                            <input type="email" class="pnumberinput" placeholder="Enter Email" name="email" id="email" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="div3">
                <input type="checkbox" value="yes" class="checkbox" name="addservice" required>
                <span class="checkboxtext">Add service Charge</span>
            </div>

            <div>
                <p class="para1">
                    If the appointment is cancelled, the total charge will be
                    <span class="para2">refunded without LKR 250/= service charge (This applies only if the appointment is cancelled at least 48 hours prior to the scheduled appointment).</span>
                </p>
            </div>

            <div class="div4">
                <input type="checkbox" value="yes" class="checkbox" name="terms" required>
                <span class="checkboxtext">I Agree to the Terms & Conditions</span>
            </div>

            <div class="div5">
                <button class="continuebtn">BACK</button>
                <button class="continuebtn" value="Continue" name="continue" onclick="openconfirmdeleteModal(event)">Submit</button>
            </div>

        </form>

    </div>
</div>

<div id="deleteconfirmation-modal" class="updatemodal">
    <div class="updatemodal-content">
        <h2>Successfully!</h2>
        <p>Your Appointment is added successfully</p>
        <div class="updatemodal-buttons">
            <button onclick="confirmedit(event)" class="updateyes-btn">OK</button>
        </div>
    </div>
</div>

<script>
    const sessionUserData = <?php echo json_encode($_SESSION['user'] ?? []); ?>;

    document.addEventListener("DOMContentLoaded", function () {
        const loggeduserCheckbox = document.getElementById("isloggeduser");
        const patientFirstNameInput = document.getElementById("pfirstname");
        const patientLastNameInput = document.getElementById("plastname");
        const patientEmailInput = document.getElementById("email");
        const patientPhoneInput = document.getElementById("phoneNumber");
        const idNumberInput = document.getElementById("nic");
        const title = document.getElementById("Title");
        const patientAddress = document.getElementById("address");

        function updateFormFields() {
            if (loggeduserCheckbox.checked && Object.keys(sessionUserData).length > 0) {
                patientFirstNameInput.value = sessionUserData.firstName || "";
                patientLastNameInput.value = sessionUserData.lastName || "";
                patientEmailInput.value = sessionUserData.email || "";
                patientPhoneInput.value = sessionUserData.phoneNumber || "";
                idNumberInput.value = sessionUserData.nic || "";
                title.value = sessionUserData.title || "";
                patientAddress.value = sessionUserData.address || "";
            } else {
                patientFirstNameInput.value = "";
                patientLastNameInput.value = "";
                patientEmailInput.value = "";
                patientPhoneInput.value = "";
                idNumberInput.value = "";
                title.value = "";
                patientAddress.value = "";
            }
        }

        // Initial check on page load
        updateFormFields();

        // Add event listener for changes
        loggeduserCheckbox.addEventListener("change", updateFormFields);
    });

    function openconfirmdeleteModal(event) {
        event.preventDefault();
        document.getElementById('deleteconfirmation-modal').style.display = 'block';
        const modal = document.querySelector('.updatemodal');
        modal.style.display = 'flex';
    }

    function confirmedit(event) {
        event.preventDefault();
        document.getElementById('channelform').submit();
    }
</script>

<?php require APPROOT . '/views/Components/footer.php' ?>
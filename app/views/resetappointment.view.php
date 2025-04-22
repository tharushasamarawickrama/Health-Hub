<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/ReNavbar.php' ?>

<div class="screen">
    <div class="outrectangle">
        <div>
            <a href="<?php echo URLROOT; ?>redashboard">
                <img src="<?php echo URLROOT; ?>/assets/images/backarrow.png" class="backimg">
            </a>
        </div>
        <div>

            <div class="channeltextdiv">
                <span class="channeldoctortext">Channel Your Doctor</span>
            </div>
            <form action="<?php echo URLROOT; ?>resetappointment?id=<?php echo $_GET['id']; ?>&sch_id=<?php echo $_GET['sch_id']; ?>" method="POST" id="channelform">
                <div class="dropdown-div">



                    <span class="titletext1">Select Patient</span><br>
                    <select class="patient-select" name="patientType" id="patientType" required>
                        <option value="" disabled selected hidden>Select Patient</option>
                        <option value="0">Me</option>
                        <!-- <option value="another">Another User</option> -->
                        <?php foreach ($referal as $referal1): ?>
                            <option value="<?php echo $referal1['referal_id']; ?>"><?php echo $referal1['p_firstName'] . ' ' . $referal1['p_lastName']; ?></option>
                        <?php endforeach; ?>
                        <option value="new" selected>New User</option>
                    </select>
                </div>

                <div class="middlediv">
                    <div>
                        <div class="div1">
                            <div>
                                <span class="titletext">Title</span><br>
                                <select class="titleselect" name="Title" id="Title" required>
                                    <option value="" disabled selected hidden>Select Title</option>
                                    <option value="Mr" selected>Mr</option>
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
                            <div>
                                <span class="pnumber">Patient's Age</span><br>
                                <input type="text" class="pnumberinput" placeholder="Enter Age" name="age" id="age" required>   
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
                            <div>
                                <span class="titletext">Gender</span><br>
                                <select class="titleselect" name="gender" id="gender" required>
                                    <option value="" disabled selected hidden>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
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
                    <button class="continuebtn" value="Continue" name="continue">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const referal = <?php echo json_encode($referal); ?>;
    // console.log(referal);
    document.addEventListener("DOMContentLoaded", function() {
        const patientTypeDropdown = document.getElementById("patientType");
        const patientFirstNameInput = document.getElementById("pfirstname");
        const patientLastNameInput = document.getElementById("plastname");
        const patientEmailInput = document.getElementById("email");
        const patientPhoneInput = document.getElementById("phoneNumber");
        const idNumberInput = document.getElementById("nic");
        const title = document.getElementById("Title");
        const patientAddress = document.getElementById("address");
        const age = document.getElementById("age");
        const gender = document.getElementById("gender");

        // Update form fields based on selected referal_id
        patientTypeDropdown.addEventListener("change", function() {
            const selectedReferalId = patientTypeDropdown.value;
            if (selectedReferalId == "0") {
                patientFirstNameInput.value = "<?php echo $_SESSION['user']['firstName']; ?>";
                patientLastNameInput.value = "<?php echo $_SESSION['user']['lastName']; ?>";
                patientEmailInput.value = "<?php echo $_SESSION['user']['email']; ?>";
                patientPhoneInput.value = "<?php echo $_SESSION['user']['phoneNumber']; ?>";
                idNumberInput.value = "<?php echo $_SESSION['user']['nic']; ?>";
                title.value = "<?php echo $_SESSION['user']['title']; ?>";
                patientAddress.value = "<?php echo $_SESSION['user']['address']; ?>";
                age.value = "<?php echo $_SESSION['user']['age']; ?>";
                gender.value = "<?php echo $_SESSION['user']['gender']; ?>";
            } else {

                // Find the selected referal in the referal array
                const selectedReferal = referal.find(r => r.referal_id == selectedReferalId);

                if (selectedReferal) {
                    // Update form fields with the selected referal's data
                    patientFirstNameInput.value = selectedReferal.p_firstName || "";
                    patientLastNameInput.value = selectedReferal.p_lastName || "";
                    patientEmailInput.value = selectedReferal.email || "";
                    patientPhoneInput.value = selectedReferal.phoneNumber || "";
                    idNumberInput.value = selectedReferal.nic || "";
                    title.value = selectedReferal.title || "";
                    patientAddress.value = selectedReferal.address || "";
                    age.value = selectedReferal.age || "";
                    gender.value = selectedReferal.gender || "";
                } else {
                    // Clear the form fields if no referal is selected
                    patientFirstNameInput.value = "";
                    patientLastNameInput.value = "";
                    patientEmailInput.value = "";
                    patientPhoneInput.value = "";
                    idNumberInput.value = "";
                    title.value = "";
                    patientAddress.value = "";
                    age.value = "";
                    gender.value = "";
                }
            }
        });
    });
</script>

<?php require APPROOT . '/views/Components/footer.php' ?>
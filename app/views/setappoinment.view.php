<?php require APPROOT.'/views/Components/header.php' ?>
<?php require APPROOT.'/views/Components/Navbar.php' ?>

<div class="screen">
    <div class="outrectangle">
        <form action="" method="POST">
        <div class="channeltextdiv">
            <span class="channeldoctortext">Channel Your Doctor</span>
        </div>
        
        <div class="middlediv">
            <div>
                <div class="div1">
                    <div>
                        <span class="titletext">Title</span><br>
                        <select class="titleselect" name="Title" required>
                            <option value="" disabled selected hidden>Select Title</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Ms">Miss</option>
                            <option value="Dr">Dr</option>
                        </select>
                    </div>
                    <div>
                        <span class="pname">Patient's First Name</span><br>
                        <input type="text" class="pnameinput" placeholder="Enter First Name" name="p_firstName" required>
                    </div>
                    <div>
                        <span class="pname">Patient's Last Name</span><br>
                        <input type="text" class="pnameinput" placeholder="Enter Last Name" name="p_lastName" required>
                    </div>
                </div>
                <div class="div2">
                    <div>
                        <span class="pnic">Patient's NIC</span><br>
                        <input type="text" class="pnicinput" placeholder="Enter NIC" name="nic" required>
                    </div>
                    <div>
                        <span class="pnumber">Patient's Contact Number</span><br>
                        <input type="text" class="pnumberinput" placeholder="Enter Contact Number" name="phoneNumber" required>
                    </div>
                </div>
                <div class="div2">
                    <div>
                        <span class="pnic">Patient's Address</span><br>
                        <input type="text" class="pnicinput" placeholder="Enter Address" name="address" required>
                    </div>
                    <div>
                        <span class="pnumber">Patient's Email</span><br>
                        <input type="text" class="pnumberinput" placeholder="Enter Email" name="email" required>
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
                if Appoinment is cancelled the total charge will be
                <span class="para2">refunded without LKR 250/= service charge (this Applies only the Appoinment is cancelled at least 48 hours prior to the schedule Appoinment)</span>
            </p>
        </div>
        
        <div class="div4">
            <input type="checkbox" value="yes" class="checkbox" name="terms" required> 
            <span class="checkboxtext">I Agree to the Terms & Conditions</span>
        </div>
        
        <div class="div5">
            <input type="submit" class="continuebtn" value="Continue" name="continue">
        </div>  
        </form>
        
    </div>
</div>

<?php require APPROOT.'/views/Components/footer.php' ?>


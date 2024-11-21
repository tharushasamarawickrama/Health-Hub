<?php require APPROOT.'/views/Components/header.php' ?>
<?php require APPROOT.'/views/Components/Navbar.php' ?>

<div class="screen">
    <div class="outrectangle">
        <form action="">
        <div class="channeltextdiv">
            <span class="channeldoctortext">Channel Your Doctor</span>
        </div>
        
        <div class="middlediv">
            <div>
                <div class="div1">
                    <div>
                        <span class="titletext">Title</span><br>
                        <select class="titleselect">
                            <option value="" disabled selected hidden>Select Title</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Ms">Miss</option>
                            <option value="Dr">Dr</option>
                        </select>
                    </div>
                    <div>
                        <span class="pname">Patient's First Name</span><br>
                        <input type="text" class="pnameinput" placeholder="Enter First Name">
                    </div>
                    <div>
                        <span class="pname">Patient's Last Name</span><br>
                        <input type="text" class="pnameinput" placeholder="Enter First Name">
                    </div>
                </div>
                <div class="div2">
                    <div>
                        <span class="pnic">Patient's NIC</span><br>
                        <input type="text" class="pnicinput" placeholder="Enter NIC">
                    </div>
                    <div>
                        <span class="pnumber">Patient's Contact Number</span><br>
                        <input type="text" class="pnumberinput" placeholder="Enter Contact Number">
                    </div>
                </div>
                <div class="div2">
                    <div>
                        <span class="pnic">Patient's Address</span><br>
                        <input type="text" class="pnicinput" placeholder="Enter Address">
                    </div>
                    <div>
                        <span class="pnumber">Patient's Email</span><br>
                        <input type="text" class="pnumberinput" placeholder="Enter Email">
                    </div>
                </div>
            </div>


           
        </div>
        
        <div class="div3">
            <input type="checkbox" class="checkbox"> 
            <span class="checkboxtext">Add service Charge</span>
        </div>
        
        <div>
            <p class="para1">
                if Appoinment is cancelled the total charge will be
                <span class="para2">refunded without LKR 250/= service charge (this Applies only the Appoinment is cancelled at least 48 hours prior to the schedule Appoinment)</span>
            </p>
        </div>
        
        <div class="div4">
            <input type="checkbox" class="checkbox"> 
            <span class="checkboxtext">I Agree to the Terms & Conditions</span>
        </div>
        
        <div class="div5">
            <input type="submit" class="continuebtn" value="Continue">
        </div>  
        </form>
        
    </div>
</div>

<?php require APPROOT.'/views/Components/footer.php' ?>


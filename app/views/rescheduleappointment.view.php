<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/reNavbar.php' ?>
<div class="re-sch-app-container">
<div class="re-sch-app-back-button-container">
    <a href="<?php echo URLROOT; ?>/rechannel" class="re-sch-app-back-button">
    <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
            Back
            </a>
        </div> 
<div class="re-sch-app-form-container">

            <form action="#" method="POST">
                <div class="re-sch-app-form-row">
                    <div class="re-sch-app-form-group">
                        <label for="title">Title</label>
                        <select id="title" name="title">
                            <option value="Mr">Mr</option>
                            <option value="Ms">Ms</option>
                            <option value="Mrs">Mrs</option>
                        </select>
                    </div>
                    <div class="re-sch-app-form-group">
                        <label for="first-name">Patient's First Name</label>
                        <input type="text" id="first-name" name="first_name" value="">
                    </div>
                    <div class="re-sch-app-form-group">
                        <label for="last-name">Patient's Last Name</label>
                        <input type="text" id="last-name" name="last_name" value="">
                    </div>
                </div>
                
                <div class="re-sch-app-form-row">
                    <div class="re-sch-app-form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="">
                    </div>
                    <div class="re-sch-app-form-group">
                        <label for="phone">Phone Number</label>
                        <div class="re-sch-app-phone-group">
                            <select id="country-code" name="country_code">
                                <option value="+94">+94</option>
                                <option value="+1">+1</option>
                                <option value="+44">+44</option>
                            </select>
                            <input type="text" id="phone" name="phone_number" value="">
                        </div>
                    </div>
                </div>
                
                <div class="re-sch-app-form-row">
                    <div class="re-sch-app-form-group full-width">
                        <label for="nic">NIC/Passport</label>
                        <input type="text" id="nic" name="nic" value="">
                    </div>
                </div>

            </form>
        </div>
        <a href="<?php echo URLROOT; ?>/reappointmentdetails" class="re-sch-app-continue-btn">Continue</a>
    </div>
<?php require APPROOT . '/views/Components/footer.php' ?>
<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div class="AdminRegister-body">
    <div class="AdminRegister-form-container">
        <?php if (!empty($errors)): ?>
            <div class="errordiv">
                <?= implode("<br>", $errors) ?>
            </div>
        <?php endif; ?>
        <h1>New Doctor</h1>
        <form class="AdminRegister-form" id="addDoctorForm" action="" method="POST" enctype="multipart/form-data">
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="firstName">First Name</label>
                    <input class="AdminInput" type="text" id="firstName" name="firstName" required>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="lastName">Last Name</label>
                    <input class="AdminInput" type="text" id="lastName" name="lastName">
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="password">Password</label>
                    <input class="AdminInput" type="password" id="password" name="password">
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="phoneNumber">Phone Number</label>
                    <input class="AdminInput" type="text" id="phoneNumber" name="phoneNumber">
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="email">Email</label>
                    <input class="AdminInput" type="email" id="email" name="email">
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="specialization">Specialization</label>
                    <select class="AdminSelect" id="specialization" name="specialization">
                        <option value="Cardiologist">Cardiologist</option>
                        <option value="Neurologist">Neurologist </option>
                        <option value="Dermatologist">Dermatologist</option>
                        <option value="Gastroenterologist">Gastroenterologist </option>
                        <option value="Endocrinologist">Endocrinologist</option>
                        <option value="Pulmonologist">Pulmonologist</option>
                    </select>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="gender">Gender</label>
                    <select class="AdminSelect" id="gender" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="dob">Date of Birth</label>
                    <input class="AdminInput" type="date" id="dob" name="dob">
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="slmcNo">SLMC No</label>
                    <input class="AdminInput" type="text" id="slmcNo" name="slmcNo">
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="nic">NIC</label>
                    <input class="AdminInput" type="text" id="nic" name="nic">
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group-full-width">
                    <label class="AdminLabel" for="address">Address</label>
                    <textarea class="AdminTextarea" id="address" name="address" rows="3"></textarea>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group-full-width">
                    <label class="AdminLabel" for="photo">Doctor's Photo</label>
                    <input class="AdminFileInput" type="file" id="photo" name="photo_path" accept="image/*">

                </div>
            </div>
            <div class="admin-popup-container">
                <div class="AdminRegister-form-row">
                    <button type="submit" class="add-doctor-btn" onclick="openPopup()">Add Doctor</button>
                    <div class="popup" id="popup">
                    
                    <h2>Thank You!</h2>
                    <p>Your details has been successfully submited. Thanks!</p>
                    <button type="button" onclick="closePopup()">OK</button>
                </div>
                </div>
            </div>
            <!-- <div class="container">
                <button type="submit" class="btn" onclick="openPopup()"> Submit </button>
                <div class="popup" id="popup">
                    <img src="checkmark2.png" >
                    <h2>Thank You!</h2>
                    <p>Your details has been successfully submited. Thanks!</p>
                    <button type="button" onclick="closePopup()">OK</button>
                </div>
            </div> -->
        </form>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php' ?>




<script>
    let popup = document.getElementById('popup');

    function openPopup() {
        popup.classList.add("popup-active");
    }
    function closePopup() {
        popup.classList.remove("popup-active");
    }

   
</script>
<!-- <?php if(isset($data['success']) && $data['success'] == "true"): ?>
<?php endif; ?> -->
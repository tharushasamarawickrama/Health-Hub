<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div class="AdminRegister-body">
    <div class="AdminRegister-form-container">
        <h1>New Doctor</h1>
        <form class="AdminRegister-form" id="addDoctorForm" action="" method="POST" enctype="multipart/form-data">
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="firstName">First Name</label>
                    <input class="AdminInput" type="text" id="firstName" name="firstName" required>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="lastName">Last Name</label>
                    <input class="AdminInput" type="text" id="lastName" name="lastName" >
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="password">Password</label>
                    <input class="AdminInput" type="password" id="password" name="password" >
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="phoneNumber">Phone Number</label>
                    <input class="AdminInput" type="text" id="phoneNumber" name="phoneNumber" >
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="email">Email</label>
                    <input class="AdminInput" type="email" id="email" name="email" >
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="specialization">Specialization</label>
                    <select class="AdminSelect" id="specialization" name="specialization" >
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
                    <select class="AdminSelect" id="gender" name="gender" >
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="dob">Date of Birth</label>
                    <input class="AdminInput" type="date" id="dob" name="dob" >
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="slmcNo">SLMC No</label>
                    <input class="AdminInput" type="text" id="slmcNo" name="slmcNo" >
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="nic">NIC</label>
                    <input class="AdminInput" type="text" id="nic" name="nic" >
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group-full-width">
                    <label class="AdminLabel" for="address">Address</label>
                    <textarea class="AdminTextarea" id="address" name="address" rows="3" ></textarea>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group-full-width">
                    <label class="AdminLabel" for="photo">Doctor's Photo</label>
                    <input class="AdminFileInput" type="file" id="photo" name="photo_path" accept="image/*" >
                    
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <button type="submit" class="add-doctor-btn">Add Doctor</button>
            </div>
        </form>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php' ?>

<?php if (isset($data['success'])): ?>
<script>
    alert("<?php echo $data['success']; ?>");
</script>
<?php endif; ?>
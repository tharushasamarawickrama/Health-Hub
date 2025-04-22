<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<?php require APPROOT . '/views/Components/AdminSidebar.php' ?>

<div class="AdminRegister-body">
    <div class="AdminRegister-form-container">
        <h1>New Doctor</h1>
        <form class="AdminRegister-form" id="addDoctorForm" action="" method="POST" enctype="multipart/form-data">
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="firstName">First Name</label>
                    <input class="AdminInput" type="text" id="firstName" name="firstName" 
                        value="<?php echo isset($data1['firstName']) ? htmlspecialchars($data1['firstName']) : ''; ?>" readonly>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="lastName">Last Name</label>
                    <input class="AdminInput" type="text" id="lastName" name="lastName" 
                        value="<?php echo isset($data1['lastName']) ? htmlspecialchars($data1['lastName']) : ''; ?>" readonly>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="password">Password</label>
                    <input class="AdminInput" type="password" id="password" name="password" required>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="phoneNumber">Phone Number</label>
                    <input class="AdminInput" type="text" id="phoneNumber" name="phoneNumber" 
                        value="<?php echo isset($data1['phoneNumber']) ? htmlspecialchars($data1['phoneNumber']) : ''; ?>" readonly>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="email">Email</label>
                    <input class="AdminInput" type="email" id="email" name="email" 
                        value="<?php echo isset($data1['email']) ? htmlspecialchars($data1['email']) : ''; ?>" readonly>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="specialization">Specialization</label>
                    <input class="AdminInput" type="specialization" id="specialization" name="specialization" 
                        value="<?php echo isset($data1['specialization']) ? htmlspecialchars($data1['specialization']) : ''; ?>" readonly>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="gender">Gender</label>
                    <input class="AdminInput" type="gender" id="gender" name="gender" 
                        value="<?php echo isset($data1['gender']) ? htmlspecialchars($data1['gender']) : ''; ?>" readonly>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="dob">Date of Birth</label>
                    <input class="AdminInput" type="date" id="dob" name="dob" 
                        value="<?php echo isset($data1['dob']) ? htmlspecialchars($data1['dob']) : ''; ?>" readonly>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="slmcNo">SLMC No</label>
                    <input class="AdminInput" type="text" id="slmcNo" name="slmcNo" 
                        value="<?php echo isset($data1['slmcNo']) ? htmlspecialchars($data1['slmcNo']) : ''; ?>" readonly>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="nic">NIC</label>
                    <input class="AdminInput" type="text" id="nic" name="nic" 
                        value="<?php echo isset($data1['nic']) ? htmlspecialchars($data1['nic']) : ''; ?>" readonly>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group-full-width">
                    <label class="AdminLabel" for="address">Address</label>
                    <textarea class="AdminTextarea" id="address" name="address" rows="3" readonly><?php echo isset($data1['address']) ? htmlspecialchars($data1['address']) : ''; ?></textarea>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group-full-width">
                    <label class="AdminLabel" for="age">Age</label>
                    <input class="AdminInput" type="text" id="age" name="age" 
                        value="<?php echo isset($data1['age']) ? htmlspecialchars($data1['age']) : ''; ?>" readonly>
                </div>
                <div class="AdminRegister-form-group-full-width">
                    <label class="AdminLabel" for="type">Doctor's Type</label>
                    <input class="AdminInput" type="text" id="type" name="type" 
                    value="<?php echo isset($data1['type']) ? htmlspecialchars($data1['type']) : ''; ?>" readonly>
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
    window.location.href = "<?php echo URLROOT; ?>/DrRequestList";
</script>
<?php endif; ?>
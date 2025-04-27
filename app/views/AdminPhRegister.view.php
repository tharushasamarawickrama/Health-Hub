<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<?php require APPROOT . '/views/Components/AdminSidebar.php' ?> 

<div class="AdminRegister-body">
    <div class="AdminRegister-form-container">
        <h1>New Pharmacist</h1>

        <?php if (isset($data['error'])): ?>
            <div class="error-message" id="error-message">
                <p><?php echo $data['error']; ?></p>
            </div>
        <?php endif; ?>

        <form class="AdminRegister-form" id="addDoctorForm" action="" method="POST" enctype="multipart/form-data">
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="firstName">First Name</label>
                    <input class="AdminInput" type="text" id="firstName" name="firstName" pattern="[A-Za-z]+" title="First name can only contain letters (A-Z, a-z)" required>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="lastName">Last Name</label>
                    <input class="AdminInput" type="text" id="lastName" name="lastName" pattern="[A-Za-z]+" title="Last name can only contain letters (A-Z, a-z)" required>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="password">Password</label>
                    <input class="AdminInput" type="password" id="password" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,}$" title="Password must be at least 6 characters long and include at least one uppercase letter, one lowercase letter, and one number." required>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="phoneNumber">Phone Number</label>
                    <input class="AdminInput" type="text" id="phoneNumber" name="phoneNumber" pattern="07[0-9]{8}" title="Phone number must start with '07' and have exactly 10 digits." required>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="email">Email</label>
                    <input class="AdminInput" type="email" id="email" name="email" pattern="[a-z0-9]+@gmail\.com" title="Email must be in the format: anystring@gmail.com (lowercase letters and numbers only)" required>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="title">Title</label>
                    <select class="AdminSelect" id="title" name="title" required>
                        <option value="Mr">Mr</option>
                        <option value="Dr">Dr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Miss">Miss</option>
                    </select>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="gender">Gender</label>
                    <select class="AdminSelect" id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="dob">Date of Birth</label>
                    <input class="AdminInput" type="date" id="dob" name="dob" max="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="slmcNo">SLMC No</label>
                    <input class="AdminInput" type="text" id="slmcNo" name="slmcNo" pattern="^SLMC[0-9]{5}$"   title="SLMC number must start with 'SLMC' followed by exactly 5 digits." required>
                </div>
                <div class="AdminRegister-form-group">
                    <label class="AdminLabel" for="nic">NIC</label>
                    <input class="AdminInput" type="text" id="nic" name="nic" pattern="^([0-9]{9}[V]|[0-9]{12})$" title="NIC must be 9 digits followed by 'V', or exactly 12 digits." required>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group-full-width">
                    <label class="AdminLabel" for="address">Address</label>
                    <textarea class="AdminTextarea" id="address" name="address" rows="3" required></textarea>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <div class="AdminRegister-form-group-full-width">
                    <label class="AdminLabel" for="photo">Pharmacist's Photo</label>
                    <input class="AdminFileInput" type="file" id="photo" name="photo_path" accept="image/*" required>
                </div>
            </div>
            <div class="AdminRegister-form-row">
                <button type="submit" class="add-doctor-btn" id="dr-req-btn-left">Add Pharmacist</button>
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
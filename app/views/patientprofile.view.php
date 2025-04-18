<?php require APPROOT . '/views/Components/header.php' ?>


<div class="patientprofilemain">
    <div class="Navbar">
        <a href="#">
            <img src="<?php echo URLROOT; ?>/assets/images/logohealth.png" class="logo">
        </a>

        <a href="<?php echo URLROOT; ?>home" class="navitems">Home</a>
        <a href="#" class="navitems">About</a>
        <a href="#" class="navitems">Contact</a>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['photo_path'] !== ''): ?>
            <a href="#" class="logname dropdown-toggle">

                <img src="<?php echo URLROOT . '/' . htmlspecialchars($_SESSION['user']['photo_path']); ?>" class="loginlogo">
            </a>
        <?php else: ?>
            <img src="<?php echo URLROOT; ?>/assets/images/loginlogo.jpg" class="loginlogo">
        <?php endif; ?>
        <?php if (isset($_SESSION['user'])): ?>
            <!-- User dropdown -->
            <div class="dropdown">


                <p class="username"><?php echo htmlspecialchars($_SESSION['user']['firstName']); ?></p>

                <div class="dropdown-content">
                    <a href="<?php echo URLROOT; ?>patientprofile">Profile</a>
                    <a href="?action=logout">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <!-- Show "Login" link if no user is logged in -->
            <a href="<?php echo URLROOT; ?>/Prevlog" class="login">Login</a>
        <?php endif; ?>
    </div>

    <div class="profile-top">
        <div class="profile-top2">
            <img src="<?php echo isset($_SESSION['user']['photo_path']) && !empty($_SESSION['user']['photo_path'])
                            ? htmlspecialchars($_SESSION['user']['photo_path'])
                            : URLROOT . '/assets/images/profile-men.png'; ?>" class="profileimge">
            <div class="profile-top-details">
                <span class="profile-top-details-name"><?php echo htmlspecialchars($_SESSION['user']['firstName']); ?></span><br />
                <span>Member ID:<span>00012</span></span><br />
                <span>Age:<span>25</span></span>
            </div>
        </div>
        <div class="profile-top-button-div">
            <div>
                <a href="<?php echo URLROOT; ?>pendingappointment">
                    <button class="profile-top-button1">My Appointment</button>
                </a>
            </div>

            <div>
                <a href="<?php echo URLROOT; ?>searchappointment">
                    <button class="profile-top-button2">Make An Appointment</button>
                </a>
            </div>
        </div>

    </div>
    <?php if (isset($_SESSION['user'])): ?>
        <div class="profile-middle">
            <div class="profile-middle-details">
                <div class="profile-middle-details-div">
                    <div>
                        <span>Title</span>
                        <div>
                            <input type="text" class="profile-middle-details-input" value="<?php echo htmlspecialchars($_SESSION['user']['title']); ?>">
                        </div>
                    </div>
                    <div class="profile-middle-details-div1">
                        <span>First Name</span>
                        <div>
                            <input type="text" class="profile-middle-details-input2" value="<?php echo htmlspecialchars($_SESSION['user']['firstName']); ?>">
                        </div>
                    </div>
                    <div class="profile-middle-details-div1">
                        <span>Last Name</span>
                        <div>
                            <input type="text" class="profile-middle-details-input2" value="<?php echo htmlspecialchars($_SESSION['user']['lastName']); ?>">
                        </div>
                    </div>

                </div>
                <div class="profile-middle-details-div2">
                    <div>
                        <span>Phone Number</span>
                        <div>
                            <input type="text" class="profile-middle-details-input3" value="<?php echo htmlspecialchars($_SESSION['user']['phoneNumber']); ?>">
                        </div>
                    </div>
                    <div class="profile-middle-details-div3">
                        <span>Email</span>
                        <div>
                            <input type="text" class="profile-middle-details-input3" value="<?php echo htmlspecialchars($_SESSION['user']['email']); ?>">
                        </div>
                    </div>

                </div>
                <div class="profile-middle-details-div4">
                    <span>Address</span>
                    <div>
                        <input type="text" class="profile-middle-details-input4" value="<?php echo htmlspecialchars($_SESSION['user']['address']); ?>">
                    </div>
                </div>
                <div class="profile-middle-details-div4">
                    <span>NIC</span>
                    <div>
                        <input type="text" class="profile-middle-details-input4" value="<?php echo htmlspecialchars($_SESSION['user']['nic']); ?>">
                    </div>
                </div>
                <form action="" method="POST">
                    <div class="profile-middle-details-button-div">
                        <a href="<?php echo URLROOT; ?>patientprofile?action=logout" class="profile-middle-details-button1">
                            Log Out
                        </a>

                        <div>

                            <button class="profile-middle-details-button2" id="" name="resetButton">Reset</button>


                            <button class="profile-middle-details-button2" onclick="event.preventDefault(); openUpdateModal()">Update</button>

                        </div>


                    </div>
                </form>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="updateprofileimge-div">
                    <input type="file" id="file" name="ProfilePic" accept="image/*" style="display: none;">
                    <img src="<?php echo isset($_SESSION['user']['photo_path']) && !empty($_SESSION['user']['photo_path'])
                                    ? htmlspecialchars($_SESSION['user']['photo_path'])
                                    : URLROOT . '/assets/images/profile-men.png'; ?>"
                        class="updateprofileimge" id="profileImage"
                        alt="Profile" style="cursor: pointer;">
                </div>
            </form>
        </div>
    <?php endif; ?>

    <div id="updateProfileModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeUpdateModal()">&times;</span>
            <h2 class="modal-topic">Update Profile Details</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-main-top-div">
                    <div class="modal-main-div">
                        <div class="modal-input-div">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="modal-title" value="<?php echo htmlspecialchars($_SESSION['user']['title']); ?>" required>
                        </div>

                        <div class="modal-input-div">
                            <label for="firstName">First Name</label>
                            <input type="text" name="firstName" class="modal-title" value="<?php echo htmlspecialchars($_SESSION['user']['firstName']); ?>" required>
                        </div>

                        <div class="modal-input-div">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" class="modal-title" value="<?php echo htmlspecialchars($_SESSION['user']['lastName']); ?>" required>

                        </div>
                        <div class="modal-input-div">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="modal-title" value="<?php echo htmlspecialchars($_SESSION['user']['email']); ?>" required>

                        </div>
                        <div class="modal-input-div">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="text" name="phoneNumber" class="modal-title" value="<?php echo htmlspecialchars($_SESSION['user']['phoneNumber']); ?>" required>

                        </div>
                        <div class="modal-input-div">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="modal-title" value="<?php echo htmlspecialchars($_SESSION['user']['address']); ?>" required>

                        </div>
                        <div class="modal-input-div">
                            <label for="nic">NIC</label>
                            <input type="text" name="nic" class="modal-title" value="<?php echo htmlspecialchars($_SESSION['user']['nic']); ?>" required>

                        </div>
                    </div>
                    <div>

                        <div class="modal-updateprofileimge-div">
                            <input type="file" id="modalFile" name="ProfilePic" accept="image/*" style="display: none;">
                            <img src="<?php echo isset($_SESSION['user']['photo_path']) && !empty($_SESSION['user']['photo_path'])
                                            ? htmlspecialchars($_SESSION['user']['photo_path'])
                                            : URLROOT . '/assets/images/profile-men.png'; ?>"
                                class="updateprofileimge" id="modalProfileImage"
                                alt="Profile" style="cursor: pointer;">
                        </div>

                    </div>


                </div>


                <div class="modal-button-div">
                    <button type="submit" class="modal-save-button" name="saveupdate">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
</div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Select elements
            const profileImage = document.getElementById('modalProfileImage');
            const fileInput = document.getElementById('modalFile');

            if (profileImage && fileInput) {
                // Trigger file input when image is clicked
                profileImage.addEventListener('click', () => {
                    fileInput.click();
                });

                // Preview selected image
                fileInput.addEventListener('change', (event) => {
                    const file = event.target.files[0];

                    if (file) {
                        // Check if the file is an image
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                profileImage.src = e.target.result; // Preview the image
                            };
                            reader.readAsDataURL(file);
                        } else {
                            alert('Please upload a valid image file.');
                        }
                    }
                });
            }
        });
    </script>


    <script>
        function openconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'none';
        }

        function confirmDelete(id) {
            window.location.href = '../../patientprofile?id=' + id;
            // successToast("Advertisement deleted successfully");
        }
    </script>

    <script>
        function openUpdateModal() {
            document.getElementById('updateProfileModal').style.display = 'block';
        }

        function closeUpdateModal() {
            document.getElementById('updateProfileModal').style.display = 'none';
        }

        // Close the modal if the user clicks outside the modal content
        window.onclick = function(event) {
            const modal = document.getElementById('updateProfileModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    </script>






    <?php require APPROOT . '/views/Components/footer.php' ?>
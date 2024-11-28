<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/reNavbar.php' ?>

<div class="re-dash-container">
    <div class="re-dash-content">
        <h1 class="re-dash-title">Make an Appointment</h1>
        
        <div class="re-dash-card">
            <form action="" method="POST">
                <div class="re-dash-form-group">
                    <label>Select Doctor</label>
                    <select>
                        <option value="" disabled selected hidden>Select Doctor</option>
                        <?php foreach($data as $doctor): ?>
                            <option value="1">Dr. <?php echo $doctor['firstName']." ".$doctor['lastName']?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="re-dash-form-group">
                    <label>Select Specialization</label>
                    <select>
                        <option value="" disabled selected hidden>Select Specialization</option>
                        <option value="1">Pediatrics</option>
                        <option value="2">Dermatology</option>
                        <option value="3">Radiology</option>
                    </select>
                </div>

                <div class="re-dash-form-group">
                    <label>Select Date</label>
                    <input type="date">
                </div>

                <button type="submit" class="re-dash-btn-search">Search</button>
            </form>
        </div>

        <div class="re-dash-search-results">
            <h1>Search results for "Gastrologist"</h1>
            <div class="re-dash-result-cards-container">
                <?php
            // Example data array
                $doctors = [
                    ['name' => 'Dr. Krishantha Jayasekara', 'gender' => 'Male', 'specialization' => 'Gastrologist'],
                    ['name' => 'Dr. Nethmi Nimasha', 'gender' => 'Female', 'specialization' => 'Gastrologist'],
                    ['name' => 'Dr. Tanuri Mandini', 'gender' => 'Female', 'specialization' => 'Gastrologist'],
                    ['name' => 'Dr. Senuja Udugampala', 'gender' => 'Male', 'specialization' => 'Gastrologist'],
                    ['name' => 'Dr. Nirmi Kawmada', 'gender' => 'Female', 'specialization' => 'Gastrologist'],
                    ['name' => 'Dr. Shakila Thathsara', 'gender' => 'Male', 'specialization' => 'Gastrologist']
                ];

            // Loop through the doctors array to create cards
                foreach ($doctors as $doctor) {
                    echo '<div class="re-dash-result-card">';
                    echo '<img src="' . URLROOT . '/assets/images/profile-men.png" class="re-dash-avatar" alt="Doctor Avatar">';
                    echo '<h2>' . $doctor['name'] . '</h2>';
                    echo '<p>' . $doctor['gender'] . '</p>';
                    echo '<p>' . $doctor['specialization'] . '</p>';
                    echo '<button class="re-dash-view-profile">View Profile</button>';                                                                                      
                    echo '<a href="' . URLROOT . '/rechannel" class="re-dash-channel-now">Channel Now</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>

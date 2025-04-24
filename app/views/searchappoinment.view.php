<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>
<div class="container">
    <div class="pt-topic">
        <h1 class="title">Make an Appointment</h1>
    </div>
    <div class="pt-appoinment-section">
        <form action="" method="POST">
            <div class="pt-selectdoctor-div">
                <label class="pt-selectdoctor">Select Doctor :</label>
                <select name="doctor" id="" class="pt-searchdoctor">
                    <option value="" disabled selected hidden>--------Select Doctor--------</option>
                    <?php foreach ($data as $doctor): ?>
                        <?php if ($doctor['type'] !== 'opd'): ?>
                            <option value="<?php echo $doctor['firstName'] . " " . $doctor['lastName'] ?>">Dr.<?php echo $doctor['firstName'] . " " . $doctor['lastName'] ?></option>
                        <?php endif; ?>
                    <?php endforeach ?>
                </select>
            </div>
            <div>
                <label class="pt-selectspecialization">Select Specialization :</label>
                <select name="specialization" id="" class="pt-searchspecialization">
                    <option value="" disabled selected hidden>--------Select Specialization--------</option>
                    <?php foreach ($data as $doctor): ?><option value="<?php echo $doctor['specialization'] ?>"><?php echo $doctor['specialization'] ?></option><?php endforeach ?>

                </select>
            </div>
            <div>
                <label class="pt-selectdate">Select Date :</label>
                <input
                    type="date"
                    class="pt-searchdate"
                    name="appointment_date"
                    min="<?php echo date('Y-m-d'); ?>">
            </div>
            <div>
                <input type="submit" value="Search" class="pt-searchbtn" name="search">
            </div>
        </form>
    </div>

    <!-- Display message if no criteria or no results -->
    <?php if (!empty($message)): ?>
        <div class="message">
            <h2><?php echo $message; ?></h2>
        </div>
    <?php endif; ?>

    <!-- Display results if available -->
    <?php if (!empty($data2)): ?>
        <div class="doctors">
            <?php foreach ($data2 as $doctor): ?>
                <?php require APPROOT . '/views/Components/doctorcard.php' ?>
            <?php endforeach ?>
        </div>
    <?php endif; ?>
</div>
<?php require APPROOT . '/views/Components/footer.php' ?>
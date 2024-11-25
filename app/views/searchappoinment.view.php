<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>
<div class="container">
    <div class="pt-topic">
        <h1 class="title">Make an Appoinment</h1>
    </div>
    <div class="pt-appoinment-section">
        <form action="" method="POST">
            <div class="pt-selectdoctor-div">
                <label class="pt-selectdoctor">Select Doctor :</label>
                <select name="doctor" id="" class="pt-searchdoctor">
                    <option value="" disabled selected hidden>--------Select Doctor--------</option>
                    <?php foreach ($data as $doctor): ?><option value="<?php echo $doctor['firstName'] . " " . $doctor['lastName'] ?>">Dr.<?php echo $doctor['firstName'] . " " . $doctor['lastName'] ?></option><?php endforeach ?>
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
                <input type="date" class="pt-searchdate" name="appointment_date" >
            </div>
            <div>
                <input type="submit" value="Search" class="pt-searchbtn" name="search">
            </div>
        </form>
    </div>
    <?php if (!empty($data2)): ?>
        <div class="doctors">
            <?php foreach ($data2 as $doctor): ?>
                
                <?php


                require APPROOT . '/views/Components/doctorcard.php' ?>
            <?php endforeach ?>
        </div>
    <?php else: ?>
        <div class="noresults">
            <h1>No Results Found</h1>
        </div>
    <?php endif; ?>



</div>
<?php require APPROOT . '/views/Components/footer.php' ?>
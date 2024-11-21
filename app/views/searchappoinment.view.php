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
                <select name="" id="" class="pt-searchdoctor">
                    <option value="" disabled selected hidden>--------Select Doctor--------</option>
                    <?php foreach($data as $doctor):?><option value="1">Dr.<?php echo $doctor['firstName']." ".$doctor['lastName']?></option><?php endforeach ?>
                    <!-- <option value="2">Dr. Jane Doe</option>
                    <option value="3">Dr. James Doe</option> -->
                </select>
            </div>
            <div>
                <label class="pt-selectspecialization">Select Specialization :</label>
                <select name="" id="" class="pt-searchspecialization">
                    <option value="" disabled selected hidden>--------Select Specialization--------</option>
                    <option value="1">Pediatrics</option>
                    <option value="2">Dermatology</option>
                    <option value="3">Radiology</option>
                </select>
            </div>
            <div>
                <label class="pt-selectdate">Select Date :</label>
                <input type="date" class="pt-searchdate">
            </div>
            <div>
                <input type="submit" value="Search" class="pt-searchbtn">
            </div>
        </form>
    </div>
    <div class="doctors">
        <?php require APPROOT . '/views/Components/doctorcard.php' ?>
    </div>




</div>
<?php require APPROOT . '/views/Components/footer.php' ?>
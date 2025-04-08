<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?> 

    

<div class="ViewProfile-body">
    <!-- <?php show($data) ?> -->
     
           
    <div class="ViewProfile-container">

            <!-- Searchbar start -->
            <div class="search-bar-container">
                        <form action="<?php echo URLROOT; ?>ViewAllDrProfile/index" method="get">
                            <input type="text" name="search" placeholder="Search by name or SLMC number..." class="search-input">
                            <button type="submit" class="search-btn">Search</button>
                        </form>
            </div>
            <!-- Searchbar end -->

            <h1>Doctors List</h1>
            
            <?php foreach ($data as $doctor): ?>
            <div class="ViewProfile-doctor-card">
                <span class="ViewProfile-doctor-info">SLMC <?php echo $doctor['slmcNo'] ?> - Mr.<?php echo $doctor['firstName'] ?></span>
                <div class="ViewProfile-button-group">
                    <a href="<?php echo URLROOT;?>DrProfiledetails?id=<?php echo $doctor['doctor_id'] ?>"><button class="ViewProfile-view-btn" >VIEW</button></a>
                    <a href="<?php echo URLROOT;?>ViewAllDrProfile/delete?id=<?php echo $doctor['doctor_id'] ?>"><button class="ViewProfile-delete-btn"  >DELETE</button></a>
                </div>
            </div>
            <?php endforeach ?>            
    </div>
    
    
</div>




<?php require APPROOT . '/views/Components/footer.php' ?>

<?php if (isset($data['success'])): ?>
<script>
    alert("<?php echo $data['success']; ?>");
</script>
<?php endif; ?>
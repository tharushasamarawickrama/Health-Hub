<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<div class="ViewProfile-body">
    <div class="ViewProfile-container">
            <!-- Searchbar start -->
            <div class="search-bar-container">
                        <form action="<?php echo URLROOT; ?>ViewAllPharmProfile/index" method="get">
                            <input type="text" name="search" placeholder="Search by name or SLMC number..." class="search-input">
                            <button type="submit" class="search-btn">Search</button>
                        </form>
            </div>
            <!-- Searchbar end -->
            <h1>Pharmacists List</h1>
            <?php foreach ($data as $pharmacist): ?>
            <div class="ViewProfile-doctor-card">
                <span class="ViewProfile-doctor-info">SLMC <?php echo $pharmacist['slmcNo'] ?> - Mr.<?php echo $pharmacist['firstName'] ?></span>
                <div class="ViewProfile-button-group">
                    <a href="<?php echo URLROOT;?>PhProfiledetails?id=<?php echo $pharmacist['pharmacist_id'] ?>"><button class="ViewProfile-view-btn" >VIEW</button></a>
                    <a href="<?php echo URLROOT;?>ViewAllPharmProfile/delete?id=<?php echo $pharmacist['pharmacist_id'] ?>"><button class="ViewProfile-delete-btn" >DELETE</button></a>
                </div>
            </div>
            <?php endforeach ?>
    </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>


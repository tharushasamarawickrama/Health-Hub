<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/AdminNavbar.php' ?>
<?php require APPROOT . '/views/Components/AdminSidebar.php' ?>

<div class="ViewProfile-body">
    <div class="ViewProfile-container">
            <!-- Searchbar start -->
            <div class="search-bar-container">
                        <form action="<?php echo URLROOT; ?>ViewAllPharmProfile/index" method="get">
                            <input type="text" name="search" placeholder="Search by name or SLMC number..." class="search-input">
                            <button type="submit" class="search-btn" id="dr-req-btn-left">Search</button>
                        </form>
            </div>
            <!-- Searchbar end -->
            <h1>Pharmacists List</h1>

            <?php if (empty($data)): ?>
                <p>No pharmacists available.</p>
            <?php else: ?>
                

                <?php foreach ($data as $pharmacist): ?>
                <div class="ViewProfile-doctor-card">
                    <span class="ViewProfile-doctor-info">SLMC <?php echo $pharmacist['slmcNo'] ?> - Mr.<?php echo $pharmacist['firstName'] ?></span>
                    <div class="ViewProfile-button-group">
                        <a href="<?php echo URLROOT;?>PhProfiledetails?id=<?php echo $pharmacist['pharmacist_id'] ?>"><button class="ViewProfile-view-btn" id="dr-req-btn-left">VIEW</button></a>
                        <a href="<?php echo URLROOT;?>ViewAllPharmProfile/delete?id=<?php echo $pharmacist['pharmacist_id'] ?>"><button class="ViewProfile-delete-btn" id="dr-req-btn-right">DELETE</button></a>
                    </div>
                </div>
                <?php endforeach ?>
            <?php endif; ?>
    </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>


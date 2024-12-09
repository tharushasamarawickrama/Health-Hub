<div class="phNavbar">
            <img src="<?php echo URLROOT; ?>/assets/images/hhlogo.png" alt="Health Hub Logo" class="phlogo">
        
            <a href="<?php echo URLROOT; ?>/phdashboard" class="phNavitems">Dashboard</a> 
            <a href="<?php echo URLROOT; ?>/phprescriptions" class="phNavitems">Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/phprocessedprescriptions" class="phNavitems">Processed Prescriptions</a>
            <a href="<?php echo URLROOT; ?>/phdailyusage" class="phNavitems">Daily Usage</a>

            <?php if (isset($_SESSION['user'])): ?>
            <a href="#">
            <img src="<?php echo URLROOT .'/'. htmlspecialchars($_SESSION['user']['photo_path'])?>" alt="User Icon" class="phloginlogo">
            <?php else: ?>
            <a>
            
                <img src="<?php echo URLROOT; ?>/assets/images/loginlogo.jpg" alt="User Icon" class="phloginlogo">
            <?php endif; ?>
            <!-- <a href="#" class="phlogin">Pharmacist</a> -->
            <?php if (isset($_SESSION['user'])): ?>
        <!-- User dropdown -->
        <div class="dropdown">


            <p class="username"><?php echo htmlspecialchars($_SESSION['user']['firstName']); ?></p>

            <div class="dropdown-content">
                <a href="#">Profile</a>
                <a href="?action=logout">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Show "Login" link if no user is logged in -->
        <a href="<?php echo URLROOT; ?>/Prevlog" class="login">Login</a>
    <?php endif; ?>

        </div>
</div>
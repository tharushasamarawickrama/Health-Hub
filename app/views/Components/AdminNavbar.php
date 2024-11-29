

<div class="AdminNavbar">
    <div class="fullcontainer">

        
            <img src="<?php echo URLROOT; ?>/assets/images/hhlogo.png" class="logo">
        
        <div class="AdminNav">
            <a href="<?php echo URLROOT; ?>AdminDashboard" class="AdminNavitems">Dashboard</a>
            <a href="<?php echo URLROOT; ?>phdailyusage" class="AdminNavitems">Reports</a>
            
            <a href="<?php echo URLROOT; ?>AdminViewProfile" class="AdminNavitems">View Profiles</a>
        </div>
       <div class="adminlogodiv">
        <?php if (isset($_SESSION['user'])):?>
           <a href="#">
               <img src="<?php echo URLROOT . '/' . htmlspecialchars($_SESSION['user']['photo_path'])?>" class="Adminloginlogo">
           </a>
        <?php else:?>
            <img src="<?php echo URLROOT; ?>/assets/images/loginlogo.jpg" class="Adminloginlogo">
        <?php endif;?>

        <?php if (isset($_SESSION['user'])): ?>
        <!-- User dropdown -->
        <div class="dropdown">


            <p class="username"><?php echo htmlspecialchars($_SESSION['user']['firstName']); ?></p>

            <div class="dropdown-content">
                <a href="">Profile</a>
                <a href="?action=logout">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Show "Login" link if no user is logged in -->
        <a href="<?php echo URLROOT; ?>/Prevlog" class="login">Login</a>
    <?php endif; ?>
           <!-- <p class="Adminlogin">Admin</p> -->
    
       </div>
    </div>

</div>
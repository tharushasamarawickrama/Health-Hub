<?php
define('URLROOT', 'http://localhost/healthHub');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/fonts.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/components/dr-dashboard.css?v=<?php echo time(); ?>">
</head>
<body>
    <div>
        <?php
            include 'Components/dr-navbar.php';
        ?>
        <div class="content">
            <h2>Select Action</h2>
            <div class="action-buttons">
                <a href="#" class="btn">View Appointments &rarr;</a>
                <a href="#" class="btn">Update Availability &rarr;</a>
                <a href="#" class="btn">View Profile &rarr;</a>
            </div>
        </div>
    </div>
</body>
</html>
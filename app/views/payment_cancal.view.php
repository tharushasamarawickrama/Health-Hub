<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/Navbar.php';
?>

<div class="payment-status">
    <h1>Payment Cancelled!</h1>
    <p>Your payment was not completed. Please try again.</p>
    <a href="<?php echo URLROOT; ?>/setappoinment">
        <button class="btn btn-primary">Try Again</button>
    </a>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>

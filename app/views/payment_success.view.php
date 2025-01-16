<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/Navbar.php';
?>

<div class="payment-status">
    <h1>Payment Successful!</h1>
    <p>Thank you for your payment. Your appointment has been confirmed.</p>
    <a href="<?php echo URLROOT; ?>/dashboard">
        <button class="btn btn-primary">Go to Dashboard</button>
    </a>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>

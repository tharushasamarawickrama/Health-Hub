<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/Navbar.php';
?>

<div class="payment-status">
    <img src="<?php URLROOT; ?>assets/images/payment_successfull.gif" />
    <h1>Payment Successful!</h1>
    <p>Thank you for your payment. Your appointment has been confirmed.</p>
    <a href="<?php echo URLROOT; ?>/home">
        <button class="gotohome-btn">Go To Home</button>
    </a>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>

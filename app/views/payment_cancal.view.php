<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/Navbar.php';
?>

<div class="payment-status-container">
    <img class="payment-status-image" src="<?php echo URLROOT; ?>assets/images/payment_cancelled.gif" />
    <h1 class="payment-status-heading">Payment Cancelled!</h1>
    <p class="payment-status-text">Your payment was not completed. Please try again.</p>
    <a href="<?php echo URLROOT; ?>/patientpaymentdetails">
        <button class="gotoappointment-btn">Try Again</button>
    </a>
</div>


<?php require APPROOT . '/views/Components/footer.php'; ?>

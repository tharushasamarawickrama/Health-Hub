<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/Navbar.php'; ?>

<div class="paymentdetails-div">
    <div class="paymentdetails-div2">
        <h1>Payment Details</h1>
        <p class="paymentdetails-div2-p">Comprehensive summary of charges for your transaction</p>
        <div class="paymentdetails-div2-p-div">
            <strong class="">Doctor Fee:</strong>
            <p>1800.00</p>
        </div>
        <div class="paymentdetails-div2-p-div">
            <strong class="">Hospital Fee:</strong>
            <p>1000.00</p>
        </div>
        <div class="paymentdetails-div2-p-div">
            <strong class="">Discount:</strong>
            <p>00.00</p>
        </div>
        <div class="paymentdetails-div2-p-div">
            <strong class="">Service Charge:</strong>
            <p>250.00</p>
        </div>
        <div class="paymentdetails-div2-p-div-last">
            <strong class="">Total Fee:</strong>
            <p id="totalAmount">3050.00</p>
        </div>
    </div>
</div>



<?php
$merchant_id = "1229280";
$merchant_secret = "Mzc1MjMxOTk3NTMzMDU5MjI1NTMxMTg4MzQwNTMzNTYzOTMwODc=";
$order_id = 1;
$amount = 3050.00;
$curreny = "LKR";
$hash_string = strtoupper(
    md5(
        $merchant_id .
            $order_id .
            number_format($amount, 2, '.', '') .
            $curreny .
            strtoupper(md5($merchant_secret))
    )
);
?>

<div class="payment-btn-div">
    <div>
        <a href="<?php echo URLROOT; ?>setappoinment">
            <button class="payment-btn">Edit</button>
        </a>
    </div>
    <div>
        <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
            <input type="hidden" name="merchant_id" value="<?= $merchant_id ?>"> <!-- Replace with your Merchant ID -->
            <input type="hidden" name="return_url" value="<?php echo URLROOT; ?>/payment_success">
            <input type="hidden" name="cancel_url" value="<?php echo URLROOT; ?>/payment_cancal">
            <input type="hidden" name="notify_url" value="<?php echo URLROOT; ?>/payment_notify">

            <input type="hidden" name="order_id" value="<?= $order_id ?>">
            <input type="hidden" name="items" value="Appointment Payment"><br>
            <input type="hidden" name="currency" value="<?= $curreny ?>">
            <input type="hidden" name="amount" value="<?= $amount ?>">

            <input type="hidden" name="hash" value="<?php echo $hash_string; ?>">

            <input type="hidden" name="first_name" value="<?php echo $_SESSION['user']['firstName']; ?>">
            <input type="hidden" name="last_name" value="<?php echo $_SESSION['user']['lastName']; ?>">
            <input type="hidden" name="email" value="<?php echo $_SESSION['user']['email']; ?>">
            <input type="hidden" name="phone" value="<?php echo $_SESSION['user']['phoneNumber']; ?>">
            <input type="hidden" name="address" value="<?php echo $_SESSION['user']['address']; ?>">
            <input type="hidden" name="city" value="Colombo">
            <input type="hidden" name="country" value="LK">

            <button type="submit" class="payment-btn2">Pay Now</button>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
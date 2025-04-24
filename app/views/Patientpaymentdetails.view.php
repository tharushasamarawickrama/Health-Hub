<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/Navbar.php'; ?>

<div class="paymentdetails-div">
    <div class="paymentdetails-div2">
        <h1>Payment Details</h1>
        <p class="paymentdetails-div2-p">Comprehensive summary of charges for your transaction</p>

        <?php
        // Define the base charges
        $doctorFee = 1800.00;
        $hospitalFee = 1000.00;
        $serviceCharge = 250.00;
        $discount = 0.00;

        if (!isset($_SESSION['appointment']['sameMonthAppointmentCount'])) {
            if ($data['sameMonthAppointmentCount'] >= 1) {
                $discount = 50.00; // Example discount amount
            }
        } elseif ($_SESSION['appointment']['sameMonthAppointmentCount'] >= 1) {
            $discount = 50.00; // Example discount amount
            // $serviceCharge -= $discount; // Apply the discount to the service charge
        }

        // Calculate the total fee
        $totalFee = $doctorFee + $hospitalFee + $serviceCharge - $discount;
        ?>

        <div class="paymentdetails-div2-p-div">
            <strong class="">Doctor Fee:</strong>
            <p><?= number_format($doctorFee, 2) ?></p>
        </div>
        <div class="paymentdetails-div2-p-div">
            <strong class="">Hospital Fee:</strong>
            <p><?= number_format($hospitalFee, 2) ?></p>
        </div>
        <?php if (!isset($_SESSION['appointment']['sameMonthAppointmentCount'])): ?>
            <?php if ($data['sameMonthAppointmentCount'] >= 1): ?>
                <div class="paymentdetails-div2-p-div">
                    <strong class="">Discount:</strong>
                    <p><?= number_format($discount, 2) ?></p>
                </div>
            <?php endif; ?>
        <?php elseif ($_SESSION['appointment']['sameMonthAppointmentCount'] >= 1): ?>
            <div class="paymentdetails-div2-p-div">
                <strong class="">Discount:</strong>
                <p><?= number_format($discount, 2) ?></p>
            </div>
        <?php endif; ?>
        <div class="paymentdetails-div2-p-div">
            <strong class="">Service Charge:</strong>
            <p><?= number_format($serviceCharge, 2) ?></p>
        </div>
        <div class="paymentdetails-div2-p-div-last">
            <strong class="">Total Fee:</strong>
            <p id="totalAmount"><?= number_format($totalFee, 2) ?></p>
        </div>
    </div>
</div>

<?php
$merchant_id = "1229280";
$merchant_secret = "Mzc1MjMxOTk3NTMzMDU5MjI1NTMxMTg4MzQwNTMzNTYzOTMwODc=";
$order_id = 1;
$amount = $totalFee; // Use the dynamically calculated total fee
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
            <input type="hidden" name="return_url" value="<?php echo URLROOT; ?>/payment_success?appo_id=<?php echo !isset($_SESSION['appo_id']) ? $data['appo_id'] : $_SESSION['appo_id']; ?>">
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
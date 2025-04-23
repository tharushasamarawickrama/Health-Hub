<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/ReNavbar.php'; ?>

<div class="paymentdetails-div">
    
<div>
        <a href="<?php echo URLROOT; ?>resetappoinment">
            <button class="payment-btn">Edit</button>
        </a>
        <a href="<?php echo URLROOT; ?>redashboard">
            <button class="payment-btn">Done</button>
        </a>
    </div>
    <div class="paymentdetails-div2">
        <h1>Payment Details</h1>
        <p class="paymentdetails-div2-p">Comprehensive summary of charges for your transaction</p>

        <?php
        // Define the base charges
        $doctorFee = 1800.00;
        $hospitalFee = 1000.00;
        $serviceCharge = 250.00;
        $discount = 0.00;

        // Check if the appointment count is greater than 1
        if ($_SESSION['appointment']['sameMonthAppointmentCount'] > 1) {
            $discount = 50.00; // Example discount amount
            // $serviceCharge -= $discount; // Apply the discount to the service charge
        }

        // Calculate the total fee
        $totalFee = $doctorFee + $hospitalFee + $serviceCharge- $discount;
        ?>

        <div class="paymentdetails-div2-p-div">
            <strong class="">Doctor Fee:</strong>
            <p><?= number_format($doctorFee, 2) ?></p>
        </div>
        <div class="paymentdetails-div2-p-div">
            <strong class="">Hospital Fee:</strong>
            <p><?= number_format($hospitalFee, 2) ?></p>
        </div>
        <?php if ($_SESSION['appointment']['sameMonthAppointmentCount'] > 1): ?>
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



<?php require APPROOT . '/views/Components/footer.php'; ?>
<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>

<div class="paymentdetails-div">
    <div class="paymentdetails-div2">
        <h1>Payment Details</h1>
        <p class="paymentdetails-div2-p">Comprehensive summery of charges for your transaction</p>
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
            <p>3050.00</p>
        </div>

    </div>

</div>

<div class="payment-btn-div">
    <div>
        <a href="<?php echo URLROOT; ?>setappoinment">
            <button class="payment-btn">Edit</button>
        </a>

    </div>
    <div>
        <button class="payment-btn2">Pay Now</button>
    </div>

</div>







<?php require APPROOT . '/views/Components/footer.php' ?>
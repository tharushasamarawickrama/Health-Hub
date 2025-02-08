<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/reNavbar.php' ?>
<div class="re-pay-det-container">
    <div class="re-pay-det-content">
        <div class="re-pay-det-box">
            <h2>Payment Details</h2>
            <p>Comprehensive summary of charges for your transaction</p>
            <div class="re-pay-det-payment-info">
                <div class="re-pay-det-item">
                    <span>Doctor fee</span>
                    <span>1800.00</span>
                </div>
                <div class="re-pay-det-item">
                    <span>Hospital fee</span>
                    <span>1000.00</span>
                </div>
                <div class="re-pay-det-item">
                    <span>Discount</span>
                    <span>0.00</span>
                </div>
                <div class="re-pay-det-item">
                    <span>Service Charge</span>
                    <span>250.00</span>
                </div>
                <div class="re-pay-det-item total">
                    <span>Total Fee</span>
                    <span>3050.00</span>
                </div>
            </div>
            <button class="re-pay-det-payment-button">Payment Completed</button>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php' ?>
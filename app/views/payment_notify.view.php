<?php
// Validate the payment notification from PayHere
$merchant_secret = 'Mzc1MjMxOTk3NTMzMDU5MjI1NTMxMTg4MzQwNTMzNTYzOTMwODc='; // Replace with your Merchant Secret

// Capture POST data
$data = $_POST;

// Generate hash
$local_hash = strtoupper(
    md5(
        $data['merchant_id'] .
        $data['order_id'] .
        $data['payhere_amount'] .
        $data['payhere_currency'] .
        $data['status_code'] .
        strtoupper(md5($merchant_secret))
    )
);

// Verify hash and process the status
if ($local_hash === $data['md5sig']) {
    if ($data['status_code'] == 2) {
        // Payment is successful
        // Update your database to mark the payment as completed
        file_put_contents('payment.log', "Payment Success: " . json_encode($data) . PHP_EOL, FILE_APPEND);
    }
} else {
    file_put_contents('payment.log', "Payment Verification Failed: " . json_encode($data) . PHP_EOL, FILE_APPEND);
}

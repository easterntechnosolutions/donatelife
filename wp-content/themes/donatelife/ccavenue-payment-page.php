<?php
/* Template Name: CCAvenue Payment Page */
get_header();
print_r($_POST); print_r($_GET); 
echo 'this page '.$_POST['hidden-4']. 'query var '.get_query_var('amount');
die();
if (isset($_POST['amount'])) {
    // CCAvenue Merchant Details
    $merchant_id = '187810'; // Provided by CCAvenue
    $access_code = 'AVZP79FH90BP66PZPB'; // Provided by CCAvenue
    $working_key = '9E52BA0317EB2B12ADF4FE9A504897A0'; // Provided by CCAvenue

    // Fetch form data
    $amount = $_POST['amount'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // CCAvenue Payment Request Parameters
    $order_id = $_POST['id']; // Generate a unique order ID
    $redirect_url = home_url('/ccavenue-payment-response');
    $cancel_url = home_url('/ccavenue-payment-cancel');

    // Build CCAvenue payment form (Encrypted Data)
    $data = [
        'merchant_id' => $merchant_id,
        'order_id' => $order_id,
        'amount' => $amount,
        'currency' => 'INR',
        'redirect_url' => $redirect_url,
        'cancel_url' => $cancel_url,
        'billing_name' => $name,
        'billing_email' => $email,
        'language' => 'EN',
    ];

     // Generate the checksum
     $checksum = generate_checksum($data, $working_key);

     // Add checksum to the request
     $data['checksum'] = $checksum;

    echo '<form method="POST" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">';
    echo '<input type="hidden" name="encRequest" value="' . $encrypted_data . '">';
    echo '<input type="hidden" name="access_code" value="' . $access_code . '">';
    echo '<input type="submit" value="Proceed to Pay">';
    echo '</form>';
}


function generate_checksum($data, $working_key) {
    // Create a string with the relevant data
    $string = "";
    foreach ($data as $key => $value) {
        $string .= $key . "=" . $value . "&";
    }
    $string = rtrim($string, "&"); // Remove the trailing '&'

    // Generate checksum hash
    return hash_hmac('sha256', $string, $working_key);
}

get_footer();
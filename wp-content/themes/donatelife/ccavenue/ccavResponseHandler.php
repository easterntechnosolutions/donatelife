<?php
require_once('../../../../wp-load.php');

require_once('Crypto.php'); // Include the Crypto.php file from the CCAvenue kit

global $wpdb;

$working_key = "9E52BA0317EB2B12ADF4FE9A504897A0"; // Your CCAvenue working key

// Get the encrypted response
$enc_response = $_POST['encResp'];
$decrypted_response = decrypt($enc_response, $working_key);

// Parse the response
parse_str($decrypted_response, $response);

$od_table = $wpdb->prefix.'online_donation_master';
$od_insert = $wpdb->update($od_table,
	array(
		'odstatus' => $response['order_status'],
	), 
	array('id' => $wpdb->insert_id)
);
// Check the payment status
if ($response['order_status'] === "Success") {
	
	echo "Donation successful! Thank you for your payment.";
    // Handle success, store transaction data, send email, etc.
} else {
    echo "Payment failed. Please try again.";
    // Handle failure, log errors, etc.
}
?>


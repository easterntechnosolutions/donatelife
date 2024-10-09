<?php 
require_once('../../../../wp-load.php');

require_once('Crypto.php'); // Include the Crypto.php file from the CCAvenue kit


$name = $_POST['name-1'];
$address = $_POST['address-1-street_address'];
$city = $_POST['address-1-city'];
$state = $_POST['address-1-state'];
$zip = $_POST['address-1-zip'];
$country = $_POST['address-1-country'];
$mobile = $_POST['phone-1'];
$email = $_POST['email-1'];
$details = $_POST['text-1'];
$amount = $_POST['number-1'];

// $amount = $_POST['amount'];
// $name = $_POST['name'];
// $email = $_POST['email'];


$merchant_id = "187810";
$access_code = "AVZP79FH90BP66PZPB";
$working_key = "9E52BA0317EB2B12ADF4FE9A504897A0"; // Encryption key provided by CCAvenue

$merchant_data = '';
$merchant_data .= 'merchant_id=' . $merchant_id . '&order_id=' . uniqid() . '&currency=INR';
$merchant_data .= '&amount=' . $amount;
$merchant_data .= '&billing_name=' . $name . '&billing_email=' . $email . '&billing_address=' . $address . '&billing_city=' . $city . '&billing_state='. $state . '&billing_zip=' . $zip . '&billing_country='. $country . '&billing_tel='.$mobile . '&merchant_param1='.$details;
$merchant_data .= '&redirect_url=' . get_stylesheet_directory_uri().'/ccavenue/ccavResponseHandler.php';
$merchant_data .= '&cancel_url=' . get_stylesheet_directory_uri().'/ccavenue/ccavResponseHandler.php';

$encrypted_data = encrypt($merchant_data, $working_key);

$payment_url = "https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction";

// Generate the payment form and submit automatically
echo '<form id="ccavenue_payment_form" method="post" action="' . $payment_url . '">';
echo '<input type="hidden" name="encRequest" value="' . $encrypted_data . '">';
echo '<input type="hidden" name="access_code" value="' . $access_code . '">';
echo '</form>';
echo '<script type="text/javascript">document.getElementById("ccavenue_payment_form").submit();</script>';

?>

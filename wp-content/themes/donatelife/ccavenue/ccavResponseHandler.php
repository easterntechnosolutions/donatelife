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
$od_insert = $wpdb->insert($od_table,
	array(
		'odname' => $response['billing_name'],
		'odaddress' => $response['billing_address'],
		'odcity' => $response['billing_city'],
		'odstate' => $response['billing_state'],
		'odpin' => $response['billing_zip'],
		'odcountry' => $response['billing_country'],
		'odmobile' => $response['billing_tel'],
		'odemail' => $response['billing_email'],
		'oddetails' => $response['merchant_param1'],
		'odamount' => $response['amount'],
		'odstatus' => $response['order_status'],
		'is_trash' => 0,
	)
);

$admin_email = get_option('admin_email');
$to = $admin_email;
$reply_to = $response['billing_email'];
$subject = 'DonateLife - Online Donation from website';
$body = do_shortcode('[email_header_template]');
$body .= '<table class="tbl" width="80%" cellpadding="3" align="center">
		<tbody>
		<tr>
		<td><strong>Name</strong></td>
		<td>:</td>
		<td>'.$response['billing_name'].'</td>
		</tr>
		<tr>
		<td><strong>Address </strong></td>
		<td>:</td>
		<td>'.$response['billing_address'].'</td>
		</tr>
		<tr>
		<td><strong>City</strong></td>
		<td>:</td>
		<td>'.$response['billing_city'].'</td>
		</tr>
		<tr>
		<td><strong>State </strong></td>
		<td>:</td>
		<td>'.$response['billing_state'].'</td>
		</tr>
		<tr>
		<td><strong>Pin Code</strong></td>
		<td>:</td>
		<td>'.$response['billing_zip'].'</td>
		</tr>
		<tr>
		<td><strong>Country </strong></td>
		<td>:</td>
		<td>'.$response['billing_country'].'</td>
		</tr>
		<tr>
		<td><strong>Mobile Number </strong></td>
		<td>:</td>
		<td>'.$response['billing_tel'].'</td>
		</tr>
		<tr>
		<td><strong>Email Address </strong></td>
		<td>:</td>
		<td>'.$response['billing_email'].'</td>
		</tr>
		<tr>
		<td><strong>Donation Amount </strong></td>
		<td>:</td>
		<td>'.$response['amount'].'</td>
		</tr>
		<tr>
		<td><strong>Payment Status  </strong></td>
		<td>:</td>
		<td>'.$response['order_status'].'</td>
		</tr>
		</tbody>
		</table>';
	$body .= do_shortcode('[email_footer_template]');

$headers = array('Content-Type: text/html; charset=UTF-8');

wp_mail($to, $subject, $body, $headers, $reply_to);

$reply_to_admin = $admin_email;
$user_email_subject = 'DonateLife - Thank you for your donation';
$user_email = $response['billing_email'];
$user_email_body = do_shortcode('[email_header_template]');
$user_email_body .= '<br />Hi '.$response['billing_name'].' ,<br />Thank you for your Donation of '.$response['amount'].' INR to Donate Life Organization (An Initiative for Organ Donation). <br />';
$user_email_body .= 'Your Payment Status: '.$response['order_status'];
$user_email_body .= 'Please contact <a href="mailto:info@donatelife.org.in">info@donatelife.org.in</a> for the further details.';
$user_email_body .= do_shortcode('[email_footer_template]');


wp_mail($user_email, $user_email_subject, $user_email_body, $headers, $reply_to_admin);

// Check the payment status
if ($response['order_status'] === "Success") {
	
	echo "Donation successful! Thank you for your payment.";
    // Handle success, store transaction data, send email, etc.
} else {
    echo "Payment failed. Please try again. <a href='".site_url()."/online-donation/'>Go back</a>";
    // Handle failure, log errors, etc.
}
?>
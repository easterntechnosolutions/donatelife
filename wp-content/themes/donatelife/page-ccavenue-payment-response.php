<?php
/* Template Name: CCAvenue Payment Response Page */

require_once get_stylesheet_directory_uri().'/ccavenue/Crypto.php';

global $wpdb;
if (isset($_POST["encResp"])) {
    $working_key = '9E52BA0317EB2B12ADF4FE9A504897A0'; // CCAvenue working key
    $encResponse = $_POST["encResp"]; // The encrypted response from CCAvenue
    $decryptedResponse = decryptResponse($encResponse, $working_key); // Decrypt response
    parse_str($decryptedResponse, $responseArray);
    
    // Check the payment status
    if ($responseArray['order_status'] == 'Success') {
        // Payment was successful
        
        // Prepare form data for email
        $formData = array(
            'name' => $responseArray['billing_name'],
            'email' => $responseArray['billing_email'],
            'amount' => $responseArray['amount']
        );

        // Save the form data in the database
        save_data_in_db($formData);

        // Trigger the CF7 mail using the 'wpcf7_submit' action
        do_action('wpcf7_mail_sent', $formData);
        
        // Display success message or redirect user
        echo "Payment successful! An email has been sent.";
    } else {
        // Payment failed or was canceled
        echo "Payment failed or canceled.";
    }
}
?>
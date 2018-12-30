<?php
$message = $_SESSION['message'];
require  ('/Users/DAW/vendor/autoload.php');
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC54c6ee5d88dabd8f9e1f70dda72369be';
$auth_token = '29d9d7ad7db40c3718ca30a77169d2d3';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

// A Twilio number you own with SMS capabilities
$twilio_number = "+18329349915";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+201003114726',
    array(
        'from' => $twilio_number,
        'body' => 'Noob of Noobs'
    )
);
?>
<?php
require_once 'vendor/autoload.php'; // Composer autoload

use Twilio\Rest\Client;

// Thông tin Twilio
$account_sid = 'AC3a084999eb971a0a533a43bafb40a7dc';
$auth_token = '1c7c23c5472ee4c8f7af51dd08dda1e8';
$twilio_number = 'YOUR_TWILIO_PHONE_NUMBER';

// Khởi tạo Client của Twilio
$client = new Client($account_sid, $auth_token);
?>

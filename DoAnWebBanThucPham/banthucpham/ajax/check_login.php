<?php
include '../lib/session.php';
Session::init();

$login_check = Session::get('curtomer_login');
if ($login_check) {
    echo 'true'; // Đã đăng nhập
} else {
    echo 'false'; // Chưa đăng nhập
}
?>

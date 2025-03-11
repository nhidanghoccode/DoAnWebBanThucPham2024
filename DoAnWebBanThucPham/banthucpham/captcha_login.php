<?php
session_start();
header('Content-Type: image/png');

// Tạo mã CAPTCHA ngẫu nhiên
$captcha_code = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjklmnpqstuwyz123456789'), 0, 6);
$_SESSION['captcha_code_login'] = $captcha_code;

// Thiết lập hình ảnh
$image = imagecreate(200, 60);
$background_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$line_color = imagecolorallocate($image, 64, 64, 64);

// Tạo đường nhiễu
for ($i = 0; $i < 6; $i++) {
    imageline($image, 0, rand() % 60, 200, rand() % 60, $line_color);
}

// Thêm mã CAPTCHA vào hình
imagettftext($image, 24, rand(-10, 10), 30, 40, $text_color, __DIR__ . '/fonts/arial.ttf', $captcha_code);

// Xuất ảnh
imagepng($image);
imagedestroy($image);
?>

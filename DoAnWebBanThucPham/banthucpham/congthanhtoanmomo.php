<?php
header('Content-type: text/html; charset=utf-8');

function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

// Cấu hình thông tin MoMo
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán qua MoMo";

// Kiểm tra số tiền thanh toán
if (!isset($_POST['sotienthanhtoanONLINE']) || empty($_POST['sotienthanhtoanONLINE'])) {
    die("Số tiền thanh toán không hợp lệ!");
}
$amount = (int)$_POST['sotienthanhtoanONLINE'];
if ($amount <= 0) {
    die("Số tiền phải lớn hơn 0!");
}

// Các thông tin giao dịch
$orderId = time() . "";
$requestId = time() . "";
$requestType = "captureWallet";
$redirectUrl = "http://localhost:8088/sourcebanthucpham/thanhtoandonhangonline.php";
$ipnUrl = "http://localhost:8088/sourcebanthucpham/ipn_momo.php"; // Cần tạo file xử lý callback này
$extraData = "";

// Tạo chữ ký
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);

// Chuẩn bị dữ liệu gửi
$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    'storeId' => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);

// Gửi request
$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);

// Kiểm tra kết quả và điều hướng
if (isset($jsonResult['payUrl'])) {
    header('Location: ' . $jsonResult['payUrl']);
} else {
    echo "Không thể khởi tạo giao dịch MoMo: " . $jsonResult['message'];
}
exit;
?>

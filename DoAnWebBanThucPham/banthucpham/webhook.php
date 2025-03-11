<?php
// Kết nối cơ sở dữ liệu
include './incc/hearder.php';

// Kiểm tra kết nối cơ sở dữ liệu
if ($db->connect_error) {
    http_response_code(500);
    echo json_encode(['message' => 'Kết nối cơ sở dữ liệu thất bại: ' . $db->connect_error]);
    exit;
}

// Kiểm tra phương thức HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Phương thức không hợp lệ
    echo json_encode(['message' => 'Phương thức không được hỗ trợ.']);
    exit;
}

// Đọc dữ liệu từ yêu cầu POST
$data = file_get_contents('php://input');

// Ghi log để kiểm tra giá trị của $data
file_put_contents('debug_log.txt', "Raw Data: " . $data . PHP_EOL, FILE_APPEND);

// Giải mã JSON
$decoded_data = json_decode($data, true);

// Kiểm tra nếu JSON không hợp lệ
if ($decoded_data === null && json_last_error() !== JSON_ERROR_NONE) {
    file_put_contents('debug_log.txt', "JSON Error: " . json_last_error_msg() . PHP_EOL, FILE_APPEND);
    http_response_code(400);
    echo json_encode(['message' => 'Payload không hợp lệ (Lỗi JSON).']);
    exit;
}

// Ghi log để kiểm tra dữ liệu sau giải mã
file_put_contents('debug_log.txt', "Decoded Data: " . print_r($decoded_data, true) . PHP_EOL, FILE_APPEND);

// Kiểm tra payload hợp lệ
if (isset($decoded_data['transaction_status'], $decoded_data['order_id'])) {
    $transaction_status = $decoded_data['transaction_status'];
    $order_id = $decoded_data['order_id'];
    $transaction_id = $decoded_data['transaction_id'] ?? '';
    $amount_paid = $decoded_data['amount'] ?? 0;

    // Xử lý theo trạng thái giao dịch
    if ($transaction_status === 'success') {
        // Cập nhật trạng thái đơn hàng khi giao dịch thành công
        $update_order_status = "UPDATE da_donhangdadat SET TrangThai = 1, Magiaodich = '$transaction_id' WHERE madonhang = '$order_id'";
        if ($db->query($update_order_status)) {
            file_put_contents('debug_log.txt', "Order updated successfully: $order_id" . PHP_EOL, FILE_APPEND);
            http_response_code(200);
            echo json_encode(['message' => 'Giao dịch thành công!']);
        } else {
            file_put_contents('debug_log.txt', "SQL Error: " . $db->error . PHP_EOL, FILE_APPEND);
            http_response_code(500);
            echo json_encode(['message' => 'Lỗi cập nhật đơn hàng: ' . $db->error]);
        }
    } elseif ($transaction_status === 'fail') {
        // Cập nhật trạng thái đơn hàng khi giao dịch thất bại
        $update_order_status = "UPDATE da_donhangdadat SET TrangThai = 0 WHERE madonhang = '$order_id'";
        if ($db->query($update_order_status)) {
            file_put_contents('debug_log.txt', "Failed transaction updated: $order_id" . PHP_EOL, FILE_APPEND);
            http_response_code(200);
            echo json_encode(['message' => 'Giao dịch thất bại, trạng thái đã được cập nhật.']);
        } else {
            file_put_contents('debug_log.txt', "SQL Error: " . $db->error . PHP_EOL, FILE_APPEND);
            http_response_code(500);
            echo json_encode(['message' => 'Lỗi cập nhật trạng thái: ' . $db->error]);
        }
    } else {
        // Trạng thái giao dịch không hợp lệ
        file_put_contents('debug_log.txt', "Invalid transaction status: $transaction_status" . PHP_EOL, FILE_APPEND);
        http_response_code(400);
        echo json_encode(['message' => 'Trạng thái giao dịch không hợp lệ.']);
    }
} else {
    // Payload không hợp lệ
    file_put_contents('debug_log.txt', "Invalid payload: missing transaction_status or order_id" . PHP_EOL, FILE_APPEND);
    http_response_code(400);
    echo json_encode(['message' => 'Payload không hợp lệ.']);
}
?>
<div class="container">
    <h2>Thanh toán thành công!</h2>
    <p>Cảm ơn bạn đã mua hàng. Đơn hàng của bạn đang được xử lý.</p>
</div>



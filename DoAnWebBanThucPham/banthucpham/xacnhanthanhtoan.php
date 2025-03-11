<?php
// Kết nối cơ sở dữ liệu
include './incc/hearder.php';

// Kiểm tra đăng nhập
$login_checkk = Session::get('curtomer_login');
if ($login_checkk == false) {
    header('Location:login.php');
    exit;
}
    $tongTien = 0; // Khởi tạo giá trị mặc định
    $sl = 0;
    $hienthigh = $gh->get_themgiahang();
    if ($hienthigh) {
        while ($result = $hienthigh->fetch_assoc()) {
            $tongcong = $result['gia'] * $result['soluong'];
            echo $tongcong;
            $tongTien += $tongcong;
            $sl += $result['soluong'];
        }
    }

// Lấy và kiểm tra tham số từ URL
$transaction_status = filter_input(INPUT_GET, 'transaction_status', FILTER_SANITIZE_STRING);
$order_id = filter_input(INPUT_GET, 'order_id', FILTER_SANITIZE_STRING);
$transaction_id = filter_input(INPUT_GET, 'transaction_id', FILTER_SANITIZE_STRING);
$amount_paid = filter_input(INPUT_GET, 'amount', FILTER_VALIDATE_FLOAT);

if (!$transaction_status || !$order_id || !$transaction_id || $amount_paid === false) {
    echo "<p>Tham số không hợp lệ hoặc thiếu thông tin cần thiết.</p>";
    exit;
}

// Kiểm tra trạng thái giao dịch
if ($transaction_status === 'success') {
    $stmt = $db->prepare("UPDATE da_donhangdadat SET TrangThai = 1 WHERE madonhang = ?");
    $stmt->bind_param("s", $order_id);

    if ($stmt->execute()) {
        echo "<p>Thanh toán thành công! Đơn hàng đã được giao và trạng thái đã được cập nhật.</p>";
    } else {
        echo "<p>Đã xảy ra lỗi khi cập nhật trạng thái đơn hàng.</p>";
    }
    $stmt->close();
} else {
    echo "<p>Thanh toán thất bại. Vui lòng thử lại.</p>";
}

// Hiển thị chi tiết đơn hàng
$query_order = $db->prepare("SELECT * FROM da_donhangdadat WHERE madonhang = ?");
$query_order->bind_param("s", $order_id);
$query_order->execute();
$result_order = $query_order->get_result();

if ($result_order && $result_order->num_rows > 0) {
    $order = $result_order->fetch_assoc();
    echo "<h4>Thông tin tổng quan</h4>";
    echo "<p>Mã đơn hàng: " . htmlspecialchars($order['madonhang']) . "</p>";
    echo "<p>Trạng thái thanh toán: " . ($order['TrangThai'] == 2 ? 'Đã thanh toán và giao hàng' : 'Chưa thanh toán') . "</p>";
    echo "<p>Ngày đặt hàng: " . htmlspecialchars($order['ngaydat']) . "</p>";
    echo "<p>Tổng tiền: " . number_format($order['tongtien']) . " VNĐ</p>";

    // Hiển thị chi tiết sản phẩm
    $query_details = $db->prepare("SELECT * FROM da_dathang WHERE madonhang = ?");
    $query_details->bind_param("s", $order_id);
    $query_details->execute();
    $result_details = $query_details->get_result();

    if ($result_details && $result_details->num_rows > 0) {
        echo "<h4>Chi tiết sản phẩm</h4>";
        while ($detail = $result_details->fetch_assoc()) {
            echo "<p>Sản phẩm: " . htmlspecialchars($detail['ChiTietName']) . "</p>";
            echo "<p>Số lượng: " . htmlspecialchars($detail['soluong']) . "</p>";
            echo "<p>Giá: " . number_format($detail['gia']) . " VNĐ</p>";
            echo "<hr>";
        }
    } else {
        echo "<p>Không tìm thấy chi tiết sản phẩm.</p>";
    }
    $query_details->close();
} else {
    echo "<p>Không tìm thấy thông tin đơn hàng.</p>";
}
$query_order->close();
?>

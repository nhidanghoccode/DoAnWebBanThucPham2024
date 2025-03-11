<?php
include './incc/hearder.php';
?>
<?php
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
?>
<?php
$receiver_account = "9335311203";
$receiver_bank = "Vietcombank"; 
$receiver_name = "Ngo Thi My Tien";
$transaction_note = "Thanh toán giỏ hàng";
// Tạo URL mã QR
$cus_idd = $_POST['cus_idd']; // ID người dùng
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cus_idd = $_POST['cus_idd'];
    $finalAmount = $_POST['final_amount'];

    // Thêm đơn hàng mới vào cơ sở dữ liệu và lấy ID
    $inseorder = $gh->themdon_hangg($cus_idd, $finalAmount);
    if ($inseorder) {
        // Lấy mã đơn hàng vừa chèn (ID tự tăng trong CSDL)
        $order_id = $db->insert_id; // Sử dụng insert_id để lấy ID cuối cùng được thêm
        echo "Mã đơn hàng là: $order_id";

        // Tạo callback URL sử dụng mã đơn hàng từ CSDL
        $callback_url = urlencode("https://6f1f-2402-800-63e0-d6b3-fc80-7845-5c13-bff3.ngrok-free.app/banthucpham/webhook.php?cus_id=$cus_idd&order_id=$order_id");

        // Xóa giỏ hàng
        $gh->dell_all();
    } else {
        // Xử lý lỗi
        echo "Có lỗi xảy ra khi tạo đơn hàng!";
    }
}
// Tạo URL mã QR
$qr_url = "https://img.vietqr.io/image/$receiver_bank-{$receiver_account}-compact.png?amount=$tongTien&addInfo=$transaction_note&callback_url=$callback_url";
?>
<div class="container" style="margin-top: 150px;">
<div class="col">
    <div class="text-center">
        <h5>Thanh toán qua mã QR</h5>
        <img src="<?php echo $qr_url; ?>" alt="Mã QR thanh toán" class="img-fluid" style="width: 350px; height: auto;" />
        <p>Quét mã QR để thanh toán số tiền: <strong><?php echo $tongTien; ?> VNĐ</strong></p>
</div>
</div>
</div>
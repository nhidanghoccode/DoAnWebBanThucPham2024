<?php
// Include thư viện DOMPDF và các lớp cần thiết
require '../vendor/autoload.php'; // Thư viện DOMPDF
use Dompdf\Dompdf;

include_once('../lib/database.php');
$db = new Database();

// Nhận dữ liệu từ URL
$cusid = $_GET['cusid'] ?? null; // ID khách hàng
$madonhang = $_GET['madonhang'] ?? null; // Mã đơn hàng

// Kiểm tra dữ liệu đầu vào
if (!$cusid || !$madonhang) {
    die("Dữ liệu không hợp lệ. Vui lòng kiểm tra lại.");
}

// Lấy thông tin khách hàng
include_once '../class/login_class.php';
$cs = new login_class();
$customer = $cs->layTTnguoidung($cusid)->fetch_assoc();
if (!$customer) {
    die("Không tìm thấy thông tin khách hàng.");
}

// Lấy tổng tiền đã trừ xu
$query_tongtien = "SELECT tongtien FROM da_donhangdadat WHERE madonhang = '$madonhang'";
$result_tongtien = $db->select($query_tongtien);
$finalAmount = 0;

if ($result_tongtien && $result_tongtien->num_rows > 0) {
    $row = $result_tongtien->fetch_assoc();
    $finalAmount = $row['tongtien'];
} else {
    $finalAmount = 0;
}

// Lấy danh sách sản phẩm thuộc đơn hàng
$products = $cs->hienthicacdonhang($madonhang);
if (!$products || $products->num_rows <= 0) {
    die("Không tìm thấy sản phẩm nào trong đơn hàng.");
}

// Chuẩn bị nội dung HTML
$html = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Hóa đơn mua hàng</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .invoice-container {
            padding: 20px;
            max-width: 800px;
            margin: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
        }
        h1, h3 {
            text-align: center;
        }
        .customer-info p {
            margin: 5px 0;
            font-size: 14px;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .product-table th, .product-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .product-table th {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class='invoice-container'>
        <h1>HÓA ĐƠN MUA HÀNG</h1>
        <h3>Thông tin khách hàng</h3>
        <div class='customer-info'>
            <p><strong>Tên:</strong> {$customer['cusName']}</p>
            <p><strong>Địa chỉ:</strong> {$customer['cusDiaChi']}, {$customer['tenTinh']}, {$customer['TenHuyen']}</p>
            <p><strong>SĐT:</strong> {$customer['cusSDT']}</p>
            <p><strong>Email:</strong> {$customer['cusEmail']}</p>
        </div>
        <h3>Danh sách sản phẩm</h3>
        <table class='product-table'>
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá (VNĐ)</th>
                    <th>Thành tiền (VNĐ)</th>
                </tr>
            </thead>
            <tbody>";
$tong_thanhtien = 0;

// Thêm sản phẩm vào bảng HTML
while ($row = $products->fetch_assoc()) {
    $soluong = $row['soluong'];
    $gia = $row['gia'];
    $thanhtien = $row['orderGia'];
    $tong_thanhtien += $thanhtien;

    $html .= "
        <tr>
            <td>{$row['ChiTietName']}</td>
            <td>{$soluong}</td>
            <td>" . number_format($gia, 0, ',', '.') . "</td>
            <td>" . number_format($thanhtien, 0, ',', '.') . "</td>
        </tr>";
}

// Thêm tổng tiền vào bảng
$html .= "
                <tr class='total-row'>
                    <td colspan='3'>Tổng tiền</td>
                    <td>" . number_format($tong_thanhtien, 0, ',', '.') . "</td>
                </tr>
                <tr class='total-row'>
                    <td colspan='3'>Số tiền sau khi trừ xu</td>
                    <td>" . number_format($finalAmount, 0, ',', '.') . "</td>
                </tr>
            </tbody>
        </table>
        <div class='footer'>
            <p>Cảm ơn quý khách đã mua hàng!</p>
            <p>Mọi thắc mắc xin vui lòng liên hệ hotline: 1900 123 456</p>
        </div>
    </div>
</body>
</html>";

// Khởi tạo DOMPDF và xuất PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Xuất file PDF
$dompdf->stream("hoadon_madonhang_$madonhang.pdf", ["Attachment" => 1]);
?>

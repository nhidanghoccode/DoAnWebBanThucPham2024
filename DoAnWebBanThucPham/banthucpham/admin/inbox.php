<?php 
include 'inc/header.php'; 
include 'inc/sidebar.php'; 

$filepath = realpath(dirname(__FILE__)); 

include_once($filepath . '/../class/giohang_class.php'); 
include_once($filepath . '/../helpers/format.php'); 
include_once($filepath . '/../class/login_class.php'); 

// Sử dụng đường dẫn đúng để yêu cầu PHPMailer
require '../mail/PHPMailer/src/Exception.php'; // Đi lên 1 cấp để vào thư mục mail
require '../mail/PHPMailer/src/PHPMailer.php';
require '../mail/PHPMailer/src/SMTP.php';

$gh = new giohang_class;
$login = new login_class(); 

// Xử lý phần trạng thái đơn hàng chờ xử lý và vận chuyển
if(isset($_GET['shiftid'])){
    $id = $_GET['shiftid'];
    // Cập nhật trạng thái đơn hàng
    $capnhat_kho = $gh->capnhatTrangThaiVaSL($id);
    echo $capnhat_kho;
    
    $shifted = $gh->shifted($id); // Lấy kết quả cập nhật trạng thái

    // Lấy thông tin đơn hàng
    $order = $gh->getOrderById($id); // Lấy thông tin đơn hàng
    if ($order) {
        $cus_id = $order['customer_id']; // Lấy ID khách hàng
        $madonhang = $order['madonhang']; // Mã đơn hàng
        $tongtien = $order['tongtien']; // Tổng tiền đơn hàng

        // Lấy email và tên khách hàng từ đối tượng Login
        $cusEmail = $login->layEmailNguoidung($cus_id); 
        $cusName = $login->layTenNguoidung($cus_id);

        // Lấy thông tin sản phẩm từ đơn hàng
        $products = $gh->getProductsByOrderId($madonhang);
        $productDetails = '';
        $totalAmount = 0; // Biến lưu tổng tiền của tất cả sản phẩm
        foreach ($products as $product) {
            $giaGoc = $product['gia'];
            $thanhTien = $product['soluong'] * $giaGoc; // Tính thành tiền của từng sản phẩm
            $totalAmount += $thanhTien; // Cộng dồn thành tiền vào tổng tiền
            $productDetails .= '
            <tr class="text-center">
                <td>' . $product['ChiTietName'] . '</td>
                <td>' . $product['soluong'] . '</td>
                <td>' . number_format($giaGoc, 0, ',', '.') . ' VNĐ</td>
                <td>' . number_format($thanhTien, 0, ',', '.') . ' VNĐ</td>
            </tr>';
        }

        // Lấy tổng tiền đã trừ xu từ bảng da_donhangdadat bằng phương thức của lớp giohang_class
        $finalAmount = $gh->getFinalAmountByOrderId($madonhang);

        // Cấu hình gửi email với PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
            // Cấu hình máy chủ SMTP
            $mail->isSMTP();  
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'yenconguyet@gmail.com';
            $mail->Password = 'yrgnbqyujvctxxkx';  
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Thêm người gửi và người nhận
            $mail->setFrom('yenconguyet@gmail.com', 'Cửa hàng Thực Phẩm');
            $mail->addAddress($cusEmail, $cusName); 

            // Cấu hình nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'Cập nhật trạng thái đơn hàng';
            $mail->Body = "
            <h2>Thông báo về trạng thái đơn hàng</h2>
            <p>Chào $cusName,</p>
            <p>Đơn hàng của bạn với mã đơn hàng <strong>$madonhang</strong> hiện tại đang được xử lý.</p>
            <p>Sản phẩm trong đơn hàng của bạn:</p>
            <table border='1' style='border-collapse: collapse; width: 100%;'>
                <thead>
                    <tr class='text-center'>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    $productDetails
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan='4' class='text-end'>
                            <strong>Số tiền sau khi trừ xu: " . number_format($finalAmount, 0, ',', '.') . " VNĐ</strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <p>Chúng tôi sẽ tiếp tục thông báo về trạng thái giao hàng trong thời gian sớm nhất.</p>
            <p>Cảm ơn bạn đã mua sắm tại cửa hàng Thực Phẩm.</p>
            <p>Trân trọng,</p>
            <p>Cửa hàng Thực Phẩm</p>";

            // Gửi email
            $mail->send();
            echo 'Đã gửi email xác nhận trạng thái đơn hàng';
        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }
    }
}

if (isset($_GET['deltid'])) {
    $id = $_GET['deltid'];
    // Xóa đơn hàng từ hệ thống
    $dele = $gh->xoamotinbox($id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thư gửi</h2>
        <div class="block">
            <?php
            if (isset($shifted)) {
                echo $shifted;
            }
            ?>
            <table class="table table-striped table-bordered table-hover" id="example">
                <thead class="text-center">
                    <tr>
                        <th>STT</th>
                        <th>Thời Gian ĐH</th>
                        <th>Mã đơn hàng</th>
                        <th>ID khách hàng</th>
                        <th>Chi tiết</th>
                        <th>Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // $ct = new cat;
                    $fm = new Format;
                    $get_inbox_cart = $gh->get_inbox_cart();
                    if ($get_inbox_cart) {
                        $i = 0;
                        while ($result = $get_inbox_cart->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i ?></td>
                                <td><?php echo $fm->formatDate($result['ngaydat']) ?></td>
                                <td><?php echo $result['madonhang'] ?></td>
                                <td><?php echo $result['cusName'] ?></td>
                                <td><a href="customer.php?cusid=<?php echo $result['customer_id'] ?>&madonhang=<?php echo $result['madonhang'] ?>">Xem chi tiết</a></td>
                                <td class="text-center">
                                    <?php
                                    if ($result['TrangThai'] == '0') {
                                    ?>
                                        <a href="?shiftid=<?php echo $result['madonhang']?>" class="btn btn-warning btn-sm">Chờ xử lý</a>
                                    <?php
                                    } else if ($result['TrangThai'] == '2') {
                                    ?>
                                        <p href="" class="btn btn-warning">Giao hàng thành công</p>
                                        <!-- <a href="?deltid=" class="btn btn-warning">Xóa</a> -->
                                    <?php
                                    } else {
                                        echo 'Chờ xác nhận của khách hàng';
                                    }
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>
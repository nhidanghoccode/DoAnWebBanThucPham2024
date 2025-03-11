<?php
include './incc/hearder.php';
include_once './class/giohang_class.php';
?>

<?php
// Handle order cancellation when seller has not confirmed
if (isset($_GET['confid'])) {
    $productId = $_GET['confid'];
    $dele = $gh->xoamotdonhan($productId);
}

// Handle shipment acknowledgment
if (isset($_GET['shiftid'])) {
    $id = $_GET['shiftid'];
    $update_status = $gh->danhanhang($id);
    if ($update_status) {
        echo "<script>window.location = 'success.php'</script>";
    } else {
        echo $update_status;
    }
}


// Check if user is logged in
$login_check = Session::get('curtomer_login');
if ($login_check == false) {
    header('Location: login.php');
}
?>

<?php
// Kiểm tra xem biến $resultt đã được khởi tạo và có giá trị hợp lệ
if (isset($resultt) && is_array($resultt)) {
    // Tạo đối tượng lớp giohang_class
    $ktDanhGia = new giohang_class();

    // Lấy thông tin đơn hàng
    $madonhang = $resultt['madonhang'];
    $customer_id = $resultt['customer_id'];

    // Kiểm tra xem đơn hàng đã được đánh giá chưa
    if ($ktDanhGia->ktdanhgia($madonhang, $customer_id)) {
        // Nếu đã đánh giá
        echo 'Đã đánh giá';
    } else {
        // Nếu chưa đánh giá
        echo '<a href="danhgiasanpham.php?madonhang=' . $madonhang . '" class="btn btn-success">Đánh giá sản phẩm đã mua</a>';
    }
} else {
    echo 'Không có thông tin đơn hàng để hiển thị.';
}
?>


<!-- Order History Page -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h4 class="mb-4 text-center">Lịch sử đơn hàng</h4>
        <div class="row g-5">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ngày đặt</th>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Chi tiết</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hủy đơn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cus_id = Session::get('curtomer_id');
                            $fm = new Format;
                            $get_cart_order = $gh->get_trangthaidonhang($cus_id);
                            $i = 0;
                            if ($get_cart_order) {
                                while ($resultt = $get_cart_order->fetch_assoc()) {
                                    $i++;
                            ?>
                                    <tr class="text-center">             
                                    <td class="py-3"><?php echo $i ?></td>
                                    <td class="py-3"><?php echo $resultt['ngaydat'] ?></td>
                                    <td class="py-3"><?php echo $resultt['madonhang'] ?></td>
                                    <td><a href="chitietdonhang.php?cusid=<?php echo $resultt['customer_id'] ?>&madonhang=<?php echo $resultt['madonhang'] ?>" class="btn btn-warning">Xem chi tiết</a></td>
                                    <td class="py-3">
    <?php
    if ($resultt['TrangThai'] == '0') {
        echo 'Chờ xác nhận';
    } else if ($resultt['TrangThai'] == '1') {
    ?>
        <a href="?shiftid=<?php echo $resultt['madonhang'] ?>" class="btn btn-warning">Xác nhận đã nhận hàng</a>
    <?php
    } else if ($resultt['TrangThai'] == '2') { // Đơn hàng đã nhận, người dùng có thể đánh giá
        $madonhang = $resultt['madonhang'];
        $customer_id = $resultt['customer_id'];
        $ktDanhGia = new giohang_class();
        // Kiểm tra xem đơn hàng đã được đánh giá chưa
        if ($ktDanhGia->ktdanhgia($madonhang, $customer_id)) {
            // Nếu đã đánh giá
            echo 'Đã đánh giá';
        } else {
            // Nếu chưa đánh giá
            echo '<a href="danhgiasanpham.php?madonhang=' . $madonhang . '" class="btn btn-success">Đánh giá sản phẩm đã mua</a>';
        }
    } else {
        echo 'Đã đánh giá';
    }
    ?>
</td>


                                        </td>
                                        <?php
                                        if ($resultt['TrangThai'] == '0') {
                                        ?>
                                            <td class="py-3"><a href="?confid=<?php echo $resultt['madonhang'] ?>" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này không?')" class="btn btn-danger">Hủy Đơn</a></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td class="py-3"><?php echo ''; ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
$cus_id = Session::get('curtomer_id');
$current_points = $gh->getUserPoints($cus_id);
?>
<div class="mt-4 text-center">
    <p class="text-success fw-bold">
        Hãy đánh giá đơn hàng, bạn sẽ được nhận <span class="text-danger">200 xu</span>!
    </p>
    <div class="d-flex justify-content-center align-items-center">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0TR8nyWjoXQ71mJAOVhbC-B4cHk4W6ydvPA&s" alt="Xu" style="width: 50px; height: 50px; margin-right: 10px;">
        <span class="fw-bold text-primary" style="font-size: 1.5rem;">
            Số xu hiện tại: <?php echo $current_points; ?>xu
        </span>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('./incc/chantrang.php');
?>

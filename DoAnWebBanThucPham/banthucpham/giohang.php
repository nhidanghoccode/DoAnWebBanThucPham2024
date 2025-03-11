<?php
include './incc/hearder.php';
// include './incc/sileder.php';
include 'notification.php';
?>

<?php
if (isset($_GET['cartid'])) {
    $cartid = $_GET['cartid'];
    $XOAgihang = $gh->xoagihang($cartid);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $cartid = $_POST['cartid'];
    $sl = $_POST['quantity'];
    $stock = $_POST['stock'];
    $capnhatSL_addtocart = $gh->capnhatSLgiohang($stock,$sl, $cartid);
    //nếu người dùng chọn sl là 0 hoặc dưới sẽ xóa sản phẩm đó luôn
    if ($sl <= 0) {
        $XOAgihang = $gh->xoagihang($cartid);
    }
}

?>
<?php
$login_checkk = Session::get('curtomer_login');
if ($login_checkk == false) {
    //khi người dùng chưa đăng nhập mà biết đường dẫn thì dăn ra trang login
    header('Location:login.php');
}
?>

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">

        <div class="row g-5" style="margin-top: 50px;">
            <div class="col-md-12 col-lg-6 col-xl-12">
                <div class="table-responsive">
                    <?php
                    if (isset($capnhatSL_addtocart)) {
                        echo $capnhatSL_addtocart;
                    }
                    ?>
                    <table class="table">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th scope="col">Chọn</th>
                                <th scope="col">Các sản phẩm</th>
                                <th scope="col">Tên SP</th>
                                <th scope="col">Tồn kho</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng cộng</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $hienthigh = $gh->get_themgiahang();
                            if ($hienthigh) {
                                $tongTien = 0;
                                $sl = 0;
                                while ($result = $hienthigh->fetch_assoc()) {
                                    // Lấy giá trị giảm giá từ bảng khuyến mãi
                                    $giaGoc = $result['ChiTietGia'];
                                    $giaKhuyenMai = $result['gia_tri_khuyenmai'] ?? 0;
                                    $giaSauKhuyenMai = $giaGoc * (100 - $giaKhuyenMai) / 100;  // Tính giá sau khi giảm
                        ?>
                                    <tr class="text-center">
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input buy_checked" 
                                                    <?php if ($result['TrangThai'] == 1) { echo "checked"; } ?>
                                                    id="check1" name="option1" value="<?php echo $result['ghID'] ?>">                                                 
                                            </div>
                                        </td>
                                        <th scope="row">
                                            <div class="d-flex align-items-center mt-2">
                                                <img src="admin/upload/<?php echo trim($result['ChiTietImg']) ?>" class="img-fluid rounded-circle " style="width: 90px; height: 90px;" alt="">
                                            </div>
                                        </th>
                                        <td class="py-5"><?php echo $result['ChiTietName'] ?></td>
                                        <td class="py-5"><?php echo $result['stock'] ?></td>
                                        <td class="py-5">
                                            <?php echo number_format($giaGoc, 0, ',', '.') ?> VNĐ
                                            <?php if ($giaKhuyenMai > 0) { ?>
                                                <br><span class="text-danger">Giảm giá: <?php echo $giaKhuyenMai; ?>%</span>
                                            <?php } ?>
                                        </td>
                                        <td class="py-5">
                                            <form action="" method="post">
                                                <input type="hidden" name="cartid" value="<?php echo $result['ghID'] ?>" />
                                                <input type="hidden" name="stock" value="<?php echo $result['stock'] ?>" />
                                                <input type="number" name="quantity" min="0" value="<?php echo $result['soluong'] ?>" style="width: 60px;"/>
                                                <input type="submit" name="submit" value="Cập nhật" class="btn btn-sm btn-warning"/>
                                            </form>
                                        </td>
                                        <td class="py-5">
                                            <?php 
                                            $tongcong = $giaSauKhuyenMai * $result['soluong'];
                                            echo number_format($tongcong, 0, ',', '.') . ' VNĐ';
                                            ?>
                                        </td>
                                        <td class="py-5 text-danger">
                                            <a href="?cartid=<?php echo  $result['ghID'] ?>" class="text-danger" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a>
                                        </td>
                                    </tr>
                        <?php
                                    $tongTien += $tongcong;
                                    $sl += $result['soluong'];
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>

                <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                <a href="payment.php" id="btnCheckout" type="button" class="btn bg-secondary py-3 px-4 text-uppercase w-100 text-white" onclick="return checkLogin();">
    Thanh toán
</a>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Checkout Page End -->

<script>
    $('.buy_checked').change(function(){
        var ghID=$(this).val();
        if($(this).is(':checked')){ // nếu checkbox được chọn, thay đổi trạng thái
            var TrangThai=1;
            $.ajax({url:'ajax/stick_muahang.php',
                data:{ghID:ghID,TrangThai:TrangThai},
                type:'post',
                // success:function(){
                //     alert('Chọn mua thành công!');
                // }
            });
        }else{
            var TrangThai=0;
            $.ajax({url:'ajax/stick_muahang.php',
                data:{ghID:ghID,TrangThai:TrangThai},
                type:'post',
                // success:function(){
                //     alert('Bỏ chọn mua thành công!');
                // }
            });
        }
    })
</script>
<script>
    function checkLogin() {
        // Gửi yêu cầu AJAX kiểm tra trạng thái đăng nhập
        let isLoggedIn = false;

        $.ajax({
            url: 'ajax/check_login.php', // Endpoint kiểm tra trạng thái đăng nhập
            type: 'POST',
            async: false, // Đồng bộ để chờ kết quả
            success: function(response) {
                isLoggedIn = response === 'true'; // Trả về true nếu đã đăng nhập
            }
        });

        if (!isLoggedIn) {
            alert('Bạn cần đăng nhập để tiếp tục!');
            window.location.href = 'login.php'; // Điều hướng đến trang đăng nhập
            return false;
        }

        return true;
    }
</script>
<script>
    document.getElementById("btnCheckout").addEventListener("click", function (event) {
    // Lấy danh sách tất cả các checkbox
    const checkboxes = document.querySelectorAll(".buy_checked");
    let isChecked = false;

    // Kiểm tra xem có checkbox nào được chọn không
    for (const checkbox of checkboxes) {
        if (checkbox.checked) {
            isChecked = true;
            break; // Dừng kiểm tra nếu tìm thấy một checkbox được chọn
        }
    }

    // Nếu không có checkbox nào được chọn, hiển thị thông báo
    if (!isChecked) {
        showNotification("Vui lòng chọn ít nhất một sản phẩm để thanh toán.");
        event.preventDefault(); // Ngăn hành động mặc định (ngăn chuyển trang)
    } else {
        // Nếu có sản phẩm được chọn, không hiển thị thông báo
        closeNotification();
        // Chuyển đến trang thanh toán
        window.location.href = "payment.php";
    }
});

function showNotification(message) {
    const notification = document.getElementById("notification");
    const notificationMessage = document.getElementById("notificationMessage");

    if (notification && notificationMessage) {
        // Cập nhật nội dung thông báo
        notificationMessage.innerText = message;

        // Hiển thị khối thông báo
        notification.style.display = "block";
    } else {
        console.error("Phần tử thông báo không tồn tại trong HTML!");
    }
}

function closeNotification() {
    const notification = document.getElementById("notification");

// Ẩn thông báo
if (notification) {
    notification.style.display = "none";
}
}

</script>

<?php
include('./incc/chantrang.php');
?>

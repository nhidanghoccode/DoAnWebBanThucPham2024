<?php
include("./incc/hearder.php");

if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $cus_idd = Session::get('curtomer_id');

    // Kiểm tra checkbox
    if (isset($_POST['use_points'])) {
        $tongTien = $_SESSION['total_amount']; // Giả sử tổng tiền lưu trong session
        $tongTienSauTruXu = $gh->capnhatXuVaTongTien($cus_idd, $tongTien);

        // Lưu tổng tiền sau khi trừ xu vào session
        $_SESSION['total_amount'] = $tongTienSauTruXu;
    }

    if (isset($_POST['final_amount'])) {
        $finalAmount = $_POST['final_amount']; // Lấy số tiền sau khi trừ xu
        $inseorder = $gh->themdon_hangg($cus_idd, $finalAmount);
    }
        // Xóa giỏ hàng khi đăng xuất
    $dellgh = $gh->dell_all();
    header('location:index.php');
}
?>

<form action="?orderid=order" method="post" id="order-form">
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5" style="margin-top: 50px;">
                <h4 class="mb-0">Thông tin thanh toán</h4>
                <?php
                if (isset($inseorder)) {
                    echo $inseorder;
                }
                ?>

                <div class="col-md-12 col-lg-6 col-xl-7" style="border: 1px solid #81c408; padding:10px ;border-radius: 20px;margin-right: 20px;">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-primary text-white text-center">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên SP</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng cộng</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $hienthigh = $gh->get_themgiahang_check();
                            if ($hienthigh) {
                                $tongTien = 0;
                                $sl = 0;
                                $i = 0;
                                while ($result = $hienthigh->fetch_assoc()) {
                                    $i++;

                                    // Tính giá sau khuyến mãi
                                    $giaSauKhuyenMai = $result['ChiTietGia'];
                                    if ($result['gia_tri_khuyenmai'] > 0) {
                                        $giaSauKhuyenMai = $result['ChiTietGia'] * (1 - $result['gia_tri_khuyenmai'] / 100);
                                    }

                                    // Tính tổng tiền cho sản phẩm sau khi khuyến mãi
                                    $tongcong = $giaSauKhuyenMai * $result['soluong'];
                                    ?>
                                    <tr class="text-center">
                                        <td class="py-2"><?php echo $i ?></td>
                                        <td class="py-2"><?php echo $result['ChiTietName'] ?></td>
                                        <td class="py-2">
                                            <?php 
                                            if (!empty($result['gia_tri_khuyenmai'])) {
                                                // Hiển thị giá gốc bị gạch ngang
                                                echo "<span style='text-decoration: line-through; color: grey;'>" . number_format($result['ChiTietGia'], 0, ',', '.') . " VNĐ</span>";
                                                // Hiển thị giá sau khi giảm
                                                echo "<br><span style='color: red;'>" . number_format($giaSauKhuyenMai, 0, ',', '.') . " VNĐ</span>";
                                            } else {
                                                // Nếu không có khuyến mãi, chỉ hiển thị giá gốc
                                                echo number_format($result['ChiTietGia'], 0, ',', '.') . " VNĐ";
                                            }
                                            ?>
                                        </td>

                                        <td class="py-2"><?php echo $result['soluong'] ?></td>
                                        <td class="py-2"><?php echo number_format($tongcong, 0, ',', '.') ?> VNĐ</td>
                                    </tr>
                                    <?php
                                    $tongTien += $tongcong;
                                    $sl += $result['soluong'];
                                }
                                $_SESSION['total_amount'] = $tongTien; // Lưu tổng tiền vào session
                            }
                            ?>

                                <?php
                                $hienthigh = $gh->get_themgiahang();
                                if ($hienthigh) {
                                ?>
                                    <tr>
                                        <th scope="row"></th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark text-uppercase py-3">TỔNG CỘNG</p>
                                        </td>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">
                                                    <?php
                                                    echo number_format($tongTien, 0, ',', '.') . ' VNĐ';
                                                    ?>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                } else {
                                    echo 'Giỏ hàng trống';
                                }
                                ?>
                                <?php
                                $cus_id = Session::get('curtomer_id');
                                $current_points = $gh->getUserPoints($cus_id);
                                ?>
                                <tr>
                                    <td colspan="5" class="py-5 text-center">
                                        <div class="d-flex align-items-center justify-content-between w-100" style="border: 1px solid #81c408; padding: 15px; border-radius: 10px;">
                                            <div class="d-flex align-items-center">
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0TR8nyWjoXQ71mJAOVhbC-B4cHk4W6ydvPA&s" alt="Coin Image" style="width: 50px; height: 50px; margin-right: 15px;">
                                                <p class="mb-0 text-dark text-uppercase">Số xu hiện có: <b style="color:red"><?php echo $current_points; ?> xu</b></p>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="use_points" id="use_points" onchange="updateTotal()">
                                                <label for="use_points">Sử dụng điểm xu để giảm giá</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="py-5 text-center">
                                        <div class="d-flex align-items-center justify-content-between w-100" style="border: 1px solid #81c408; padding: 15px; border-radius: 10px;">
                                        <p class="mb-0 text-dark text-uppercase">Số tiền sau khi trừ xu: <b id="final_amount_display"><?php echo number_format($tongTien, 0, ',', '.'); ?> VNĐ</b></p>
                                        <input type="hidden" name="final_amount" id="final_amount" value="<?php echo $tongTien; ?>">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4" style="border: 1px solid #81c408; padding:10px;border-radius: 20px;">
                    <h4 class="mb-4">Thông tin khách hàng</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <?php
                            $id = Session::get('curtomer_id');
                            $get_thongtin = $login->layTTnguoidung($id);
                            if ($get_thongtin) {
                                while ($resurt = $get_thongtin->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td>Tên</td>
                                        <td>:</td>
                                        <td><?php echo $resurt['cusName'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ</td>
                                        <td>:</td>
                                        <td><?php echo $resurt['cusDiaChi'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>SĐT</td>
                                        <td>:</td>
                                        <td><?php echo $resurt['cusSDT'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tỉnh</td>
                                        <td>:</td>
                                        <td><?php echo $resurt['tenTinh'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Huyện</td>
                                        <td>:</td>
                                        <td><?php echo $resurt['TenHuyen'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td><?php echo $resurt['cusEmail'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-center"><a href="thongtinkhachhang.php">Cập nhật thông tin</a></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 text-center align-items-center justify-content-center">
            <button type="submit" name="dathang" class="btn bg-secondary py-3 px-4 text-uppercase w-50 text-white">Đặt hàng</button>
        </div>
    </div>
</form>

<script>
    function updateTotal() {
        var usePoints = document.getElementById('use_points').checked;
        var totalAmount = <?php echo $_SESSION['total_amount']; ?>;
        var pointsAvailable = <?php echo $current_points; ?>;
        
        // Tính tổng tiền sau khi trừ điểm xu
        var discountAmount = usePoints ? Math.min(totalAmount, pointsAvailable) : 0;
        var finalAmount = totalAmount - discountAmount;

        // Cập nhật giá trị hiển thị
        document.getElementById('final_amount_display').innerText = new Intl.NumberFormat().format(finalAmount) + ' VNĐ';
        document.getElementById('final_amount').value = finalAmount; // Cập nhật input ẩn
    }

    // Gọi hàm khi tải trang
    window.onload = updateTotal;
</script>

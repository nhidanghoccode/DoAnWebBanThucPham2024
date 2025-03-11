<?php
include './incc/hearder.php';
// include './incc/sileder.php';
?>
<?php
// if (isset($_GET['cartid'])) {
//     $cartid = $_GET['cartid'];
//     $XOAgihang = $gh->xoagihang($cartid);
// }
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
//     $cartid = $_POST['cartid'];
//     $sl = $_POST['quantity'];
//     $capnhatSL_addtocart = $gh->capnhatSLgiohang($stock,$sl,$cartid);
//     //nếu người dùng chọn sl là 0 hoặc dưới  sẽ xáo sản phẩm đó luôn
//     if ($sl <= 0) {
//         $XOAgihang = $gh->xoagihang($cartid);
//     }
// }
?>
<?php
// if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
//     $cus_idd = Session::get('curtomer_id');

//     // Kiểm tra checkbox
//     if (isset($_POST['use_points'])) {
//         $tongTien = $_SESSION['total_amount']; // Giả sử tổng tiền lưu trong session
//         $tongTienSauTruXu = $gh->capnhatXuVaTongTien($cus_idd, $tongTien);

//         // Lưu tổng tiền sau khi trừ xu vào session
//         $_SESSION['total_amount'] = $tongTienSauTruXu;
//     }

//     if (isset($_POST['final_amount'])) {
//         $finalAmount = $_POST['final_amount']; // Lấy số tiền sau khi trừ xu
//         $inseorder = $gh->themdon_hangg($cus_idd, $finalAmount);
//     }
//         // Xóa giỏ hàng khi đăng xuất
//     $dellgh = $gh->dell_all();
//     header('location:index.php');
// }
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
            <div class="row g-5" style="margin-top: 50px;">
                <h4 class="mb-0">Thông tin thanh toán</h4>
                <?php
                if (isset($inseorder)) {
                    echo $inseorder; // Hiển thị kết quả thêm đơn hàng
                }
                ?>

                <!-- Giỏ hàng -->
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
                                                echo "<span style='text-decoration: line-through; color: grey;'>" . number_format($result['ChiTietGia'], 0, ',', '.') . " VNĐ</span>";
                                                echo "<br><span style='color: red;'>" . number_format($giaSauKhuyenMai, 0, ',', '.') . " VNĐ</span>";
                                            } else {
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
                                        <div class="row g-4 text-center align-items-center justify-content-center pt-4 d-flex">
                        <div class="col">
                            <form action="congthanhtoan.php" method="post">
                                <input type="hidden" value="<?php echo $tongcong; ?>" name="sotienthanhtoanONLINE" id="sotienthanhtoanONLINE">
                                <button class="btn btn-success" name="" onclick="pay()">Thanh toán VNPAY</button>
                            </form>
                        </div>
                        <div class="col">
                            <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="congthanhtoanmomo.php">
                                <input type="hidden" value="<?php echo $tongcong; ?>" name="sotienthanhtoanONLINE" id="sotienthanhtoanONLINE">
                                <button class="btn btn-success">Thanh toán QR MOMO</button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="congthanhtoan_onpay.php" method="post">
                                <input type="hidden" value="<?php echo $tongcong; ?>" name="sotienthanhtoanONLINE" id="sotienthanhtoanONLINE">
                                <button class="btn btn-success">Thanh toán OnPay</button>
                            </form>
                        </div>
                        
                        <div class="col">
                            <div class="text-center">
                            <button class="btn btn-success">Thanh toán qua mã QR</button>
                            </div>
                        </div>
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
                                        <td colspan="3">
                                            
                                            <?php
                                                $receiver_account = "9335311203"; // Số tài khoản của bạn
                                                $receiver_bank = "Vietcombank"; // Vietcombank
                                                $receiver_name = "Ngo Thi My Tien"; // Tên tài khoản nhận
                                                $transaction_note = "Thanh toán giỏ hàng"; // Ghi chú giao dịch
                                                
                                                // Tạo URL mã QR
                                                $qr_url = "https://img.vietqr.io/image/$receiver_bank-{$receiver_account}-compact.png?amount=$tongTien&addInfo=$transaction_note";
                                                
                                                ?>
                                            <div class="d-grid gap-2 text-uppercase py-3 px-4 w-100">
                                            <h5>Thanh toán qua mã QR</h5>
                                                <img src="<?php echo $qr_url; ?>" alt="Mã QR thanh toán" class="img-fluid" />
                                                <p>Quét mã QR để thanh toán số tiền: <strong><?php echo $tongTien; ?> VNĐ</strong></p>
                                            </div>
                                        </td>
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
            </div>
        </div>

    </div>
</div>
<!-- Checkout Page End -->
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

<?php
include('./incc/chantrang.php');
?>
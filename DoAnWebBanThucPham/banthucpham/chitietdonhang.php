<?php
include './incc/hearder.php';
include_once ($filepath.'/../lib/database.php');
$db = new Database();
?>

<?php
// Handle order cancellation if the seller hasn't confirmed
if (isset($_GET['confid'])) {
    $productId = $_GET['confid'];
    $dele = $gh->xoamotdonhan($productId);
}
// Handle shipment acknowledgment
if (isset($_GET['shiftid'])) {
    $id = $_GET['shiftid'];
    $deledalayhang = $gh->danhanhang($id);
}
?>

<?php
$login_check = Session::get('curtomer_login');
if ($login_check == false) {
    // Redirect to login page if the user is not logged in
    header('Location: login.php');
}

$cs = new login_class;
?>

<!-- Order Details Page -->
<div class="container-fluid py-5">
    <div class="container py-5">

        <div class="row g-5">
            <h4 class="mb-4 text-center">Chi tiết đơn hàng</h4>

            <div class="col-12">
                <div class="table-responsive">
                    <table class="table ">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $madonhang = $_GET['madonhang'];
                        $get_oder = $cs->hienthicacdonhang($madonhang);
                        $tong_thanhtien = 0;

                        if ($get_oder) {
                            while ($result_donhang = $get_oder->fetch_assoc()) {
                                $giaGoc = $result_donhang['ChiTietGia'];
                                $giaKhuyenMai = $result_donhang['gia_tri_khuyenmai'];
                                $giaSauKhuyenMai = $result_donhang['GiaSauKhuyenMai'];
                                $thanhtien = $giaSauKhuyenMai * $result_donhang['soluong'];
                                $tong_thanhtien += $thanhtien;
                        ?>
                        <tr class="text-center">
                            <td><?php echo $result_donhang['ChiTietName']; ?></td>
                            <td><?php echo $result_donhang['soluong']; ?></td>
                            <td>
                                <?php echo number_format($giaGoc, 0, ',', '.'); ?> VNĐ
                                <?php if ($giaKhuyenMai > 0) { ?>
                                    <br><span class="text-danger">Giảm giá: <?php echo $giaKhuyenMai; ?>%</span>
                                <?php } ?>
                            </td>
                            <td><?php echo number_format($thanhtien, 0, ',', '.'); ?> VNĐ</td>
                        </tr>
                        <?php
                            }
                        }


                            // Lấy tổng tiền đã trừ xu từ bảng da_donhangdadat
                            $query_tongtien = "SELECT tongtien FROM da_donhangdadat WHERE madonhang = '$madonhang'";
                            $result_tongtien = $db->select($query_tongtien);
                            $finalAmount = 0;
                            if ($result_tongtien) {
                                $row = $result_tongtien->fetch_assoc();
                                $finalAmount = $row['tongtien']; // Lấy số tiền sau khi trừ xu
                            }
                            ?>
                            <tr>
                                <td colspan="4" class="text-end">
                                    <strong>Số tiền sau khi trừ xu: <?php echo number_format($finalAmount, 0, ',', '.'); ?> VNĐ</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
include('./incc/chantrang.php');
?>

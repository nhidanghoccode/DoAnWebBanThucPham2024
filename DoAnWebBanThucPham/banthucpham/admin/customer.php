<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<!-- <?php include '../class/danhmuccon.php.php';?> -->
 
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../class/login_class.php');
include_once($filepath . '/../helpers/format.php');
include_once ($filepath.'/../lib/database.php');
$db = new Database();
?>
<?php
if(!isset($_GET['cusid']) || $_GET['cusid']==NULL){
    echo "<script>window.location = 'inbox.php'</script>";
}else{
    $id=$_GET['cusid'];
    $madonhang=$_GET['madonhang'];
}
       $cs=new login_class;
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Chi tiết đơn hàng</h2>
                <div class="block row">
                <?php
                    $get_cus=$cs->layTTnguoidung($id);
                    if($get_cus){
                        while($result=$get_cus->fetch_assoc()){
                ?>
        <!-- Cột bên trái: Thông tin người đặt -->
        <div class="col-md-4">
            <h3>Thông tin người đặt</h3>
            <form action="" method="post">
            <table class="form">					
                        <tr>
                            <td>Tên</td>
                            <td>:</td>
                            <td>
                            <!-- readonly="readonly" : chỉ có thể xem chứ không được sửa chỉ có khách hàng mới được sửa-->
                                <input type="text" readonly="readonly" value="<?php echo $result['cusName']?> "name="cusName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>:</td>
                            <td>
                            <!-- readonly="readonly" : chỉ có thể xem chứ không được sửa chỉ có khách hàng mới được sửa-->
                                <input type="text" readonly="readonly" value="<?php echo $result['cusDiaChi']?> "name="cusDiaChi" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Tỉnh</td>
                            <td>:</td>
                            <td>
                            <!-- readonly="readonly" : chỉ có thể xem chứ không được sửa chỉ có khách hàng mới được sửa-->
                                <input type="text" readonly="readonly" value="<?php echo $result['tenTinh']?> "name="cusThanhPho" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Huyện</td>
                            <td>:</td>
                            <td>
                            <!-- readonly="readonly" : chỉ có thể xem chứ không được sửa chỉ có khách hàng mới được sửa-->
                                <input type="text" readonly="readonly" value="<?php echo $result['TenHuyen']?> "name="cusQuocGia" class="medium" />
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td>
                             readonly="readonly" : chỉ có thể xem chứ không được sửa chỉ có khách hàng mới được sửa
                                <input type="text" readonly="readonly" value="<?php echo $result['zipcode']?> "name="zipcode" class="medium" />
                            </td>
                        </tr> -->
                        <tr>
                            <td>SĐT</td>
                            <td>:</td>
                            <td>
                            <!-- readonly="readonly" : chỉ có thể xem chứ không được sửa chỉ có khách hàng mới được sửa-->
                                <input type="text" readonly="readonly" value="<?php echo $result['cusSDT']?> "name="cusSDT" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                            <!-- readonly="readonly" : chỉ có thể xem chứ không được sửa chỉ có khách hàng mới được sửa-->
                                <input type="text" readonly="readonly" value="<?php echo $result['cusEmail']?> "name="cusEmail" class="medium" />
                            </td>
                        </tr>
                    </table>
            </form>
        </div>
        <?php 
        }
     } ?>

        <!-- Cột bên phải: Danh sách đơn hàng -->
        <div class="col-md-8">
            <h3>Danh sách đơn hàng</h3>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $get_oder=$cs->hienthicacdonhang($madonhang);
                    $thanhtien=0;$tong_thanhtien=0;
                    if($get_oder){
                        while($result_donhang=$get_oder->fetch_assoc()){
                            $thanhtien =  $result_donhang['orderGia'];
                            $tong_thanhtien += $thanhtien;
                    ?>
                            <tr class="text-center">
                                <td><?php echo $result_donhang['ChiTietName']; ?></td>
                                <td><?php echo $result_donhang['soluong']; ?></td>
                                <td><?php echo number_format($result_donhang['gia'], 0, ',', '.'); ?> VNĐ</td>
                                <td><?php echo number_format($thanhtien, 0, ',', '.'); ?> VNĐ</td>
                        </tr>
                    <?php
                            }
                        }
                        $query_tongtien = "SELECT tongtien FROM da_donhangdadat WHERE madonhang = '$madonhang'";
                        $result_tongtien = $db->select($query_tongtien);
                        $finalAmount = 0;
                        if ($result_tongtien) {
                            $row = $result_tongtien->fetch_assoc();
                            $finalAmount = $row['tongtien']; // Lấy số tiền sau khi trừ xu
                        }
                    ?>
                    <tr>
                        <td colspan="4"><b>Thành tiền: <?php echo number_format($tong_thanhtien,0,',','.') ?> VNĐ</b></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end">
                            <strong>Số tiền sau khi trừ xu: <?php echo number_format($finalAmount, 0, ',', '.'); ?> VNĐ</strong>
                        </td>
                    </tr>
                </tbody>
                <!-- Thêm nút Xuất Hóa Đơn -->

            </table>
            <div class="col-md-12 text-right mt-3">
                <form action="xuathoadon.php" method="GET" target="_blank">
                    <input type="hidden" name="cusid" value="<?php echo $id; ?>">
                    <input type="hidden" name="madonhang" value="<?php echo $madonhang; ?>">
                    <button type="submit" class="btn btn-warning">Xuất Hóa Đơn</button>
                </form>
            </div>
        </div>
   
</div>

            </div>
        </div>
<?php include 'inc/footer.php';?>
<?php 
include './incc/hearder.php';
?>
<?php
$login_check = Session::get('curtomer_login');
if ($login_check == false) {
    header('Location:login.php');
}
$id = Session::get('curtomer_id');
?>
<div class="container-fluid py-5" style="margin-top: 100px;">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="d-lg-block d-none bg-light p-3 rounded">
                    <h5 class="mb-3">Cài đặt</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="edit_profile.php" class="btn btn-link text-start"><i class="bi bi-person"></i> Cập nhật thông tin</a>
                        </li>
                        <li class="list-group-item">
                        <a href="edit_profile.php" class="btn btn-link text-start"><i class="bi bi-person"></i> Trung tâm hỗ trợ</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main content -->
            <div class="col-lg-9">
                <h3>Thông tin người dùng</h3>
                <div class="table-responsive">
                    <table class="table">
                        <?php
                        $get_thongtin = $login->layTTnguoidung($id);  // Lấy thông tin người dùng từ DB
                        if ($get_thongtin) {
                            while ($resurt = $get_thongtin->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><b>Tên:</b></td>
                                    <td><?php echo $resurt['cusName']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Địa chỉ:</b></td>
                                    <td><?php echo $resurt['cusDiaChi']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>SĐT:</b></td>
                                    <td><?php echo $resurt['cusSDT']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Tỉnh:</b></td>
                                    <td><?php echo $resurt['tenTinh']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Huyện:</b></td>
                                    <td><?php echo $resurt['TenHuyen'] ?></td>
                                    
                                </tr>
                                <tr>
                                    <td><b>Email:</b></td>
                                    <td><?php echo $resurt['cusEmail']; ?></td>
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
<?php
include './incc/chantrang.php';
?>

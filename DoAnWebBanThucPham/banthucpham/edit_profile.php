<?php
include './incc/hearder.php';
?>
<?php
$id = Session::get('curtomer_id');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $capnhattt = $login->capnhattt($_POST, $id);
}
?>
<?php
$login_check = Session::get('curtomer_login');
if ($login_check == false) {
    //khi người dùng chưa đăng nhập mà biết đường dẫn thì dăn ra trang login
    header('Location:login.php');
}
?>
<div class="container-fluid py-5" style="margin-top: 100px;">
    <div class="container py-5">
        <h3 class="mb-4">Cập nhật thông tin</h3>
        <?php if (isset($capnhattt)) echo $capnhattt; ?>
        
        <form action="" method="post" class="bg-light p-4 rounded">
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <?php
                    $id = Session::get('curtomer_id');
                    $get_thongtin = $login->layTTnguoidung($id);
                    if ($get_thongtin) {
                        while ($resurt = $get_thongtin->fetch_assoc()) {
                    ?>
                        <tr>
                            <td class="w-25"><label for="name" class="form-label">Tên</label></td>
                            <td>:</td>
                            <td><input type="text" id="name" name="name" class="form-control" value="<?php echo $resurt['cusName']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="diachi" class="form-label">Địa chỉ</label></td>
                            <td>:</td>
                            <td><input type="text" id="diachi" name="diachi" class="form-control" value="<?php echo $resurt['cusDiaChi']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="sdt" class="form-label">SĐT</label></td>
                            <td>:</td>
                            <td><input type="text" id="sdt" name="sdt" class="form-control" value="<?php echo $resurt['cusSDT']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="tinh" class="form-label">Tỉnh</label></td>
                            <td>:</td>
                            <td>
                                <select id="tinh" name="tinh" class="form-select">
                                    <?php
                                    $hienthitinh = $login->hienthiTinh();
                                    if ($hienthitinh) {
                                        while ($result = $hienthitinh->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $result['tinhID']; ?>" <?php if ($result['tinhID'] == $resurt['tinhID']) echo 'selected'; ?>>
                                            <?php echo $result['tenTinh']; ?>
                                        </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="huyen" class="form-label">Huyện</label></td>
                            <td>:</td>
                            <td>
                                <select id="huyen" name="huyen" class="form-select">
                                    <option value="">Chọn huyện</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="email" class="form-label">Email</label></td>
                            <td>:</td>
                            <td><input type="email" id="email" name="email" class="form-control" value="<?php echo $resurt['cusEmail']; ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <button type="submit" name="submit" class="btn btn-secondary py-2 px-4 text-uppercase">Lưu</button>
                            </td>
                        </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#tinh').change(function () {
            var tinhID = $(this).val();
            $.get('./get_huyenTheotinh.php', { tinh: tinhID }, function (data) {
                $('#huyen').html(data);
            });
        });
    });
</script>

<?php
include './incc/chantrang.php';
?>
<?php
include './incc/hearder.php';
include './class/thucpham.php';
session_start(); // Bắt đầu phiên làm việc

// Xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $captcha_input_login = $_POST['captcha_login'];
    if (!isset($_SESSION['captcha_code_login']) || $captcha_input_login !== $_SESSION['captcha_code_login']) {
        $dn = "Mã CAPTCHA không chính xác!";
    } else {
        $dn = $login->dangnhap($_POST);
        if ($dn === "Đăng nhập thành công") {
            unset($_SESSION['captcha_code_login']); // Xóa CAPTCHA sau khi xác minh
            header("Location: index.php");
            exit;
        }
    }
}

// Kiểm tra trạng thái đăng nhập
$login_check = Session::get('curtomer_login');
if ($login_check) {
    echo '<script>window.location.href = "index.php";</script>';
}

// Xử lý đăng ký
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $captcha_input_register = $_POST['captcha_register'];
    if (!isset($_SESSION['captcha_code_register']) || $captcha_input_register !== $_SESSION['captcha_code_register']) {
        $themTV = "Mã CAPTCHA không chính xác!";
    } else {
        $themTV = $login->themTV($_POST);
        unset($_SESSION['captcha_code_register']); // Xóa CAPTCHA sau khi xác minh
    }
}
?>
<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-5" style="margin-top: 50px;">
            <!-- Form Đăng nhập -->
            <form action="" method="post" class="col-md-12 col-lg-6 col-xl-4">
                <div class="col-md-12 col-lg-12 col-xl-12" style="border: 1px solid #81c408; padding:10px ;border-radius: 20px;margin-right: 20px;">
                    <h4 class="mb-4">Đăng nhập</h4>
                    <?php
                    if (isset($dn)) {
                        echo $dn;
                    }
                    ?>
                    <p>Đăng nhập bằng mẫu dưới đây</p>
                    <div class="form-item">
                        <label class="form-label my-3">Số điện thoại<sup>*</sup></label>
                        <input type="sdt" name="sdt" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Mật khẩu<sup>*</sup></label>
                        <input type="password" name="pass" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Nhập mã CAPTCHA<sup>*</sup></label>
                        <img src="captcha_login.php?rand=<?php echo rand(); ?>" alt="CAPTCHA">
                        <input type="text" name="captcha_login" class="form-control mt-3" required>
                    </div>
                    <p>Nếu bạn quên mật khẩu, hãy nhấn vào <a href="">Lấy lại mật khẩu</a></p>
                    <button class="btn bg-secondary rounded-pill px-4 py-3 text-white text-uppercase mb-4 ms-4" type="submit" name="login">Đăng nhập</button>
                </div>
            </form>
            <!-- Form Đăng ký -->
            <form action="" method="post" class="col-md-12 col-lg-6 col-xl-7">
                <div class="col-md-12 col-lg-12 col-xl-12" style="border: 1px solid #81c408; padding:10px;border-radius: 20px;">
                    <h4 class="mb-4">Đăng kí tài khoản mới</h4>
                    <?php
                    if (isset($themTV)) {
                        echo $themTV;
                    }
                    ?>
                    <div class="form-item">
                        <label class="form-label my-3">Họ và tên <sup>*</sup></label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Chọn Tỉnh<sup>*</sup></label>
                                <select name="tinh" id="tinh" class="form-control">
                                    <option value="">--Chọn tỉnh</option>
                                    <?php
                                    $hienthitinh = $login->hienthiTinh();
                                    if ($hienthitinh) {
                                        while ($result = $hienthitinh->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $result['tinhID'] ?>"><?php echo $result['tenTinh'] ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Chọn huyện<sup>*</sup></label>
                                <select name="huyen" id="huyen" class="form-control">
                                    <option value="">--Chọn Huyện</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Địa chỉ<sup>*</sup></label>
                        <input type="text" class="form-control" name="diachi">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Email<sup>*</sup></label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Số điện thoại<sup>*</sup></label>
                        <input type="tel" class="form-control" name="sdt">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Mật khẩu<sup>*</sup></label>
                        <input type="password" class="form-control" name="pass">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Nhập mã CAPTCHA<sup>*</sup></label>
                        <img src="captcha_register.php?rand=<?php echo rand(); ?>" alt="CAPTCHA">
                        <input type="text" name="captcha_register" class="form-control mt-3" required>
                    </div>
                    <p>Bằng cách nhấn vào "Tạo tài khoản", bạn đồng ý với <a href="">Điều khoản & Điều kiện</a> của
                        chúng tôi</p>
                    <button class="btn bg-secondary rounded-pill px-4 py-3 text-white text-uppercase mb-4 ms-4" type="submit" name="submit">Tạo tài khoản</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- AJAX chọn tỉnh/huyện -->
<script>
    $(document).ready(function() {
        $('#tinh').change(function() {
            var x = $(this).val();
            $.get("./get_huyenTheotinh.php", { tinh: x }, function(data) {
                $("#huyen").html(data);
            });
        });
    });
</script>
<?php
include('./incc/chantrang.php');
?>

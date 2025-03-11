<?php

use Random\Engine\Secure;

include './lib/session.php';
Session::init();
?>
<?php
include './lib/database.php';
include './helpers/format.php';
?>
<?php
spl_autoload_register(function ($className) {
    include_once "class/" . $className . ".php";
});
$sl = new sileder;
$gh = new giohang_class;
$login = new login_class;
$contact = new contactxuly;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Thực Phẩm</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Phông chữ web của Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" href="img/logothucpham.jpg" type="image/jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-xrE9WOq6p8Ht2J6F/FI6k+SHDtRJ/1KCk1VUT0k6R1sY8L76OarNeGf+4w6p2gFmaLUDs7kQOglrYDUZmb9pPA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!--  hiển thị nội dung tương tác css đẹp mắt -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fontawesome.com/">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/km.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid fixed-top" style="box-shadow: 1px 0px 10px 2px #90db6b; top: 0;">
        <div class="container px-0 ">
            <form action="timkiem.php" method="post">
                <div class="timkiem" style="justify-content: center;display: flex; margin-top: 10px;">
                    <input type="text" id="" class="thanhtimkiem" placeholder="Tìm kiếm" name="tukhoa" style="border: none;border: 2px solid #81c408; width: 60%;border-radius: 30px; padding: 10px; padding-left: 20px;">
                    <!-- <input type="submit" value="tìm kiếm" name="search_product" > -->
                    <button name="search_product" class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4 ms-2"><i class="fas fa-search text-primary"></i></button>
                </div>
            </form>
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-primary display-6"><a href="index.php">Thực Phẩm</a></h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="index.php" class="nav-item nav-link active">Trang chủ</a>
                        <a href="shop.php" class="nav-item nav-link">Cửa hàng</a>
                        <a href="contact.php" class="nav-item nav-link">
                            Liên hệ</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Khác</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="giohang.php" class="dropdown-item">Giỏ hàng</a>
                                
                                <?php
                                //khi người dùng đăng nhập sẽ xuất hiện thêm 1 thông tin còn khi đx sẽ mất
                                $login_checkkk = Session::get('curtomer_login');
                                if ($login_checkkk == false) {
                                    echo '';
                                } else {
                                    echo '<a href="thongtinkhachhang.php" class="dropdown-item">Thông tin</a>';
                                }
                                ?>
                                <?php
                                //khi người dùng có mua hàng sẽ xuất hiện thêm 1 thông tin đơn hàng
                                $cus_id = Session::get('curtomer_id');
                                $Ktrdonhang = $gh->ktrdonhang($cus_id);
                                if ($Ktrdonhang == false) {
                                    echo '';
                                } else {
                                    echo '<a href="success.php" class="dropdown-item">Đơn hàng</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <a href="giohang.php" class="position-relative me-4 my-auto">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 28px; height: 20px; min-width: 20px;">
                                <?php
                                $dem = $gh->demslsptronggh();
                                if ($dem) {
                                    $demsl = $dem->fetch_assoc();
                                    echo $demsl['dem'];
                                }
                                ?>
                            </span>
                            <span>Giỏ hàng</span>
                        </a>
                        <?php
                        //khi người dùng đã đăng nhập và muốn đăng xuất thù baansm đăng xuất
                        //sẽ đăng xuất 
                        if (isset($_GET['curtomer_id'])) {
                            //xoa giỏ hàng khi đăng xuất
                            // $dellgh=$ct->dell_all();
                            Session::destroy();
                        }
                        ?>
                        <?php
                        $login_checkk = Session::get('curtomer_login');
                        $id_nguoidung = Session::get('curtomer_id');
                        if ($login_checkk == false) {
                            echo '<a href="login.php" class="my-auto"><i class="fas fa-user fa-2x"></i><span>Đăng nhập</span></a>';
                        } else {
                            echo '<a href="?curtomer_id='.$id_nguoidung.'" class="my-auto"><i class="fas fa-user fa-2x"></i>Đăng xuất</a>';
                            // echo 'href="?curtomer_id='.$id_nguoidung.' class="my-auto"><i class="fas fa-user fa-2x"></i><span>Đăng Xuất</span></a>';
                        }
                        ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>


    <!-- Menu End -->
</body>
</html>
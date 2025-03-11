<?php
include './incc/hearder.php';
// include './incc/sileder.php';
?>
<?php
$login = Session::get('curtomer_login');
if ($login == false) {
    header('Location:login.php');
}
?>
<div class="container-fluid py-5">
    <div class="container py-5">
            <div class="row g-5" style="margin-top: 100px;">
            <div class="methor">
                    <style>
                        .methor{
                            width: 500px;
                            margin: 0 auto;
                        }
                        .methor h3{
                            color: red;
                            font-size: 18px;
                            font-weight: bold;
                            text-align: center;
                        }
                        .methor a{
                            display: block;
                            text-align: center;
                            margin-top: 10px;
                            font-size: 16px;
                            color: white;
                            padding: 12px;
                        }
                        </style>
                    <h3>Chọn phương thức thanh toán</h3>
                    <a class="bg-primary" href="hinhthucthanhtoan.php">Khi nhận hàng</a>
                    <a class="bg-primary" href="thanhtoandonhangonline.php">Trực tuyến</a>
                    <a class="bg-primary" href="cart.php"><<< Quay lại</a>
                </div>
            </div>

    </div>
</div>
<!-- Checkout Page End -->


<?php
include('./incc/chantrang.php');
?>
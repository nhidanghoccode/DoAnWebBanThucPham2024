<?php
    include './incc/hearder.php';
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $name = $_POST['ten'];
        $email = $_POST['email'];
        $ghichu= $_POST['ghichu'];

        $contactProcessor= new contactxuly();
        $result = $contactProcessor->themlienhe($name, $email, $ghichu);

        if ($result) {
            echo "<script>alert('Cảm ơn bạn đã liên hệ với chúng tôi, tôi sẽ hồi đáp lại bạn sớm nhất có thể');</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra, vui lòng nhập lại');</script>";
        }
    }
?>
        <!-- Contact Start -->
        <div class="container-fluid contact py-5" style="margin-top: 50px;">
            <div class="container py-5">
                <div class="p-5 bg-light rounded">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary">Thông tin địa chỉ liên lạc của Shop</h1>
                                <p class="mb-4">Quý khách hàng có bất kì thất mắc gì, hay cần giúp đỡ thì hãy liên hệ với chúng tôi tại gmail phía dưới.</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="h-100 rounded">
                                <iframe class="rounded w-100" 
                                style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.9499757185713!2d106.32918327479969!3d10.425544489702716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310abb77abfeb299%3A0x3047216743107681!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBUaeG7gW4gR2lhbmcgY8ahIHPhu58gMg!5e0!3m2!1svi!2s!4v1706182599319!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-7">
                        <form action="" method="POST" onsubmit="return validateForm()" class="needs-validation">
                            <input type="text" class="w-100 form-control border-0 py-3 mb-4" name="ten" placeholder="Nhập tên bạn">
                            <input type="email" class="w-100 form-control border-0 py-3 mb-4" name="email" placeholder="Email">
                            <textarea class="w-100 form-control border-0 mb-4" name="ghichu" rows="5" cols="10" placeholder="Ghi chú"></textarea>
                            <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary " type="submit" name="lienhe" style="height: 50px;">Gửi</button>
                        </form>

                        </div>
                        <div class="col-lg-5">
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Địa chỉ</h4>
                                    <p class="mb-2">Phường 5, TP.Mỹ Tho Tiền Giang</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Email</h4>
                                    <p>Nếu bạn có bất kỳ câu hỏi hoặc phản hồi nào, vui lòng gửi email đến <a href="mailto:admin@example.com" class="contact-link">cuahangthucpham@gmail.com</a>.</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded bg-white">
                                <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>SĐT</h4>
                                    <p>Nếu bạn có bất kỳ câu hỏi hoặc phản hồi nào, vui lòng gọi đến <a href="tel:+123456789" class="phone-link">+123456789</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->

<script>
function validateForm() {
    var ten = document.getElementById("ten").value;
    var email = document.getElementById("email").value;
    var ghichu = document.getElementById("ghichu").value;
    if (ten == "" || email == "" || ghichu == "") {
        alert("Vui lòng điền đầy đủ thông tin");
        return false;
    }
}
</script>
        <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
<?php
    include './incc/chantrang.php';
?>
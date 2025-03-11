<?php
include './incc/hearder.php';
include_once($filepath . '/../lib/database.php');
$db = new Database();

// Kiểm tra xem người dùng đã đăng nhập chưa
$login_check = Session::get('curtomer_login');
if ($login_check == false) {
    header('Location: login.php');
    exit();
}

// Lấy mã đơn hàng từ URL
$madonhang = $_GET['madonhang'] ?? null;

// Kiểm tra nếu không có mã đơn hàng
if (!$madonhang) {
    echo "<span style='color:red'>Không tìm thấy mã đơn hàng!</span>";
    exit();
}

// Kiểm tra trạng thái đơn hàng
$query_order = "SELECT TrangThai, customer_id FROM da_donhangdadat WHERE madonhang = '$madonhang'";
$order_result = $db->select($query_order);

if ($order_result) {
    $order_data = $order_result->fetch_assoc();
    if ($order_data['TrangThai'] != 2) {
        // Nếu đơn hàng chưa được nhận, chuyển hướng
        header('Location: index.php');
        exit();
    }
} else {
    echo "<span style='color:red'>Đơn hàng không tồn tại!</span>";
    exit();
}

// Xử lý khi người dùng gửi đánh giá
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = $_POST['rating'] ?? null;
    $review = $_POST['review'] ?? null;
    $product_id = $_POST['product_id'] ?? null;

    if (!$rating) {
        echo "<span style='color:red'>Vui lòng chọn số sao đánh giá!</span>";
    } elseif (!$review) {
        echo "<span style='color:red'>Vui lòng nhập nhận xét!</span>";
    } else {
        // Kiểm tra xem đã đánh giá sản phẩm này chưa
        $query_check_review = "SELECT * FROM da_danhgia WHERE madonhang = '$madonhang' AND customer_id = '{$order_data['customer_id']}' AND product_id = '$product_id'";
        $check_review_result = $db->select($query_check_review);

        if ($check_review_result) {
            echo "<span style='color:red'>Bạn đã đánh giá sản phẩm này trước đó!</span>";
        } else {
            // Thêm đánh giá vào bảng da_danhgia
            $query_insert_review = "INSERT INTO da_danhgia (madonhang, rating, review, customer_id, product_id, ngaydanhgia) 
                                    VALUES ('$madonhang', '$rating', '$review', '{$order_data['customer_id']}', '$product_id', NOW())";
            $result_insert_review = $db->insert($query_insert_review);

            if ($result_insert_review) {
                // Cộng 200 xu cho người dùng
                $query_add_points = "UPDATE da_loginuser SET points = points + 200 WHERE cusID = '{$order_data['customer_id']}'";
                $add_points_result = $db->update($query_add_points);

                if ($add_points_result) {
                    echo "<span style='color:green'>Đánh giá thành công và bạn đã nhận 200 xu!</span>";
                } else {
                    echo "<span style='color:red'>Đánh giá thành công nhưng không cộng được xu!</span>";
                }
            } else {
                echo "<span style='color:red'>Đánh giá không thành công!</span>";
            }
        }
    }
}


// Lấy danh sách sản phẩm trong đơn hàng
$query_products = "
    SELECT d.ChiTietID, d.ChiTietName 
    FROM da_dathang dh 
    JOIN da_chitiettp d ON dh.ChiTietID = d.ChiTietID 
    WHERE dh.madonhang = '$madonhang'
";
$product_result = $db->select($query_products);

if (!$product_result) {
    echo "<span style='color:red'>Không tìm thấy sản phẩm nào trong đơn hàng này!</span>";
    exit();
}
?>
<?php
// Thêm truy vấn để lấy thông tin đánh giá (nếu có)
$query_products = "
    SELECT d.ChiTietID, d.ChiTietName, dg.rating AS user_rating, dg.review AS user_review
    FROM da_dathang dh 
    JOIN da_chitiettp d ON dh.ChiTietID = d.ChiTietID 
    LEFT JOIN da_danhgia dg ON dh.ChiTietID = dg.product_id 
        AND dg.madonhang = '$madonhang' 
        AND dg.customer_id = '{$order_data['customer_id']}'
    WHERE dh.madonhang = '$madonhang'
";
$product_result = $db->select($query_products);

if (!$product_result) {
    echo "<span style='color:red'>Không tìm thấy sản phẩm nào trong đơn hàng này!</span>";
    exit();
}
?>
<!-- Trang Đánh Giá Sản Phẩm -->
<!-- Trang Đánh Giá Sản Phẩm -->
<div class="container-fluid py-5 bg-light">
    <div class="container py-5">
        <div class="row g-5 justify-content-center">
            <h3 class="mb-5 text-center text-primary">Đánh Giá Sản Phẩm Đơn Hàng #<?php echo htmlspecialchars($madonhang); ?></h3>

            <?php while ($product = $product_result->fetch_assoc()) { ?>
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title text-center text-success"><?php echo htmlspecialchars($product['ChiTietName']); ?></h5>
                            <hr>

                            <?php if ($product['user_rating'] && $product['user_review']) { ?>
                                <!-- Hiển thị đánh giá đã tồn tại -->
                                <div class="text-center">
                                    <p><strong>Đánh giá của bạn:</strong></p>
                                    <div class="rating d-flex justify-content-center">
                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                            <span style="font-size: 40px; color: <?php echo $i <= $product['user_rating'] ? 'gold' : '#ccc'; ?>;">&#9733;</span>
                                        <?php } ?>
                                    </div>
                                    <p class="mt-3"><strong>Nhận xét:</strong> <?php echo htmlspecialchars($product['user_review']); ?></p>
                                </div>
                            <?php } else { ?>
                                <!-- Hiển thị form đánh giá -->
                                <form action="" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product['ChiTietID']; ?>">
                                    <div class="form-group mb-4 text-center">
                                        <label class="form-label">Đánh giá của bạn (sao):</label>
                                        <div class="rating d-flex justify-content-center">
                                            <input type="radio" id="star5_<?php echo $product['ChiTietID']; ?>" name="rating" value="5" required>
                                            <label for="star5_<?php echo $product['ChiTietID']; ?>">&#9733;</label>
                                            <input type="radio" id="star4_<?php echo $product['ChiTietID']; ?>" name="rating" value="4">
                                            <label for="star4_<?php echo $product['ChiTietID']; ?>">&#9733;</label>
                                            <input type="radio" id="star3_<?php echo $product['ChiTietID']; ?>" name="rating" value="3">
                                            <label for="star3_<?php echo $product['ChiTietID']; ?>">&#9733;</label>
                                            <input type="radio" id="star2_<?php echo $product['ChiTietID']; ?>" name="rating" value="2">
                                            <label for="star2_<?php echo $product['ChiTietID']; ?>">&#9733;</label>
                                            <input type="radio" id="star1_<?php echo $product['ChiTietID']; ?>" name="rating" value="1">
                                            <label for="star1_<?php echo $product['ChiTietID']; ?>">&#9733;</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="review" class="form-label">Nhận xét của bạn:</label>
                                        <textarea id="review" name="review" class="form-control shadow-sm" rows="4" placeholder="Viết nhận xét của bạn tại đây..." required></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary px-4">Gửi Đánh Giá</button>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Phần CSS cải tiến -->
<style>
/* Định dạng chung */
body {
    background-color: #f8f9fa;
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

/* Rating styles */
.rating {
    direction: rtl;
    display: inline-flex;
    gap: 5px;
}

.rating input {
    display: none;
}

.rating label {
    font-size: 40px;
    color: #ccc;
    cursor: pointer;
    transition: color 0.3s ease-in-out;
}

.rating input:checked ~ label {
    color: gold;
}

.rating label:hover,
.rating label:hover ~ label {
    color: #ffcc00;
}

/* Hiệu ứng nút */
.btn-primary {
    background-color: #007bff;
    border: none;
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 30px;
    transition: background-color 0.3s ease-in-out;
}

.btn-primary:hover {
    background-color: #0056b3;
}
</style>


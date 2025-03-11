<?php
    include './class/khuyenmai.php';
    $KM = new khuyenmai();
    $khuyenmai = $KM->getKhuyenMai(); 

    // Kiểm tra xem có khuyến mãi không
    if ($khuyenmai) {
?>
    <div id="promoBanner" class="promo-banner">
        <div class="promo-banner-content">
            <h2><?php echo $khuyenmai['ten_khuyenmai']; ?></h2>
            <p><?php echo $khuyenmai['mo_ta']; ?></p>
            <p><strong>Giảm giá:</strong> <?php echo $khuyenmai['gia_tri_khuyenmai']; ?><?php echo $khuyenmai['kieu_khuyenmai']; ?>
            <strong>Thời gian:</strong> <?php echo $khuyenmai['ngay_bat_dau']; ?> đến <?php echo $khuyenmai['ngay_ket_thuc']; ?></p>
            <!-- <a href="khuyenmai.php?id=<?php echo $khuyenmai['id_KM']; ?>" class="btn">Xem chi tiết</a> -->
        </div>
        <button class="close-btn" onclick="closeBanner()">X</button>
    </div>
<?php
    } else {
        echo "<p>Hiện tại không có khuyến mãi nào.</p>";
    }
?>

<style>
  .promo-banner {
    position: fixed;
    top: 150px; 
    left: 0;
    width: 100%; 
    height: 100px;
    background: linear-gradient(to right, #C5F9CA, #FFCC83); 
    color: #223A60; 
    text-align: center;
    padding: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4); 
    z-index: 9999; 
    display: flex;
    justify-content: center; 
    align-items: center;
    border-radius: 10px;
    animation: slideIn 0.5s ease-in-out; 
}

.promo-banner .promo-banner-content {
    max-width: 80%;
    font-family: 'Arial', sans-serif;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6); /* Hiệu ứng bóng cho chữ */
}

.promo-banner h2 {
    font-size: 15px; /* Điều chỉnh kích thước font */
    font-weight: bold;
    margin-bottom: 5px;
    text-transform: uppercase;
}

.promo-banner p {
    font-size: 12px; /* Điều chỉnh kích thước font */
    margin-bottom: 5px;
}

.promo-banner .btn {
    background-color: #FF7F50; /* Màu cam sáng */
    color: #F2EA79;
    padding: 6px 12px; /* Điều chỉnh padding */
    text-decoration: none;
    font-size: 12px; /* Điều chỉnh kích thước font */
    border-radius: 30px;
    transition: background-color 0.3s;
}

.promo-banner .btn:hover {
    background-color: #FF4500; /* Màu cam đỏ khi hover */
}

.promo-banner .close-btn {
    position: absolute;
    top: 10px;       /* Khoảng cách từ trên xuống */
    right: 10px;     /* Đẩy nút sang bên phải */
    background-color: #FF4C4C;
    color: white;
    border: none;
    padding: 6px 12px;
    font-size: 12px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.promo-banner .close-btn:hover {
    background-color: #FF2A2A; /* Đỏ tươi khi hover */
}

/* Animation for the banner */
@keyframes slideIn {
    from {
        top: -100px;
        opacity: 0;
    }
    to {
        top: 150px;
        opacity: 1;
    }
}

</style>
<script>
    function closeBanner() {
    var banner = document.getElementById('promoBanner');
    banner.style.display = 'none'; 
}
</script>
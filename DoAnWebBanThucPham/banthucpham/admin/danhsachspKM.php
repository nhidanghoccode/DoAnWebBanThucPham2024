<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../class/khuyenmai.php';

    $KM = new khuyenmai();
    $dskm = $KM->hienthidanhsachspKM();
    if (isset($_GET['xoaid']) && $_GET['xoaid'] != NULL) {
        $id = $_GET['xoaid']; // Lấy id từ URL
    
        // Gọi phương thức xóa trong class khuyenmai
        $ketquaXoa = $KM->xoaspKM($id);
    
        if ($ketquaXoa) {
            echo "<script>alert('Xóa thành công!');</script>";
            echo "<script>window.location = 'danhsachspKM.php';</script>";
        } else {
            echo "<script>alert('Không thể xóa. Vui lòng kiểm tra lại!');</script>";
        }
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm khuyến mãi</h2>
        <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên khuyến mãi</th>
                    <th>Mô tả</th>
                    <th>Kiểu áp dụng</th>
                    <th>Sản phẩm/Danh mục áp dụng</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
            <?php
    if ($dskm) {
        $stt = 1; 
        while ($result = $dskm->fetch_assoc()) {
           
            $kieuApDung = isset($result['KieuApDung']) ? $result['KieuApDung'] : ''; 
            $sanPhamDanhMuc = '';

            if ($kieuApDung == 'tat_ca') {
                $kieuApDung = 'Tất cả sản phẩm';
                $sanPhamDanhMuc = '-'; 
            } elseif ($kieuApDung == 'danh_muc') {
                $kieuApDung = 'Theo danh mục';
                $sanPhamDanhMuc = $result['PhanLoaiTPName'];  
            } elseif ($kieuApDung == 'san_pham_cu_the') {
                $kieuApDung = 'Theo sản phẩm cụ thể';
                $sanPhamDanhMuc = $result['ChiTietName'];  
            } else {
                $kieuApDung = 'Không xác định';
            }
?>
            <tr class="odd gradeX">
                <td><?php echo $stt++; ?></td>
                <td><?php echo $result['ten_khuyenmai']; ?></td>
                <td><?php echo $result['mo_ta']; ?></td>
                <td><?php echo $kieuApDung; ?></td>
                <td><?php echo $sanPhamDanhMuc; ?></td>
                <td><?php echo $result['ngay_bat_dau']; ?></td>
                <td><?php echo $result['ngay_ket_thuc']; ?></td>
                <td>
                    <a href="suaspKM.php?id=<?php echo $result['id']; ?>">Sửa</a> | 
                    <a onclick="return confirm('Bạn có muốn xóa không?')" 
                            href="?xoaid=<?php echo $result['id']; ?>" 
                            title="Xóa">Xóa<i class="fa-solid fa-trash"></i></a></td>
            </tr>
<?php
        }
    }
?>

            </tbody>
        </table>
    </div>
</div>

<?php include 'inc/footer.php'; ?>

<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../class/khuyenmai.php'; ?>

<?php
    $KM = new khuyenmai();
    $hienthikhuyenmai = $KM->hienthidanhsachKM();
    if (isset($_GET['xoaid']) && $_GET['xoaid'] != NULL) {
        $id = $_GET['xoaid']; // Lấy id từ URL
    
        // Gọi phương thức xóa trong class khuyenmai
        $ketquaXoa = $KM->xoaKM($id);
    
        if ($ketquaXoa) {
            echo "<script>alert('Xóa thành công!');</script>";
            echo "<script>window.location = 'danhsachKM.php';</script>";
        } else {
            echo "<script>alert('Không thể xóa. Vui lòng kiểm tra lại!');</script>";
        }
    }
    
    // Lấy danh sách khuyến mãi
    $hienthikhuyenmai = $KM->hienthidanhsachKM();
    ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách khuyến mãi</h2>
        <div class="block"> 
        <form action="" method="post">       
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên khuyến mãi</th>
                        <th>Mô Tả</th>
                        <th>Giá trị khuyến mãi</th>
                        <th>Kiểu khuyến mãi</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($hienthikhuyenmai) {
                        $i = 0;
                        while ($result = $hienthikhuyenmai->fetch_assoc()) {
                            $i++;
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo ($result['ten_khuyenmai']); ?></td>
                        <td><?php echo ($result['mo_ta']); ?></td>
                        <td><?php echo ($result['gia_tri_khuyenmai']); ?></td>
                        <td><?php echo ($result['kieu_khuyenmai']); ?></td>
                        <td><?php echo ($result['ngay_bat_dau']); ?></td>
                        <td><?php echo ($result['ngay_ket_thuc']); ?></td>
                        <td>
                            <a href="suaKM.php?id=<?php echo $result['id_KM']; ?>">Sửa</a> | 
                            <a onclick="return confirm('Bạn có muốn xóa không?')" 
                            href="?xoaid=<?php echo $result['id_KM']; ?>" 
                            title="Xóa">Xóa<i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>Không có khuyến mãi nào!</td></tr>";
                    }
                ?>
                </tbody>
            </table>
       </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
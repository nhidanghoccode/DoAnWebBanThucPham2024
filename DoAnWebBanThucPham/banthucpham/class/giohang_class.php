<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
?>
<?php
class giohang_class
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format();
    }
    public function themgiohang($sl,$quantity_stock, $id)
    {
        $quatity = $this->fm->validation($sl);
            $quatity = mysqli_real_escape_string($this->db->link, $sl);
            $quantity_stock = $this->fm->validation($quantity_stock);
            $quantity_stock = mysqli_real_escape_string($this->db->link, $quantity_stock);
            $id = mysqli_real_escape_string($this->db->link, $id);
        $seID = session_id();

        $query = "SELECT * from da_chitiettp where ChiTietID='$id'";
        $result = $this->db->select($query)->fetch_assoc();
        $img = $result['ChiTietImg'];
        $productName = $result['ChiTietName'];
        $gia = $result['ChiTietGia'];
        // kiểm tra xem sản phẩm đó có trong giỏ hàng hay chưa
        $check_cartt = "SELECT * from da_giohang where ChiTietID='$id' and sed='$seID'";
        $check_cart =  $this->db->select($check_cartt);
        if($quatity <= $quantity_stock){
            if ($check_cart) {
                $mg = "<span>Sản phẩm này đã có trong giỏ hàng</span>";
                return $mg;
            } else {
                $query_insert = "INSERT INTO da_giohang(gia,img,ChiTietID,ChiTietName,sed,soluong,stock) 
                    VALUE ('$gia',' $img', '$id','$productName', '$seID', '$quatity','$quantity_stock')";
                $inser_cart = $this->db->insert($query_insert);
                if ($inser_cart) {
                    header("Location: giohang.php");
                } else {
                    header('Location:404.php');
                }
            }
        }else{
            $mg = "<span>SL đặt vượt quá số lượng tồn kho</span>";
            return $mg;
        }
       
    }
    public function chek_cart(){
        $seID = session_id();
        
        $query = "SELECT *from da_giohang where sed='$seID'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_themgiahang()
    {
        $seID = session_id();
        
        $query = "SELECT 
    gh.*, 
    sp.ChiTietGia, 
    sp.ChiTietName, 
    sp.ChiTietImg, 
    sp.PhanLoaiTPID,
    COALESCE(
        km.gia_tri_khuyenmai, 
        km_dm.gia_tri_khuyenmai, 
        0
    ) AS gia_tri_khuyenmai, -- Lấy giá trị khuyến mãi từ sản phẩm hoặc danh mục
    CASE 
        WHEN km.gia_tri_khuyenmai IS NOT NULL THEN sp.ChiTietGia * (1 - km.gia_tri_khuyenmai / 100) -- Giá sau khuyến mãi sản phẩm
        WHEN km_dm.gia_tri_khuyenmai IS NOT NULL THEN sp.ChiTietGia * (1 - km_dm.gia_tri_khuyenmai / 100) -- Giá sau khuyến mãi danh mục
        ELSE sp.ChiTietGia -- Giá gốc nếu không có khuyến mãi
    END AS GiaSauKhuyenMai
FROM 
    da_giohang gh
JOIN 
    da_chitiettp sp ON gh.ChiTietID = sp.ChiTietID
LEFT JOIN 
    chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID -- Khuyến mãi sản phẩm
LEFT JOIN 
    khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
LEFT JOIN 
    chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID -- Khuyến mãi danh mục
LEFT JOIN 
    khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
WHERE 
    gh.sed = '$seID'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_themgiahang_check()
    {
        $seID = session_id();
        $query = "SELECT 
    gh.*, 
    sp.ChiTietGia, 
    sp.ChiTietName, 
    sp.ChiTietImg, 
    sp.PhanLoaiTPID,
    COALESCE(
        km.gia_tri_khuyenmai, 
        km_dm.gia_tri_khuyenmai, 
        0
    ) AS gia_tri_khuyenmai, -- Lấy giá trị khuyến mãi từ sản phẩm hoặc danh mục
    CASE 
        WHEN km.gia_tri_khuyenmai IS NOT NULL THEN sp.ChiTietGia * (1 - km.gia_tri_khuyenmai / 100) -- Giá sau khuyến mãi sản phẩm
        WHEN km_dm.gia_tri_khuyenmai IS NOT NULL THEN sp.ChiTietGia * (1 - km_dm.gia_tri_khuyenmai / 100) -- Giá sau khuyến mãi danh mục
        ELSE sp.ChiTietGia -- Giá gốc nếu không có khuyến mãi
    END AS GiaSauKhuyenMai
FROM 
    da_giohang gh
JOIN 
    da_chitiettp sp ON gh.ChiTietID = sp.ChiTietID
LEFT JOIN 
    chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID -- Khuyến mãi sản phẩm
LEFT JOIN 
    khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
LEFT JOIN 
    chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID -- Khuyến mãi danh mục
LEFT JOIN 
    khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
WHERE 
    gh.sed = '$seID' 
    AND gh.TrangThai = '1'";
        $result = $this->db->select($query);
        return $result;
    }
    public function xoagihang($cartid){
        $query = "DELETE from  da_giohang where ghID='$cartid'";
        $result =$this ->db ->delete($query);
        return $result;
    }
    public function dell_all(){
        $seID = session_id();
        $query = "DELETE FROM da_giohang ";
        $result =$this ->db ->delete($query);
        return $result;
    }
    public function capnhatSLgiohang($stock,$sl,$cartid){
        // $sl = mysqli_real_escape_string($this->db->link, $sl);
        // $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $quatity = mysqli_real_escape_string($this->db->link, $sl);
        $stock = mysqli_real_escape_string($this->db->link, $stock);
       
        if($stock >= $quatity){//nếu sl kho > sl cập nhật
            $query =" UPDATE da_giohang SET soluong='$sl' where ghID='$cartid' ";
            $resultt=$this->db->update($query);
            if($resultt){
                $mg= "<span>cập nhật số lượng thành công</span>";
                return $mg;
            }else{
                $mg = "<span>cập nhật số lượng không thành công</span>";
                return $mg;
            }
        }else{
            $mg= "<span>SL hàng trong kho không đủ</span>";
                return $mg;
        }
      
    }
    public function demslsptronggh(){
        $query ="SELECT COUNT(*) as dem FROM da_giohang";
        $resultt=$this->db->select($query);
        return $resultt;
    }
    public function themdon_hangg($cus_idd, $finalAmount) {
        $seID = session_id();
        $query = "SELECT * FROM da_giohang WHERE TrangThai = '1'";
        $hienthi_result = $this->db->select($query);
    
        if (!$hienthi_result) {
            die("Lỗi khi lấy giỏ hàng: " . $this->db->error);
        }
    
        // Tạo mã đơn hàng ngẫu nhiên
        $madonhang = rand(1000, 9999);
    
        // Thêm vào bảng đơn hàng đã đặt
        $query_donhangdadat = "INSERT INTO da_donhangdadat (customer_id, madonhang, TrangThai, tongtien) 
                               VALUES ('$cus_idd', '$madonhang', '0', '$finalAmount')";
        $them_result = $this->db->insert($query_donhangdadat);
    
        if (!$them_result) {
            die("Lỗi khi thêm đơn hàng: " . $this->db->error);
        }
    
        while ($result = $hienthi_result->fetch_assoc()) {
            $ChiTietID = $result['ChiTietID'];
            $ChiTietName = $result['ChiTietName'];
            $sll = $result['soluong'];
            $gia = $result['gia'];
            $ordergia = $result['gia'] * $sll;
            $img = $result['img'];
    
            $query_insert = "INSERT INTO da_dathang (ChiTietID, madonhang, ChiTietName, cusID, soluong, gia, orderGia, orderImg) 
                             VALUES ('$ChiTietID', '$madonhang', '$ChiTietName', '$cus_idd', '$sll', '$gia' ,'$ordergia', '$img')";
            $inser_cart = $this->db->insert($query_insert);
    
            if (!$inser_cart) {
                die("Lỗi khi thêm chi tiết đơn hàng: " . $this->db->error);
            }
        }
    
        return "<span style='margin:0;color:green;font-size:24px'>Đặt hàng thành công</span>";
    }
    public function ktrdonhang($cus_id){
        $seID = session_id();
        //cái đó kiểu như là mỗi 1 đơn hàng đều có 1 mã riêng
        $query = "SELECT *from da_dathang where cusID='$cus_id'";
        $result = $this->db->select($query);
        return $result;
    }
    //XỬ LÝ ĐƠN hàng 
    // public function get_trangthaidonhang($cus_id){
    //     //cái đó kiểu như là mỗi 1 đơn hàng đều có 1 mã riêng
    //      $query = "SELECT *from da_dathang where cusID='$cus_id'";
    //     $result = $this->db->select($query);
    //     return $result;
    // }
    public function get_trangthaidonhang($cus_id){
        //cái đó kiểu như là mỗi 1 đơn hàng đều có 1 mã riêng
         $query = "SELECT *from da_donhangdadat,da_loginuser where da_donhangdadat.customer_id=da_loginuser.cusID and cusID='$cus_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function xoamotdonhan($productId){
        $query = "DELETE FROM da_donhangdadat where madonhang='$productId'";
        $result =$this ->db ->delete($query);
        header('Location:success.php');
        return $result;
    }
    public function danhanhang($id){
        $id = mysqli_real_escape_string($this->db->link, $id);

        // Lấy thông tin đơn hàng
        $query_order = "SELECT customer_id, TrangThai FROM da_donhangdadat WHERE madonhang = '$id' AND TrangThai = '1'";
        $order_result = $this->db->select($query_order);
    
        if ($order_result) {
            $order_data = $order_result->fetch_assoc();
            $customer_id = $order_data['customer_id'];
    
            // Cập nhật trạng thái đơn hàng thành 'Đã nhận' (TrangThai = '2')
            $query_update_status = "UPDATE da_donhangdadat SET TrangThai = '2' WHERE madonhang = '$id'";
            $update_status_result = $this->db->update($query_update_status);
    
            if ($update_status_result) {
                // Tạo cơ hội cho người dùng đánh giá sản phẩm
                return "<span style='color:green'>Đơn hàng đã được xác nhận đã nhận. Bạn có thể đánh giá sản phẩm ngay bây giờ để nhận 200 xu!</span>";
            } else {
                return "<span style='color:red'>Cập nhật trạng thái đơn hàng thất bại!</span>";
            }
        } else {
            return "<span style='color:red'>Không tìm thấy đơn hàng hoặc trạng thái không hợp lệ!</span>";
        }
    }
    public function getUserPoints($cus_id) {
        $query_points = "SELECT points FROM da_loginuser WHERE cusID = '$cus_id'";
        $result_points = $this->db->select($query_points);
        
        if ($result_points) {
            $row_points = $result_points->fetch_assoc();
            return $row_points['points'];
        }
        return 0; // Mặc định là 0 nếu không có dữ liệu
    }
    
    //XƯ LÝ BÊN TRANG ADMIN phần Đơn hàng
    public function shifted($id){
        //$time = mysqli_real_escape_string($this->db->link, $time);
        $id = mysqli_real_escape_string($this->db->link, $id);
        //$gia= mysqli_real_escape_string($this->db->link,$gia);
        $query ="UPDATE da_donhangdadat SET TrangThai='1' where madonhang='$id' ";
        $result=$this->db->update($query);
        if($result){
            $mg= "<span style='color:green'>cập nhật thành công</span>";
            return $mg;
        }else{
            $mg = "<span>cập nhật số lượng không thành công</span>";
            return $mg;
        }
    }
    public function xoamotinbox($id){
        $query = "DELETE FROM da_donhangdadat where madonhang='$id' ";
        $result =$this ->db ->delete($query);
        // header('Location:inbox.php');
        return $result;
    }
    public function get_inbox_cart(){
        $query = "SELECT *FROM da_donhangdadat,da_loginuser where da_donhangdadat.customer_id=da_loginuser.cusID order by ngaydat";
        $result = $this->db->select($query);
        return $result;
    }
    public function laydulieura($layid){
        $query = "SELECT o.*,p.productSL
        from da_dathang o
        join da_chitiettp p on o.chitietID=p.chitietID where o.chitietID='$layid' AND o.TrangThai=1
        ORDER BY o.ngaymua ";
        $result = $this->db->select($query);
        return $result;
    }
    public function capnhatTrangThaiVaSL($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
    
        // Truy vấn tất cả sản phẩm trong đơn hàng từ bảng da_dathang
        $query = "SELECT ChiTietID, soluong FROM da_dathang WHERE madonhang = '$id'";
        $result = $this->db->select($query);
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $ChiTietID = $row['ChiTietID'];
                $soluong = $row['soluong'];
    
                // Truy vấn số lượng tồn kho từ bảng da_chitiettp
                $query_stock = "SELECT productSL FROM da_chitiettp WHERE ChiTietID = '$ChiTietID'";
                $stock_result = $this->db->select($query_stock);
    
                if ($stock_result) {
                    $stock_row = $stock_result->fetch_assoc();
                    $productSL = $stock_row['productSL'];
    
                    // Trừ số lượng đặt hàng từ số lượng tồn kho
                    $new_stock = $productSL - $soluong;
    
                    // Cập nhật tồn kho trong bảng da_chitiettp
                    $query_update_stock = "UPDATE da_chitiettp SET productSL = '$new_stock' WHERE ChiTietID = '$ChiTietID'";
                    $this->db->update($query_update_stock);
                }
            }
    
            // Sau khi xử lý tồn kho, cập nhật trạng thái đơn hàng trong bảng da_donhangdadat
            $query_update_status = "UPDATE da_donhangdadat SET TrangThai = '1' WHERE madonhang = '$id'";
            $update_status_result = $this->db->update($query_update_status);
    
            if ($update_status_result) {
                return "<span style='color:green'>Cập nhật tồn kho và trạng thái đơn hàng thành công.</span>";
            } else {
                return "<span style='color:red'>Cập nhật trạng thái đơn hàng thất bại.</span>";
            }
        } else {
            return "<span style='color:red'>Không tìm thấy sản phẩm trong đơn hàng.</span>";
        }
    }
    
    public function capnhatXuVaTongTien($customer_id, $tongTien) {
        // Lấy số xu hiện tại của khách hàng
        $query = "SELECT points FROM da_loginuser WHERE cusID = '$customer_id'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            $current_points = $row['points'];
    
            // Tính tổng tiền sau khi trừ xu
            $discount_amount = min($tongTien, $current_points);
            $new_total = $tongTien - $discount_amount;
    
            // Cập nhật số xu còn lại (0 nếu đã dùng hết)
            $remaining_points = max(0, $current_points - $discount_amount);
            $query = "UPDATE da_loginuser SET points = '$remaining_points' WHERE cusID = '$customer_id'";
            $this->db->update($query);
    
            return $new_total;
        }
        return $tongTien; // Nếu không có kết quả thì trả về tổng tiền ban đầu
    }
    
    public function ktdanhgia($madonhang, $customer_id)
    {
        // Truy vấn kiểm tra xem có đánh giá cho đơn hàng này từ khách hàng này hay không
        $query = "SELECT * FROM da_danhgia WHERE madonhang = '$madonhang' AND customer_id = '$customer_id'";
        $result = $this->db->select($query);

        // Nếu có đánh giá, trả về true
        if ($result && $result->num_rows > 0) {
            return true;
        } else {
            // Nếu không có đánh giá, trả về false
            return false;
        }
    }

    public function layDanhGiaTheoSanPham($product_id) {
        $query = "SELECT * FROM danhgia WHERE product_id = '$product_id' ORDER BY ngaydanhgia DESC";
        $result = $this->db->select($query);
        return $result;
    }    

    public function getOrderById($orderId) {
        // Truy vấn lấy thông tin đơn hàng từ cơ sở dữ liệu
        $query = "SELECT * FROM da_donhangdadat WHERE madonhang = '$orderId' LIMIT 1";
        $result = $this->db->select($query);
        return $result ? $result->fetch_assoc() : null; // Nếu tìm thấy đơn hàng, trả về thông tin
    }

    public function getProductsByOrderId($madonhang) {
        $query = "SELECT * FROM da_dathang WHERE madonhang = '$madonhang'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getFinalAmountByOrderId($madonhang) {
        $query = "SELECT tongtien FROM da_donhangdadat WHERE madonhang = '$madonhang'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['tongtien']; // Trả về số tiền sau khi trừ xu
        } else {
            error_log("Lỗi truy vấn SQL trong getFinalAmountByOrderId: " . $this->db->error);
            return false; // Trả về false nếu truy vấn không thành công
        }
    }
   
}
?>
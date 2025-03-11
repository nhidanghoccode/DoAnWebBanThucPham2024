<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
?>

<?php
class thucpham{
    private $db;
    private $fm ;
    public function __construct(){
        $this -> db = new Database;
        $this ->fm=new Format();
    }
    public function hienthi(){
        $query = "SELECT 
            sp.ChiTietID, 
            sp.ChiTietName, 
            sp.ChiTietGia, 
            sp.ChiTietImg, 
            sp.mota, 
            sp.donvitinh,
            -- Hiển thị giá khuyến mãi chỉ khi còn hiệu lực và trạng thái là 'hoat_dong'
            CASE 
                WHEN (km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE()) THEN km.gia_tri_khuyenmai
                WHEN (km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE()) THEN km_dm.gia_tri_khuyenmai
                ELSE NULL
            END AS GiaKhuyenMai, 
            COALESCE(km.ngay_ket_thuc, km_dm.ngay_ket_thuc) AS NgayKetThuc,
            CASE 
                WHEN km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE() THEN 'san_pham_cu_the'
                WHEN km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE() THEN 'danh_muc'
                ELSE 'khong_khuyen_mai'
            END AS LoaiKhuyenMai
        FROM 
            da_chitiettp sp
        LEFT JOIN 
            chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID
        LEFT JOIN 
            khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
        LEFT JOIN 
            chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID
        LEFT JOIN 
            khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
        ORDER BY sp.ChiTietName ASC";
        
        $result = $this->db->select($query);
        return $result;
    }
    
    public function hienthiloaiDMcha_ajax($cargoryID){
        $query = "SELECT *from da_dmcon where PhanLoaiTPID='$cargoryID'";
        $result =$this ->db ->select($query);
        return $result;
    }
    public function Ajax_PLTP($selectedValue){
        $query = "SELECT *from da_chitiettp where PhanLoaiTPID='$selectedValue'";
        $result =$this ->db ->select($query);
        return $result;
    }
    public function hienthiDMcha(){
        $query = " SELECT * from da_phanloaitp order by PhanLoaiTPID desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function hienthiDMcon(){
        $query = " SELECT * from da_dmcon order by DMID desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function themthucpham($data, $files)
    {
        $ChiTietName = mysqli_real_escape_string($this->db->link, $data['ChiTietName']);
        $danhmuccha = mysqli_real_escape_string($this->db->link, $data['danhmuccha']);
        $danhmuccon = mysqli_real_escape_string($this->db->link, $data['danhmuccon']);
        $mota = mysqli_real_escape_string($this->db->link, $data['mota']);
        $ChiTietGia = mysqli_real_escape_string($this->db->link, $data['ChiTietGia']);
        $productSL = mysqli_real_escape_string($this->db->link, $data['productSL']);
        $donvitinh = mysqli_real_escape_string($this->db->link, $data['donvitinh']);
        //kiểm tra hình ảnh và lấy hình ảnh cho vào file uploads
        // $productImg =mysqli_real_escape_string( $this->db->link,$data['productImg']);
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $files_name = $_FILES['ChiTietImg']['name'];
        $files_size = $_FILES['ChiTietImg']['size'];
        $files_temp = $_FILES['ChiTietImg']['tmp_name'];
        $div = explode('.', $files_name);
        $file_ext = strtolower(end($div));
        $unique_imge = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_imge;

        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        //empty: trống
        if ($productSL == "" ||$ChiTietName == "" || $danhmuccha == "" ||  $mota == "" || $ChiTietGia == "" || $type == "" || $files_name == "" || $donvitinh =="") {
            $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống trường nào</span>";
            return $alert;
        }
        else {
            move_uploaded_file($files_temp, $uploaded_image);
            $query = "INSERT INTO da_chitiettp (ChiTietName,ChiTietGia,donvitinh,PhanLoaiTPID,DMID,mota,ChiTietImg,typee,productSL)
VALUE ('$ChiTietName','$ChiTietGia',$donvitinh,'$danhmuccha','$danhmuccon ',' $mota','$unique_imge','$type','$productSL')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span style='font-size: 20px;color: green;' class='success'>Thêm thành công</span>";
            return $alert;
            }
        }
    }
    public function suaSP($data, $file, $id)
    {
        $ChiTietName = mysqli_real_escape_string($this->db->link, $data['ChiTietName']);
        $danhmuccha = mysqli_real_escape_string($this->db->link, $data['danhmuccha']);
        $danhmuccon = mysqli_real_escape_string($this->db->link, $data['danhmuccon']);
        $mota = mysqli_real_escape_string($this->db->link, $data['mota']);
        $ChiTietGia = mysqli_real_escape_string($this->db->link, $data['ChiTietGia']);
        $productSL = mysqli_real_escape_string($this->db->link, $data['productSL']);
        $donvitinh = mysqli_real_escape_string($this->db->link, $data['donvitinh']);
        //kiểm tra hình ảnh và lấy hình ảnh cho vào file uploads
        // $productImg =mysqli_real_escape_string( $this->db->link,$data['productImg']);
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $files_name = $_FILES['ChiTietImg']['name'];
        $files_size = $_FILES['ChiTietImg']['size'];
        $files_temp = $_FILES['ChiTietImg']['tmp_name'];
        $div = explode('.', $files_name);
        $file_ext = strtolower(end($div));
        $unique_imge = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_imge;

        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        if ($donvitinh == "" || $ChiTietName == "" || $danhmuccha == "" ||  $mota == "" || $ChiTietGia == "" || $type == "" ) {
            $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống trường nào</span>";
            return $alert;
        }else {
            if (!empty($files_name)) {
                // nếu người dùng chọn ảnh
                if ($files_size < 20480) {
                    $alert = "<span style='font-size: 18px;color: red;' class='success'>kích cỡ nên nhỏ hơn 10MB</span>";
                    return $alert;
                } else if (in_array($file_ext, $permited) === false) {
                    $alert = "<span>you can upload only: -" . implode('.' . $permited) . "</span>";
                    return $alert;
                }
                move_uploaded_file($files_temp, $uploaded_image);
                $query = " UPDATE da_chitiettp set ChiTietName ='$ChiTietName',ChiTietGia ='$ChiTietGia',donvitinh='$donvitinh',PhanLoaiTPID =' $danhmuccha',DMID=' $danhmuccon',mota ='$mota',ChiTietImg ='$unique_imge',typee ='$type',productSL='$productSL' WHERE ChiTietID='$id' ";
            } else {

                // nếu người dùng không chọn ảnh
$query = " UPDATE da_chitiettp set ChiTietName ='$ChiTietName',ChiTietGia ='$ChiTietGia',donvitinh='$donvitinh',PhanLoaiTPID =' $danhmuccha',DMID=' $danhmuccon',mota ='$mota',typee ='$type',productSL='$productSL' WHERE ChiTietID='$id'";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span style='font-size: 18px;color: green;' class='success'>Cập nhật thành công</span>";
                // header('Location:catlist.php');
                return $alert;
                // header('Location:catlist.php',true);
            } else {
                $alert = "<span style='font-size: 18px;color: red;' class='error'> đã sảy ra lỗi cập nhật không thành công</span>";
                return $alert;
            }
        }
    }
    public function Laysanpham($id)
    {
        $query = " SELECT* from da_chitiettp where ChiTietID='$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function hienthiThucpham(){
        $query="SELECT ct.*, pl.PhanLoaiTPName, dm.DMName 
        FROM da_chitiettp as ct
        INNER JOIN da_phanloaitp as pl ON ct.PhanLoaiTPID = pl.PhanLoaiTPID
        INNER JOIN da_dmcon as dm ON ct.DMID = dm.DMID
        ORDER BY ct.ChiTietID DESC";
        $result =$this ->db ->select($query);
        return $result;
    }
    public function hienthitatcaThucpham(){
        $query = "SELECT 
            sp.ChiTietID, 
            sp.ChiTietName, 
            sp.ChiTietGia, 
            sp.ChiTietImg, 
            -- Lấy giá trị khuyến mãi khi khuyến mãi còn hiệu lực
            CASE 
                WHEN (km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE()) THEN km.gia_tri_khuyenmai
                WHEN (km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE()) THEN km_dm.gia_tri_khuyenmai
                ELSE NULL
            END AS GiaKhuyenMai, 
            COALESCE(km.ngay_ket_thuc, km_dm.ngay_ket_thuc) AS NgayKetThuc,
            CASE 
                WHEN km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE() THEN 'san_pham_cu_the'
                WHEN km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE() THEN 'danh_muc'
                ELSE 'khong_khuyen_mai'
            END AS LoaiKhuyenMai
        FROM 
            da_chitiettp sp
        LEFT JOIN 
            chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID
        LEFT JOIN 
            khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
        LEFT JOIN 
            chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID
        LEFT JOIN 
            khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
        ORDER BY sp.ChiTietName ASC";
    
        $result = $this->db->select($query);
        return $result;
    }
    
    public function hienthiDMrau(){
        $query = "SELECT 
            sp.ChiTietID, 
            sp.ChiTietName, 
            sp.ChiTietGia, 
            sp.ChiTietImg, 
            sp.donvitinh,
            -- Hiển thị giá khuyến mãi chỉ khi còn hiệu lực và trạng thái là 'hoat_dong'
            CASE 
                WHEN (km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE()) THEN km.gia_tri_khuyenmai
                WHEN (km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE()) THEN km_dm.gia_tri_khuyenmai
                ELSE NULL
            END AS GiaKhuyenMai, 
            COALESCE(km.ngay_ket_thuc, km_dm.ngay_ket_thuc) AS NgayKetThuc,
            CASE 
                WHEN km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE() THEN 'san_pham_cu_the'
                WHEN km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE() THEN 'danh_muc'
                ELSE 'khong_khuyen_mai'
            END AS LoaiKhuyenMai
        FROM 
            da_chitiettp sp
        LEFT JOIN 
            chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID
        LEFT JOIN 
            khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
        LEFT JOIN 
            chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID
        LEFT JOIN 
            khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
        WHERE 
            sp.PhanLoaiTPID = '15' 
        ORDER BY 
            sp.ChiTietID DESC;";
        
        $result = $this->db->select($query);
        return $result;
    }
    
    public function hienthiDMthit(){
        $query = "SELECT 
            sp.ChiTietID, 
            sp.ChiTietName, 
            sp.ChiTietGia, 
            sp.ChiTietImg, 
            sp.donvitinh,
            -- Hiển thị giá khuyến mãi chỉ khi còn hiệu lực và trạng thái là 'hoat_dong'
            CASE 
                WHEN (km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE()) THEN km.gia_tri_khuyenmai
                WHEN (km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE()) THEN km_dm.gia_tri_khuyenmai
                ELSE NULL
            END AS GiaKhuyenMai, 
            COALESCE(km.ngay_ket_thuc, km_dm.ngay_ket_thuc) AS NgayKetThuc,
            CASE 
                WHEN km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE() THEN 'san_pham_cu_the'
                WHEN km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE() THEN 'danh_muc'
                ELSE 'khong_khuyen_mai'
            END AS LoaiKhuyenMai
        FROM 
            da_chitiettp sp
        LEFT JOIN 
            chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID
        LEFT JOIN 
            khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
        LEFT JOIN 
            chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID
        LEFT JOIN 
            khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
        WHERE 
            sp.PhanLoaiTPID = '18' 
        ORDER BY 
            sp.ChiTietID DESC;";
    
        $result = $this->db->select($query);
        return $result;
    }
    
    public function hienthiDMca(){
        $query = "SELECT 
            sp.ChiTietID, 
            sp.ChiTietName, 
            sp.ChiTietGia, 
            sp.ChiTietImg, 
            sp.donvitinh,
            -- Hiển thị giá khuyến mãi chỉ khi còn hiệu lực và trạng thái là 'hoat_dong'
            CASE 
                WHEN (km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE()) THEN km.gia_tri_khuyenmai
                WHEN (km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE()) THEN km_dm.gia_tri_khuyenmai
                ELSE NULL
            END AS GiaKhuyenMai, 
            COALESCE(km.ngay_ket_thuc, km_dm.ngay_ket_thuc) AS NgayKetThuc,
            CASE 
                WHEN km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE() THEN 'san_pham_cu_the'
                WHEN km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE() THEN 'danh_muc'
                ELSE 'khong_khuyen_mai'
            END AS LoaiKhuyenMai
        FROM 
            da_chitiettp sp
        LEFT JOIN 
            chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID
        LEFT JOIN 
            khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
        LEFT JOIN 
            chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID
        LEFT JOIN 
            khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
        WHERE 
            sp.PhanLoaiTPID = '17' 
        ORDER BY 
            sp.ChiTietID DESC;";
    
        $result = $this->db->select($query);
        return $result;
    }
    
    public function hienthiDMtraicay(){
        $query = "SELECT 
            sp.ChiTietID, 
            sp.ChiTietName, 
            sp.ChiTietGia, 
            sp.ChiTietImg, 
            sp.donvitinh,
            -- Hiển thị giá khuyến mãi chỉ khi còn hiệu lực và trạng thái là 'hoat_dong'
            CASE 
                WHEN (km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE()) THEN km.gia_tri_khuyenmai
                WHEN (km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE()) THEN km_dm.gia_tri_khuyenmai
                ELSE NULL
            END AS GiaKhuyenMai, 
            COALESCE(km.ngay_ket_thuc, km_dm.ngay_ket_thuc) AS NgayKetThuc,
            CASE 
                WHEN km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE() THEN 'san_pham_cu_the'
                WHEN km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE() THEN 'danh_muc'
                ELSE 'khong_khuyen_mai'
            END AS LoaiKhuyenMai
        FROM 
            da_chitiettp sp
        LEFT JOIN 
            chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID
        LEFT JOIN 
            khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
        LEFT JOIN 
            chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID
        LEFT JOIN 
            khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
        WHERE 
            sp.PhanLoaiTPID = '7' 
        ORDER BY 
            sp.ChiTietID DESC;";
    
        $result = $this->db->select($query);
        return $result;
    }
    
    public function htTprauhuuco(){
        $query = "SELECT 
            sp.ChiTietID, 
            sp.ChiTietName, 
            sp.ChiTietGia, 
            sp.ChiTietImg, 
            sp.donvitinh,
            -- Hiển thị giá khuyến mãi chỉ khi còn hiệu lực và trạng thái là 'hoat_dong'
            CASE 
                WHEN (km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE()) THEN km.gia_tri_khuyenmai
                WHEN (km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE()) THEN km_dm.gia_tri_khuyenmai
                ELSE NULL
            END AS GiaKhuyenMai, 
            COALESCE(km.ngay_ket_thuc, km_dm.ngay_ket_thuc) AS NgayKetThuc,
            CASE 
                WHEN km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE() THEN 'san_pham_cu_the'
                WHEN km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE() THEN 'danh_muc'
                ELSE 'khong_khuyen_mai'
            END AS LoaiKhuyenMai
        FROM 
            da_chitiettp sp
        LEFT JOIN 
            chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID
        LEFT JOIN 
            khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
        LEFT JOIN 
            chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID
        LEFT JOIN 
            khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
        WHERE 
            sp.PhanLoaiTPID = '15' -- Lọc theo danh mục rau
        ORDER BY 
            sp.ChiTietID DESC;";
    
        $result = $this->db->select($query);
        return $result;
    }
    
    public function httpbanchay(){
        $query = "SELECT 
            sp.ChiTietID, 
            sp.ChiTietName, 
            sp.ChiTietGia, 
            sp.ChiTietImg, 
            sp.donvitinh,
            -- Hiển thị giá khuyến mãi chỉ khi còn hiệu lực và trạng thái là 'hoat_dong'
            CASE 
                WHEN (km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE()) THEN km.gia_tri_khuyenmai
                WHEN (km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE()) THEN km_dm.gia_tri_khuyenmai
                ELSE NULL
            END AS GiaKhuyenMai, 
            COALESCE(km.ngay_ket_thuc, km_dm.ngay_ket_thuc) AS NgayKetThuc
        FROM 
            da_chitiettp sp
        LEFT JOIN 
            chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID
        LEFT JOIN 
            khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
        LEFT JOIN 
            chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID
        LEFT JOIN 
            khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
        WHERE 
            sp.typee = '1' -- Điều kiện lọc sản phẩm bán chạy
        ORDER BY 
            sp.ChiTietID DESC
        LIMIT 4;"; 
    
        $result = $this->db->select($query);
        return $result;
    }
    public function httpmoinhat(){
        $query = "SELECT 
            sp.ChiTietID, 
            sp.ChiTietName, 
            sp.ChiTietGia, 
            sp.ChiTietImg, 
            sp.donvitinh,
            -- Hiển thị giá khuyến mãi chỉ khi còn hiệu lực và trạng thái là 'hoat_dong'
            CASE 
                WHEN (km.gia_tri_khuyenmai IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE()) THEN km.gia_tri_khuyenmai
                WHEN (km_dm.gia_tri_khuyenmai IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE()) THEN km_dm.gia_tri_khuyenmai
                ELSE NULL
            END AS GiaKhuyenMai, 
            COALESCE(km.ngay_ket_thuc, km_dm.ngay_ket_thuc) AS NgayKetThuc
        FROM 
            da_chitiettp sp
        LEFT JOIN 
            chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID
        LEFT JOIN 
            khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
        LEFT JOIN 
            chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID
        LEFT JOIN 
            khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
        ORDER BY 
            sp.ChiTietID DESC
        LIMIT 6;"; 
    
        $result = $this->db->select($query);
        return $result;
    }
    public function chitiet1thucpham($id) {
        $query = "SELECT 
                sp.ChiTietID, 
                sp.ChiTietName, 
                sp.ChiTietGia, 
                sp.ChiTietImg, 
                sp.donvitinh, 
                sp.mota, 
                sp.productSL,
                pltp.PhanLoaiTPName,
                COALESCE(km.gia_tri_khuyenmai, km_dm.gia_tri_khuyenmai) AS gia_tri_khuyenmai,
                COALESCE(km.ten_khuyenmai, km_dm.ten_khuyenmai) AS ten_khuyenmai,
                CASE 
                    -- Áp dụng giá trị khuyến mãi nếu có và còn hiệu lực
                    WHEN (ctkm.KhuyenMaiID IS NOT NULL AND km.trang_thai = 'hoat_dong' AND km.ngay_ket_thuc >= CURDATE()) THEN sp.ChiTietGia * (1 - km.gia_tri_khuyenmai / 100)
                    WHEN (ctkm_dm.KhuyenMaiID IS NOT NULL AND km_dm.trang_thai = 'hoat_dong' AND km_dm.ngay_ket_thuc >= CURDATE()) THEN sp.ChiTietGia * (1 - km_dm.gia_tri_khuyenmai / 100) 
                    ELSE sp.ChiTietGia
                END AS GiaSauKhuyenMai
            FROM 
                da_chitiettp sp
            LEFT JOIN 
                da_phanloaitp pltp ON sp.PhanLoaiTPID = pltp.PhanLoaiTPID
            LEFT JOIN 
                chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID 
            LEFT JOIN 
                khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
            LEFT JOIN 
                chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID 
            LEFT JOIN 
                khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
            WHERE 
                sp.ChiTietID = '$id'";
    
        $result = $this->db->select($query);
    
        return $result;
    }    
            
    public function ctspnoibat(){
        $query="SELECT *FROM da_chitiettp where typee='1' order by ChiTietID desc limit 6";
        $result =$this ->db ->select($query);
        return $result;
    }
    public function ctsptuongtu($id){
        $query="SELECT * FROM da_chitiettp WHERE PhanLoaiTPID = (SELECT PhanLoaiTPID FROM da_chitiettp WHERE ChiTietID = '$id')";
        $result =$this ->db ->select($query);
        return $result;
    }

    public function xoaSP($delectID)
    {
        $query = "DELETE from  da_chitiettp where ChiTietID='$delectID'";
        $result = $this->db->delete($query);
        header('Location:productlist.php');
        return $result;
    }

    public function search($tukhoa)
    {
        $tukhoa=$this ->fm->validation($tukhoa);
        $query ="SELECT *from da_chitiettp where ChiTietName LIKE '%$tukhoa%'";
        $result =$this->db->select($query);
        return $result;
    }

    public function layDanhGia($product_id) {
        $query = "SELECT dg.*, lu.cusName 
        FROM da_danhgia AS dg
        JOIN da_loginuser AS lu ON dg.customer_id = lu.cusID
        WHERE dg.product_id = $product_id
        ORDER BY dg.ngaydanhgia DESC";
        $result = $this->db->select($query); 
        return $result;
    }
    public function layThongTinDanhGia($id) {
        if (!$id) {
            return null;
        }
    
        $query = "
            SELECT COUNT(*) AS tongDanhGia, 
                   AVG(rating) AS diemTrungBinh 
            FROM da_danhgia 
            WHERE product_id = $id
        ";
    
        return $this->db->select($query)->fetch_assoc();
    }
    
    
}
?>
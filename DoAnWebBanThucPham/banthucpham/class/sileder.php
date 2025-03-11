<?php
    $filepath =realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
class sileder{
    private $db;
    private $fm ;
    public function __construct(){
        $this -> db = new Database;
        $this ->fm=new Format();
    }
    public function themSile($files) {
        //kiểm tra hình ảnh và lấy hình ảnh cho vào file uploads
        // $productImg =mysqli_real_escape_string( $this->db->link,$data['productImg']);
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $files_name = $_FILES['sileImg']['name'];
        $files_size = $_FILES['sileImg']['size'];
        $files_temp = $_FILES['sileImg']['tmp_name'];
        $div = explode('.', $files_name);
        $file_ext = strtolower(end($div));
        $unique_imge = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_imge;

        if ($files_name == "") {
            $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống trường nào</span>";
            return $alert;
        } else {
            move_uploaded_file($files_temp, $uploaded_image);
            $query = "INSERT INTO da_themsile (sileImg) 
                                        VALUE ('$unique_imge')";
            $result = $this->db->insert($query);
            return $result;
        }
    }
    public function hienthiSileder(){
        $query = " SELECT * from da_themsile ";
        $result = $this->db->select($query);
        return $result;
    }
    public function xoaSileder($id){
        $query = " DELETE from da_themsile where sileID='$id' ";
        $result = $this->db->delete($query);
        if($result){
            $alert ="<span style='font-size: 18px;color: green;' class='success'>Xóa thành công</span>";
            return $alert;
        }else{
            $alert ="<span style='font-size: 18px;color: green;' class='success'>Xóa không thành công</span>";
            return $alert;
        }
        
    }
}
?>
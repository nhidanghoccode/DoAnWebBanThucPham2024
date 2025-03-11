<?php
     $filepath =realpath(dirname(__FILE__));
    include_once ( $filepath.'/../lib/session.php');
    Session::checkLogin();
    include_once ( $filepath.'/../lib/database.php');
    include_once ( $filepath.'/../helpers/format.php');
?>

<?php
    class adminlogin{
        private $db ;
        private $fm ;
        public function __construct(){
            $this ->db=new Database();
            $this ->fm=new Format();
        }
        public function login_admin($adminUser,$adminPass){
            $adminUser =$this ->fm->validation($adminUser);
            $adminPass =$this ->fm->validation($adminPass);
            $adminUser =mysqli_real_escape_string( $this->db->link,$adminUser);
            $adminPass =mysqli_real_escape_string( $this->db->link,$adminPass);
            //empty: trống
            if(empty($adminUser) ||empty($adminPass)){
                $alert="Người dùng và mật khẩu không được trống";
                return $alert;
            }else{
                $query ="SELECT *FROM da_admin where adminUser = '$adminUser' and adminPass = '$adminPass' LIMIT 1";
                $result =$this->db->select($query);
                if($result != false){
                    $value=$result ->fetch_assoc();
                    //fetch_assoc();lấy kết quả
                    Session::set('login',true);
                    Session::set('adminID',$value['adminID']);
                    Session::set('adminUser',$value['adminUser']);
                    Session::set('adminTen',$value['adminTen']);
                    header('Location:index.php');
                }else{
                    $alert="Mật khẩu hoặc tài khoản không đúng";
                    return $alert;
                }
            }

        }
    }
?>
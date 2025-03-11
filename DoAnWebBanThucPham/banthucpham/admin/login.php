<?php
	include '../class/adminlogin.php';
?>
<?php
$class = new adminlogin;
	if($_SERVER['REQUEST_METHOD'] =='POST'){
		$adminUser =$_POST['adminUser'];
		$adminPass =md5($_POST['adminPass']);
		$login_check = $class ->login_admin($adminUser,$adminPass) ;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/dndk.css">
    <title>Đăng nhập</title>
</head>
<body>
    
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#">
                <h1>Tạo tài khoản</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>hoặc sử dụng email của bạn để đăng ký</span>
                <input type="text" placeholder="Name" />
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />
                <button>Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="login.php" method="post">
                <h1>Đăng Nhập</h1>
                <span style="color:red"><?php
				if(isset($login_check)){
					echo $login_check;
				} 
			?></span>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>hoặc sử dụng tài khoản của bạn</span>
                <input type="text" placeholder="Username" required="" name="adminUser"/>
                <input type="password" placeholder="Password" required="" name="adminPass"/>
                <a href="#">Quên mật khẩu?</a>
                <input class="input" type="submit" value="Đăng nhập" />
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào mừng trở lại!</h1>
                    <p>Để duy trì kết nối với chúng tôi vui lòng đăng nhập bằng thông tin cá nhân của bạn</p>
                    <button class="ghost" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Xin chào!</h1>
                    <p>Nhập thông tin cá nhân của bạn và bắt đầu hành trình với chúng tôi</p>
                    <button class="ghost" id="signUp">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
    </script>
</body>
</html>
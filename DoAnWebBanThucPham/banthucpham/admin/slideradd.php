<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../class/sileder.php';?>
<?php
$sileder = new sileder;
	if($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['submit'])){
		$themsile = $sileder ->themSile($_FILES) ;
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Slider</h2>
    <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Chọn ảnh:</label>
                    </td>
                    <td>
                    <input type="file" id="fileInput" name="sileImg" accept="image/*" placeholder="Chọn 1 ảnh...">
                    </td>
                </tr> 
                <tr>
                    <td colspan="2">
                        <div id="imagePreview"></div>
                    </td>
                </tr>          
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Thêm ảnh" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<script>
    // JavaScript để hiển thị ảnh đã chọn
    document.getElementById('fileInput').addEventListener('change', function (e) {
        var fileInput = e.target;
        var imagePreview = document.getElementById('imagePreview');

        // Kiểm tra xem đã chọn tệp tin nào chưa
        if (fileInput.files.length > 0) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // Hiển thị ảnh đã chọn
                var img = document.createElement('img');
                img.src = e.target.result;
                imagePreview.innerHTML = ''; // Xóa ảnh hiện tại (nếu có)
                imagePreview.appendChild(img);
            };

            // Đọc tệp tin hình ảnh
            reader.readAsDataURL(fileInput.files[0]);
        }
        else {
            // Nếu không chọn tệp tin nào, xóa ảnh hiện tại (nếu có)
            imagePreview.innerHTML = '';
        }
    });
     // JavaScript để xóa ảnh khi click vào nút "Xóa trắng"
     function clearImage() {
        var imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';
    }
</script>
<style>
    #imagePreview{
    width: 400px;
    height: 200px;
    background-color: #f9d2d2;
}
#imagePreview img{
    width: 100%;
    height: 100%;
}
</style>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>
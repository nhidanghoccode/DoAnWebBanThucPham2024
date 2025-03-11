<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
include '../class/danhmuccha.php';
include '../class/danhmuccon.php';
include '../class/thucpham.php';
include_once '../helpers/format.php';
$fm=new Format;
$thucpham = new thucpham();
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách thực phẩm</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên TP</th>
					<th>Giá</th>
					<th>SL</th>
					<th>Image</th>
					<th>Mô tả</th>
					<th>Phân Loại</th>
					<th>Loại TP</th>
					<th>Type</th>
					<th>Trạng thái</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$productShow =$thucpham->hienthiThucpham();
					if($productShow){$i=0;
						while($result =$productShow->fetch_assoc()){$i++
				?>
				<tr class="odd gradeX">
					<td style=""><?php echo $i?></td>
					<td ><?php echo $result['ChiTietName']?></td>
					
					<td class="center"><?php echo $result['ChiTietGia'] ?><?php if($result['donvitinh']==1){
							echo '/bó';
						}else if($result['donvitinh']==2){
							echo '/kí';
						}else{echo '';}?></td>
					<td><?php echo $result['productSL']?></td>
					<td ><img src="upload/<?php echo $result['ChiTietImg']?>" width="60px" ></td>
					<td><?php
						 echo $fm->textShorten($result['mota'],30)?></td>
					<td><?php echo $result['PhanLoaiTPName']?></td>
					<td><?php echo $result['DMName']?></td>
					<td><?php 
						if($result['typee']==1){
							echo 'nổi bật';
						}else{
							echo 'Không nổi bật';
						}
					?></td>
					<td><a href="productEdit.php?productid=<?php echo $result['ChiTietID']?>">Sửa</a> || <a href="productDelete.php?delid=<?php echo $result['ChiTietID']?>">Xóa</a></td>
				</tr>
				<?php
					}

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
<?php include 'inc/footer.php';?>

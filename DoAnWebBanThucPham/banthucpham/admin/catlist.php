<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../class/danhmuccha.php'; ?>
<?php
$danhmuccha = new danhmuccha;
$hienthiDanhMuc = $danhmuccha->hienthiDMcha();
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách phân loại</h2>
		<?php
		?>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên phân loại</th>
						<th>Trạng thái</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($hienthiDanhMuc) {
						$i = 0;
						while ($result = $hienthiDanhMuc->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['PhanLoaiTPName'] ?></td>
								<td><a href="catEdit.php?phanloaitpid=<?php echo $result['PhanLoaiTPID'] ?>">Sửa</a> || <a href="catDelete.php?delid=<?php echo $result['PhanLoaiTPID'] ?>">Xóa</a></td>
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
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>
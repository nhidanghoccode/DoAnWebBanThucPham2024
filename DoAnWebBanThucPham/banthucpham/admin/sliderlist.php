<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../class/sileder.php'; ?>
<?php
$sl=new sileder;
$danhsachSileder = $sl->hienthiSileder();
if (isset($_GET['delid'])) {
    $id=$_GET['delid'];
    $dele=$sl->xoaSileder($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách Sileder</h2>
		<?php
			if(isset($dele)){
				echo $dele;
			}
			?>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Ảnh Sileder</th>
						<th>Trạng thái</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($danhsachSileder) {
						$i = 0;
						while ($result = $danhsachSileder->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i?></td>
								<td><img src="upload/<?php echo $result ['sileImg'] ?>" height="60px" width="100px" /></td>
								<td>
									<a href="?delid=<?php echo $result ['sileID']?>" >XÓA</a>
								</td>
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
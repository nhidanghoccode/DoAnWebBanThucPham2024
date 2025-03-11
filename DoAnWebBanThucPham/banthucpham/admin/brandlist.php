<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../class/danhmuccon.php';?>
<?php
    $danhmuccon = new danhmuccon();
    $hienthidanhmuccon= $danhmuccon->hienthidanhmucon();
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách loại thực phẩm</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên loại thực phẩm</th>
							<th>Tên phân loại</th>
							<th>Trạng thái</th>
						</tr>
					</thead>
					<tbody>
					<?php
                        if($hienthidanhmuccon){$i=0;
                            while($result=$hienthidanhmuccon->fetch_assoc()){$i++;
                    ?>
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $result['DMName']?></td>
							<td><?php echo $result['PhanLoaiTPName']?></td>
							<td><a href="brandEdit.php?brandd_id=<?php echo $result['DMID']?>">Sửa</a> || <a  href="brandDelete.php?brandd_id=<?php echo $result['DMID']?>">Xóa</a></td>
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


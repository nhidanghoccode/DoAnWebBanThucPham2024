<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
include '../class/danhmuccha.php';
include '../class/danhmuccon.php';
include '../class/contactxuly.php';
include_once '../helpers/format.php';
$fm=new Format;
$contactxuly = new contactxuly();
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách khách hàng liên hệ</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead style="text-align: center;">
				<tr>
					<th>STT</th>
					<th>Tên khách hàng</th>
					<th>Email</th>
                    <th style="width:600px;">Nội Dung</th>
                    <th>Ngày tạo</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$laylienhe =$contactxuly->laylienhe();
					if($laylienhe){$i=0;
						while($result =$laylienhe->fetch_assoc()){$i++
				?>
				<tr class="odd gradeX">
					<td style=""><?php echo $i?></td>
					<td ><?php echo $result['ten']?></td>
					<td><?php echo $result['email']?></td>
					<td>
                    <textarea style="width:500px;"><?php
						 echo $result['ghichu']?></textarea>
                        </td>
					<td><?php echo $result['thoigiantao']?></td>
                    <?php
                    // $delectID=$_GET['delid'];
                    // $XOALH = $contactxuly ->xoalienhe($delectID);
                    ?>
					<!-- <td><a href="productDelete.php?delid=<?php echo $result['id']?>">Xóa</a></td> -->
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

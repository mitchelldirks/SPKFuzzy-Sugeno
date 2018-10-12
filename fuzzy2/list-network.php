<?php 
// require('koneksi.php');
$sql="select * from (network a left join area b on (a.area_id=b.area_id)) left join jurusan c on (a.jurusan_id=c.jurusan_id) ";
$sql.="";
$result=mysql_query($sql)or die('Maaf, Query Salah');

function show_fuzzy($show){
	global $result;

	if($result==true){
		while($row=mysql_fetch_array($result)):
			?>
				<tr>
					<td><?php echo $row['net_id'] ?></td>
					<td><?php echo $row['nama_area'] ?></td>
					<td><?php echo $row['jurusan'] ?></td>
					<td><?php echo $row['node_id'] ?></td>
					<td><?php echo $row['bandwidth'] ?></td>
					<td><?php echo $row['jml_pelanggan'] ?></td>
					<td><?php echo $row['pelayanan'] ?></td>
						
					
					
				<?php
					switch ($show) {
						case 'all':
							?>
							<td><div class="btn-group">
								<a href="proses.php?form=network&a=edit&id=<?php echo $row['net_id'] ?>" class="btn btn-xs btn-success">Edit</a>
								<a href="proses.php?form=network&a=delete&id=<?php echo $row['net_id'] ?>" class="btn btn-xs btn-danger">Delete</a>
							</div></td>
							<?php
							# code...
							break;
						case 'no-edit':
							?>
								<td></td>
							<?php
						break;
						
					}
				?>
				</tr>
			<?php
		endwhile;
	}
}


?>


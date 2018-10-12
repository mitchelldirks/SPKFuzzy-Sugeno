<?php 
// require('koneksi.php');
$sql="select a.jurusan_id,a.jurusan,b.fakultas,a.datetime from jurusan a left join fakultas b on a.fakultas_id=b.fakultas_id";
$result=mysql_query($sql)or die('Maaf, Query Jurusan Salah');

function show_rule($show){
	global $result;

	if($result==true){
		while($row=mysql_fetch_array($result)):
			?>
				<tr>
					<td><?php echo $row['jurusan_id'] ?></td>
					<td><?php echo $row['jurusan'] ?></td>
					<td><?php echo $row['fakultas'] ?></td>
					<td><?php echo $row['datetime'] ?></td>
						
					
					
				<?php
					switch ($show) {
						case 'all':
							?>
							<td><div class="btn-group">
								<a href="proses.php?form=jurusan&a=edit&id=<?php echo $row['jurusan_id'] ?>" class="btn btn-xs btn-success">Edit</a>
								<a href="proses.php?form=jurusan&a=delete&id=<?php echo $row['jurusan_id'] ?>" class="btn btn-xs btn-danger">Delete</a>
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


<?php 
// require('koneksi.php');
$sql="select * from fakultas";
$result=mysql_query($sql)or die('Maaf, Query Salah');

function show_fakultas($show){
	global $result;

	if($result==true){
		while($row=mysql_fetch_array($result)):
			?>
				<tr>
					<td><?php echo $row['fakultas_id'] ?></td>
					<td><?php echo $row['fakultas'] ?></td>
					<td><?php echo $row['datetime'] ?></td>
				
					
					
				<?php
					switch ($show) {
						case 'all':
							?>
							<td><div class="btn-group">
								<a href="proses.php?form=fakultas&a=edit&id=<?php echo $row['fakultas_id'] ?>" class="btn btn-xs btn-success">Edit</a>
								<a href="proses.php?form=fakultas&a=delete&id=<?php echo $row['fakultas_id'] ?>" class="btn btn-xs btn-danger">Delete</a>
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


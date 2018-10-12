<?php 

$sql="select a.area_id,a.nama_area,b.fakultas,a.datetime 
from area a left join fakultas b on a.fakultas_id=b.fakultas_id order by area_id";
$result=mysql_query($sql)or die('Maaf, Query Salah');

function show_rule($show){
	global $result;

	if($result==true){
		while($row=mysql_fetch_array($result)):
			?>
				<tr>
					<td><?php echo $row['area_id'] ?></td>
					<td><?php echo $row['nama_area'] ?></td>
					<td><?php echo $row['fakultas'] ?></td>
					<td><?php echo $row['datetime'] ?></td>
					
					
					
				<?php
					switch ($show) {
						case 'all':
							?>
							<td><div class="btn-group">
								<a href="proses.php?form=area&a=edit&id=<?php echo $row['area_id'] ?>" class="btn btn-xs btn-success">Edit</a>
								<a href="proses.php?form=area&a=delete&id=<?php echo $row['area_id'] ?>" class="btn btn-xs btn-danger">Delete</a>
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


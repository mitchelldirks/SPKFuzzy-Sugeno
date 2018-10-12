<?php //require('koneksi.php') ?>
<?php 
$areaid= isset($_GET['id']) ? $_GET['id'] : '';
					if(!empty($areaid) || isset($areaid)){
						$sqlarea="select * from area a left join fakultas b on a.fakultas_id=b.fakultas_id where area_id='$areaid'";
						$areas=mysql_query($sqlarea)or die('Query Area Error:'.mysql_error());
						while($area=mysql_fetch_array($areas)){
							$areaname=$area['nama_area'];
							$fakultasid=$area['fakultas_id'];
							$fakultasname=$area['fakultas'];
						}
					}
 ?>

	<form action="proses.php" method="POST" role="form">
				<legend>Form Area</legend>
				<input type="hidden" name="form" value="area">
				<input type="hidden" name="area_id" value="<?php echo (!empty($areaid)?$areaid:''); ?>">
				<?php 
				// echo isset($areaid)?$areaid:'kosong';

				 ?>
				<div class="form-group">
					<label for="area">Area</label>
					<input name="nama_area" type="text" class="form-control" id="area" required="required" placeholder="Masukkan Area" value="<?php echo (!empty($areaname)?$areaname:''); ?>">
					
				</div>
				<div class="form-group">
					<label for="fakultas_id">Fakultas</label>
					<div class="input-group">
 		<span class="input-group-btn">
        					<a class="btn btn-success " href="fakultas.php"><i class="glyphicon glyphicon-plus"></i></a>

      </span>	
					<select name="fakultas_id" id="fakultas" class="form-control" required="required">
						<option value='0' selected>Pilih Fakultas</option>
						<?php 
						
							$sql="select * from fakultas";
							$hasil=mysql_query($sql) or die("Query Error:".$sql);
							if($hasil==true){
								while($row=mysql_fetch_array($hasil)){
									if(empty($fakultasid)){
										echo "<option value='".$row['fakultas_id']."'>".$row['fakultas']."</option>";
									}else{
										echo "<option value='".$fakultasid."'' selected>$fakultasname</option>";
										$fakultasid='';
									}
								}
							}
						
						 ?>
						
					</select>
				</div>
				</div>
				
				

			
				<button name="<?php echo !empty($areaid)?'save':'submit'; ?>" type="submit" class="btn btn-primary"><?php echo !empty($areaid)?'Simpan':'Tambah Data'; ?></button>
				<a href="area.php" class="btn btn-warning">Batal</a>
			</form>

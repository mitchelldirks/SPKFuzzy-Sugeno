<?php 
$jid= isset($_GET['id']) ? $_GET['id'] : '';
					if(!empty($jid) || isset($jid)){
						$sqljurusan="select * from jurusan where jurusan_id='".$jid."'";
						$jurus=mysql_query($sqljurusan)or die('Query Jurusan Error:'.mysql_error());
						while($jur=mysql_fetch_array($jurus)){
							$jurusan=$jur['jurusan'];
							$fid=$jur['fakultas_id'];
							
						}
					}
 ?>

<form action="proses.php" method="POST" role="form">
				<legend>Form Jurusan</legend>
				<input type="hidden" name="form" value="jurusan">
				<input type="hidden" name="jurusan_id" value="<?php echo (!empty($jid)?$jid:''); ?>">
				
				<div class="form-group">
					<label for="jurusan">Jurusan</label>
					<input name="jurusan" type="text" class="form-control" id="jurusan" placeholder="Masukkan Nama Jurusan" value="<?php echo (!empty($jurusan)?$jurusan:''); ?>">
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
									if(empty($fid)){
										
											echo "<option value='".$row['fakultas_id']."' >".$row['fakultas']."</option>";
										}elseif($fid==$row['fakultas_id']){
											echo "<option value='".$fid."' selected='selected'>".$row['fakultas']."</option>";
										$fid='';
										
									}
								}
							}
						
						 ?>
						
					</select>
				</div>
				</div>
				
			
				<button name="<?php echo !empty($jid)?'save':'submit'; ?>" type="submit" class="btn btn-primary">Submit</button>
				<a href="jurusan.php" class="btn btn-warning">Batal</a>

			</form>
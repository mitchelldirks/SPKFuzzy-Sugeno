<?php //require('koneksi.php') ?>
<?php 
$fakid= isset($_GET['id']) ? $_GET['id'] : '';
					if(!empty($fakid) || isset($fakid)){
						$sqlfak="select * from fakultas where fakultas_id='$fakid'";
						$faks=mysql_query($sqlfak)or die('Query Area Error:'.mysql_error());
						while($fak=mysql_fetch_array($faks)){
							$fakname=$fak['fakultas'];
							$fakultasid=$fak['fakultas_id'];
							$fakultasname=$fak['fakultas'];
						}
					}
 ?>

	<form action="proses.php" method="POST" role="form">
				<legend>Form Fakultas</legend>
				<input type="hidden" name="form" value="fakultas">
				<input type="hidden" name="fakultas_id" value="<?php echo (!empty($fakid)?$fakid:''); ?>">
				<?php 
				// echo isset($fakid)?$fakid:'kosong';

				 ?>
				<div class="form-group">
					<label for="fakultas">Fakultas</label>
					<input name="fakultas" type="text" class="form-control" id="fak" required="required" placeholder="Masukkan Fakultas" value="<?php echo (!empty($fakname)?$fakname:''); ?>">
					
				</div>
				
				
				

			
				<button name="<?php echo !empty($fakid)?'save':'submit'; ?>" type="submit" class="btn btn-primary"><?php echo !empty($fakid)?'Simpan':'Tambah Data'; ?></button>
				<a href="fakultas.php" class="btn btn-warning">Batal</a>
			</form>

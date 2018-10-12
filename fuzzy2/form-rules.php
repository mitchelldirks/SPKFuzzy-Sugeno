<?php 
$ruleid= isset($_GET['id']) ? $_GET['id'] : '';
					if(!empty($ruleid) || isset($ruleid)){
						$sqlrule="select * from rules where rule_id='$ruleid'";
						$rules=mysql_query($sqlrule)or die('Query Rule Error:'.mysql_error());
						while($rule=mysql_fetch_array($rules)){
							$rulename=$rule['rulename'];
							$ruleid=$rule['rule_id'];
							$bandwidth=$rule['trafik_jaringan_b'];
							$jumlah=$rule['j_pelanggan_cmt'];
							$service=$rule['kualitas_ck'];
							$fuzzy=$rule['fuzzy_output'];
						}
					}
 ?>
<form action="proses.php" method="POST" role="form">
				<legend>Form Rules</legend>
				<input type="hidden" name="form" value="rules">
				<input type="hidden" name="rule_id" value="<?php echo (!empty($ruleid)?$ruleid:''); ?>">
				<div class="form-group">
					<label for="rulename">Nama Rule</label>
					<input name="rulename" type="text" class="form-control" id="" placeholder="Masukkan Nama Rule" value="<?php echo (!empty($rulename)?$rulename:''); ?>">
				</div>
				<?php 
					$bw=array('Sedikit','Sedang','Banyak');
					$cmt=$bw;
					$ck=array('Buruk','Cukup','Baik'); 
				?>
				<div class="form-group">
					<label for="bandwidth">Bandwidth</label>
					<select name="bandwidth" id="bandwidth" class="form-control" required="required">
						<option value='0' selected>Pilih Bandwidth</option>
						<?php 
						foreach($bw as $row){
							if(!empty($bandwidth)){
								if($bandwidth==$row){
								echo "<option value='".$row."' selected>".$row."</option>";
									}else{
								echo "<option value='".$row."' >$row</option>";
									$row='';
								}
							}else{
								echo "<option value='".$row."' >$row</option>";
									// $row='';
							}
							
						}
						 ?>
						
					</select>
				</div>
				<div class="form-group">
					<label for="jumlah">Jumlah Pelanggan</label>
					<select name="jumlah" id="jumlah" class="form-control" required="required">
						<option value='0' selected>Pilih Jumlah Pelanggan</option>
						<?php 
						foreach($cmt as $row){
							if(!empty($jumlah)){
								if($jumlah==$row){
								echo "<option value='".$row."' selected>".$row."</option>";
									}else{
								echo "<option value='".$row."' >$row</option>";
									$row='';
								}
							}else{
								echo "<option value='".$row."' >$row</option>";
									// $row='';
							}
							
						}
						 ?>
						
					</select>
				</div>
				<div class="form-group">
					<label for="service">Kualitas Pelayanan</label>
					<select name="service" id="service" class="form-control" required="required">
						<option value='0' selected>Pilih Pelayanan</option>
						<?php 
						foreach($ck as $row){
							if(!empty($service)){
								if($service==$row){
								echo "<option value='".$row."' selected>".$row."</option>";
									}else{
								echo "<option value='".$row."' >$row</option>";
									$row='';
								}
							}else{
								echo "<option value='".$row."' >$row</option>";
									// $row='';
							}
							
						}
						 ?>
						
					</select>
				</div>
			<div class="form-group">
					<label for="fuzzy">Fuzzy Output</label>
					<input name="fuzzy" type="text" class="form-control" id="fuzzy" placeholder="Fuzzy Output" value="<?php echo (!empty($fuzzy)?$fuzzy:''); ?>">
				</div>
				
			
				<button name="<?php echo !empty($ruleid)?'save':'submit'; ?>" type="submit" class="btn btn-primary">Submit</button>
				<a href="rules.php" class="btn btn-warning">Batal</a>
			</form>
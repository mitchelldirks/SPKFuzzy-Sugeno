<?php 
$netid= isset($_GET['id']) ? $_GET['id'] : '';
					if(!empty($netid) || isset($netid)){
						$sqlnet="select * from network where net_id='$netid'";
						$nets=mysql_query($sqlnet)or die('Query net Error:'.mysql_error());
						while($net=mysql_fetch_array($nets)){
							$areaid=$net['area_id'];
							$jid=$net['jurusan_id'];
							$netid=$net['net_id'];
							$bandwidth=$net['bandwidth'];
							$jumlah=$net['jml_pelanggan'];
							$service=$net['pelayanan'];
							$nodeid=$net['node_id'];
						}
					}
 ?>
<form action="proses.php" method="POST" role="form">
				<legend>Form Network</legend>
				<input type="hidden" name="form" value="network">
				<input type="hidden" name="net_id" value="<?php echo (!empty($netid)?$netid:''); ?>">
			
				<?php 
					$bw=array('Sedikit','Sedang','Banyak');
					$cmt=$bw;
					$ck=array(
						'33.3','66.6','100'); 
				?>
				<div class="form-group"><label for="area_id">Area</label>
					<div class="input-group">
 		<span class="input-group-btn">
        					<a class="btn btn-success " href="area.php"><i class="glyphicon glyphicon-plus"></i></a>

      </span>	
					<select name="area_id" id="area_id" class="form-control" required="required">
						<option value='0'>Pilih Area</option>
						<?php 
						
							$sql="select * from area";
							$hasil=mysql_query($sql) or die("Query Error:".$sql);
							if($hasil==true){
								while($row=mysql_fetch_array($hasil)){
									if(empty($areaid)){
										echo "<option value='".$row['area_id']."'>".$row['nama_area']."</option>";
									}elseif(!empty($areaid)){
										if($row['area_id']==$areaid){
									// }elseif($areaid==$row['area_id']){
									// }else{
										echo "<option value='".$areaid."' selected='selected'>".$row['nama_area']."</option>";
										$areaid='';
										}else{
										echo "<option value='".$areaid."'>".$row['nama_area'].$areaid."</option>";
	
										}

									}
								}
							}
						
						 ?>
						
					</select>
					 
</div>
		
					 
				</div>
				
				<div class="form-group">
					<label for="jurusan_id">Jurusan</label>
					<div class="input-group">
 		<span class="input-group-btn">
        					<a class="btn btn-success " href="jurusan.php"><i class="glyphicon glyphicon-plus"></i></a>

      </span>	
					<select name="jurusan_id" id="jurusan" class="form-control" required="required">
						<option value='0' selected>Pilih Jurusan </option>
						<?php 
						
							$sql="select * from jurusan";
							$hasil=mysql_query($sql) or die("Query Error:".$sql);
							if($hasil==true){
								while($row=mysql_fetch_array($hasil)){
									if(empty($jid)){
										echo "<option value='".$row['jurusan_id']."' >".$row['jurusan']."</option>";
									// }elseif($jid==$row['jurusan_id']){
									}elseif(!empty($jid)){
										if($row['jurusan_id']==$jid){
										echo "<option value='".$jid."' selected='selected'>".$row['jurusan']."</option>";
										$jid='';
										}else{
										echo "<option value='".$jid."'>".$row['jurusan']."</option>";

										}
										
									}
								}
							}	
						
						 ?>
						
					</select>
				</div>
				</div>
				<div class="form-group">
					<label for="node_id">Posisi Titik/Node</label>
					<input name="node_id" type="text" class="form-control" id="node_id" placeholder="Masukkan Posisi Titik atau Node" value="<?php echo (!empty($node_id)?$node_id:''); ?>">
				</div>
				<div class="form-group">
					<label for="bandwidth">Trafik Jaringan (B)</label>
					<input name="bandwidth" type="text" class="form-control" id="bandwidth" required placeholder="Masukkan Nilai Bandwidth" value="<?php echo (!empty($bandwidth)?$bandwidth:''); ?>">
				</div>
				<div class="form-group">
					<label for="jumlah">Jumlah Pelanggan (CMT)</label>
					<input name="jumlah" type="text" class="form-control" id="jumlah" required placeholder="Masukkan Jumlah Pelanggan" value="<?php echo (!empty($jumlah)?$jumlah:''); ?>">
				</div>
				<div class="form-group">
					<label for="service">Kualitas Pelayanan</label>
					<select name="service" id="service" class="form-control" required="required">
						<option value='0'>Pilih Pelayanan</option>
						
							<?php if(isset($service)): ?>
								<?php if($service=='33.3'): ?>
								<option value='33.3' selected='selected'>Buruk </option>
								<option value='66.6'>Cukup </option>
								<option value='100'>Baik </option>
								<?php elseif($service=='66.6'): ?>
								<option value='33.3' >Buruk </option>
								<option value='66.6' selected='selected'>Cukup </option>
								<option value='100'>Baik </option>
								<?php else: ?>
								<option value='33.3' >Buruk </option>
								<option value='66.6' >Cukup </option>
								<option value='100' selected='selected'>Baik </option>
								<?php endif; ?>
							<?php else: ?>
							<option value='33.3' >Buruk </option>
							<option value='66.6'>Cukup </option>
							<option value='100'>Baik </option>
							<?php endif; ?>
							
					
					</select>
				</div>
				
			
				<button name="<?php echo !empty($netid)?'save':'submit'; ?>" type="submit" class="btn btn-primary">Submit</button>
				<a href="network.php" class="btn btn-warning">Batal</a>
			</form>
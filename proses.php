<?php 

require('koneksi.php');
include('header.php');
?>


<?php
if(isset($_POST['submit'])){
	$form= isset($_POST['form']) ? $_POST['form'] : '';
		switch ($form) {
			case 'network':
					$areaid= isset($_POST['area_id']) ? clean($_POST['area_id']) : '';
					$jid= isset($_POST['jurusan_id']) ? clean($_POST['jurusan_id']) : '';
					$nodeid= isset($_POST['node_id']) ? clean($_POST['node_id']) : '';
					$bw= isset($_POST['bandwidth']) ? clean($_POST['bandwidth']) : '';
					$jml= isset($_POST['jumlah']) ? clean($_POST['jumlah']) : '';
					$serv= isset($_POST['service']) ? clean($_POST['service']) : '';
					
					// $sqlcheck="select * from area where nama_area='".$area."'";
					
					// $check=mysql_query($sqlcheck) or die('SQL Check Area Error:'.mysql_error());
					// $numcheck=mysql_num_rows($check);

					// if($numcheck==0){
						
						
						$sql="insert into network (area_id,jurusan_id,node_id,bandwidth,jml_pelanggan,pelayanan) values ('".$areaid."','".$jid."','".$nodeid."','".$bw."','".$jml."','".$serv."')";
						
						$insert=mysql_query($sql)or die('Insert Data Network Error:'.mysql_error());
						if($insert==true){
							// echo $sql;
							alert('success','insert','network.php');
							
						}else{
							alert('danger','insert','network.php');
						}
					// }elseif($numcheck>0){
						// echo $sqlcheck;
						// alert('danger','insert','network.php');
						
					// }
				break;
			case 'area':
					$area= isset($_POST['nama_area']) ? clean($_POST['nama_area']) : '';
					$fid= isset($_POST['fakultas_id']) ? clean($_POST['fakultas_id']) : '';
					$sqlcheck="select * from area where nama_area='".$area."'";
					
					$check=mysql_query($sqlcheck) or die('SQL Check Area Error:'.mysql_error());
					$numcheck=mysql_num_rows($check);

					if($numcheck==0){
						
						
						$sql="insert into area (nama_area,fakultas_id) values ('".$area."',".$fid.")";
						
						$insert=mysql_query($sql)or die('Insert Data Area Error:'.mysql_error());
						if($insert==true){
							// echo $sql;
							alert('success','insert','area.php');
							
						}
					}elseif($numcheck>0){
						// echo $sqlcheck;
						alert('danger','insert','area.php');
						
					}
				break;
			case 'fakultas':
					$fakultas= isset($_POST['fakultas']) ? clean($_POST['fakultas']) : '';
					$fid= isset($_POST['fakultas_id']) ? clean($_POST['fakultas_id']) : '';
					$sqlcheck="select * from fakultas where fakultas='".$fakultas."'";
					
					$check=mysql_query($sqlcheck) or die('SQL Check Fakultas Error:'.mysql_error());
					$numcheck=mysql_num_rows($check);

					if($numcheck==0){
						
						
						$sql="insert into fakultas (fakultas) values ('".$fakultas."')";
						
						$insert=mysql_query($sql)or die('Insert Data Fakultas Error:'.mysql_error());
						if($insert==true){
							// echo $sql;
							alert('success','insert','fakultas.php');
						}
					}elseif($numcheck>0){
						//echo $sqlcheck;
						alert('danger','insert','fakultas.php');
					}
			break;
			case 'jurusan':
					$jurusan= isset($_POST['jurusan']) ? clean($_POST['jurusan']) : '';
					$fid= isset($_POST['fakultas_id']) ? clean($_POST['fakultas_id']) : '';
					$jid= isset($_POST['jurusan_id']) ? clean($_POST['jurusan_id']) : '';
					$sqlcheck="select * from jurusan where jurusan='".$jurusan."'";
					
					$check=mysql_query($sqlcheck) or die('SQL Check Jurusan Error:'.mysql_error());
					$numcheck=mysql_num_rows($check);

					if($numcheck==0){
						
						
						$sql="insert into jurusan (jurusan,fakultas_id) values ('".$jurusan."','".$fid."')";
						
						$insert=mysql_query($sql)or die('Insert Data Jurusan Error:'.mysql_error());
						if($insert==true){
							alert('success','insert','jurusan.php');
						}
					}elseif($numcheck>0){
						// echo $sqlcheck;
						alert('danger','insert','jurusan.php');
					}
			break;
			case 'rules':
					
					$rulename= isset($_POST['rulename']) ? clean($_POST['rulename']) : '';
					$bandwidth= isset($_POST['bandwidth']) ? clean($_POST['bandwidth']) : '';
					$jumlah= isset($_POST['jumlah']) ? clean($_POST['jumlah']) : '';
					$service= isset($_POST['service']) ? clean($_POST['service']) : '';
					$fuzzy= isset($_POST['fuzzy']) ? clean($_POST['fuzzy']) : '';
					$rid= isset($_POST['rule_id']) ? clean($_POST['rule_id']) : '';
					$sqlcheck="select * from rules where rulename='".$rulename."'";
					// echo $bandwidth;

					$check=mysql_query($sqlcheck) or die('SQL Check Rule Error:'.mysql_error());
					$numcheck=mysql_num_rows($check);

					if($numcheck==0){
						
						
						$sql="insert into rules (rulename,trafik_jaringan_b,j_pelanggan_cmt,kualitas_ck,fuzzy_output) values ('".$rulename."','".$bandwidth."','".$jumlah."','".$service."','".$fuzzy."')";
						
						$insert=mysql_query($sql)or die('Insert Data Rule Error:'.mysql_error());
						if($insert==true){
							// echo $sql;
							alert('success','insert','rules.php');
						}
					}elseif($numcheck>0){
						// echo $sqlcheck;
						alert('danger','insert','rules.php');
					}
			break;
			default:
				# code...
				break;
		}
					
}
if(isset($_POST['save'])){
	$form= isset($_POST['form']) ? $_POST['form'] : '';
	switch ($form) {
		case 'area':
			$area= isset($_POST['nama_area']) ? clean($_POST['nama_area']) : '';
					$fid= isset($_POST['fakultas_id']) ? clean($_POST['fakultas_id']) : '';
					$areaid= isset($_POST['area_id']) ? clean($_POST['area_id']) : '';
					

					
					if(isset($areaid)):
						
							
							
							$sql="update area set `nama_area`='".$area."', `fakultas_id`=".$fid." where area_id=".$areaid;
							
							$update=mysql_query($sql)or die('Update Data Area Error:'.mysql_error());
							if($update==true){
								// echo $sql;
								alert('success','update','area.php');
								
							
						}
					endif;
			# code...
			break;
		case 'fakultas':
					$fakultas= isset($_POST['fakultas']) ? clean($_POST['fakultas']) : '';
					$fid= isset($_POST['fakultas_id']) ? clean($_POST['fakultas_id']) : '';
					
					
					if(isset($fid)):
						
							
							
							$sql="update fakultas set fakultas='".$fakultas."' where fakultas_id=".$fid;
							
							$update=mysql_query($sql)or die('Update Data Fakultas Error:'.mysql_error());
							if($update==true){
								// echo $sql;
								alert('success','update','fakultas.php');
							
						}
					endif;
			break;
		case 'jurusan':
					$jurusan= isset($_POST['jurusan']) ? clean($_POST['jurusan']) : '';
					$jid= isset($_POST['jurusan_id']) ? clean($_POST['jurusan_id']) : '';
					
					
					if(isset($jid)):
						
							
							
							$sql="update jurusan set jurusan='".$jurusan."' where jurusan_id=".$jid;
							
							$update=mysql_query($sql)or die('Update Data Jurusan Error:'.mysql_error());
							if($update==true){
								// echo $sql;
								alert('success','update','jurusan.php');
							
						}
					endif;
			break;
		case 'rules':
					$rid= isset($_POST['rule_id']) ? clean($_POST['rule_id']) : '';
					$rulename= isset($_POST['rulename']) ? clean($_POST['rulename']) : '';
					$bandwidth= isset($_POST['bandwidth']) ? clean($_POST['bandwidth']) : '';
					$jumlah= isset($_POST['jumlah']) ? clean($_POST['jumlah']) : '';
					$service= isset($_POST['service']) ? clean($_POST['service']) : '';
					$fuzzy= isset($_POST['fuzzy']) ? clean($_POST['fuzzy']) : '';
					
					if(isset($rid)):
						
							
							
							$sql="update rules set rulename='".$rulename."',trafik_jaringan_b='".$bandwidth."',j_pelanggan_cmt='".$jumlah."',kualitas_ck='".$service."',fuzzy_output='".$fuzzy."' where rule_id=".$rid;
							
							$update=mysql_query($sql)or die('Update Data Rule Error:'.mysql_error());
							if($update==true){
								// echo $sql;
								alert('success','update','rules.php');
							
						}
					endif;
		break;
		case 'network':
					$areaid= isset($_POST['area_id']) ? clean($_POST['area_id']) : '';
					$netid= isset($_POST['net_id']) ? clean($_POST['net_id']) : '';
					$bw= isset($_POST['bandwidth']) ? clean($_POST['bandwidth']) : '';
					$jml= isset($_POST['jumlah']) ? clean($_POST['jumlah']) : '';
					$serv= isset($_POST['service']) ? clean($_POST['service']) : '';
					$nodeid= isset($_POST['node_id']) ? clean($_POST['node_id']) : '';
					$jid= isset($_POST['jurusan_id']) ? clean($_POST['jurusan_id']) : '';
					
					
					if(isset($netid)):
						
							
							
							$sql="update network set area_id='".$areaid."',bandwidth='".$bw."',jml_pelanggan='".$jml."',pelayanan='".$serv."',node_id='".$nodeid."',jurusan_id='".$jid."' where net_id=".$netid;
							
							$update=mysql_query($sql)or die('Update Data Jaringan Error:'.mysql_error());
							if($update==true){
								// echo $sql;
								alert('success','update','network.php');
								
							
						}
					endif;
		break;
		default:
			# code...
			break;
	}
					
}
if(!isset($_POST['submit'])){
	$form= isset($_GET['form']) ? $_GET['form'] : '';
	switch ($form) {
		case 'area':
			$a= isset($_GET['a']) ? $_GET['a'] : '';
			$areaid= isset($_GET['id']) ? $_GET['id'] : '';
			switch ($a) {
				case 'edit':
					
					include('content-area.php');


					# code...
					break;
				case 'delete':
					
					delete('area','area_id',$areaid);
					break;
				default:
					# code...
					break;
			}
			# code...
			break;
		case 'fakultas':
			$a= isset($_GET['a']) ? $_GET['a'] : '';
			$fid= isset($_GET['id']) ? $_GET['id'] : '';
			switch ($a) {
				case 'edit':
					
					include('content-fakultas.php');


					# code...
					break;
				case 'delete':
					
					delete('fakultas','fakultas_id',$fid);
					break;
				default:
					# code...
					break;
			}
			break;
		case 'jurusan':
			$a= isset($_GET['a']) ? $_GET['a'] : '';
			$jid= isset($_GET['id']) ? $_GET['id'] : '';
			switch ($a) {
				case 'edit':
					
					include('content-jurusan.php');


					# code...
					break;
				case 'delete':
					
					delete('jurusan','jurusan_id',$jid);
					break;
				default:
					# code...
					break;
			}
		break;
		case 'rules':
			$a= isset($_GET['a']) ? $_GET['a'] : '';
			$rid= isset($_GET['id']) ? $_GET['id'] : '';
			switch ($a) {
				case 'edit':
					
					include('content-rules.php');


					# code...
					break;
				case 'delete':
					
					delete('rules','rule_id',$rid);
					break;
				default:
					# code...
					break;
			}
		break;
		case 'network':
			$a= isset($_GET['a']) ? $_GET['a'] : '';
			$nid= isset($_GET['id']) ? $_GET['id'] : '';
			switch ($a) {
				case 'edit':
					
					include('content-network.php');


					# code...
					break;
				case 'delete':
					
					delete('network','net_id',$nid);
					break;
				default:
					# code...
					break;
			}
		break;
		default:
			# code...
			break;
	}
	
	?>
	
	<?php
}	
?>


<?php
function alert($type=null,$action=null,$url=null){
	switch ($type) {
		case 'success':
			$alert_msg='berhasil...';
			$alert='alert-success';
			$alert_status='Sukses:';
			# code...
			break;
		case 'warning':
			$alert_msg='harus diperhatikan...';
			$alert='alert-warning';
			$alert_status='Perhatian!:';
			# code...
			break;
		case 'danger':
			$alert_msg='gagal dilakukan...';
			$alert='alert-danger';
			$alert_status='Kesalahan:';
			# code...
			break;
		
		default:
			# code...
			break;
	}
	switch ($action) {
		case 'insert':
		$alert_action='Input Data Baru';
		
			# code...
			break;
		case 'update':
			$alert_action='Update Data';
			# code...
			break;
		case 'delete':
			$alert_action='Hapus Data';
			# code...
			break;
		
		default:
			# code...
			break;
	}
	?>
	<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			

			<div class="alert <?php echo $alert ?>">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?php echo $alert_status; ?></strong> <?php echo $alert_action." ".$alert_msg; ?>
			</div>
			<a href="<?php echo $url ?>"  class="btn btn-info">Klik Disini Untuk Kembali </a>
		</div>
	</div>
</div>
						
	<?php

}


function clean($value){
   return mysql_real_escape_string($value);
}
function delete($table=null,$field=null,$id=null){
	$table=isset($table) ? $table : '';
	$field=isset($field) ? $field : '';
	$areaid=isset($id) ? $id : '';
	if(isset($areaid)):
						$sqldelete="delete from `".$table."` where ".$field."=".$areaid;
						// $sqldelete="delete from `area` where area_id=".$areaid;
						$hasil=mysql_query($sqldelete)or die("SQL Delete ERROR:".$sqldelete."-->".mysql_error());
						if($hasil==true){
							alert('success','delete',$table.".php");
						}
					endif;
}
include('footer.php');
 ?>

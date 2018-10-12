<?php 
require('koneksi.php'); //dibutuhkan file koneksi.php untuk koneksi ke database

include('header.php'); //termasuk file header.php
?>
<div class="container">
	<div class="row" style="margin-bottom:10px;">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<h3>SPK Kebutuhan Bandwidth</h3>
			<h4>Menggunakan Metode Fuzzy Sugeno</h4>
			<hr>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<button type="button" class="print pull-right btn-lg btn btn-info no-print"><i class="glyphicon glyphicon-print"></i> Cetak</button>

		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php
				$sql="select * from `view-network-fuzzy` order by netid"; //melihat view --> view-network-fuzzy
				$hasil=mysql_query($sql) or die('Query Network Error'); //hasil query disimpan pada variabel $hasil, jika tidak ada hasil akan berhenti dan mengeluarkan konfirmasi
				if($hasil==true){ //jika $hasil bernilai benar 'TRUE'
					global $hasilsugeno; //variabel $hasilsugeno dapat diakses dari function lain
					$numrow=mysql_num_rows($hasil); //mendapatkan jumlah data dari $hasil ?>
					<table class="table table-hover table-condensed table-striped table-bordered">
						<thead>
							<tr>
								<th>NetID</th>
								
								<th>Area</th>
								<th>Fakultas</th>
								<th>Jurusan</th>
								<th>Node</th>
								<th>Bandwidth</th>
								<th>Pelanggan</th>
								<th>Kualitas</th>
								<th>Fuzzy Output</th>
								<th class="no-print">Aksi</th>
								
							</tr>
						</thead>
						<tbody>
							
						
					<?php
					$i=1;$j=0; //inisialisasi variabel $i dan $j

					while($row=mysql_fetch_array($hasil)){ //selama $hasil memiliki data, simpan di variabel $row
						//membuat array $netw yang berisi netid, b, cmt, ck
						$netw[]=array(
							'netid'=>$row['netid'],
							'bw'=>$row['bw'],
							'jml'=>$row['jml'],
							'serv'=>$row['serv'],
						);

						?>

						<tr data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
							<td><?php echo $row['netid']; ?></td><!-- Cetak Data NETID-->
							<td><?php echo $row['area']; ?></td><!-- Cetak Data Area -->
							<td><?php echo $row['fakultas']; ?></td><!-- Cetak Data Fakultas-->
							<td><?php echo $row['jurusan']; ?></td><!-- Cetak Data Jurusan-->
							<td><?php echo $row['nodeid']; ?></td><!-- Cetak Data Titik/Node-->
							<td><?php echo $row['bw']; ?></td><!-- Cetak Data B-->
							<td><?php echo $row['jml']; ?></td><!-- Cetak Data CMT-->
							<td><?php echo $row['serv']; ?></td><!-- Cetak Data CK-->
							<td><?php if($row['fuzzy_output']=="Normal"){ 
								// Jika Nilainya Normal maka akan dicetak warna hijau
								echo "<div class='btn btn-xs btn-block btn-success'>".$row['fuzzy_output']."</div>";
							}else{ //selain itu dicetak warna merah
								echo "<div class='btn btn-xs btn-block btn-danger'>".$row['fuzzy_output']."</div>";
							}; ?></td>
							
							
							<td class="no-print">
								<div class="btn-group">
								<!-- 	<a href="#" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
									<a href="#" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Hapus</a>
								 -->
								 <a class="btn btn-xs btn-info" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
								          <i class="glyphicon glyphicon-chevron-down"></i> Detail
								        </a>
								    </div>
							</td>
							
						</tr>
						<tr>
							<td colspan="10" style="padding:0px" >
								<div  id="collapse<?php echo $i; ?>" class="panel-collapse collapse out">
								    
								    <div class="well">
								    	<div class="row">
								    		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								    			<h4>Derajat Keanggotaan</h4>
								    			<h5>Bandwidth (B)</h5>
								    			<!-- Memanggil Function himp_bw() -->
								    			<?php himp_bw($row['netid']); ?>
								    			
								    			<!-- Memanggil Function himp_jml() -->
								    			<h5>Jumlah Pelanggan (CMT)</h5>
								    			<?php himp_jml($row['netid']); ?>
								    		
								    			<!-- Memanggil Function himp_serv() -->
								    			<h5>Kualitas Layanan (CK)</h5>
								    			<?php himp_serv($row['netid']); ?>
								    		
								    		</div>	
								    		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
												<!-- <div class="row"> -->
													<h4>Rule Base System</h4>
													<!-- Memanggil Function Rulebase -->
													<?php rulebase($row['netid']);?>
								    			<!-- </div>
								    			<div class="row"> -->
								    				<!-- Memanggil Function Alphafuzzy -->
								    				<?php alphafuzzy($row['netid']); ?>
								    			<!-- </div> -->
								    		</div>
								    	</div>
										
										
								    </div>
								    

								</div>
								
							</td>

						</tr>
						<!-- Inisialisasi variabel $i dan $j -->
					<?php $i++; $j++;?>
					<?php } //tutup while?>
						
						</tbody>
					</table>
				<?php } //tutup if


				?>	

				</div>	
	</div>
</div>

<?php  
//Function himp_bw(netid harus masuk disini)
function himp_bw($netid){
	$sql="select * from `query-rule-bandwidth` where netid='".$netid."'"; //sql query bandwidth
	$hasil=mysql_query($sql)or die('Query View Bandwidth Error'); //masukkan query di var $hasil
	if($hasil==true){ //jika benar
		while($row=mysql_fetch_array($hasil)){ //selama di var $hasil terdapat data
			$himp_bw=array(); //definisikan $himp_bw sebagai array
			if($row['sedikit']==true){ //jika bw sedikit maka himp_bw sedikit
				$himp_bw[]="Sedikit";
			}
			if($row['sedang']==true){ //jika bw sedang maka himp_bw sedang
				$himp_bw[]="Sedang";
			}
			if($row['banyak']==true){ //jika bw banyak maka himp_bw banyak
				$himp_bw[]="Banyak";
			}
			$bw=$row['b']; //$bw adalah data B
			?>
			<div class="panel panel-default">
					<div class="panel-body">
			<?php
			// Untuk setiap $himp_bw menjadi $row0
			foreach($himp_bw as $row0){
				echo "<a href='#informasi' class='btn btn-sm btn-block btn-warning block' data-toggle='collapse' data-parent='#accordion'>".$row0."</a>";
				?>
				
					  <?php 
					  	if($row0=="Sedikit"){ //Jika nilainya seedikit
					  		//tampilkan perhitungan dan hasil
					  		echo "<span class='btn btn-default '>$bw/33,3 = ".round(($bw/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.1)</span><br>";
					  	}else/*{
					  		echo "<span class='btn btn-default '>Sedikit : 0</span><br>";

					  	}*/
					  	if($row0=="Sedang"){ //Jika nilainya Sedang
					  		//tampilkan perhitungan dan hasil
					  		echo "<span class='btn btn-default '>(100 - $bw)/33,3 = ".round(((100-$bw)/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.2)</span><br>";
					  	}/*else{
					  		echo "<span class='btn btn-default '>Sedang : 0</span><br>";

					  	}*/
					  	if($row0=="Banyak"){ //Jika nilainya Banyak
					  		//tampilkan perhitungan dan hasil
					  		echo "<span class='btn btn-default '>($bw - 66,6)/33,3 =".round((($bw-66.6)/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.3)</span><br>";
					  	}/*else{
					  		echo "<span class='btn btn-default '>Banyak : 0</span><br>";

					  	}*/

					 
			}?>
			</div>
				</div>
			<?php
		}
	}
}
//Function himp_bw(netid harus masuk disini)
function himp_jml($netid){
	$sql="select * from `query-rule-pelanggan` where netid='".$netid."'"; //query rule pelanggan
	$hasil=mysql_query($sql)or die('Query View Pelanggan Error'); //disimpan di $hasil jika gagal berhenti
	if($hasil==true){ //jika hasil bernilai  benar
		while($row=mysql_fetch_array($hasil)){ //selama punya data
			$himp_jml=array(); //ini array
			if($row['sedikit']==true){ //jika sedikit maka 'Sedikit'
				$himp_jml[]="Sedikit";
			}
			if($row['sedang']==true){ //jika sedang maka 'sedang'
				$himp_jml[]="Sedang";
			}
			if($row['banyak']==true){ //jika banyak maka 'banyak'
				$himp_jml[]="Banyak";
			}
			$jml=$row['jml']; //jumlah pelanggan
			?>
			<div class="panel panel-default">
					<div class="panel-body">
			<?php
			foreach($himp_jml as $row1){ //setiap $himp_jml sebagai $row1
				echo "<a href='#informasi' class='btn btn-sm btn-block btn-danger block' data-toggle='collapse' data-parent='#accordion'>".$row1."</a>";
				?>
				
					  <?php 
					  	if($row1=="Sedikit"){ //jika sedikit maka cetak perhitngan dan hasil 
					  	echo "<span class='btn btn-default '>$jml/33,3 = ".round(($jml/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.4)</span><br/>";
					  	}/*else{
					  		echo "<span class='btn btn-default '>Sedikit : 0</span><br>";

					  	}*/
					  	if($row1=="Sedang"){ //jika sedikit maka cetak perhitngan dan hasil
					  		echo "<span class='btn btn-default '>(100 - $jml)/33,3 = ".round(((100-$jml)/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.5)</span><br/>";
					  	}/*else{
					  		echo "<span class='btn btn-default '>Sedang : 0</span><br>";

					  	}*/
					  	if($row1=="Banyak"){ //jika banyak maka cetak perhitngan dan hasil
					  		echo "<span class='btn btn-default '>($jml- 66,6)/33,3 =".round((($jml-66.6)/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.6)</span><br/>";
					  	}/*else{
					  		echo "<span class='btn btn-default '>Banyak : 0</span><br>";

					  	}*/

					 
			}
			 	?>
					</div>
				</div>

				<?php
		}
	}
}
function himp_serv($netid){
	$sql="select * from `query-rule-pelayanan` where netid=".$netid;
	$hasil=mysql_query($sql)or die('Query View Pelayanan Error');
	if($hasil==true){
		while($row=mysql_fetch_array($hasil)){
			$himp_serv=array();
			if($row['buruk']==true){
				$himp_serv[]="Buruk";
			}
			if($row['cukup']==true){
				$himp_serv[]="Cukup";
			}
			if($row['baik']==true){
				$himp_serv[]="Baik";
			}
			$serv=$row['serv'];
			?>
			<div class="panel panel-default">
					<div class="panel-body">
			<?php
			foreach($himp_serv as $row2){
				echo "<a href='#informasi' class='btn btn-sm btn-block btn-success block' data-toggle='collapse' data-parent='#accordion'>".$row2."</a>";
				?>
				
					  <?php 
					  	if($row2=="Buruk"){
					  	echo "<span class='btn btn-default '>$serv/33,3 = ".round(($serv/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.7)</span><br/>";
					  	}/*else{
					  		echo "<span class='btn btn-default '>Buruk : 0</span><br>";

					  	}*/
					  	if($row2=="Cukup"){
					  		echo "<span class='btn btn-default '>(100 - $serv)/33,3 = ".round(((100-$serv)/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.8)</span><br/>";
					  	}/*else{
					  		echo "<span class='btn btn-default '>Cukup : 0</span><br>";

					  	}*/
					  	if($row2=="Baik"){
					  		echo "<span class='btn btn-default '>($serv - 66,6)/33,3 =".round((($serv-66.6)/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.9)</span><br/>";
					  	}/*else{
					  		echo "<span class='btn btn-default '>Baik : 0</span><br>";

					  	}*/

					 
			}?>
			</div>
				</div>
			<?php
		}
	}
}

function rulebase($netid){
	global $rulebase,$sqlrule;
	
	$sqlrulebase="select * from `22-view-rulebase` where netid='".$netid."'";
	
	$sqlrule=$sqlrulebase;
	global $sqlrule;
	$hasilrule=mysql_query($sqlrulebase)or die("Query Rule Base Error".mysql_error());
	if($hasilrule==true){
		?>
		<table class="table table-hover table-condensed table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>NETID</th>
					<th>Rule Base</th>
					
					<th>Rule Name</th>
					<th>Trafik Jaringan (B)</th>
					<th>Jumlah Pelanggan (CMT)</th>
					<th>Kualitas Pelayanan (CK)</th>
					<th>Fuzzy Output</th>
				</tr>
			</thead>
			<tbody>
				
		<?php
		$rj=1;
		$jj=0;
		$xx=1;
		$rulebase=array();
		$numrow=mysql_num_rows($hasilrule);
		while($rowrule=mysql_fetch_array($hasilrule)){
			if($xx==1||$xx==$numrow){
			echo "<tr>";
			echo "<td>".$rj."</td>";
			echo "<td>".$rowrule['netid']."</td>";
			
			echo "<td>".$rowrule['ruleid']."</td>";
			echo "<td>".$rowrule['rulename']."</td>";
			echo "<td>".$rowrule['bw']."</td>";
			echo "<td>".$rowrule['jml']."</td>";
			echo "<td>".$rowrule['serv']."</td>";
			echo "<td>".$rowrule['fz']."</td>";
			echo "</tr>";
			$rj++;
			$rulebase[]=array('netid'=>$netid,'ruleid'=>$rowrule['ruleid'],'fuzzy'=>$rowrule['fz']);
			
			}$xx++;
		}
		?>
			<tr>
				<td colspan="7"><?php //echo var_dump($rulebase); ?></td>
			</tr>
			</tbody>
		</table>
		<?php
	}
	echo "<br>";
	


	?>
	
	<?php
}

function alphafuzzy($netid){
	global $rulebase,$sqlrule,$hasilsugeno;
	$sqlpre="select * from `view-query-predikat` where id=".$netid;
	$hasilpre=mysql_query($sqlpre) or die ('Query Predikat Error');
	$ipre=1;
	$numrow=mysql_num_rows($hasilpre);
	if($hasilpre==true){
		echo "<div class='row'>";?>

		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h4>Alpha Predikat</h4>
			
		<?php
		while($rowpre=mysql_fetch_array($hasilpre)){
			if($ipre==1||$ipre==$numrow){
			echo "<p>&alpha;Predikat<sub>$ipre</sub> = MIN(".$rowpre['alpha_bw'].",".$rowpre['alpha_jml'].",".$rowpre['alpha_serv'].") </p>";
			echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; = ".MIN($rowpre['alpha_bw'],$rowpre['alpha_jml'],$rowpre['alpha_serv'])."</p>";
			if($rowpre['fz']=='Normal'){
				$fz=10;
			}elseif($rowpre['fz']=='Upgrade'){
				$fz=100;
			}
			
			echo "<p>Z<sub>$ipre</sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; = ".$rowpre['fz']." = ".$fz."</p>";
			//$minval=array();
			$minval[$ipre]=array('min'=>(MIN($rowpre['alpha_bw'],$rowpre['alpha_jml'],$rowpre['alpha_serv'])),'fz'=>$fz);
			}
			$ipre++;
		}?>

		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h4>Weight Average</h4>
			<?php  $ii=1;?>
			<p><strong>FO = </strong>
			<?php  
			$fo='';
			$nilai_alphaz=0;
			echo "<u>";
			$count=count($minval);
			foreach($minval as $r){
				
				$alphaz=$r['min']*$r['fz'];
				if($ii++>1){
					echo "+";
				}
				echo "(".$alphaz.")";
				
				$nilai_alphaz=$nilai_alphaz+$alphaz;
				$ii++;
				
				
				
			}

			
			echo "</u>";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$ii=1;
			$nilai_aza=0;
			foreach($minval as $az){
				
				$azz=$az['min'];
				if($ii>1){
					echo "+";
				}
				echo "(".$azz.")";
				
				$nilai_aza=$nilai_aza+$azz;
				$ii++;
			}
			$nilai_fo=$nilai_alphaz/$nilai_aza;
				?>
			<p><strong>FO = </strong><?php echo $nilai_alphaz."/".$nilai_aza; ?></p> 
			<p><strong>Nilai FO = </strong><?php echo $nilai_fo; ?></p> 
			<?php if($nilai_fo>=0 and $nilai_fo<=10){
				$hasilsugeno="NORMAL";
				?>
				<div class="alert alert-success">
						Hasil Fuzzy Sugeno <strong> NORMAL</strong>
					</div>	
			<?php }elseif($nilai_fo>10  and $nilai_fo<=100){
				$hasilsugeno="UPGRADE";
				?>
				<div class="alert alert-danger">
					Hasil Fuzzy Sugeno <strong>UPGRADE</strong>
				</div>
			<?php } ?>
			<?php //echo var_dump($minval) ?>
		</div>
		
		<?php

	}
	// echo $sqlrule;
	// echo var_dump($rulebase);

}
function anggota($h){
	global $netw;
	switch ($h) {
		case 'bw':
			foreach($netw as $row){
				//echo $row['netid'];
				$netid=$row['netid'];
				$bw=$row['bw'];
			/*	$jml=$row['jml'];
				$serv=$row['serv'];*/
				if($bw>=0 and $bw<=66.6){
					// echo $netid.":Sedikit";
					$hmin="Sedikit";$is_hmin=true;
					$himp[]=array("netid"=>$netid,"himpunan"=>$hmin);
				}
				if($bw>=33.3 and $bw<=100){
					// echo $netid.":Sedang";
					$hmid="Sedang";$is_hmid=true;
					$himp[]=array("netid"=>$netid,"himpunan"=>$hmid);
				}
				if($bw>=66.6 and $bw<=100){
					// echo $netid.":Banyak";
					$hmax="Banyak";$is_hmax=true;
					$himp[]=array("netid"=>$netid,"himpunan"=>$hmax);
				}
			}
		break;
		case 'jml':
			foreach($netw as $row){
				//echo $row['netid'];
				$netid=$row['netid'];
				$jml=$row['jml'];
			
				if($jml>=0 and $jml<=66.6){
					// echo $netid.":Sedikit";
					$hmin="Sedikit";$is_hmin=true;
					$himp[]=array("netid"=>$netid,"himpunan"=>$hmin);
				}
				if($jml>=33.3 and $jml<=100){
					// echo $netid.":Sedang";
					$hmid="Sedang";$is_hmid=true;
					$himp[]=array("netid"=>$netid,"himpunan"=>$hmid);
				}
				if($jml>=66.6 and $jml<=100){
					// echo $netid.":Banyak";
					$hmax="Banyak";$is_hmax=true;
					$himp[]=array("netid"=>$netid,"himpunan"=>$hmax);
				}
			}
		break;
		case 'serv':
			foreach($netw as $row){
				//echo $row['netid'];
				$netid=$row['netid'];
			
				$serv=$row['serv'];
				if($serv>=0 and $serv<=66.6){
					// echo $netid.":Sedikit";
					$hmin="Sedikit";$is_hmin=true;
					$himp[]=array("netid"=>$netid,"himpunan"=>$hmin);
				}
				if($serv>=33.3 and $serv<=100){
					// echo $netid.":Sedang";
					$hmid="Sedang";$is_hmid=true;
					$himp[]=array("netid"=>$netid,"himpunan"=>$hmid);
				}
				if($serv>=66.6 and $serv<=100){
					// echo $netid.":Banyak";
					$hmax="Banyak";$is_hmax=true;
					$himp[]=array("netid"=>$netid,"himpunan"=>$hmax);
				}
			}
		break;
		
		default:
			# code...
			break;
	}
	
	// echo var_dump(json_encode($himp));
	return $himp;
}
 ?>


<?php
include('footer.php');

 ?>		

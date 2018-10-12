<?php 
require('koneksi.php');
include('header.php');
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
				$sql="select * from `view-network-fuzzy` order by netid";
				$hasil=mysql_query($sql) or die('Query Network Error');
				if($hasil==true){
					global $hasilsugeno; 
					$numrow=mysql_num_rows($hasil);?>
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
					$i=1;$j=0;

					while($row=mysql_fetch_array($hasil)){
						$netw[]=array(
							'netid'=>$row['netid'],
							'bw'=>$row['bw'],
							'jml'=>$row['jml'],
							'serv'=>$row['serv'],
						);

						?>

						<tr data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
							<td><?php echo $row['netid']; ?></td>
							<td><?php echo $row['area']; ?></td>
							<td><?php echo $row['fakultas']; ?></td>
							<td><?php echo $row['jurusan']; ?></td>
							<td><?php echo $row['nodeid']; ?></td>
							<td><?php echo $row['bw']; ?></td>
							<td><?php echo $row['jml']; ?></td>
							<td><?php echo $row['serv']; ?></td>
							<td><?php if($row['fuzzy_output']=="Normal"){
								echo "<div class='btn btn-xs btn-block btn-success'>".$row['fuzzy_output']."</div>";
							}else{
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
								    			<?php himp_bw($row['netid']); ?>
								    		
								    			<h5>Jumlah Pelanggan (CMT)</h5>
								    			<?php himp_jml($row['netid']); ?>
								    		
								    			<h5>Kualitas Layanan (CK)</h5>
								    			<?php himp_serv($row['netid']); ?>
								    		
								    		</div>	
								    		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
												<!-- <div class="row"> -->
													<h4>Rule Base System</h4>
													<?php rulebase($row['netid']);?>
								    			<!-- </div>
								    			<div class="row"> -->
								    				
								    				<?php alphafuzzy($row['netid']); ?>
								    			<!-- </div> -->
								    		</div>
								    	</div>
										
										
								    </div>
								    

								</div>
								
							</td>

						</tr>
					<?php $i++; $j++;?>
					<?php } ?>
						
						</tbody>
					</table>
				<?php }


				?>	

				<?php //echo var_dump($netw) ?>
				
		</div>	
	</div>
</div>

<?php  
function himp_bw($netid){
	$sql="select * from `query-rule-bandwidth` where netid=".$netid;
	$hasil=mysql_query($sql)or die('Query View Bandwidth Error');
	if($hasil==true){
		while($row=mysql_fetch_array($hasil)){
			$himp_bw=array();
			if($row['sedikit']==true){
				$himp_bw[]="Sedikit";
			}
			if($row['sedang']==true){
				$himp_bw[]="Sedang";
			}
			if($row['banyak']==true){
				$himp_bw[]="Banyak";
			}
			$bw=$row['b'];
			?>
			<div class="panel panel-default">
					<div class="panel-body">
			<?php
			foreach($himp_bw as $row0){
				echo "<a href='#informasi' class='btn btn-sm btn-block btn-warning block' data-toggle='collapse' data-parent='#accordion'>".$row0."</a>";
				?>
				
					  <?php 
					  	if($row0=="Sedikit"){
					  		echo "<span class='btn btn-default '>$bw/33,3 = ".round(($bw/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.1)</span><br>";
					  	}else/*{
					  		echo "<span class='btn btn-default '>Sedikit : 0</span><br>";

					  	}*/
					  	if($row0=="Sedang"){
					  		echo "<span class='btn btn-default '>(100 - $bw)/33,3 = ".round(((100-$bw)/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.2)</span><br>";
					  	}/*else{
					  		echo "<span class='btn btn-default '>Sedang : 0</span><br>";

					  	}*/
					  	if($row0=="Banyak"){
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
function himp_jml($netid){
	$sql="select * from `query-rule-pelanggan` where netid=".$netid;
	$hasil=mysql_query($sql)or die('Query View Pelanggan Error');
	if($hasil==true){
		while($row=mysql_fetch_array($hasil)){
			$himp_jml=array();
			if($row['sedikit']==true){
				$himp_jml[]="Sedikit";
			}
			if($row['sedang']==true){
				$himp_jml[]="Sedang";
			}
			if($row['banyak']==true){
				$himp_jml[]="Banyak";
			}
			$jml=$row['jml'];
			?>
			<div class="panel panel-default">
					<div class="panel-body">
			<?php
			foreach($himp_jml as $row1){
				echo "<a href='#informasi' class='btn btn-sm btn-block btn-danger block' data-toggle='collapse' data-parent='#accordion'>".$row1."</a>";
				?>
				
					  <?php 
					  	if($row1=="Sedikit"){
					  	echo "<span class='btn btn-default '>$jml/33,3 = ".round(($jml/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.4)</span><br/>";
					  	}/*else{
					  		echo "<span class='btn btn-default '>Sedikit : 0</span><br>";

					  	}*/
					  	if($row1=="Sedang"){
					  		echo "<span class='btn btn-default '>(100 - $jml)/33,3 = ".round(((100-$jml)/33.3),2)."</span>&nbsp; <span class='btn btn-info pull-right'>(3.5)</span><br/>";
					  	}/*else{
					  		echo "<span class='btn btn-default '>Sedang : 0</span><br>";

					  	}*/
					  	if($row1=="Banyak"){
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
	$sqlmu="select x.netid,z.ruleid,z.rulename,z.bw,z.jml,z.serv,z.fz from (SELECT a.netid, a.ruleid,a.rulename,
min(ruleid) rulemin,
max(ruleid) rulemax 
FROM
`20-view-rulebase` AS a where netid=".$netid.")  x inner join `20-view-rulebase` z where z.ruleid=x.rulemin or z.ruleid=x.rulemax";

	$sqlsuper="select * from (select `a`.`netid` AS `netid`,`a`.`b` AS `b`,`a`.`jml` AS `cmt`,`a`.`serv` AS `ck`,
	`b`.`ruleid` AS `ruleid`,`b`.`rulename` AS `rulename`,`b`.`bw` AS `bw`,`b`.`jml` AS `jml`,
	`b`.`serv` AS `serv`,`b`.`fz` AS `fz` 
	from (`query-himpunan` `a` join `query-rules` `b`) 
	where ( a.netid=5 and 
	((`b`.`bw` = convert(if((`a`.`bwmin` = 1),'Sedikit',0) using latin1)) or 
			(`b`.`bw` = convert(if((`a`.`bwmid` = 1),'Sedang',0) using latin1)) or 
			(`b`.`bw` = convert(if((`a`.`bwmax` = 1),'Banyak',0) using latin1))) and 
	((`b`.`jml` = convert(if((`a`.`jmlmin` = 1),'Sedikit',0) using latin1)) or 
			(`b`.`jml` = convert(if((`a`.`jmlmid` = 1),'Sedang',0) using latin1)) or 
			(`b`.`jml` = convert(if((`a`.`jmlmax` = 1),'Banyak',0) using latin1))) and 
	((`b`.`serv` = convert(if((`a`.`servmin` = 1),'Buruk',0) using latin1)) or 
			(`b`.`serv` = convert(if((`a`.`servmid` = 1),'Cukup',0) using latin1)) or 
			(`b`.`serv` = convert(if((`a`.`servmax` = 1),'Baik',0) using latin1)))) 
	order by `a`.`netid`,`b`.`ruleid`) x, (SELECT
	`a`.`netid` AS `netid`,
	`a`.`b` AS `b`,
	`a`.`cmt` AS `cmt`,
	`a`.`ck` AS `ck`,
	min(`a`.`ruleid`)AS `rmin`,
	max(`a`.`ruleid`)AS `rmax`
FROM
	(select `a`.`netid` AS `netid`,`a`.`b` AS `b`,`a`.`jml` AS `cmt`,`a`.`serv` AS `ck`,
	`b`.`ruleid` AS `ruleid`,`b`.`rulename` AS `rulename`,`b`.`bw` AS `bw`,`b`.`jml` AS `jml`,
	`b`.`serv` AS `serv`,`b`.`fz` AS `fz` 
	from (`query-himpunan` `a` join `query-rules` `b`) 
	where ( a.netid='".$netid."' and 
	((`b`.`bw` = convert(if((`a`.`bwmin` = 1),'Sedikit',0) using latin1)) or 
			(`b`.`bw` = convert(if((`a`.`bwmid` = 1),'Sedang',0) using latin1)) or 
			(`b`.`bw` = convert(if((`a`.`bwmax` = 1),'Banyak',0) using latin1))) and 
	((`b`.`jml` = convert(if((`a`.`jmlmin` = 1),'Sedikit',0) using latin1)) or 
			(`b`.`jml` = convert(if((`a`.`jmlmid` = 1),'Sedang',0) using latin1)) or 
			(`b`.`jml` = convert(if((`a`.`jmlmax` = 1),'Banyak',0) using latin1))) and 
	((`b`.`serv` = convert(if((`a`.`servmin` = 1),'Buruk',0) using latin1)) or 
			(`b`.`serv` = convert(if((`a`.`servmid` = 1),'Cukup',0) using latin1)) or 
			(`b`.`serv` = convert(if((`a`.`servmax` = 1),'Baik',0) using latin1)))) 
	order by `a`.`netid`,`b`.`ruleid`) `a`) z where (x.ruleid=z.rmin or x.ruleid=z.rmax)";

	/*$sql="select x.*,
	(select min(x.ruleid)) min,
	(select max(x.ruleid)) max

	 from (select `a`.`netid` AS `netid`,`a`.`b` AS `b`,`a`.`jml` AS `cmt`,`a`.`serv` AS `ck`,
	`b`.`ruleid` AS `ruleid`,`b`.`rulename` AS `rulename`,`b`.`bw` AS `bw`,`b`.`jml` AS `jml`,
	`b`.`serv` AS `serv`,`b`.`fz` AS `fz` 
	from (`query-himpunan` `a` join `query-rules` `b`) 
	where (((`b`.`bw` = convert(if((`a`.`bwmin` = 1),'Sedikit',0) using latin1)) or 
			(`b`.`bw` = convert(if((`a`.`bwmid` = 1),'Sedang',0) using latin1)) or 
			(`b`.`bw` = convert(if((`a`.`bwmax` = 1),'Banyak',0) using latin1))) 
	and ((`b`.`jml` = convert(if((`a`.`jmlmin` = 1),'Sedikit',0) using latin1)) or 
			(`b`.`jml` = convert(if((`a`.`jmlmid` = 1),'Sedang',0) using latin1)) or 
			(`b`.`jml` = convert(if((`a`.`jmlmax` = 1),'Banyak',0) using latin1))) 
	and ((`b`.`serv` = convert(if((`a`.`servmin` = 1),'Buruk',0) using latin1)) or 
			(`b`.`serv` = convert(if((`a`.`servmid` = 1),'Cukup',0) using latin1)) or 
			(`b`.`serv` = convert(if((`a`.`servmax` = 1),'Baik',0) using latin1)))) 
	order by `a`.`netid`,`b`.`ruleid`) x where x.netid='".$netid."'";*/
	// $sqlrulebase="select * from `22-view-rulebase` where netid='".$netid."'";
	
	$sqlrule=$sqlsuper;
	global $sqlrule;
	$hasilrule=mysql_query($sqlsuper)or die("Query Rule Base Error".mysql_error());
	if($hasilrule==true){
		?>
		<table class="table table-hover table-condensed table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>NETID</th>
					<th>Rule Base</th>
					<th>Rule Base</th>
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
		$rulebase=array();
		while($rowrule=mysql_fetch_array($hasilrule)){
			echo "<tr>";
			echo "<td>".$rj."</td>";
			echo "<td>".$rowrule['netid']."</td>";
			echo "<td>".$rowrule['min']."</td>";
			echo "<td>".$rowrule['max']."</td>";
			echo "<td>".$rowrule['ruleid']."</td>";
			echo "<td>".$rowrule['rulename']."</td>";
			echo "<td>".$rowrule['bw']."</td>";
			echo "<td>".$rowrule['jml']."</td>";
			echo "<td>".$rowrule['serv']."</td>";
			echo "<td>".$rowrule['fz']."</td>";
			echo "</tr>";
			$rj++;
			$rulebase[]=array('netid'=>$netid,'ruleid'=>$rowrule['ruleid'],'fuzzy'=>$rowrule['fz']);

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
	if($hasilpre==true){
		echo "<div class='row'>";?>

		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h4>Alpha Predikat</h4>
			
		<?php
		while($rowpre=mysql_fetch_array($hasilpre)){
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

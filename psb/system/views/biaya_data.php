<?php notifbox(); ?>
<div id="loader2" class="loader" style="display:none"></div>
<table id="ctable" class="xtable" style="float:left" border="1" cellspacing="1px" cellpadding="4px" width="100%">
<tr>
	<th>Kriteria</th>
	<th>Golongan</th>
	<th class="alr" width="150px">Besar Biaya Pendaftaran</th>
	<th class="alr" width="150px">Besar Uang Pangkal</th>
	<th class="alr" width="150px">Besar SPP</th>
	<th class="alr" width="150px">Besar Joining Fee</th> <!-- epiii -->
</tr>
<?php 
	$x       =$ndata>2?1:0; 
	$tfield  ='x'; 
	$tfield2 ='x';
	$s1      ="SELECT * FROM psb_kriteria";
	$t       =mysql_query($s1); 
	$ADMIN   =admin_get(); 
	while($r=mysql_fetch_array($t)){
		$s2 ="SELECT * FROM psb_golongan";
		$q  =mysql_query($s2);
		$ng =mysql_num_rows($q); 
		$fr =true; 
		$x  =$x==0?1:0;
	?>
	<tr class="xtrx">
		<td width="250px" rowspan="<?=$ng?>">
			<?=$r['kriteria'].($r['keterangan']==''?'':' : '.$r['keterangan'])?>
		</td>
		<?php
			$arr=array();
			while($h=mysql_fetch_assoc($q)){
				$krit = $r['replid'];
				$gol  = $h['replid'];
				$S3   = "SELECT * FROM psb_setbiaya WHERE pros='$pros' AND kel='$kel' AND krit='$krit' AND gol='$gol' LIMIT 0,1";
				$tq   = mysql_query($S3);
				if(mysql_num_rows($tq)>0){
					$rq       =mysql_fetch_assoc($tq);
					$daftar   =$rq['daftar'];
					$biaya    =$rq['nilai'];
					$spp      =$rq['spp'];
					$joiningf =$rq['joiningf']; /*epiii*/
					$arr[]=$rq;
					// var_dump($joiningf);exit();
				} else {
					$daftar =0;
					$biaya  =0;
					$spp    =0;
					$s4     ="INSERT INTO psb_setbiaya SET pros='$pros',krit='$krit',gol='$gol',daftar='$daftar',nilai='$biaya',spp='$spp'";
					mysql_query($s4);
				}
				
				if(!$fr){
					$fr=false; 
					$x=$x==0?1:0; 
					echo '<tr class="xtrx">';
				}
			?>
				<td class="xtd" width="*">
					<?=$h['golongan'].($h['keterangan']==''?'':' : '.$h['keterangan'])?>
				</td>
				<td width="150px" align="right">
					<?php if(admin_isoperator()){
						echo iTextC('daftar'.$r['replid'].'_'.$h['replid'],$daftar,'float:right;width:150px;text-align:right');
					} else {
						echo fRp($daftar);
					} ?>
					<input type="hidden" id="<?='tbiaya'.$r['replid'].'_'.$h['replid']?>" value="<?=$daftar?>" />
				</td>
				<td width="150px" align="right">
					<?php if(admin_isoperator()){
						echo iTextC('biaya'.$r['replid'].'_'.$h['replid'],$biaya,'float:right;width:150px;text-align:right');
					} else {
						echo fRp($biaya);
					} ?>
					<input type="hidden" id="<?='tbiaya'.$r['replid'].'_'.$h['replid']?>" value="<?=$biaya?>" />
				</td>
				<td width="150px" align="right">
					<?php if(admin_isoperator()){
						echo iTextC('spp'.$r['replid'].'_'.$h['replid'],$spp,'float:right;width:150px;text-align:right');
					} else {
						echo fRp($spp);
					} ?>
					<input type="hidden" id="<?='tspp'.$r['replid'].'_'.$h['replid']?>" value="<?=$spp?>" />
				</td>
				<!-- epiii -->
				<td width="150px" align="right">
					<?php if(admin_isoperator()){
						echo iTextC('joiningf'.$r['replid'].'_'.$h['replid'],$joiningf,'float:right;width:150px;text-align:right');
					} else {
						echo fRp($joiningf);
					} ?>
					<input type="hidden" id="<?='tjoiningf'.$r['replid'].'_'.$h['replid']?>" value="<?=$joiningf?>" />
				</td>
				<!-- epiii -->
			</tr>
			<?php
				$tfield.='~biaya'.$r['replid'].'_'.$h['replid'];
				$tfield2.='~spp'.$r['replid'].'_'.$h['replid'];
				$tfield3.='~daftar'.$r['replid'].'_'.$h['replid'];
				$tfield4.='~joiningf'.$r['replid'].'_'.$h['replid']; /*epiii*/
			}
			// echo '<pre>';
			// 	print_r($arr[0]['joiningf']);
			// echo '</pre>';
		?>
<?php }?>
</table>
<input type="hidden" id="tfields" value="<?=$tfield?>" />
<input type="hidden" id="tfields2" value="<?=$tfield2?>" />
<input type="hidden" id="tfields3" value="<?=$tfield3?>" />
<input type="hidden" id="tfields4" value="<?=$tfield4?>" /> <!-- epiii -->
<?php if(admin_isoperator()){?>
<div class="tbltopbar" style="width:100%;margin-top:10px">
	<button class="btnz" style="float:right;margin-left:4px" onclick="biaya_save()">Simpan</button>
</div>
<?php }?>
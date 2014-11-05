<?php notifbox(); ?>
<div id="loader2" class="loader" style="display:none"></div>
<table id="ctable" class="xtable" style="float:left" border="1" cellspacing="1px" cellpadding="4px" width="100%">
<tr>
	<th>Kriteria</th>
	<th>Golongan</th>
	<th class="alr" width="150px">Besar Biaya Pendaftaran</th>
	<th class="alr" width="150px">Besar Uang Pangkal</th>
	<th class="alr" width="150px">Besar Uang Sekolah</th>
</tr>
<?php $x=$ndata>2?1:0; $tfield='x'; $tfield2='x';
$t=mysql_query("SELECT * FROM psb_kriteria"); $ADMIN=admin_get(); 
while($r=mysql_fetch_array($t)){
	$q=mysql_query("SELECT * FROM psb_golongan");
	$ng=mysql_num_rows($q); $fr=true; $x=$x==0?1:0;
	?>
	<tr class="xtrx">
		<td width="250px" rowspan="<?=$ng?>"><?=$r['kriteria'].($r['keterangan']==''?'':' : '.$r['keterangan'])?></td>
	<?php
	while($h=mysql_fetch_array($q)){
		$krit=$r['replid'];
		$gol=$h['replid'];
		$tq=mysql_query("SELECT * FROM psb_setbiaya WHERE pros='$pros' AND kel='$kel' AND krit='$krit' AND gol='$gol' LIMIT 0,1");
		if(mysql_num_rows($tq)>0){
			$rq=mysql_fetch_array($tq);
			$daftar=$rq['daftar'];
			$biaya=$rq['nilai'];
			$spp=$rq['spp'];
		} else {
			$daftar=0;
			$biaya=0;
			$spp=0;
			mysql_query("INSERT INTO psb_setbiaya SET pros='$pros',krit='$krit',gol='$gol',daftar='$daftar',nilai='$biaya',spp='$spp'");
		}
		
		if(!$fr){$fr=false; $x=$x==0?1:0; echo '<tr class="xtrx">';}?>
		<td class="xtd" width="*"><?=$h['golongan'].($h['keterangan']==''?'':' : '.$h['keterangan'])?></td>
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
		</tr>
	<?php
		$tfield.='~biaya'.$r['replid'].'_'.$h['replid'];
		$tfield2.='~spp'.$r['replid'].'_'.$h['replid'];
		$tfield3.='~daftar'.$r['replid'].'_'.$h['replid'];
	}?>
<?php }?>
</table>
<input type="hidden" id="tfields" value="<?=$tfield?>" />
<input type="hidden" id="tfields2" value="<?=$tfield2?>" />
<input type="hidden" id="tfields3" value="<?=$tfield3?>" />
<?php if(admin_isoperator()){?>
<div class="tbltopbar" style="width:100%;margin-top:10px">
	<button class="btnz" style="float:right;margin-left:4px" onclick="biaya_save()">Simpan</button>
</div>
<?php }?>
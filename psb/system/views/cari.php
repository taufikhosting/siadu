<?php
require_once(MODDIR.'control.php');
$opt=gpost('opt');

// departemen >>
$dept=gpost('departemen');
$departemen=departemen_r($dept);
if($ADMIN_DEPT!=0)$dept=$ADMIN_DEPT;

$optcari=Array('nopendaftaran'=>'Nomor pendaftaran','nama'=>'Nama');
$ocari=gpost('optcari');
if($ocari=='')$ocari='nopendaftaran';
$qcari=gpost('qcari');

$finfo="";
$filt="";

if($ocari=='nopendaftaran'){
	$filt=" AND psb_calonsiswa.nopendaftaran='$qcari'";
	$finfo=" nomor pendaftaran <b>".$qcari."</b>.";
}
else if($ocari=='nama'){
	$filt=" AND (psb_calonsiswa.nama LIKE '$qcari %' OR psb_calonsiswa.nama LIKE '% $qcari' OR psb_calonsiswa.nama='$qcari')";
	$finfo=" nama <b>".$qcari."</b>.";
}

?>
<div class="tbltopbar" style="width:100%">
<div class="sfont" style="margin-top:4px;margin-right:10px;float:left"><b>Departemen:</b></div>
<?php if($ADMIN_DEPT==0){?>
<?=iSelect('departemen',$departemen,$dept,'float:left;margin-right:40px','cari_cari()')?>
<?php } else {?>
<div class="sfont" style="margin-top:4px;margin-right:40px;float:left"><b><?=departemen_name($dept)?></b></div>
<input type="hidden" id="departemen" value="<?=$dept?>"/>
<?php }?>
<div class="sfont" style="margin-top:4px;margin-right:10px;float:left"><b>Cari berdasarkan:</b></div>
<?=iSelect('optcari',$optcari,$ocari,'float:left;margin-right:10px')?>
<?=iText('qcari',$qcari,'float:left;width:300px;margin-right:10px','','onkeyup="cari_keyword(event)"')?>
<button class="find21" title="Cari" style="float:left;margin-top:2px" onclick="cari_cari()"></button>
</div>
<?php
if($qcari!=''){
// Query
$sql="SELECT psb_calonsiswa.* FROM psb_calonsiswa LEFT JOIN psb_proses ON psb_calonsiswa.proses=psb_proses.replid WHERE departemen='$dept'".$filt;
//echo $sql;
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);
if($ndata>0){
?>
<div class="tbltopbar" style="width:100%">
	<div class="infobox2">Menampilkan hasil pencarian <?=$finfo?> Ditemukan <?=$ndata?> data.</div>
</div>
<table id="ctable" class="xtable" border="1" cellspacing="1px" cellpadding="4px" width="100%" style="margin-top:5px">
<tr>
	<th>No Pendaftaran</th>
	<th>Nama Calon Siswa</th>
	<th>Kelompok</th>
	<th>Status</th>
	<th style="text-align:center">Pilihan</th>
</tr>
<?php
$x=0;
while($r=mysql_fetch_array($t)){
	if($ndata>2) $x=$x==0?1:0;
	
	$q=mysql_query("SELECT * FROM psb_kelompok WHERE replid='".$r['idkelompok']."' LIMIT 0,1");
	$h=mysql_fetch_array($q);
	?>
	<tr class="xtr<?=$x?>">
		<td><?=$r['nopendaftaran']?></td>
		<td><?=$r['nama']?></td>
		<td><?=$h['kelompok']?></td>
		<td>
			<?php if($r['aktif']=='1'){?>
			<a class="stat1">Aktif</a>
			<?php }else{?>
			<a class="stat0">Tidak Lulus</a>
			<?php }?>
		</td>
		<td style="text-align:center;width:60px">
			<button class="btn" title="Lihat detil" onclick="pendataan_showdetil(<?=$r['replid']?>)"><div class="bi_srcb">&nbsp;</div></button>
		</td>
	</tr>
<?php }?>
</table>
<?php }else{ ?>
<div class="infobox2">Tidak ditemukan data calon siswa <?=departemen_name($dept)?> dengan <?=$finfo?></div>
<?php }
}else{?>
<div class="infobox2">Silahkan masukkan kata kuci pencarian.</div>
<?php }?>
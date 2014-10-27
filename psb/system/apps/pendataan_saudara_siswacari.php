<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php');
$fmod='penempatan_saudara_pilihsiswa';
$xtable=new xtable($fmod);

$keyw=gpost('pskeyword');

?>
<div class="fftabbar">
<div class="fftab1" onclick="pendataan_saudara_siswacari(0)">Cari siswa</div>
<div class="fftab" onclick="pendataan_saudara_siswapilih(0)">Pilih siswa</div>
</div>
<div style="width:100%;float:left;margin-bottom:4px">
<?=iText('pskeyword',$keyw,'width:300px;float:left;margin-right:4px','nama atau nis siswa')?>
<button class="find21" title="Cari siswa" style="float:left;margin-top:2px" onclick="pendataan_saudara_siswacari(1)"></button>
</div>
<?php
notifbox();
if($keyw!=''){
$t=mysql_query("SELECT * FROM aka_siswa WHERE nama LIKE '%$keyw%' OR nis='$keyw' ORDER BY nama");
$xtable->ndata=mysql_num_rows($t);
if($xtable->ndata>0){
	//$xtable->optw='50px';
	$xtable->head('NIS','Nama','Kelas');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();

		$xtable->td($r['nis'],120);
		$xtable->td($r['nama']);
		$xtable->td(kelas_name($r['kelas']));
		if(admin_isoperator()) $s='<button class="btn" title="Lihat detil" onclick="pendataan_saudara_detil(\''.$r['replid'].'\')"><div class="bi_srcb">&nbsp;</div></button>&nbsp;<button class="btn" onclick="pendataan_saudara_setsiswa(\''.$r['nama'].'\',\''.departemen_name($r['departemen']).'\',\''.$r['tgllahir'].'\')">Pilih</button>~72px';
		else $s='<div style="height:23px;width:40px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
} else { $xtable->nodata_cust('Tidak data siswa dengan nama atau nis <b>'.$keyw.'</b>.'); }
} else { $xtable->nodata_cust('Cari siswa dengan nama atau nis.'); }
?>
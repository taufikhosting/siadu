<?php require_once(MODDIR.'xtable/xtable.php');
$fmod='pendataan_saudara';
$xtable=new xtable($fmod);
$xtable->row_strip=false;
// Query
$sql="SELECT * FROM psb_tmp_saudara WHERE sesid='".session_id()."' ORDER BY replid";
$t=mysql_query($sql); $xtable->ndata=mysql_num_rows($t);

if($xtable->ndata>0){
	$xtable->begin();
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		$s='<div class="psf12200">Nama: <b>'.$r['nama'].'</b></div>';
		if($r['tgllahir']!='0000-00-00')$s.='<div class="psf12200">Tanggal lahir: '.fftgl($r['tgllahir']).'</div>';
		if($r['sekolah']!='')$s.='<div class="psf12200">Sekolah: '.$r['sekolah'].'</div>';
		$xtable->td($s);
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{}
?>
<?php
require_once(MODDIR.'control.php');

$fmod='user';
$xtable=new xtable($fmod);

// Query
$t=mysql_query("SELECT admin.*,departemen.nama as ndepartemen FROM admin LEFT JOIN departemen ON departemen.replid=admin.departemen");
$xtable->ndata=mysql_num_rows($t);

$modul=array('psb'=>'Penerimaan Siswa Baru','aka'=>'Akademik','pus'=>'Perpustakaan','hrd'=>'Kepegawaian','sar'=>'Sarpras','keu'=>'Keuangan');
$ulevel=array(1=>'Administrator',2=>'Operator',3=>'Guest');

$xtable->btnbar_f('add','print');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Username','Level','Modul','Departemen','Nama');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['uname'],200);
		$xtable->td($ulevel[$r['level']],120);
		$xtable->td($modul[$r['app']],150);
		$xtable->td(($r['ndepartemen']==''?'Semua':$r['ndepartemen']),200);
		$xtable->td($r['nama']);
		if($r['replid']!=1){
		$xtable->opt_ud($r['replid']);
		} else {
		$xtable->td('&nbsp;');
		}
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>
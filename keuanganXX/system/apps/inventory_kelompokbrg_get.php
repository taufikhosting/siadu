<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'xtable/xtable.php');
$fmod='inventory_kelompokbrg';
$xform=new xform($fmod);

$grupbrg=gpost('grupbrg',0);
if($grupbrg==0){
	$t=mysql_query("SELECT replid FROM keu_grupbrg ORDER BY nama LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		$grupbrg=$r['replid'];
	}
}
$kelompokbrg=gpost('kelompokbrg',0);
if($kelompokbrg==0){
	$t=mysql_query("SELECT replid FROM keu_kelompokbrg WHERE grupbrg='$grupbrg' ORDER BY nama LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		$kelompokbrg=$r['replid'];
	}
}

$t=mysql_query("SELECT * FROM keu_kelompokbrg WHERE replid='$kelompokbrg'");
if(mysql_num_rows($t)>0){
	$r=mysql_fetch_array($t);
	$nkelompok=$r['nama'];
} else {
	$nkelompok='';
}
$xform->table_begin('<div id="box_kelompokbrg_nama" style="float:left;margin-top:2px;margin-left:6px;height:24px">'.$nkelompok.'</div>');
$xform->col_begin();
if($kelompokbrg!=0){
	$fmod='inventory_brg';
	$xtable=new xtable($fmod,'barang','','','inventory');
	$xtable->pageorder="kode";

	// Query
	$db=new xdb("keu_brg");
	if($kat!==0)$db->where("kelompokbrg='$kelompokbrg'");
	$t=$db->query();
	$xtable->ndata=mysql_num_rows($t);
	$t=$db->query($xtable->pageorder_sql('kode','nama'));

	$xtable->btnbar_f('add');

	if($xtable->ndata>0){
		// Table head
		$xtable->head('@Kode','@Nama Barang','@Tanggal diperoleh','@jumlah barang{100px}','Keterangan');
		
		$lkat=0;
		while($r=mysql_fetch_array($t)){
			$xtable->row_begin();
				$xtable->td($r['kode'],100);
				$xtable->td($r['nama'],250);
				$xtable->td(fftgl($r['tanggal']),120);
				$xtable->td($r['unit'].' '.$r['satuan'],100);
				$xtable->td(nl2br($r['keterangan']));
				$xtable->opt_ud($r['replid']);
		}$xtable->foot();
	}else{$xtable->nodata();}
}
$xform->table_end(0);
?>
<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'xtable/xtable.php'); require_once(MODDIR.'control.php');
$fmod="siswakelas";
$fform=new fform($fmod,'af',$cid,'Cari siswa');
$fform->globalkey='0';
$fform->reg['title_af']='<idata>';
$fform->reg['btnlabel_a_y']='Tutup';
//$fform->reg['btnlabel_a_n']='Tutup';
$fform->dimension(650);
$fform->ptop=30;
$fform->yes_act='close_fform()';
$fform->head('Daftar Pengecekan Item');
echo '<tr><td><div id="data_member" style="height:350px;overflow:auto">';

$tbl=stocktake_ctable();

$fmod='stocktake_daftar';
$xtable=new xtable($fmod,'item');
$xtable->noopt=true;
$xtable->pageorder="cek,ts";
$xtable->search_box_pos('l');
$xtable->search_keyon('barkode=>'.$tbl.'.barkode:EQ-0');

// Query
//$sql="SELECT * FROM ".$tbl." ORDER BY cek,ts";
$db=new xdb($tbl);
$db->field($tbl.":*","josh.pus_katalog:judul");
$db->join("buku","josh.pus_buku");
$db->joinother("josh.pus_buku","katalog","josh.pus_katalog");
$db->where($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql($tbl.".barkode","josh.pus_katalog.judul",$tbl.".cek,@".$tbl.".barkode",$tbl.".ts"));

$ncek_y=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl." WHERE cek='Y'"));
$ncek=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl));

if($ncek_y<$ncek){
echo '<div class="infobox">Item yang sudah di cek : <b>'.$ncek_y.'</b> dari <b>'.$ncek.'</b> item.</div>';
} else {
echo '<div class="infobox">Semua item sebanyak <b>'.$ncek.'</b> item sudah dicek.</div>';
}

$xtable->search_box('cari barkode');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@barkode','@judul','@Cek~C','@Waktu cek');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		$t1=mysql_query("SELECT pus_buku.barkode,pus_katalog.judul FROM pus_buku LEFT JOIN pus_katalog ON pus_katalog.replid=pus_buku.katalog WHERE pus_buku.replid='".$r['buku']."'");
		//echo 
		$r1=mysql_fetch_array($t1);
		
		$xtable->td($r['barkode'],120);
		$xtable->td(buku_judul($r['judul']));
		$s='<span style="color:'.($r['cek']=='Y'?'':'#ff0000').'"><b>'.$r['cek'].'</b></span>';
		$xtable->td($s,40,'c');
		$d=explode(" ",$r['ts']);
		if($r['cek']=='Y') $xtable->td(fftgl($d[0])." - ".$d[1],160);
		else  $xtable->td('-',160);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}

echo '</div></td></tr>';

$fform->foot(1,0);

 ?>
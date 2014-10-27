<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php');
$fmod='sirkulasi_peminjaman_form_buku_list';
$xtable=new xtable($fmod,'item','',3);
$xtable->search_keyon('kunci=>pus_buku.barkode:EQ|pus_katalog.judul:LIKE-0,1');
$xtable->search_box_pos('l');
$xtable->pageorder="pus_buku.barkode";
$xtable->use_select();
$xtable->select_noopt=true;
$xtable->select_cekfunc="sirkulasi_peminjaman_form_buku_list_cek(param)";

$lok=gpost('ff2_lokasi');
$lokasi=lokasi_r($lok);

$PSBar = new PSBar_2(100);
$PSBar->begin();
	if(count($lokasi)>0){
		$PSBar->selection('Lokasi',iSelect('ff2_lokasi',$lokasi,$lok,$PSBar->selws,"peminjaman_buku_get_cari(1)"));
	} else {
		$PSBar->end();
		hiddenval('pslokasi',$lok);
		lokasi_warn(0,'float:left');
		$PSBar->pass=false;
	}
$PSBar->end();
if($PSBar->pass){

$xtable->search_box('barkode atau judul item');
			  
$db=new xdb("pus_buku");
$db->field("pus_buku:replid","pus_buku:barkode","pus_katalog:judul");
$db->join("katalog","pus_katalog");
$db->where_and("pus_buku.lokasi='$lok'");
$db->where_and("pus_buku.status='1'");
$db->where_and("!( NOT EXISTS (SELECT pus_tpjm.replid FROM pus_tpjm WHERE pus_tpjm.buku=pus_buku.replid ) )");
$db->where_and($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('pus_buku.barkode','pus_katalog.judul'));

if($xtable->ndata>0){
	echo '<div style="width:100%;height:300px;max-height:300px;overflow:auto;float:left">';
	$xtable->head('@Barkode','@Judul','{44px}');
	$n=0;
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);

		$xtable->td($r['barkode'],100);
		$xtable->td(buku_judul($r['judul']));
		
		if(admin_isoperator()) $s='<button class="btn" onclick="xtable3_cekall(false);xtable3_sel('.$n.');sirkulasi_peminjaman_form_buku_form(\'a\',\'0\',true)">Pilih</button>~40px';
		else $s='<div style="height:23px;width:40px"></div>';
		$xtable->opt($r['replid'],$s);
		
		$n++;
	$xtable->row_end();}$xtable->foot();
	echo '</div>';
} else { $xtable->nodata_cust(); }
}
?>
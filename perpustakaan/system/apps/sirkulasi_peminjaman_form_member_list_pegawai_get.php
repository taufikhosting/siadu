<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php');

?>
<div style="float:left;width:100%;margin-bottom:20px;border-bottom:1px solid #01a8f7">
<div class="gptab" onclick="sirkulasi_peminjaman_form_member_list_siswa_get(0)">Siswa</div>
<div class="gptab1" onclick="sirkulasi_peminjaman_form_member_list_pegawai_get(0)">Pegawai</div>
<div class="gptab" onclick="sirkulasi_peminjaman_form_member_list_lain_get(0)">Member Luar</div>
</div>
<?php

$fmod='sirkulasi_peminjaman_form_member_list_pegawai';
$xtable=new xtable($fmod,'item','',3);
$xtable->search_box_pos('l');
$xtable->search_keyon('kunci=>hrd_pegawai.nip:EQ|hrd_pegawai.nama:LIKE-0,1');

/*
SELECT aka_siswa.replid, aka_siswa.nis, aka_siswa.nama, COUNT( pus_peminjaman.buku ) AS cnt
FROM aka_siswa
LEFT JOIN pus_peminjaman ON ( pus_peminjaman.member = aka_siswa.replid
AND pus_peminjaman.mtipe =  '1' ) 
GROUP BY aka_siswa.replid
*/

// Query
$db=new xdb('hrd_pegawai');
$db->field("hrd_pegawai:replid,nip,nama");
$db->where_and($xtable->search_sql_get());

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('hrd_pegawai.nip','hrd_pegawai.nama'));

$xtable->search_box('nip atau nama member');

if($xtable->ndata>0){
	echo '<div style="width:100%;height:300px;max-height:300px;overflow:auto;float:left">';
	$xtable->head('@!ID Member','@Nama','{44px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		$xtable->td($r['nip'],80);
		$xtable->td($r['nama']);
		
		if(admin_isoperator()) $s='<button class="btn" onclick="sirkulasi_peminjaman_form_member_set(2,'.$r['replid'].')">Pilih</button>~40px';
		else $s='<div style="height:23px;width:40px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot(0);
	echo '</div>';
	$xtable->foot_option();
}else{$xtable->nodata();}
?>
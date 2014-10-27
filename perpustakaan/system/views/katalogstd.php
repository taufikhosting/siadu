<?php
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;
$keyw=gpost('keyword'); $keyn=gpost('keyon');

$fmod='katalog';
$katalog_view=gpost('katalog_view');
hiddenval('katalog_view',$katalog_view);
hiddenval('opf','kat');

if($opt=='af'||$opt=='uf') require_once(VWDIR.'katalog_form.php');
else{
/*
   SELECT katalog.*, 
          COUNT(post_id) AS post_count
     FROM katalog 
LEFT JOIN blogger_posts ON katalog.blogger_id = blogger_posts.blogger_id
    WHERE katalog.AUX = 3
 GROUP BY katalog.blogger_id
 ORDER BY post_count
*/
$xtable = new xtable($fmod,'katalog');
$xtable->search_keyon('judul=>pus_katalog.judul-0',
			  'kode(kode klasifikasi)=>pus_klasifikasi.kode:EQ-1',
			  'pengarang(nama pengarang)=>pus_pengarang.nama:LIKE-2',
			  'penerbit(nama penerbit)=>pus_penerbit.nama:LIKE-3');
$xtable->pageorder="pus_katalog.judul";
// Query			  
$db=new xdb("pus_katalog");
$db->field("pus_katalog:replid,judul,klasifikasi,pengarang,penerbit,kota,tahunterbit,halaman,isbn,deskripsi","pus_klasifikasi:kode as n1,kode","pus_pengarang:nama as n2","pus_penerbit:nama as n3","COUNT(pus_buku.replid) as buku_count");
$db->join("replid","pus_buku","katalog");
$db->join("klasifikasi","pus_klasifikasi");
$db->join("pengarang","pus_pengarang");
$db->join("penerbit","pus_penerbit");
$db->where($xtable->search_sql_get());
$db->group("pus_katalog.replid");

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('judul','n1','n2','n3','buku_count'));

$SOUF=stocktake_unfinished();

$xtable->btnbar_begin();
	if($SOUF==0) $xtable->btnbar_add();
	else echo '<div class="warnbox">Perubahan katalog tidak dapat dilakukan selama proses stock opname berlangsung.</div>';
	
	$xtable->btnbar_print();
	echo '<button title="Tampilan daftar" class="btn" style="float:left;margin-right:4px" onclick="E(\'katalog_view\').value=\'\';katalog_get()"><div class="bi_lis">Daftar</div></button>';
	
	$xtable->search_box();
$xtable->btnbar_end();

$xtable->search_info();
$xtable->printable_info('KATALOG',5);

if($xtable->ndata>0){
// Table head
	$cols=0; $rows=0; $ncols=3; $n=0;
	echo '<table cellspacing="10px" cellpadding="0" border="0" width="100%">';
	
	while($r=mysql_fetch_array($t)){
		if($cols==0){
			echo '<tr>';
		}
		
		echo '<td width="'.(100/$ncols).'%"><a href="javascript:void(0)" onclick="katalog_form_view(\''.$r['replid'].'\')" class="katalog_box" style="display:block;text-decoration:none;position:relative;" onmouseout="EHide(\'katalog_box_opt'.$n.'\')" onmouseover="EShow(\'katalog_box_opt'.$n.'\')"><div id="katalog_box_opt'.$n.'" style="display:none;position:absolute;top:2px;right:2px"><button class="btn" title="Lihat Katalog" onclick="katalog_form_view(\''.$r['replid'].'\')"><div class="bi_srcb">&nbsp;</div></button>&nbsp;<button class="btn" title="Edit" onclick="katalog_form(\'uf\',\''.$r['replid'].'\')"><div class="bi_editb">&nbsp;</div></button>&nbsp;<button class="btn" title="Hapus" onclick="katalog_form(\'df\',\''.$r['replid'].'\')"><div class="bi_delb">&nbsp;</div></button>&nbsp;<button class="btn" title="Tambah koleksi baru" onclick="PCBCODE=201;katalog_form_view(\''.$r['replid'].'\')"><div class="bi_add">Koleksi</div></button></div><table cellspacing="10px" cellpadding="0"><tr><td>';
		
		$pubinfo=$r['kota'];
		if($pubinfo!='')$pubinfo.=' : ';
		$pubinfo.=$r['n3'];
		if($r['n3']!='')$pubinfo.=', ';
		$pubinfo.=$r['tahunterbit'];
		
		$des='';
		if($r['deskripsi']!=''){
			$des.='<br/><br/>';
			$des.=strtoupper(str_firstword($r['deskripsi'])).'<br/><br/>'.$r['deskripsi'];
		}
		
		echo '<table cellspacing="0px" cellpadding="0">',
				'<tr valign="top">',
					'<td width="70px" style="font:11px '.MSTYPEFONT.'">',$r['kode'],'<br/>',strtoupper(substr($r['n2'],0,3)),'<br/>',strtolower(substr($r['judul'],0,1)),'</td>',
					'<td style="font:11px '.MSTYPEFONT.'"><br/>',$r['n2'],'<br/><br/>',buku_judul($r['judul']),' / ',$r['n2'],' -- ',$pubinfo,'<br/><br/>',$r['halaman'],' Hlm<br/><br/>ISBN ',$r['isbn'],$des,'</td>',
				'</tr>',
			'</table>';
		
		echo '</td></tr></table></a></td>';
		
		$cols++; $n++;
		
		if($cols==$ncols){
			$cols=0;
			$rows++;
			echo '</tr>';
		}		
	}
	if($cols<$ncols){
		for($i=$cols;$i<$ncols;$i++){
			echo '<td><div style="height:250px;width:100%"></div></td>';
		}
		echo '</tr>';
	}
	echo '</table>';
	
	echo '<input type="hidden" id="xtable_usesearch" value="1">';
} else { $xtable->nodata(); }
}
?>
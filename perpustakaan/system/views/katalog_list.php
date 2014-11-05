<?php
$xtable->head('@Judul','@Klasifikasi','@Pengarang','@Penerbit','@Callnumber','@Jumlah koleksi{C,100px}',($SOUF==0?'':'{40px}'));
while($r=mysql_fetch_array($t)){$xtable->row_begin();
			
	$xtable->td(buku_judul($r['judul']));
	$xtable->td(klasifikasi_name($r['klasifikasi']),200);
	$xtable->td($r['n2'],120);
	$xtable->td($r['n3'],120);
	$xtable->td($r['callnumber'],80);
	$xtable->td($r['buku_count'],100,'c');
	if($SOUF==0){
		$s='<button class="btn" title="Tambah koleksi baru" onclick="PCBCODE=201;katalog_form_view(\''.$r['replid'].'\')"><div class="bi_add">Koleksi</div></button>~60';
		$xtable->opt($r['replid'],'v','u','d',$s);
	} else {
		$xtable->opt($r['replid'],'v');
	}
	
$xtable->row_end();}$xtable->foot();
?>
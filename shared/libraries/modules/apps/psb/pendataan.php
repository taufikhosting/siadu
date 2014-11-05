<?php
function pendataan_warn($a=0){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan calon siswa pada proses penerimaan ini.<br/>Silahkan <a class="linkb" href="#&pendataan" onclick="PCBCODE=5;openPage('.app_page_getindex('pendataan').',\'pendataan\',false,\'departemen=\'+E(\'departemen\').value+\'&proses=\'+E(\'proses\').value+\'&kelompok=\'+E(\'kelompok\').value)">menambah data calon siswa baru</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox">Tidak ditemukan data calon siswa.<br/>Silahkan menghubungi bagian penerimaan siswa baru untuk menambah data calon siswa baru.</div>';
	}
}
?>
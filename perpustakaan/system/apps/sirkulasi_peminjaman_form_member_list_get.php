<?php
$fmod='sirkulasi_peminjaman_form_member_list';
$mtipe=gpost('mtipe',0);
hiddenval('fftam_mtipe',$mtipe);
?>
<div style="float:left;width:100%;margin-bottom:20px;border-bottom:1px solid #01a8f7">
<div class="fftab<?=($mtipe==1?'1':'')?>" onclick="sirkulasi_peminjaman_form_member_list_siswa_get(0)">Siswa</div>
<div class="fftab<?=($mtipe==2?'1':'')?>" onclick="sirkulasi_peminjaman_form_member_list_pegawai_get(0)">Pegawai</div>
<div class="fftab<?=($mtipe==3?'1':'')?>" onclick="sirkulasi_peminjaman_form_member_list_lain_get(0)">Member luar</div>
</div>
<?php
	if($mtipe==2) require_once(APPDIR.'sirkulasi_peminjaman_form_member_list_lain_get.php');
	else if($mtipe==3) require_once(APPDIR.'sirkulasi_peminjaman_form_member_list_lain_get.php');
	else require_once(APPDIR.'sirkulasi_peminjaman_form_member_list_siswa_get.php');
?>
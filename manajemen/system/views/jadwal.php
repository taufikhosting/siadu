<?php
appmod_use('aka/tahunajaran');
$fmod='pelajaran';

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){
$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);
// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);

	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun ajaran',iSelect('tahunajaran',$tahunajaran,$tajar,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tahunajaran',$tajar);
		tahunajaran_warn(0,'float:left');
		$PSBar->pass=false;
	}

$PSBar->end();
hiddenval('sks_kelas',0);
hiddenval('sks_picked',0);
hiddenval('sks_picked_kode',0);
hiddenval('sks_picked_kelas',0);
hiddenval('sks_picked_hari',0);
hiddenval('sks_picked_jam',0);
hiddenval('sks_picked_opt','');
hiddenval('sks_picked_stat',0);
hiddenval('sks_todrop',0);
hiddenval('sks_todel',0);
?>
<div id="jadwal_notifbox" style="position: fixed; width: 100%; top: 140px; left: 0px; padding-top: 0px; padding-bottom: 0px;display:none"><table style="position:relative;margin:auto" cellspacing="0" cellpadding="0"><tr><td><div id="jadwal_notifmsg" style="position:relative;font:12px <?=SFONT?>;color:#444;cursor:default;padding:4px 8px 2px 20px;border:1px solid #ffc000;border-radius:2px;background:url('<?=IMGR?>info.png') 4px 6px no-repeat #fff8d6;line-height:150%;box-shadow:0px 2px 5px rgba(0,0,0,0.4);margin:auto"><b>Loading . . .</b></div></td></tr></table></div>

<table cellspacing="0px" cellpadding="0" width="100%" style="border-collapse:collapse"><tr valign="top">
<td width="100px" style="border:1px solid #01a8f7;">
	<div style="float:left;width:100%">
		<div style="float:left;width:100%;background:#01a8f7">
			<div class="sfont" style="height:16px;margin:4px;color:#fff"><b>Data Kelas:</b></div>
		</div>
		<div id="box_sks"><?php require_once(APPDIR.'sks_get.php'); ?></div>
	</div>
</td>
<td style="border:1px solid #01a8f7;position:relative">
	<div style="float:left;width:100%">
		<div style="float:left;width:100%;display:none">
			<div style="float:left;margin:4px">
				<button class="btn" style="float:left;margin-right:4px"><div class="bi_edit">Jumlah jam per hari</div></button>
				<button class="btnz" style="float:left;margin-right:4px">Susun jadwal &raquo;</button>
			</div>
		</div>
		<div style="float:left;width:100%"><div id="box_jadwal_sks" style="margin:5px">
		<?php require_once(APPDIR.'jadwal_sks_get.php'); ?>
		</div></div>
	</div>
	<div id="jadwal_trashcan" class="jadwal_trash" style="display:none">
		
	</div>
</td>
</tr></table>

<?php
} else { departemen_warn(); }?>
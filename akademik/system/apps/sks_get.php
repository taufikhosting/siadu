<?php
if(!isset($tajar) || empty($tajar)){
	$tajar=gpost('tahunajaran');
}
$t=mysql_query("SELECT * FROM aka_kelas WHERE tahunajaran='$tajar'");
while($r=mysql_fetch_array($t)){ ?>
	<div id="box_sks_allstock_<?=$r['replid']?>" class="jadwal_stock">
		<div style="float:left;width:106px;height:24px;background:#ddd;padding:1px">
			<div class="sfont" style="float:left;margin-top:5px;margin-left:5px"><b><?=$r['kelas']?></b></div>
			<button title="Tambah pelajaran" class="btn" style="float:right" onclick="E('sks_kelas').value=<?=$r['replid']?>;sks_form('af')"><div class="bi_addb">&nbsp;</div></button>
		</div>
		<div id="box_sks_substock_<?=$r['replid']?>" style="float:left;width:100%">
	<?php
	$t1=mysql_query("SELECT aka_sks.replid FROM aka_sks WHERE aka_sks.tahunajaran='$tajar' AND aka_sks.kelas='".$r['replid']."'");
	if(mysql_num_rows($t1)>0){
		$t1=mysql_query("SELECT aka_sks.replid,aka_guru.kode as kodeguru,hrd_pegawai.nama as npegawai,aka_pelajaran.kode,aka_pelajaran.nama as npelajaran FROM aka_sks LEFT JOIN aka_pelajaran ON aka_pelajaran.replid=aka_sks.pelajaran LEFT JOIN aka_guru ON aka_guru.replid=aka_sks.guru LEFT JOIN hrd_pegawai ON hrd_pegawai.replid=aka_guru.pegawai WHERE aka_sks.tahunajaran='$tajar' AND aka_sks.kelas='".$r['replid']."' AND (NOT EXISTS (SELECT aka_jadwal.replid FROM aka_jadwal WHERE aka_jadwal.sks=aka_sks.replid )) ");
		if(mysql_num_rows($t1)>0){ $n=0;
		while($r1=mysql_fetch_array($t1)){?>
		
		<div style="float:left;width:28px;margin:1px;<?=($n>0?'margin-left:-6px;':'')?>height:34px;background:#f0f0f0;border:1px solid #ccc">
		<div id="box_sks_stock_<?=$r1['replid']?>" style="float:left;width:30px;height:36px;margin-top:-1px;margin-left:-1px">
			<div id="sks_stock_<?=$r1['replid']?>" class="sfont" style="position:relative;float:left;width:28px;height:34px;border:1px solid #aaa;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;background:#ffff00" onmousedown="jadwal_sks_pick(<?=$r1['replid']?>,'<?=('<b>'.$r1['kode'].'</b><br/>'.substr($r1['npegawai'],0,3))?>',<?=$r['replid']?>)" title="<?=$r1['npelajaran']?> - <?=$r1['npegawai']?>" onmouseup="jadwal_sks_drop()">
				<div style="margin:2px;white-space:nowrap;overflow:hidden;text-align:center">
				<b><?=$r1['kode']?></b><br/><span style="font-size:11px"><?=substr($r1['npegawai'],0,3)?></span>
				</div>
			</div>
		</div>
		</div>
		
	<?php $n++;if($n==4)$n=0;}
		} else { echo '<div class="infobox" style="color:#aaa">Semua sudah dijadwalkan.</div>'; }
	} else {
		echo '<div class="infobox" style="color:#aaa">Tidak ada data.</div>';
	}
	?>
		</div>
	</div>
<?php
}
?>
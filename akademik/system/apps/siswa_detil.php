<?php
require_once(MODDIR.'date.php');

$replid=gpost('id');
$cid=$replid;
//echo 'SISWA ID:'.$replid.' OR '.$cid;
$t=mysql_query("SELECT * FROM aka_siswa WHERE replid='$replid' LIMIT 0,1");
//echo '  NUM SIS:'.mysql_num_rows($t);

$r=mysql_fetch_array($t);
$fwidth=700;

if($r['photo']=='') $r['photo']='nophoto.png';

$proses=mysql_fetch_array(mysql_query("SELECT * FROM psb_proses WHERE replid='".$r['proses']."' LIMIT 0,1"));
$kelompok=mysql_fetch_array(mysql_query("SELECT * FROM psb_kelompok WHERE replid='".$r['kelompok']."' LIMIT 0,1"));
$kondisi=mysql_fetch_array(mysql_query("SELECT * FROM psb_kondisisiswa WHERE replid='".$r['kondisi']."' LIMIT 0,1"));
$status=mysql_fetch_array(mysql_query("SELECT * FROM psb_statussiswa WHERE replid='".$r['status']."' LIMIT 0,1"));
$agama=mysql_fetch_array(mysql_query("SELECT * FROM mst_agama WHERE replid='".$r['agama']."' LIMIT 0,1"));
$jkelamin=Array('L'=>'Laki-laki','P'=>'Perempuan'); $a=0;
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt" align="center" style="padding-top:10px">
<div id="fformbox" class="fformbox" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<table cellspacing="25px" cellpadding="0" width="100%" height="100%"><tr><td>
	<div style="cursor:default;text-align:left;color:<?=CDARK?>;font:24px <?=SFONTL?>;float:left;width:100%;margin-bottom:20px">
		Data Siswa
		<div style="float:right">
			<button class="btn" title="Tutup" style="float:right;margin-left:4px" onclick="close_fform3()"><div class="bi_canb">&nbsp;</div></button>
			<button class="btn" title="Cetak" style="float:right" onclick="siswa_detil_print('<?=$r['replid']?>','<?=$r['nis']?>')"><div class="bi_prib">&nbsp;</div></button>
		</div>
	</div>
	<div style="float:left;width:100%;padding-bottom:10px;border-bottom:1px solid #ddd;margin-bottom:10px;">
	<div style="float:left;width:100%">
		<div class="xrowl">
			<div class="xlbl" style="background:#01a8f7;border-radius:3px;width:100%;margin-left:-4px;margin-bottom:10px;padding-left:4px;padding-bottom:2px"><span style="color:#fff;font:18px <?=SFONTL?>"><b><?=strtoupper($r['nama'])?></b></span></div>
		</div>
		<div class="xrowl" style="display:block">
			<div class="xlbl" style="width:200px">Departemen</div><div class="xlbl">: <?=departemen_name($proses['departemen'])?></div>
		</div>
		<div class="xrowl">
			<div class="xlbl" style="width:200px">NIS</div><div class="xlbl">: <?=$r['nis']?></div>
		</div>
		<div class="xrowl">
			<div class="xlbl" style="width:200px">NISN</div><div class="xlbl">: <?=$r['nisn']?></div>
		</div>
	</div>
	
	</div>
	
	<div style="float:left;width:100%;padding-bottom:10px;margin-bottom:10px;height:300px;overflow:auto">
	<div style="float:left;width:100%;margin-bottom:0px">
	<div style="float:left">
		<div class="xrowl2" style="margin-bottom:25px"><div class="xlbl"><b>Data Pribadi Siswa:</b></div></div>
		<div class="xrowl2"><div class="xlbl" style="width:200px">Nama Lengkap</div><div class="xlbl">: <?=$r['nama']?></div></div>
		<div class="xrowl2"><div class="xlbl" style="width:200px">Jenis kelamin</div><div class="xlbl">: <?=$jkelamin[$r['kelamin']]?></div></div>
		<div class="xrowl2"><div class="xlbl" style="width:200px">Tempat lahir</div><div class="xlbl">: <?=$r['tmplahir']?></div></div>
		<div class="xrowl2"><div class="xlbl" style="width:200px">Tanggal lahir</div><div class="xlbl">: <?=fftgl($r['tgllahir'])?></div></div>
		<div class="xrowl2"><div class="xlbl" style="width:200px">Agama</div><div class="xlbl">: <?=$agama['agama']?></div></div>
		<div class="xrowl2"><div class="xlbl" style="width:200px">Alamat rumah</div><div class="xlbl">: <?=$r['alamat']?></div></div>
		<div class="xrowl2"><div class="xlbl" style="width:200px">Telepon rumah</div><div class="xlbl">: <?=$r['telpon']?></div></div>
	</div>
	<div style="float:right">
		<div style="width:140px;height:200px;margin-right:30px;margin-top:20px">
			<div style="border:4px solid #ffffff;width:140px;box-shadow: 0px 2px 5px rgba(0, 0, 0, .25)">
				<?php
				$q=mysql_query("SELECT LENGTH(photo) AS psize FROM aka_siswa WHERE replid='".$r['replid']."'");
				$h=mysql_fetch_array($q);
				if($h['psize']>0){ ?>
				<img src="photo/siswa.php?id=<?=$r['replid']?>" width="140px"/>
				<?php }else{?>
				<div style="width:140px;height:150px;background:#f0f0f0"></div>
				<?php }?>
			</div>
		</div>
	</div>
	</div>
	<div style="float:left;width:100%;margin-bottom:20px">
		<div class="xrowl" style="margin-bottom:10px"><div class="xlbl"><b>Kesehatan Siswa:</b></div></div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Golongan Darah</div><div class="xlbl">: <?=$r['darah']?></div></div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Penyakit yang pernah diderita</div><div class="xlbl">: <?=$r['kesehatan']?></div></div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Alergi terhadap</div><div class="xlbl">: <?=$r['ketkesehatan']?></div></div>
	</div>
	<div style="float:left;width:100%;margin-bottom:20px">
		<div class="xrowl" style="margin-bottom:10px"><div class="xlbl"><b>Data Orang Tua Siswa:</b></div></div>
		<?php
		$t=mysql_query("SELECT * FROM aka_siswa_ayah WHERE siswa='$cid'");
		$ayah=mysql_fetch_array($t);
		$t=mysql_query("SELECT * FROM aka_siswa_ibu WHERE siswa='$cid'");
		$ibu=mysql_fetch_array($t);
		?>
		<div class="xrowl"><div class="xlbl" style="width:200px">&nbsp;</div>
			<div class="xlbl" style="width:200px;margin-right:4px">&nbsp;&nbsp;Ayah</div><div class="xlbl">Ibu</div>
		</div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Nama</div>
			<div class="xlbl" style="width:200px;margin-right:4px">: <?=$ayah['nama']?></div><div class="xlbl"><?=$ibu['nama']?></div>
		</div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Kebangsaan</div>
			<div class="xlbl" style="width:200px;margin-right:4px">: <?=$ayah['warga']?></div><div class="xlbl"><?=$ibu['warga']?></div>
		</div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Tempat Lahir</div>
			<div class="xlbl" style="width:200px;margin-right:4px">: <?=$ayah['tmplahir']?></div><div class="xlbl"><?=$ibu['tmplahir']?></div>
		</div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Tanggal Lahir</div>
			<div class="xlbl" style="width:200px;margin-right:4px">: <?=fftgl($ayah['tgllahir'])?></div><div class="xlbl"><?=fftgl($ibu['tgllahir'])?></div>
		</div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Pekerjaan</div>
			<div class="xlbl" style="width:200px;margin-right:4px">: <?=$ayah['pekerjaan']?></div><div class="xlbl"><?=$ibu['pekerjaan']?></div>
		</div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Telepon Orangtua</div>
			<div class="xlbl" style="width:200px;margin-right:4px">: <?=$ayah['telpon']?></div><div class="xlbl"><?=$ibu['telpon']?></div>
		</div>
		<div class="xrowl"><div class="xlbl" style="width:200px">PIN BB Orangtua</div>
			<div class="xlbl" style="width:200px;margin-right:4px">: <?=$ayah['pinbb']?></div><div class="xlbl"><?=$ibu['pinbb']?></div>
		</div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Email Orang Tua</div>
			<div class="xlbl" style="width:200px;margin-right:4px">: <?=$ayah['email']?></div><div class="xlbl"><?=$ibu['email']?></div>
		</div>
	</div>
	<div style="float:left;width:100%;margin-bottom:20px">
		<div class="xrowl" style="margin-bottom:10px"><div class="xlbl"><b>Data Keluarga Siswa:</b></div></div>
		<?php 
			$t=mysql_query("SELECT * FROM aka_siswa_keluarga WHERE siswa='$cid'");
			$keluarga=mysql_fetch_array($t);
		?>
		<div class="xrowl"><div class="xlbl" style="width:200px">Tanggal perkawinan orang tua </div><div class="xlbl">: <?=fftgl($keluarga['tglnikah'])?></div></div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Nama Kakek</div><div class="xlbl">: <?=$keluarga['kakek-nama']?></div></div>
		<!--div class="xrowl"><div class="xlbl" style="width:200px">Tanggal lahir Kakek</div><div class="xlbl">: <?=fftgl($keluarga['kakek-tgllahir'])?></div></div-->
		<div class="xrowl"><div class="xlbl" style="width:200px">Nama Nenek</div><div class="xlbl">: <?=$keluarga['nenek-nama']?></div></div>
		<!--div class="xrowl"><div class="xlbl" style="width:200px">Tanggal lahir Nenek</div><div class="xlbl">: <?=fftgl($keluarga['nenek-tgllahir'])?></div></div-->
	</div>
	<div style="float:left;width:100%;margin-bottom:20px">
		<div class="xrowl" style="margin-bottom:10px"><div class="xlbl"><b>Saudara Siswa:</b></div></div>
		<?php
			$t=mysql_query("SELECT * FROM aka_siswa_saudara WHERE siswa='$cid' ORDER BY replid");
			while($saudara=mysql_fetch_array($t)){
			?>
			<div class="xrowl"><div class="xlbl" style="width:200px">Nama saudara <?=$i?></div><div class="xlbl">: <?=$saudara['nama']?></div></div>
			<div class="xrowl"><div class="xlbl" style="width:200px">Tanggal lahir saudara <?=$i?></div><div class="xlbl">: <?=fftgl($saudara['tgllahir'])?></div></div>
			<div class="xrowl"><div class="xlbl" style="width:200px">Sekolah saudara <?=$i?></div><div class="xlbl">: <?=$saudara['sekolah']?></div></div>
			<?php
			}
		?>
	</div>
	<div style="float:left;width:100%;margin-bottom:20px">
		<div class="xrowl" style="margin-bottom:10px"><div class="xlbl"><b>Dalam Kondisi Mendesak, orang yang dapat dihubungi (selain orang tua):</b></div></div>
		<?php 
			$t=mysql_query("SELECT * FROM aka_siswa_kontakdarurat WHERE siswa='$cid'");
			$kontakdarurat=mysql_fetch_array($t);
		?>
		<div class="xrowl"><div class="xlbl" style="width:200px">Nama </div><div class="xlbl">: <?=$kontakdarurat['nama']?></div></div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Hubungan</div><div class="xlbl">: <?=$kontakdarurat['hubungan']?></div></div>
		<div class="xrowl"><div class="xlbl" style="width:200px">Nomor yang dapat dihubungi</div><div class="xlbl">: <?=$kontakdarurat['telpon']?></div></div>
	</div>
	</div>
	</td></tr></table>
</div>
</td></tr></table>
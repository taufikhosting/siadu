<?php
if(!isset($tajar) || empty($tajar)){
	$tajar=gpost('tahunajaran');
}

$jmlhari=5; $jmljam=7;
$namahari=array(1=>'Senin',2=>'Selasa',3=>'Rabu',4=>'Kamis',5=>'Jum\'at',6=>'Sabtu',7=>'Minggu');

echo '<table cellspacing="0" cellpadding="0" style="table-layout:fixed;border-collapse:collapse" width="100%">';
echo '<tr>';
echo '<td width="30px" rowspan="2" align="center" style="border:1px solid #999"><span class="sfont">Kelas</span></td>';
for($i=1;$i<=$jmlhari;$i++){
	echo '<td align="center" colspan="'.$jmljam.'" style="table-layout:fixed;border:1px solid #999"><span class="sfont">'.$namahari[$i].'</span></td>';
}
echo '</tr>';
echo '<tr>';
for($i=1;$i<=$jmlhari;$i++){
	for($l=1;$l<=$jmljam;$l++){
		echo '<td id="box_jsj_'.$i.'_'.$l.'" align="center" style="table-layout:fixed;border:1px solid #999"><span class="sfont">'.$l.'</span></td>';
	}
}
echo '</tr>'; $klsid='';
$t=mysql_query("SELECT * FROM aka_kelas WHERE tahunajaran='$tajar'");
while($r=mysql_fetch_array($t)){
	if($klsid!='')$klsid.=',';$klsid.=$r['replid'];
	echo '<tr id="box_jsr_'.$r['replid'].'" class="jadwal_row" height="31px"><td id="box_jsk_'.$r['replid'].'" align="center"><span class="sfont">'.$r['kelas'].'</span></td>';
	for($h=1;$h<=$jmlhari;$h++){
		for($j=1;$j<=$jmljam;$j++){
			$ts=mysql_query("SELECT * FROM aka_jadwal_set WHERE tahunajaran='$tajar' AND hari='$h' AND jam='$j' LIMIT 0,1");
			if(mysql_num_rows($ts)>0){
				$rs=mysql_fetch_array($ts);
				$jak=$rs['aktif'];
			} else {
				mysql_query("INSERT INTO aka_jadwal_set SET tahunajaran='$tajar', hari='$h', jam='$j', aktif='1'");
				$jak=1;
			}
			if($jak==1){
				$t1=mysql_query("SELECT aka_jadwal.*,aka_jadwal.sks,aka_pelajaran.nama as npelajaran, aka_pelajaran.kode,hrd_pegawai.nama as npegawai FROM aka_jadwal LEFT JOIN aka_sks ON aka_sks.replid=aka_jadwal.sks LEFT JOIN aka_pelajaran ON aka_pelajaran.replid=aka_sks.pelajaran LEFT JOIN aka_guru ON aka_guru.replid=aka_sks.guru LEFT JOIN hrd_pegawai ON hrd_pegawai.replid=aka_guru.pegawai WHERE aka_jadwal.tahunajaran='$tajar' AND aka_jadwal.kelas='".$r['replid']."' AND aka_jadwal.hari='$h' AND aka_jadwal.jam='$j' LIMIT 0,1");
				if(mysql_num_rows($t1)>0){
					$r1=mysql_fetch_array($t1);
					$kode=$r1['kode'].'<br/>'.substr($r1['npegawai'],0,3);
					$s='<div title="'.$r1['npelajaran'].' - '.$r1['npegawai'].'" id="box_jsd_'.$r1['sks'].'" class="jadwal_td_in" onmousedown="jadwal_sks_repick('.$r1['sks'].',\''.$kode.'\','.$r['replid'].')" onmouseup="jadwal_sks_drop()">'.$kode.'</div>';
				} else {
					$s='';
				}
				echo '<td id="box_jss_'.$r['replid'].'_'.$h.'_'.$j.'" align="center">'.$s.'</td>';
			} else {
				echo '<td align="center" style="background:#ddd !important;border-color:#999 !important">x</td>';
			}
		}
	}
	echo '</tr>';
}
echo '</table>';
hiddenval('jadwalkelasid',$klsid);
?>
<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php');
appmod_use('aka/angkatan','aka/guru');

$fmod='presensiguru_list';

$tajar=gpost('tahunajaran');
$tanggal=gpost('tanggal');
$tgl=explode("-",$tanggal);
$dim=cal_days_in_month(CAL_GREGORIAN,intval($tgl[1]),intval($tgl[0]));
$tgl_f=$tgl[0]."-".$tgl[1]."-1";
$tgl_c=date("Y-m-d");
$tgl_l=$tgl[0]."-".$tgl[1]."-".$dim;
$tgl_cm=$tgl[0]."-".$tgl[1]."-";

if($opt=='af'){
$xtable=new xtable($fmod,'siswa','',2);
$xtable->search_keyon('kunci=>hrd_pegawai.nama:LIKE-0');
$xtable->search_box_pos('l');
$xtable->pageorder="hrd_pegawai.nama";
$xtable->noopt=true;
$xtable->use_select();

$db=guru_db_bytahunajaran($tajar);
$db->where_and($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('hrd_pegawai.nama'));

if($xtable->ndata>0){
	echo '<div style="width:100%;height:300px;max-height:300px;overflow:auto;float:left">';
	$xtable->head('@nama','presensi{C}','Keterangan');
	$n=0;
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);

		//$xtable->td($r['nis'],100);
		$xtable->td($r['npegawai'],200);
		
		$t1=mysql_query("SELECT absen,keterangan FROM aka_absen_guru WHERE guru='".$r['replid']."' AND tanggal='".$tanggal."'");
		if(mysql_num_rows($t1)>0){
			$r1=mysql_fetch_array($t1);
			$absen=$r1['absen'];
			$info=$r1['keterangan'];
		} else {
			$absen='';
			$info='';
		}
		
$s='<button id="presensi_btn_H_'.$r['replid'].'" class="presensi_btn'.($absen=='H'?'_H':'').'" onclick="xtable2_cekall(false);presensiguru_list_get_setabsen('.$r['replid'].',\'H\')"><b>H</b></button>';
$s.='&nbsp;<button id="presensi_btn_S_'.$r['replid'].'" class="presensi_btn'.($absen=='S'?'_S':'').'" onclick="xtable2_cekall(false);presensiguru_list_get_setabsen('.$r['replid'].',\'S\')"><b>S</b></button>';
$s.='&nbsp;<button id="presensi_btn_I_'.$r['replid'].'" class="presensi_btn'.($absen=='I'?'_I':'').'" onclick="xtable2_cekall(false);presensiguru_list_get_setabsen('.$r['replid'].',\'I\')"><b>I</b></button>';
$s.='&nbsp;<button id="presensi_btn_A_'.$r['replid'].'" class="presensi_btn'.($absen=='A'?'_A':'').'" onclick="xtable2_cekall(false);presensiguru_list_get_setabsen('.$r['replid'].',\'A\')"><b>A</b></button>';

		//$xtable->td($s,110,'c');
		echo '<td style="width:110px;text-align:center">'.$s.'</td>';
		$s=iText('keterangan_'.$r['replid'],$r1['keterangan'],'width:100%');
		echo '<td>'.$s.'</td>';
		hiddenval('absen_'.$r['replid'],$absen);
		$n++;
	$xtable->row_end();}
	
$s='<div style="float:left">';
//$s.='<button class="presensi_btn" onclick="presensiguru_list_get_setabsen_sel(\'\')"><b>&nbsp;</b></button>';
$s.='<button class="presensi_btn" onclick="presensiguru_list_get_setabsen_sel(\'H\')"><b>H</b></button>';
$s.='&nbsp;<button class="presensi_btn" onclick="presensiguru_list_get_setabsen_sel(\'S\')"><b>S</b></button>';
$s.='&nbsp;<button class="presensi_btn" onclick="presensiguru_list_get_setabsen_sel(\'I\')"><b>I</b></button>';
$s.='&nbsp;<button class="presensi_btn" onclick="presensiguru_list_get_setabsen_sel(\'A\')"><b>A</b></button>';
$s.='</div>';

	$xtable->select_opt='<div class="sfont" style="width:164px;float:left;margin-top:4px;margin-left:0px;margin-right:5px">set presensi guru yang dipilih:</div>'.$s;
	$xtable->foot(0);
	echo '</div>';
	$xtable->foot_option();
} else { $xtable->nodata(); }

} else { // Per guru
$xtable=new xtable($fmod,'guru','',2);
$xtable->search_keyon('kunci=>hrd_pegawai.nama:LIKE-0');
$xtable->search_box_pos('l');
$xtable->pageorder="hrd_pegawai.nip";
$xtable->noopt=true;
$xtable->use_select();

echo '<div style="width:100%;height:300px;max-height:300px;overflow:auto;float:left">';
	$xtable->head('Tgl{C}','presensi{C}','Keterangan');
	for($i=1;$i<=$dim;$i++){ $xtable->row_begin($i);
		//$ctgl=$tgl_cm.$i;
		$r=array('replid'=>$i);
		$xtable->td($i,40,'c');
		
		$t1=mysql_query("SELECT absen,keterangan FROM aka_absen_guru WHERE guru='".$cid."' AND tanggal='".$tgl_cm.$i."'");
		if(mysql_num_rows($t1)>0){
			$r1=mysql_fetch_array($t1);
			$absen=$r1['absen'];
			$info=$r1['keterangan'];
		} else {
			$absen='';
			$info='';
		}
		
$s='<button id="presensi_btn_H_'.$r['replid'].'" class="presensi_btn'.($absen=='H'?'_H':'').'" onclick="xtable2_cekall(false);presensiguru_list_get_setabsen('.$r['replid'].',\'H\')"><b>H</b></button>';
$s.='&nbsp;<button id="presensi_btn_S_'.$r['replid'].'" class="presensi_btn'.($absen=='S'?'_S':'').'" onclick="xtable2_cekall(false);presensiguru_list_get_setabsen('.$r['replid'].',\'S\')"><b>S</b></button>';
$s.='&nbsp;<button id="presensi_btn_I_'.$r['replid'].'" class="presensi_btn'.($absen=='I'?'_I':'').'" onclick="xtable2_cekall(false);presensiguru_list_get_setabsen('.$r['replid'].',\'I\')"><b>I</b></button>';
$s.='&nbsp;<button id="presensi_btn_A_'.$r['replid'].'" class="presensi_btn'.($absen=='A'?'_A':'').'" onclick="xtable2_cekall(false);presensiguru_list_get_setabsen('.$r['replid'].',\'A\')"><b>A</b></button>';

		//$xtable->td($s,110,'c');
		echo '<td style="width:110px;text-align:center">'.$s.'</td>';
		$s=iText('keterangan_'.$r['replid'],$info,'width:100%');
		echo '<td>'.$s.'</td>';
		hiddenval('absen_'.$r['replid'],$absen);
	$xtable->row_end();}
	
$s='<div style="float:left">';
//$s.='<button class="presensi_btn" onclick="presensiguru_list_get_setabsen_sel(\'\')"><b>&nbsp;</b></button>';
$s.='<button class="presensi_btn" onclick="presensiguru_list_get_setabsen_sel(\'H\')"><b>H</b></button>';
$s.='&nbsp;<button class="presensi_btn" onclick="presensiguru_list_get_setabsen_sel(\'S\')"><b>S</b></button>';
$s.='&nbsp;<button class="presensi_btn" onclick="presensiguru_list_get_setabsen_sel(\'I\')"><b>I</b></button>';
$s.='&nbsp;<button class="presensi_btn" onclick="presensiguru_list_get_setabsen_sel(\'A\')"><b>A</b></button>';
$s.='</div>';

	$xtable->select_opt='<div class="sfont" style="width:164px;float:left;margin-top:4px;margin-left:0px;margin-right:5px">set presensi guru yang dipilih:</div>'.$s;
	$xtable->foot(0);
echo '</div>';
	$xtable->foot_option();
}
?>
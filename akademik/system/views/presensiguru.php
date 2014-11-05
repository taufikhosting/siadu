<?php appmod_use('aka/tahunajaran','aka/guru','aka/presensi');
$opt=gpost('opt'); $cid=gpost('cid',0);

$fmod='presensiguru';
$xtable=new xtable($fmod,'presensi');
$xtable->noopt=true;
$xtable->search_keyon('nama=>hrd_pegawai.nama:LIKE-0');

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);

$tanggal=gpost('tanggal');
if($tanggal=='')$tanggal=date("Y-m-d");

$tgl=explode("-",$tanggal);
$dim=cal_days_in_month(CAL_GREGORIAN,intval($tgl[1]),intval($tgl[0]));
$tgl_f=$tgl[0]."-".$tgl[1]."-1";
$tgl_c=date("Y-m-d");
$tgl_l=$tgl[0]."-".$tgl[1]."-".$dim;
$tgl_cm=$tgl[0]."-".$tgl[1]."-";

$t0 = date('Y-m-d',strtotime('- 1 day',strtotime($tanggal)));
$t1 = date('Y-m-d',strtotime('+ 1 day',strtotime($tanggal)));


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
	
	if($PSBar->pass){
		$s='<button style="float:left;margin:0px 4px 0px 4px" class="btn" title="Tampilkan" onclick="'.$fmod.'_get()"><div class="bi_srcb">&nbsp;</div></button>';
		$PSBar->selection('Bulan',inputTanggal('tanggal',$tanggal,$fmod.'_get()','Ym').' '.$s);
	}
$PSBar->end();

if($PSBar->pass){
// Query
$db=guru_db_bytahunajaran($tajar);
$db->where_and($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('npegawai'));

$xtable->btnbar_begin();
	echo '<button style="float:left;margin-right:6px" class="btnz" onclick="inputdateSetDate(\'tanggal\',\''.$tgl_c.'\');presensiguru_form(\'af\',0)">Presensi hari ini</button>';
	echo '<div class="sfont" style="float:left;margin-top:4px">atau klik pada tanggal utuk mengedit presensi guru.</div>';
	$xtable->search_box('nama guru');
$xtable->btnbar_end();
$absensi=array('0'=>'','h'=>'Hadir','a'=>'Abstain','i'=>'Ijin','s'=>'sakit');

if($xtable->ndata>0){
	// Table head
	$heads=array('@nama');
	for($i=1;$i<=$dim;$i++){
		$s='!<div class="presensi_tgl_btn" title="Edit presensi guru tanggal '.$i.'" onclick="inputdateSetDate(\'tanggal\',\''.$tgl_cm.$i.'\');presensiguru_form(\'af\',0)">'.$i.'</div>';
		array_push($heads,$s.'{C,24px}');
	}
	array_push($heads,'%{C}');
	array_push($heads,'{30px,C}');
	$xtable->head($heads);
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		//$xtable->td($r['nis'],60);
		$xtable->td($r['npegawai']); $nabsen=0; $nhadir=0;
		for($i=1;$i<=$dim;$i++){
			$t1=mysql_query("SELECT absen,keterangan FROM aka_absen_guru WHERE guru='".$r['replid']."' AND tanggal='".$tgl_cm.$i."'");
			if(mysql_num_rows($t1)>0){
				$r1=mysql_fetch_array($t1);
				$absen=$r1['absen'];
				$info=$r1['keterangan'];
				if($absen!=''){
				$nabsen++;
				if($absen=='H')$nhadir++;
				}
			} else {
				$absen='';
				$info='';
			}
			$s=presensi_icon($absen);
			
			$ifo=$info;
			if($ifo!=''){
				$ifo='<div id="absen_info_'.$r['replid'].'_'.$i.'" style="display:none;white-space:nowrap;background:url(\''.IMGR.'absen_ibox.png\') top right no-repeat;height:24px;padding-right:10px;padding-top:2px;padding-left:10px;position:absolute;top:-25px;right:0px;color:#fff;text-align:left">'.$info.'</div>';
				$ifo.='<img src="'.IMGR.'/absen_info.png?asd" style="position:absolute;top:0px;right:0px"/>';
			}
			echo '<td style="width:16px;text-align:center;position:relative" onmouseover="EShow(\'absen_info_'.$r['replid'].'_'.$i.'\')" onmouseout="EHide(\'absen_info_'.$r['replid'].'_'.$i.'\')">'.$s.$ifo.'</td>';
			//$xtable->td(,20,'c');
		}
		$per=$nabsen>0?ceil($nhadir*100/$nabsen):'';
		$xtable->td('<span style="font-size:11px">'.$per.'</span>',28,'c');
		
		$s='<button title="Edit presensiguru siswa" class="btn" onclick="inputdateSetDate(\'tanggal\',\''.$tgl_f.'\');presensiguru_form(\'uf\','.$r['replid'].')"><div class="bi_editb">&nbsp;</div></button>';
		$xtable->td($s,24,'c');
		
	$xtable->row_end();}$xtable->foot();
	
	echo '<div class="tbltopbar" style="margin-top:20px;width:100%">';
$st='float:left;margin-right:4px;height:12px;width:12px;padding:2px;font-size:11px;text-align:center;background:';
echo '<div style="float:left;margin-top:4px;margin-right:20px">',
	'<div class="sfont" style="'.$st.'#00ff00">H</div>',
	'<div class="sfont" style="float:left;margin-right:10px">= Hadir</div>',
	'<div class="sfont" style="'.$st.'#ffff00">S</div>',
	'<div class="sfont" style="float:left;margin-right:10px">= Sakit</div>',
	'<div class="sfont" style="'.$st.'#ff9000">I</div>',
	'<div class="sfont" style="float:left;margin-right:10px">= Ijin</div>',
	'<div class="sfont" style="'.$st.'#ff0000">A</div>',
	'<div class="sfont" style="float:left;margin-right:10px">= Abstain</div>',
	'</div>';
echo '</div>';

}else{$xtable->nodata_cust('Tidak ada data guru pada tahun ajaran ini.');}

}} else { departemen_warn(); }?>
<?php appmod_use('aka/tahunajaran');
$fmod='semester';
$xtable=new xtable($fmod);
$xtable->use_urut('aka_semester');
$dept=gpost('departemen');
$departemen=departemen_r($dept);
if(count($departemen)>0){
$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);

// Query
$t=mysql_query("SELECT * FROM aka_semester WHERE tahunajaran='$tajar' ORDER BY urut");
$xtable->ndata=mysql_num_rows($t);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);

	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun ajaran',iSelect('tahunajaran',$tahunajaran,$tajar,"width:".$PSBar->selw,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tahunajaran',$tajar);
		tahunajaran_warn(); exit();
	}

$PSBar->end();

$xtable->btnbar_f('add','updn');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Semester','Keterangan','Status~C');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$xtable->td($r['nama'],200);
		$xtable->td(nl2br($r['keterangan']));
		if($r['aktif']=='1'){
		$s='<button class="btns" title="Klik untuk me-non aktifkan." style="width:85px" onclick="semester_status_form(\'uf\','.$r['replid'].')">Aktif</button>';
		} else {
		$s='<button class="btn" title="Klik untuk mengaktifkan." style="width:85px" onclick="semester_status_form(\'uf\','.$r['replid'].')">Tidak Aktif</button>';
		}
		$xtable->td($s,100,'c');
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
} else departemen_warn();
?>
<?php appmod_use('aka/pelajaran','aka/tahunajaran','aka/tingkat','aka/kelas','aka/siswa');
$gid=guru_pegawaiId();

$fmod='penilaian'; 
$xtable=new xtable($fmod);

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);

$ting=gpost('tingkat');
$tingkat=tingkat_r($ting,$dept);

$kel=gpost('kelas');
$kelas=kelas_r($kel,$ting);

$pel=gpost('pelajaran');
$pelajaran=pelajaran_r_pegawai($pel,$gid);

// Query
$db=siswa_db_bykelas($kel);
$t=$db->query();

// echo "SELECT aka_guru.*,hrd_pegawai.nip,hrd_pegawai.nama FROM aka_guru LEFT JOIN hrd_pegawai ON aka_guru.pegawai=hrd_pegawai.replid WHERE aka_guru.pelajaran='$pel' ORDER BY hrd_pegawai.nama";
$xtable->ndata=mysql_num_rows($t);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);

	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun ajaran',iSelect('tahunajaran',$tahunajaran,$tajar,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tahunajaran',$tajar);
		hiddenval('tingkat',$ting);
		hiddenval('kelas',$kls);
		hiddenval('pelajaran',$pel);
		tahunajaran_warn(0);
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('tingkat',$tingkat,$ting,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tingkat',$ting);
		hiddenval('kelas',$kls);
		hiddenval('pelajaran',$pel);
		tingkat_warn(0);
		$PSBar->pass=false;
	}}
	
	if($PSBar->pass){
	if(count($kelas)>0){
		$PSBar->selection('Rombel/Kelas',iSelect('kelas',$kelas,$kls,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelas',$kls);
		hiddenval('pelajaran',$pel);
		kelas_warn(0);
		$PSBar->pass=false;
	}}
	
	if($PSBar->pass){
	if(count($pelajaran)>0){
		$PSBar->selection('Pelajaran',iSelect('pelajaran',$pelajaran,$pel,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('pelajaran',$pel);
		pelajaran_warn(0);
		$PSBar->pass=false;
	}}
$PSBar->end();

$xtable->btnbar_f('<button class="btn" style="float:right" onclick="penilaian_simpan()"><div class="bi_save">Simpan</div></button>');

$x=mysql_query("SELECT * FROM aka_jenispengujian WHERE pelajaran='$pel'");
if(mysql_num_rows($x)>0){
if($xtable->ndata>0){
	// Table head
	$xtable->noopt=true;
	
	$head=array();
	$head[0]='!NIS';
	$head[1]='nama siswa';
	$k=2;
	$x=mysql_query("SELECT * FROM aka_jenispengujian WHERE pelajaran='$pel'");
	while($y=mysql_fetch_array($x)){
		$head[$k++]='!'.$y['kode'].'{C}';
	}
	$head[$k]='!Nilai Akhir{C,80px}';
	$xtable->head($head);
	
	$b=0;
	$total=0;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['nis'],100);
		$xtable->td($r['nama']);
		$nk=0;
		$ni=array();
		$nb=array();
		$tb=0;
		$x=mysql_query("SELECT * FROM aka_jenispengujian WHERE pelajaran='$pel'");
		$nc=mysql_num_rows($x);
		$nx=ceil(600/$nc);
		while($y=mysql_fetch_array($x)){
			$q=mysql_query("SELECT * FROM aka_penilaian WHERE pelajaran='$pel' AND jenispengujian='".$y['replid']."' AND siswa='".$r['replid']."'");
			if(mysql_num_rows($q)>0){
				$h=mysql_fetch_array($q);
				$n=$h['nilai'];
				$ni[$nk]=$n;
				$nb[$nk++]=$y['bobot'];
				$tb+=$y['bobot'];
			} else {
				mysql_query("INSERT INTO aka_penilaian SET pelajaran='$pel',jenispengujian='".$y['replid']."',siswa='".$r['replid']."',nilai='0'");
				$n=0;
				$ni[$nk]=$n;
				$nb[$nk++]=1;
				$tb+=1;
			}
			$tid='n-'.$r['replid'].'-'.$pel.'-'.$y['replid'];
			$xtable->td(iText($tid,$n,'width:100%;text-align:center').hiddenval('nilai'.($b++),$tid),60,'c');
		}
		
		$nc=count($ni); $n=0;
		if($tb>0){
		for($nk=0;$nk<$nc;$nk++){
			$n+=$ni[$nk]*$nb[$nk]/$tb;
		}}
		
		$total+=$n;
		$xtable->td(number_format($n,2),80,'c');

		//$xtable->td(nl2br($r['keterangan']));
		//$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}
	
	$xtable->row_begin();
	echo '<td>&nbsp;</td><td colspan="'.($nc+1).'" align="right"><b>Rata-rata</b></td><td align="center"><b>'.number_format($total/$xtable->ndata,2).'</b></td>';
	$xtable->row_end();
	
	$xtable->foot();
	hiddenval('jml_nilai',$b);
}else{$xtable->nodata();}}else {$xtable->nodata_cust('Tidak ada pengujian pada pelajaran ini. Silahkan menambahkan jenis pengujian untuk pelajaran ini.');}
} else departemen_warn(); ?>
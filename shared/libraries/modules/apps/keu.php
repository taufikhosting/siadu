<?php
define('ITEXTC_SHOW_NUL',0);

define('JT_UMUM',0);
define('JT_SISWA',1);
define('JT_CALONSISWA',2);
define('JT_INCOME',3);
define('JT_OUTCOME',4);
define('JT_INBANK',5);
define('JT_OUTBANK',6);
define('JT_INBRG',7);

function jt_name($a){
	if($a==JT_INCOME) return 'pemasukan kas';
	else if($a==JT_OUTCOME) return 'pengeluaran kas';
	else if($a==JT_INBANK) return 'pemasukan bank';
	else if($a==JT_OUTBANK) return 'pengeluaran bank';
	else if($a==JT_SISWA || $a==JT_CALONSISWA) return 'pembayaran siswa';
	else return '';
}

// epiii -------
function jt_jenisbukti($a){
	if($a==JT_INCOME) return 'BKM';
	else if($a==JT_OUTCOME) return 'BKK';
	else if($a==JT_INBANK) return 'BBM';
	else if($a==JT_OUTBANK) return 'BBK';
	else return '';
}
function tahunbuku_getsaldoawal(){
	$r=tahunbuku_getaktif();
	return $r['saldoawal'];
}
// epiii -------

define('RT_SPP',1);
define('RT_PSB',2);
define('RT_USP',3);
define('RT_INV',4);

define('KM_SISWAWJB',1);
define('KM_SISWASKR',2);
define('KM_CALONSISWAWJB',3);
define('KM_CALONSISWASKR',4);

define('KR_AKTIVA',1);
define('KR_KEWAJIBAN',2);
define('KR_MODAL',3);
define('KR_PENDAPATAN',4);
define('KR_BIAYA',5);
define('KR_PENDAPATANLAIN',6);
define('KR_BIAYALAIN',7);

function tahunbuku_getaktif(){
	$t=mysql_query("SELECT * FROM keu_tahunbuku WHERE aktif='1' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
	} else {
		$r=array('replid'=>0,'nama'=>'');
	}
	return $r;
}
function tahunbuku_getaktifid(){
	$a=tahunbuku_getaktif();
	return $a['replid'];
}

function transaksi_lastct(){
	$t=mysql_query("SELECT ct FROM keu_transaksi ORDER BY ct DESC LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		return $r['ct'];
	} else {
		return 0;
	}
}

function jurnal_repost($tid,$nom,$rekd,$rekk){
	dbDel("keu_jurnal","transaksi='$tid'");
	return jurnal_post($tid,$nom,$rekd,$rekk);
}
function transaksi_edit($transid,$tgl,$urai,$nom,$rekd,$rekk,$rekkas=0,$rekitem=0){
	//$tb=tahunbuku_getaktif();
	//$ct=transaksi_lastct()+1;
	
	$trans=array();
	//$trans['tahunbuku']=$tb['replid'];
	//$trans['nomer']=$tb['kode'].sprintf("%05d",$ct);
	$trans['tanggal']=$tgl;
	$trans['rekkas']=$rekkas;
	$trans['rekitem']=$rekitem;
	$trans['uraian']=$urai;
	$trans['nominal']=$nom;
	//$trans['modul']=$mod;
	//$trans['jenis']=$jt;
	//$trans['ct']=$ct;
	
	if(dbUpdate("keu_transaksi",$trans,"replid='$transid'")){
		return jurnal_repost($transid,$nom,$rekd,$rekk);
	}
	
	return 0;
}
function transaksi_hapus($transid){
	$t=mysql_query("SELECT pembayaran FROM keu_transaksi WHERE replid='$transid'");
	$r=mysql_fetch_array($t);
	$q=dbDel("keu_transaksi","replid='$transid'");
	$q=dbDel("keu_jurnal","transaksi='$transid'");
	//log_print('Cek pembayaran: ['.$r['pembayaran'].']');
	pembayaran_cek($r['pembayaran']);
	return $q;
}
function transaksi_kodejt($jt=JT_UMUM){
	$kode=array(JT_UMUM=>'MMJ',JT_INCOME=>'BKM',JT_OUTCOME=>'BKK');
	return $kode[$jt];
}
function transaksi_newnomer($jt=JT_UMUM){
	$kode=transaksi_kodejt($jt);
	$tb=tahunbuku_getaktif();
	$ct=transaksi_lastct()+1;
	$res=array();
	//$res['nomer']=$tb['kode'].sprintf("%05d",$ct);
	$res['nomer']=$kode.'-'.sprintf("%04d",$ct).'/'.date("m").'/'.date("Y");
	$res['ct']=$ct;
	return $res;
}

/*epiii*/
function jurnal_post($tid,$nom,$rekd,$rekk){
	$jurnal=array();
		$jurnal['transaksi']=$tid; // masuk field : kredit
		$jurnal['rek']=$rekd;
		$jurnal['debet']=$nom;
		$jurnal['kredit']=0;
	$q=dbInsert("keu_jurnal",$jurnal);
		$jurnal['rek']=$rekk; // masuk field : debet
		$jurnal['debet']=0;
		$jurnal['kredit']=$nom;
	$q=dbInsert("keu_jurnal",$jurnal);
	return $q;}

function transaksi_post($no,$ct,$tgl,$urai,$nom,$rekd,$rekk,$rekkas=0,$rekitem=0,$jt=JT_UMUM,$pem=0,$kat=0,$pbrg=0,$bud=0){
	$transid=0;
	$trans=array();
		$trans['tahunbuku']=tahunbuku_getaktifid();
		$trans['nomer']=$no;
		$trans['tanggal']=$tgl;
		$trans['rekkas']=$rekkas;
		$trans['rekitem']=$rekitem;
		$trans['uraian']=$urai;
		$trans['nominal']=$nom;
		$trans['kategori']=$kat;
		$trans['pembayaran']=$pem;
		$trans['penerimaanbrg']=$pbrg;
		$trans['jenis']=$jt;
		$trans['budget']=$bud;
		$trans['ct']=$ct;
	if(dbInsert("keu_transaksi",$trans)){
		$transid =mysql_insert_id();
		jurnal_post($transid,$nom,$rekd,$rekk);
	}transaksi_cekpembayaran($transid);
	return $transid;
}

function transaksi_saldo(){
	
}
// New Posting
function transaksi_posting_auto($urai,$jur,$jt=JT_UMUM,$kat=0){
	$no=transaksi_newnomer();
	return transaksi_posting($no['nomer'],$no['ct'],date("Y-m-d"),$urai,$jur,$jt,$kat);
}
function transaksi_posting($no,$ct,$tgl,$urai,$jur,$jt=JT_UMUM,$kat=0){
	$tid=0;
	$n=count($jur);
	if($n>0){
		$trans=array();
		$trans['tahunbuku']=tahunbuku_getaktifid();
		$trans['nomer']=$no;
		$trans['tanggal']=$tgl;
		$trans['uraian']=$urai;
		//$trans['rekkas']=$rekkas;
		//$trans['rekitem']=$rekitem;
		//$trans['modul']=$mod;
		$trans['kategori']=$kat;
		$trans['jenis']=$jt;
		$trans['ct']=$ct;
		$trans['nominal']=0;
		for($i=0;$i<$n;$i++){
			$jurnal=$jur[$i];
			$trans['nominal']+=$jurnal['debet'];
			//log_print("dapat debet:".$jurnal['debet']);
		}
		if(dbInsert("keu_transaksi",$trans)){
			$tid=mysql_insert_id();
			for($i=0;$i<$n;$i++){
				$jurnal=$jur[$i];
				$jurnal['transaksi']=$tid;
				$q=dbInsert("keu_jurnal",$jurnal);
			}
		}
	}
	transaksi_cekpembayaran($tid);
	return $tid;
}
function jurnal_pack($rek,$d=0,$k=0){
	$jur=array();
	$jur['transaksi']=$tid;
	$jur['rek']=$rek;
	$jur['debet']=$d;
	$jur['kredit']=$k;
	return $jur;
}
function transaksi_update($tid,$tgl,$urai,$nom,$jur){
	$n=count($jur);
	if($n>0){
		$trans=array();
		$trans['tanggal']=$tgl;
		$trans['uraian']=$urai;
		$trans['nominal']=0;
		for($i=0;$i<$n;$i++){
			$jurnal=$jur[$i];
			$trans['nominal']+=$jurnal['debet'];
		}
		if(dbUpdate("keu_transaksi",$trans,"replid='$tid'")){
			dbDel("keu_jurnal","transaksi='$tid'");
			for($i=0;$i<$n;$i++){
				$jurnal=$jur[$i];
				$jurnal['transaksi']=$tid;
				$q=dbInsert("keu_jurnal",$jurnal);
			}
		}
	}
	transaksi_cekpembayaran($tid);
	return $tid;
}

function transaksi_cekpembayaran($tid){ //cek apakah transasi termaseuk jenis "PEMBAYARAN" atau bukan 
	$t =mysql_query("SELECT pembayaran FROM keu_transaksi WHERE replid='$tid'");
	$r =mysql_fetch_assoc($t); /*epiii*/
	// $r =mysql_fetch_array($t);
	pembayaran_cek($r['pembayaran']);
}

function pembayaran_getdatabysubj($mod,$sis,$d=1){
	$pemb=array();
	$t=mysql_query("SELECT keu_pembayaran.replid FROM keu_pembayaran WHERE keu_pembayaran.modul='$mod' AND keu_pembayaran.siswa='$sis' LIMIT 0,1");
	$pemb=mysql_fetch_array($t);
	
	return pembayaran_getdata($pemb['replid'],$d);
}

function pembayaran_getdata($a,$d=1){
	$pemb =array();
	$t    =mysql_query("SELECT keu_pembayaran.* FROM keu_pembayaran WHERE keu_pembayaran.replid='$a' LIMIT 0,1");
	$pemb =mysql_fetch_assoc($t); /*epiii*/
	// $pemb =mysql_fetch_array($t);
	
	$t0 =mysql_query("SELECT kategori,reftipe,refid,nama,rek1,rek2,rek3 FROM keu_modul WHERE replid='".$pemb['modul']."' LIMIT 0,1");
	// $pemb['modul'] =mysql_fetch_array($t0);
	$pemb['modul']=mysql_fetch_assoc($t0); /*epiii*/
	$pemb['rekkas']=$pemb['modul']['rek1']; //modal
	$pemb['rekitem']=$pemb['modul']['rek2']; //pengeluaran
	
	if($d>0){
		if($pemb['modul']['reftipe']==RT_SPP){ //pembayaran SPP
			$t1=mysql_query("SELECT replid,tahunajaran as nama FROM aka_tahunajaran WHERE replid='".$pemb['modul']['refid']."' LIMIT 0,1");
			$pemb['tahunajaran']=mysql_fetch_array($t1);
			
			$t2=mysql_query("SELECT replid,nama,nis FROM aka_siswa WHERE replid='".$pemb['siswa']."' LIMIT 0,1");
			$pemb['siswa']=mysql_fetch_array($t2);
			
			$pemb['uraian']='Pembayaran '.$pemb['modul']['nama'].'.'.chr(13).'Siswa: '.$pemb['siswa']['nama'].'. No. pendaftaran: '.$pemb['siswa']['nis'].'.';
			
			$pemb['rekitem']=$pemb['modul']['rek3'];
			
		} else if($pemb['modul']['reftipe']==RT_PSB){ //pembayran FORMULIR
			$t1=mysql_query("SELECT replid,proses as nama FROM psb_proses WHERE replid='".$pemb['modul']['refid']."' LIMIT 0,1");
			$pemb['proses']=mysql_fetch_array($t1);
			
			$t2=mysql_query("SELECT replid,nama,nopendaftaran FROM psb_calonsiswa WHERE replid='".$pemb['siswa']."' LIMIT 0,1");
			$pemb['calonsiswa']=mysql_fetch_array($t2);
			
			$pemb['uraian']='Pembayaran '.$pemb['modul']['nama'].'.'.chr(13).'Calon siswa: '.$pemb['calonsiswa']['nama'].'. No. pendaftaran: '.$pemb['calonsiswa']['nopendaftaran'].'.';
		}else if($pemb['modul']['reftipe']==RT_USP){ //pembayaran UANG PANGKAL
			$t1=mysql_query("SELECT replid,angkatan as nama FROM aka_angkatan WHERE replid='".$pemb['modul']['refid']."' LIMIT 0,1");
			$pemb['angkatan']=mysql_fetch_array($t1);
			
			$t2=mysql_query("SELECT replid,nama,nis FROM aka_siswa WHERE replid='".$pemb['siswa']."' LIMIT 0,1");
			$pemb['siswa']=mysql_fetch_array($t2);
			
			$pemb['uraian']='Pembayaran '.$pemb['modul']['nama'].'.'.chr(13).'Siswa: '.$pemb['siswa']['nama'].'. No. pendaftaran: '.$pemb['siswa']['nis'].'.';
			
			$pemb['rekitem']=$pemb['modul']['rek3'];
		}
	}return $pemb;
}
function pembayaran_trans($pid,$no,$ct,$tgl,$rekkas,$rekitem,$urai,$nom){
	$pemb=pembayaran_getdata($pid,0);
	
	if($pemb['modul']['kategori']==1||$pemb['modul']['kategori']==2) // siswa resmi
		$jt=JT_SISWA;
	else if($pemb['modul']['kategori']==3||$pemb['modul']['kategori']==4)  //siswa calon
		$jt=JT_CALONSISWA;
	$rekd =$rekkas; // modal
	$rekk =$rekitem; // pengeluaran
	$q    =transaksi_post($no,$ct,$tgl,$urai,$nom,$rekd,$rekk,$rekkas,$rekitem,$jt,$pid,$pemb['modul']['kategori']);
	
	/*epiii*/	
	// $ss = 'UPDATE keu_rekening SET ';
	if($q){
		$t=mysql_query("SELECT nominal FROM keu_transaksi WHERE pembayaran='$pid'");
		$bayar=0;
		while($r=mysql_fetch_array($t)){
			$bayar+=$r['nominal'];
		}
		
		if($bayar>=$pemb['nominal'])$lunas=1;
		else $lunas=0;
		$q=dbUpdate("keu_pembayaran",array('lunas'=>$lunas),"replid='$pid'");
		
		if($pemb['modul']['reftipe']==RT_PSB){
			dbUpdate("psb_calonsiswa",array('bayar'=>$lunas),"replid='".$pemb['siswa']."'");
		}
	}
	
	return $q;
}
function pembayaran_cek($pid=0){
	//log_print("pembayaran_cek(".$pid.")");
	if($pid!=0){
		$pemb =pembayaran_getdata($pid,0);
		
		$t=mysql_query("SELECT nominal FROM keu_transaksi WHERE pembayaran='$pid'");
		$bayar=0;
		while($r=mysql_fetch_array($t)){
			$bayar+=$r['nominal'];
		}
		//log_print("bayar:".$bayar." of nominal:".$nominal);
		
		if($bayar>=$pemb['nominal'])$lunas=1;
		else $lunas=0;
		//log_print("Lunas:".$lunas);
		$q=dbUpdate("keu_pembayaran",array('lunas'=>$lunas),"replid='$pid'");
		
		if($pemb['modul']['reftipe']==RT_PSB){
			dbUpdate("psb_calonsiswa",array('bayar'=>$lunas),"replid='".$pemb['siswa']."'");
		}
	}
}
?>
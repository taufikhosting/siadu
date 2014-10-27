<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
// form Module
$fmod="katalog_buku";
$dbtable="pus_buku";
$fform=new fform($fmod,$opt,$cid,'Koleksi');

$inp=app_form_gpost('katalog','idbuku','barkode','callnumber','sumber','harga','satuan','tanggal');
//$inp['urut']=$l;
//$inp['idbuku']=buku_getidbuku($lok,$tingb,0,$l);
//$inp['barkode']=buku_idbukutobarkode($inp['idbuku']);
$nunit=intval(gpost('nbuku'));
$inp['lokasi']=gpost('tlokasi');
$inp['tingkatbuku']=gpost('ttingkatbuku');
$inp['tahun']=date("Y");


if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add		
		if($nunit>1){
			$lok=$inp['lokasi'];
			$tingb=$inp['tingkatbuku'];
			$data=array('kodelokasi'=>$inp['lokasi'],'kodetingkat'=>$inp['tingkatbuku'],'sumber'=>$inp['sumber']);
			for($i=0;$i<$nunit;$i++){
				$inp['urut']=buku_getlasturut()+1;
				$data['nomorauto']=$inp['urut'];
				$inp['idbuku']=buku_makeid($data);
				$inp['barkode']=buku_makebarkode($data);;
				$q=dbInsert($dbtable,$inp);
			}
		} else {
			$inp['urut']=buku_getlasturut()+1;
			$q=dbInsert($dbtable,$inp);
		}
		//log_print($_SESSION['libdb_dbIsert']);
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q=dbDel("pus_peminjaman","buku='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
		$tk=mysql_query("SELECT judul,klasifikasi,pengarang FROM pus_katalog WHERE replid='".$r['katalog']."'");
		$rk=mysql_fetch_array($tk);
		
		$lok=$r['lokasi'];
		$sat=$r['satuan'];
		$tingb=$r['tingkatbuku'];
		
		$lokasi=lokasi_r($lok);
		$satuan=satuan_r($sat);
		$tingkatbuku=tingkatbuku_r($tingb);
	} else {
		$lok=gpost('lokasi');
		$sat='IDR';
		$tingb=0;
		
		$lokasi=lokasi_r($lok);
		$satuan=satuan_r($sat);
		$tingkatbuku=tingkatbuku_r($tingb);
		
		$tk=mysql_query("SELECT judul,klasifikasi,pengarang FROM pus_katalog WHERE replid='".$inp['katalog']."'");
		$rk=mysql_fetch_array($tk);
		$r=array();
		$r['sumber']=0;
		
		$t1=mysql_query("SELECT kode FROM pus_klasifikasi WHERE replid='".$rk['klasifikasi']."' LIMIT 0,1");
		$r1=mysql_fetch_array($t1);
		$r['callnumber']=$r1['kode'];
		
		$t1=mysql_query("SELECT nama,nama2 FROM pus_pengarang WHERE replid='".$rk['pengarang']."' LIMIT 0,1");
		$r1=mysql_fetch_array($t1);
		$r1=substr($r1['nama2'],0,3);
		$r['callnumber'].=" ".$r1;
		
		$jud=strtolower(substr($rk['judul'],0,1));
		$r['callnumber'].=" ".$jud;
		
		$r['idbuku']=buku_makeid();
		$r['barkode']=buku_makebarkode();
		$r['urut']=buku_getlasturut()+1;;
		
		$r['tanggal']=date("Y-m-d");
		
		$r['harga']=0;
	}
	
	$fform->dimension(450,120);
	$fform->ptop=20;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		
		$fform->fg('Data Koleksi');
		$fform->fl('Judul','<b>'.buku_judul($rk['judul']).'</b>');
		if($opt=='af'){
		$fform->fi('Jumlah koleksi baru',iText('nbuku',1,'width:30px;text-align:center','','onblur="katalog_buku_getkode('.$cid.')"').' &nbsp;item');
		hiddenval('tbarkode',$r['barkode']);
		hiddenval('tidbuku',$r['idbuku']);
		} else {
		hiddenval('nbuku',0);
		}
		$fform->fi('ID buku',iText('idbuku',$r['idbuku'],$fform->rwidths,'','','disabled'));
		//hiddenval('idbuku',$r['idbuku']);
		$fform->fi('Barkode',iText('barkode',$r['barkode'],$fform->rwidths,'','','disabled'));
		//$fform->fi('Callnumber',iText('callnumber',$r['callnumber'],$fform->rwidths));
		hiddenval('callnumber',$r['callnumber']);
		$fform->fi('Sumber',iRadio('sumber1','sumber',0,'Beli',$r['sumber'],'','onclick="katalog_buku_getkode('.$cid.')"'));
		$fform->fi('',iRadio('sumber2','sumber',1,'Pemberian',$r['sumber'],'','onclick="katalog_buku_getkode('.$cid.')"'));
		$fform->fi('Harga',iSelect('satuan',$satuan,$sat).'&nbsp;'.iText('harga',$r['harga'],'width:120px'));
		$fform->fi('Tanggal diperoleh',inputTanggal('tanggal',$r['tanggal']));
		
		$fform->fg('Alokasi Koleksi');
		$fform->fi('Lokasi',iSelect('tlokasi',$lokasi,$lok,'','katalog_buku_getkode('.$cid.')'));
		$fform->fi('Tingkat',iSelect('ttingkatbuku',$tingkatbuku,$tingb,'','katalog_buku_getkode('.$cid.')'));
		//$fform->fi('Rak buku',iSelect('trakbuku',$rakbuku,$rak).'&nbsp;<img id="loader3" src="'.IMGR.'loadsmall.gif" style="display: none;">');
		//$fform->fi('Kondisi',iSelect('kondisi',kondisi_a(),$r['kondisi']));
		//$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['idbuku']);
		
	} $fform->foot();
}
?>
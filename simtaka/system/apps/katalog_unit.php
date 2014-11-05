<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
// form Module
$fmod="katalog_unit";
$dbtable="sar_barang";
$fform=new fform($fmod,$opt,$cid,'Unit Barang');

$inp=app_form_gpost('lokasi','grup','katalog','kode','barkode','sumber','harga','kondisi','keterangan');
$inp['urut']=intval($inp['barkode']);
$inp['barkode']=sprintf("%05d",$inp['urut']);
$nunit=intval(gpost('nunit'));


if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		if($nunit>1){
			for($i=0;$i<$nunit;$i++){
				$l=barang_lbarkode();
				$inp['kode']=lokasi_kode($inp['lokasi']).'.'.grup_kode($inp['grup']).'.'.katalog_kode($inp['katalog']).'.';
				$inp['kode'].=sprintf("%05d",$l);
				$inp['barkode']=sprintf("%05d",$l);
				$inp['urut']=$l;
				$q=dbInsert($dbtable,$inp);
			}
		} else {
			$q=dbInsert($dbtable,$inp);
		}
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else {
	$tk=mysql_query("SELECT nama FROM sar_katalog WHERE replid='".$inp['katalog']."'");
	$rk=mysql_fetch_array($tk);
		
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=array();
		$r['sumber']=0;
		$r['kode']=lokasi_kode($inp['lokasi']).'.'.grup_kode($inp['grup']).'.'.katalog_kode($inp['katalog']).'.';
		$l=barang_lbarkode();
		$r['kode'].=sprintf("%05d",$l);
		$r['barkode']=sprintf("%05d",$l);
		$r['kondisi']=1;
	}
	$fform->ptop=100;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		
		$fform->fl('Nama barang',$rk['nama']);
		if($opt=='af'){
		//echo '<textarea>';
		$fform->fi('Jumlah unit baru',iText('nunit',1,'width:50px','','onblur="katalog_unit_cek(this)"'));
		hiddenval('tkode',$r['kode']);
		hiddenval('tbarkode',$r['barkode']);
		//echo '</textarea>';
		}
		$fform->fi('Kode',iText('kode',$r['kode'],$fform->rwidths,'','','disabled'));
		$fform->fi('Barkode',iText('barkode',$r['barkode'],'width:150px','','','disabled'));
		// iRadio($d,$n,$v,$l='',$a='',$s=''){
		$fform->fi('Sumber',iRadio('sumber1','sumber',0,'Beli',$r['sumber']));
		$fform->fi('',iRadio('sumber2','sumber',1,'Pemberian',$r['sumber']));
		$fform->fi('',iRadio('sumber3','sumber',2,'Membuat sendiri',$r['sumber']));
		$fform->fi('Harga',iTextC('harga',$r['harga']));
		$fform->fi('Kondisi',iSelect('kondisi',kondisi_a(),$r['kondisi']));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['kode']);
		
	} $fform->foot();
}
?>
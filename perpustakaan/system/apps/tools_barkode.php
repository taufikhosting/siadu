<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='tools_barkode';
$dbtable='pus_setting';
$fform=new fform($fmod,$opt,$cid,'!Format Barkode Item');

$inp=app_form_gpost('nilai');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
		if($q && gpost('updatebuku')=='1'){
			$t1=mysql_query("SELECT * FROM pus_buku");
			while($r1=mysql_fetch_array($t1)){
				$data=array('kodelokasi'=>$r1['lokasi'],'kodetingkat'=>$r1['tingkatbuku'],'sumber'=>$r1['sumber'],'nomorauto'=>$r1['urut']);
				$barkode=buku_makebarkode($data);
				$q=dbUpdate("pus_buku",array('barkode'=>$barkode),"replid='".$r1['replid']."'");
			}
		}
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		
	}
	$fform->dimension(500,60);
	$fform->ptop=10;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		echo '<tr><td colspan="2">';
			echo '<table id="xtable" cellpadding="3px" class="xtable" width="490px" style="margin-bottom:20px">';
				echo '<tr><th>Kode</th><th>Keterangan</th></tr>';
				echo '<tr valign="top" class="xtrx"><td style="font:11px '.MSFONT.' !important;line-height:150%" width="200px">[nomorauto(.panjang digit)]</td><td>Nomor otomatis (<i>incremental</i>). Panjang digit maksimal 5 karakter dengan penambahan angka 0 di depan. Jika panjang digit tidak diberikan atau 0 maka panjang digit sesuai angka asli tanpa penambahan angka 0 di depan.<br/>Contoh:<br/><span style="font:11px '.MSFONT.' !important">[nomorauto.5]</span> untuk nomor otomatis dengan panjang digit lima karakter.<br/><span style="font:11px '.MSFONT.' !important">[nomorauto]</span> untuk nomor otomatis dengan panjang digit sesuai angka asli.</td></tr>';
				echo '<tr valign="top" class="xtrx"><td style="font:11px '.MSFONT.' !important;line-height:150%">[tahun]</td><td>Tahun.</td></tr>';
				echo '<tr valign="top" class="xtrx"><td style="font:11px '.MSFONT.' !important;line-height:150%">[kodelokasi]</td><td>Kode lokasi.</td></tr>';
				echo '<tr valign="top" class="xtrx"><td style="font:11px '.MSFONT.' !important;line-height:150%">[kodetingkat]</td><td>Kode tingkat koleksi.</td></tr>';
				echo '<tr valign="top" class="xtrx"><td style="font:11px '.MSFONT.' !important;line-height:150%">[sumber]</td><td>Sumber item.<br/>Sumber dari pembelian berkode B.</br>Sumber dari hibah/pemberian berkode H.</td></tr>';
			echo '</table>';
		echo '</td></tr>';
		$fform->fi('Format',iText('nilai',$r['nilai'],'font-family:'.MSFONT.';'.$fform->rwidths));
		$fform->fi('',iCheckx('updatebuku','Update barkode item ke format baru',1));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del('['.$r['kode'].'] '.$r['nama']);
		
	} $fform->foot();
} ?>
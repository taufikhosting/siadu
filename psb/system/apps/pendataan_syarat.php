<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="pendataan_syarat";
$dbtable="psb_calonsiswa";
$fform=new fform($fmod,$opt,$cid,'Persyaratan calon siswa');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$t=mysql_query("SELECT psb_calonsiswa_syarat.*,psb_syarat.syarat as nama FROM psb_calonsiswa_syarat LEFT JOIN psb_syarat ON psb_syarat.replid=psb_calonsiswa_syarat.syarat WHERE calonsiswa='$cid'");
		//log_print("SELECT psb_calonsiswa_syarat.*,psb_syarat.syarat as nama FROM psb_calonsiswa_syarat LEFT JOIN psb_syarat ON psb_syarat.replid=psb_calonsiswa_syarat.syarat WHERE calonsiswa='$cid' AND syarat<>1");
		while($r=mysql_fetch_array($t)){
			$stat=gpost('syarat'.$r['syarat']);
			$q=mysql_query("UPDATE psb_calonsiswa_syarat SET status='$stat' WHERE calonsiswa='$cid' AND syarat='".$r['syarat']."'");
		}
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("nama,nopendaftaran",$dbtable,"W/replid='$cid'");
	} else {
		
	}
	//$fform->dimension(350);
	$fform->lwidth=150;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		$fform->fl('Nama calon siswa',$r['nama']);
		$fform->fl('Nomor pendaftaran',$r['nopendaftaran']);
		$s='';
		//qarea();
		$t=mysql_query("SELECT psb_calonsiswa_syarat.*,psb_syarat.wajib,psb_syarat.syarat as nama FROM psb_calonsiswa_syarat LEFT JOIN psb_syarat ON psb_syarat.replid=psb_calonsiswa_syarat.syarat WHERE psb_calonsiswa_syarat.calonsiswa='$cid' AND psb_syarat.wajib='1'");
		if(mysql_num_rows($t)>0){
			$si='<table cellspacing="0" cellpaddin="0">';
			while($r=mysql_fetch_array($t)){
				$si.='<tr height="26px"><td width=150px">'.$r['nama'].':</td><td>';
				/*if($r['syarat']==1 && false){
					$si.=($r['status']==1?'<span style="color:#01a8f7">&nbsp;&nbsp;<b>Sudah bayar</b></span>':'<span style="color:#fd6906">&nbsp;&nbsp;<b>Belum bayar</b></span>');
				}
				else if($r['syarat']==2 && false){
					$si.=($r['status']==1?'<span style="color:#01a8f7">&nbsp;&nbsp;<b>Sudah bayar</b></span>':'<span style="color:#fd6906">&nbsp;&nbsp;<b>Belum bayar</b></span>');
				}
				else{*/
					$si.='<div style="margin-left:10px;width:14px;padding:0px;text-align:center;border:1px solid #999"><input type="checkbox" class="iCheck" id="syarat'.$r['syarat'].'" name="syarat" value="1" '.($r['status']==1?'checked':'').' /></div>';
					if($s!='')$s.=',';
					$s.='syarat'.$r['syarat'];
				//}
				$si.='</td></tr>';
			}
			$si.='</table>';
			$fform->fw('<b>Persyaratan wajib</b>',$si);
		}
		$t=mysql_query("SELECT psb_calonsiswa_syarat.*,psb_syarat.wajib,psb_syarat.syarat as nama FROM psb_calonsiswa_syarat LEFT JOIN psb_syarat ON psb_syarat.replid=psb_calonsiswa_syarat.syarat WHERE psb_calonsiswa_syarat.calonsiswa='$cid' AND psb_syarat.wajib<>'1'");
		if(mysql_num_rows($t)>0){
			$si='<table cellspacing="0" cellpaddin="0">';
			while($r=mysql_fetch_array($t)){
				$si.='<tr height="26px"><td width=150px">'.$r['nama'].':</td><td>';
				/*if($r['syarat']==1||$r['syarat']==2 && false){
					$si.=($r['status']==1?'<span style="color:#01a8f7">&nbsp;&nbsp;<b>Sudah bayar</b></span>':'&nbsp;&nbsp;Belum bayar');
				}
				else{*/
					$si.='<div style="margin-left:10px;width:14px;padding:0px;text-align:center;border:1px solid #999"><input type="checkbox" class="iCheck" id="syarat'.$r['syarat'].'" name="syarat" value="1" '.($r['status']==1?'checked':'').' /></div>';
					if($s!='')$s.=',';
					$s.='syarat'.$r['syarat'];
				//}
				$si.='</td></tr>';
			}
			$si.='</table>';
			$fform->fw('<b>Persyaratan tidak wajib</b>',$si);
		}
		hiddenval('syaratid',$s);
		//area();
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['kriteria']);
		
	} $fform->foot();
} ?>
<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;
$mtipe=gpost('mtipe'); if($mtipe=='')$mtipe=0;
//$cid=gpost('member_id');
//$mtipe=gpost('member_tipe');
$fmod='peminjaman';
$xform=new xform($fmod,$opt,$cid);

if($mtipe!=0){
	$lbls='float:left;width:120px;margin-right:4px';
	$fs='float:left;width:200px;margin-right:4px';
		
	echo '<div style="float:left;margin-right:6px;width:62px;height:92px">';
	$xform->photof($cid.'-'.$mtipe,'member',60,90,'h');
	echo '</div>';
	echo '<div style="float:left;width:328px">';

	if($mtipe==1){
		$db=new xdb("aka_siswa","*","aka_siswa.replid='$cid'");
		$db->field('aka_siswa:replid,nis,nama','aka_kelas:kelas');
		$db->join('kelas','aka_kelas');
		$t=$db->go();
		$r=mysql_fetch_array($t);
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="font-size:14px;float:left:margin-right:4px;width:324px"><b>'.$r['nama'].'</b></div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">ID member:</div>';
			echo '<div class="sfont" style="'.$fs.'">'.$r['nis'].'</div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">Tipe member:</div>';
			echo '<div class="sfont" style="'.$fs.'">Siswa</div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">Kelas:</div>';
			echo '<div class="sfont" style="'.$fs.'">'.$r['kelas'].'</div>';
		echo '</div>';
	}
	else if($mtipe==2){
		$t=mysql_query("SELECT * FROM hrd_pegawai WHERE replid='$cid' LIMIT 0,1");
		$r=mysql_fetch_array($t);
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="font-size:14px;float:left:margin-right:4px;width:324px"><b>'.$r['nama'].'</b></div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">Tipe member:</div>';
			echo '<div class="sfont" style="'.$fs.'">Member luar</div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">Alamat:</div>';
			echo '<div class="sfont" style="'.$fs.'">'.$r['alamat'].'</div>';
		echo '</div>';
	} else {
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="font-size:14px;float:left:margin-right:4px;width:324px"><b>'.$r['nama'].'</b></div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">Tipe member:</div>';
			echo '<div class="sfont" style="'.$fs.'">Member luar</div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">Alamat:</div>';
			echo '<div class="sfont" style="'.$fs.'">'.$r['alamat'].'</div>';
		echo '</div>';
	}
	echo '</div>';
}
?>
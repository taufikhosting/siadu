<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
appmod_use('aka/siswa');
$opt=gpost('opt'); $cid=gpost('cid',0); $mtipe=gpost('mtipe',0);

hiddenval('member_id',$cid);
hiddenval('member_tipe',$mtipe);

$fmod='sirkulasi_peminjaman_form_member_get';
$xform=new xform($fmod);

if($mtipe!=0){
	$lbls='float:left;width:80px;margin-right:4px';
	$fs='float:left;width:150px;margin-right:4px';
		
	echo '<div style="float:left;margin-right:6px;width:62px;height:92px;margin-top:2px">';
	$xform->photof($cid.'-'.$mtipe,'member',60,90,'h');
	echo '</div>';
	echo '<div style="float:left;width:280px">';

	if($mtipe==1){
		$db=siswa_db_byID($cid);
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
			echo '<div class="sfont" style="'.$fs.'">'.$r['nkelas'].'</div>';
		echo '</div>';
	}
	else if($mtipe==2){
		$t=mysql_query("SELECT replid,nip,nama FROM hrd_pegawai WHERE replid='$cid' LIMIT 0,1");
		$r=mysql_fetch_array($t);
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="font-size:14px;float:left:margin-right:4px;width:324px"><b>'.$r['nama'].'</b></div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">ID member:</div>';
			echo '<div class="sfont" style="'.$fs.'">'.$r['nip'].'</div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">Tipe member:</div>';
			echo '<div class="sfont" style="'.$fs.'">Pegawai</div>';
		echo '</div>';
	} else {
		$t=mysql_query("SELECT * FROM pus_member WHERE replid='$cid' LIMIT 0,1");
		$r=mysql_fetch_array($t);
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="font-size:14px;float:left:margin-right:4px;width:324px"><b>'.$r['nama'].'</b></div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">ID member:</div>';
			echo '<div class="sfont" style="'.$fs.'">'.$r['nid'].'</div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">Tipe member:</div>';
			echo '<div class="sfont" style="'.$fs.'">Member luar</div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">Kontak:</div>';
			echo '<div class="sfont" style="'.$fs.'">'.$r['kontak'].'</div>';
		echo '</div>';
		echo '<div class="xrowl">';
			echo '<div class="sfont" style="'.$lbls.'">Alamat:</div>';
			echo '<div class="sfont" style="'.$fs.'">'.$r['alamat'].'</div>';
		echo '</div>';
	}
	echo '</div>';
}
?>
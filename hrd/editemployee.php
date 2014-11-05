<?php
require_once('db.php');
require_once('common.php');

$empstatus=getStatus();
$ct_bg="empfile2.png";
?>
<html>
<head>
<title> KEPEGAWAIAN </title>
<?php require_once('style.php');?>
<script type="text/javascript" src="djsobj.js"></script>
<script type="text/javascript" src="jquery-1.8.2.min.js"></script>
<script type="text/javascript" language="javascript">
function search_foc(){
	if(E('search_input').value=='Search...'){
		E('search_input').value='';
	}
	E('search_input').style.color='black';
	
	if(E('search_input').style.width!='160px') $("#search_input").animate({"width": "160px"}, { queue: false, duration: 200 });
}
function search_blur(){
	if(E('search_input').value==''){
		E('search_input').value='Search...';
		E('search_input').style.color='#999999';
		$("#search_input").animate({"width": "120px"}, { queue: false, duration: 200 });
	}
}
function doSearch(){
	if(E('search_input').value!='' && E('search_input').value!='Search...'){
		E('srcform').submit();
	}
}
function selectAll(){
	var n=E('nrow').value;
	for(var i=0;i<parseInt(n);i++){
		
	}
}
</script>
</head>
<body>
<div style="width:1000px;margin:auto">
<table cellspacing="0" cellpadding="0" width="1000px">
<tr valign="top">
	<?php require_once('banner.php');?>
</tr>
<tr><td colspan="2">
	<table cellspacing="0" cellpadding="0" width="1000px">
	<tr><td>
		<?php $cview="employee"; require_once('tabs.php');?>
	</td><td align="right">
		<?php require_once('srcform.php'); ?>
	</td></tr>
	<tr>
		<td colspan="2">
			<!--============================= CONTENTS =============================-->
			<?php
			$dcid = $_REQUEST['nid'];
			$empp = mysql_fetch_array(mysql_query("SELECT * FROM jbssdm.employment_app WHERE dcid='$dcid'"));
			?>
			<div id="ct_box">
				<div class="tview"><b>Edit Data Karyawan</b></div>
				<button class="btn" style="margin-bottom:5px" title="Kembali ke halaman daftar karyawan" onclick="<?php if(gets('lnk')==''){?>history.back()<?php }else {echo "jumpTo('".RLNK."employee.php')";}?>">
					<div style="background:url('<?=IMGR?>larrow.png') no-repeat;padding-left:16px">Daftar Karyawan</div>
				</button>
				<form action="<?=RLNK?>request.php?q=editemployee" method="post" style="padding:0;margin:0" enctype="multipart/form-data">
				<input type="hidden" name="dcid" value="<?=$empp['dcid']?>"/>
				<table class="stable" style="border:1px solid #dedede;padding:10px;background:#f4f4ff" cellspacing="0" cellpadding="2px" width="940px">
					<tr><td colspan="3"><strong>FORMULIR APLIKASI PEKERJAAN</strong></td></tr>
					<tr><td colspan="3"><hr size="1"/></td></tr>
					<tr><td width="16px"><b>A.</b></td><td colspan="2"><strong>Tentukan posisi nama saja yang anda inginkan:</strong></td></tr>
					<?php
					$desired_emp=explode("~",$empp['desired_emp']);
					?>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2">
						<table cellspacing="2px" cellpadding="0" width="100%">
							<tr>
								<td width="20px"><input type="checkbox" name="desired_emp1" id="desired_emp1" <?=isCheck($desired_emp[0],"1")?> value="1"/></td><td>Kepala Sekolah/Guru Klp.Bermain</td>
								<td><input type="checkbox" name="desired_emp2" id="desired_emp2" <?=isCheck($desired_emp[1],"1")?> value="1"/></td><td>Kepala Sekolah/Guru SMA</td>
							</tr>
							<tr>
								<td width="20px"><input type="checkbox" name="desired_emp3" <?=isCheck($desired_emp[2],"1")?> id="desired_emp3" value="1"/></td><td>Kepala Sekolah/Guru TK</td>
								<td><input type="checkbox" name="desired_emp4" id="desired_emp4" <?=isCheck($desired_emp[3],"1")?> value="1"/></td><td>Sekretatis/Administrasi</td>
							</tr>
							<tr>
								<td width="20px"><input type="checkbox" name="desired_emp5" <?=isCheck($desired_emp[4],"1")?> id="desired_emp5" value="1"/></td><td>Kepala Sekolah/Guru SD</td>
								<td><input type="checkbox" name="desired_emp6" id="desired_emp6" <?=isCheck($desired_emp[5],"1")?> value="1"/></td><td>Guru Paruh Waktu</td>
							</tr>
							<tr>
								<td width="20px"><input type="checkbox" name="desired_emp7" <?=isCheck($desired_emp[6],"1")?> id="desired_emp7" value="1"/></td><td>Kepala Sekolah/Guru SMP</td>
								<td><input type="checkbox" name="desired_emp8" id="desired_emp8" <?=isCheck($desired_emp[7],"1")?> value="1"/></td><td>Posisi lain: <input type="text" name="desired_emp_other" id="desired_emp_other" class="ifield" style="width:250px" value="<?=$empp['desired_emp_other']?>"/></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2">Bidang studi apa saja yang anda dapat dan ingin mengajar (khusus guru):</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2"><input type="text" class="ifield" style="width:100%" name="desired_emp_subj" id="desired_emp_subj" value="<?=$empp['desired_emp_subj']?>"/></td>
					</tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>B.</b></td><td colspan="2"><strong>Data Pribadi</strong></td></tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Nama</td>
						<td><input type="text" class="ifield" style="width:100%" name="name" id="name" value="<?=$empp['name']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Jenis Kelamin</td>
						<td>
							<select class="ifield" onchange="getMenikah(this.value)" name="gender" id="gender">
								<option value="Pria" <?=isSelect("Pria",$empp['gender'])?>>Pria</option>
								<option value="Pria" <?=isSelect("Wanita",$empp['gender'])?>>Wanita</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Alamat asal</td>
						<td><input type="text" class="ifield" style="width:100%" name="address" id="address" value="<?=$empp['address']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Alamat Surabaya</td>
						<td><input type="text" class="ifield" style="width:100%" name="addresssby" id="addresssby" value="<?=$empp['addresssby']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Email</td>
						<td><input type="text" class="ifield" style="width:100%" name="email" id="email" value="<?=$empp['email']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Telpon rumah</td>
						<td><input type="text" class="ifield" style="width:100%" name="home_phone" id="home_phone" value="<?=$empp['home_phone']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Fax</td>
						<td><input type="text" class="ifield" style="width:100%" name="fax" id="fax" value="<?=$empp['fax']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">HP</td>
						<td><input type="text" class="ifield" style="width:100%" name="cellphone" id="cellphone" value="<?=$empp['cellphone']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Tempat Lahir</td>
						<td><input type="text" class="ifield" style="width:100%" name="birth_place" id="birth_place" value="<?=$empp['birth_place']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Tanggal Lahir</td>
						<td>
							<?=inputTanggal('birth_date',$empp['birth_date'])?>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Status pernikahan</td>
						<td>
							<select class="ifield" onchange="getMenikah(this.value)" name="marital_stat" id="marital_stat">
								<?=getNikahOpt($empp['marital_stat'])?>
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Agama dan denominasi</td>
						<td><input type="text" class="ifield" style="width:100%" name="religion" id="religion" value="<?=$empp['religion']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Nama gereja</td>
						<td><input type="text" class="ifield" style="width:100%" name="church_name" id="church_name" value="<?=$empp['church_name']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Alamat gereja</td>
						<td><input type="text" class="ifield" style="width:100%" name="church_address" id="church_address" value="<?=$empp['church_address']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Nama pendeta/pastor</td>
						<td><input type="text" class="ifield" style="width:100%" name="pastor_name" id="pastor_name" value="<?=$empp['pastor_name']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Kegiatan-kegiatan anda di gereja</td>
						<td><input type="text" class="ifield" style="width:100%" name="church_activity" id="church_activity" value="<?=$empp['church_activity']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Hobi dan kegiatan kreatif lainnya</td>
						<td><input type="text" class="ifield" style="width:100%" name="hobbies" id="hobbies" value="<?=$empp['hobbies']?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Apakah pernah ke luar negeri?</td>
						<td>
							<script language="javascript" type="text/javascript">
								function getAbroad(a){
									if(a=='Y') document.getElementById('abroadx').style.display='';
									else document.getElementById('abroadx').style.display='none';
								}
							</script>
							<select class="ifield" onchange="getAbroad(this.value)" name="abroad" id="abroad">
								<option value="Y" <?=isSelect($empp['abroad'],"Y")?>>Pernah</option>
								<option value="N" <?=isSelect($empp['abroad'],"N")?>>Belum pernah</option>
							</select>
						</td>
					</tr>
					<tr id="abroadx" style="display:<?=(($empp['abroad']!="N")?"":"none")?>">
						<td>&nbsp;</td>
						<td width="200px">Kemana? Untuk apa?</td>
						<td><input type="text" class="ifield" style="width:100%" name="abroad_where" id="abroad_where" value="<?=$empp['abroad_where']?>"/></td>
					</tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr>
						<td>&nbsp;</td>
						<td colspan="2">
							<table class="tablex" cellspacing="0" cellpadding="2px" width="100%">
								<tr class="tablexhead">
									<th>Keluarga</th>
									<th width="234px">Nama</th>
									<th width="154">Alamat</th>
									<th width="104">Pendidikan</th>
									<th width="154">Tempat & Tgl. lahir</th>
									<th width="104">Pekerjaan</th>
								</tr>
								<?php $relv=Array('orangtua','saudara','sutri','anak');
									  $relx=Array('Orang tua','Saudara kandung','Suami/Isteri','Anak Kandung');
								for($kk=0;$kk<count($relv);$kk++){ ?>
								<tr>
									<td><?=$relx[$kk]?><input type="hidden" name="rel_relative<?=$kk?>" value="<?=$kk?>"/></td>
									<td align="center"><input style="width:230px" type="text" class="ifield" name="rel_name<?=$kk?>"/></td>
									<td align="center"><input style="width:150px" type="text" class="ifield" name="rel_address<?=$kk?>"/></td>
									<td align="center"><input style="width:100px" type="text" class="ifield" name="rel_education<?=$kk?>"/></td>
									<td align="center"><input style="width:150px" type="text" class="ifield" name="rel_birth_place<?=$kk?>"/></td>
									<td align="center"><input style="width:100px" type="text" class="ifield" name="rel_ocupation<?=$kk?>"/></td>
								<?php }?>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>C.</b></td><td colspan="2"><strong>Riwayat Pendidikan</strong></td></tr>
					<tr><td><b>&nbsp;</b></td><td colspan="2"><strong>Pendidikan Formal</strong></td></tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2">
							<script type="text/javascript" language="javascript">
								var edu_r=3;
								function  addedu(){
									E('edu_r'+edu_r).style.display='';
									edu_r++;
								}
							</script>
							<table class="tablex" cellspacing="0" cellpadding="2px" style="margin-bottom:5px">
								<tr class="tablexhead">
									<th width="444px">Nama Sekolah/Universitas</th>
									<th width="84px">Tahun</th>
									<th width="104px">Gelar</th>
									<th width="154px">Bidang</th>
									<tH width="84px">IPK</th>
								</tr>
								<?php
								for($kk=0;$kk<10;$kk++){ ?>
								<tr id="edu_r<?=$kk?>" style="display:<?=(($kk>2)?"none":"")?>"><input type="hidden" name="edu_urut<?=$kk?>" value="<?=$kk?>"/>
									<td align="center"><input style="width:440px" type="text" class="ifield" name="edu_school_name<?=$kk?>"/></td>
									<td align="center"><input style="width:80px" type="text" class="ifield" name="edu_year<?=$kk?>"/></td>
									<td align="center"><input style="width:100px" type="text" class="ifield" name="edu_degree<?=$kk?>"/></td>
									<td align="center"><input style="width:150px" type="text" class="ifield" name="edu_major<?=$kk?>"/></td>
									<td align="center"><input style="width:80px" type="text" class="ifield" name="edu_gpa<?=$kk?>"/></td>
								<?php }?>
								</tr>
							</table>
							<a class="linkl11" href="javascript:addedu()"/>Tambah baris riwayat pendidikan...</a>
						</td>
					</tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>&nbsp;</b></td><td colspan="2"><strong>Kursus-kursus/Seminar-seminar</strong></td></tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2">
							<script type="text/javascript" language="javascript">
								var cou_r=3;
								function  addcourse(){
									E('cou_r'+cou_r).style.display='';
									cou_r++;
								}
							</script>
							<table class="tablex" cellspacing="0" cellpadding="2px" style="margin-bottom:5px">
								<tr class="tablexhead">
									<th width="481px">Nama Kursus/Seminar</th>
									<th width="204px">Penyelenggara</th>
									<th width="104px">Kota</th>
									<th width="84px">Tahun</th>

								</tr>
								<?php
								for($kk=0;$kk<10;$kk++){ ?>
								<tr id="cou_r<?=$kk?>" style="display:<?=(($kk>2)?"none":"")?>"><input type="hidden" name="cou_urut<?=$kk?>" value="<?=$kk?>"/>
									<td align="center"><input style="width:477px" type="text" class="ifield" name="cou_title<?=$kk?>"/></td>
									<td align="center"><input style="width:200px" type="text" class="ifield" name="cou_institution<?=$kk?>"/></td>
									<td align="center"><input style="width:100px" type="text" class="ifield" name="cou_city<?=$kk?>"/></td>
									<td align="center"><input style="width:80px" type="text" class="ifield" name="cou_year<?=$kk?>"/></td>
								<?php }?>
								</tr>
							</table>
							<a class="linkl11" href="javascript:addcourse()"/>Tambah baris kurus...</a>
						</td>
					</tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>&nbsp;</b></td><td colspan="2"><strong>Keanggotaan</strong></td></tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2">
							<script type="text/javascript" language="javascript">
								var org_r=3;
								function  addorg(){
									E('org_r'+org_r).style.display='';
									org_r++;
								}
							</script>
							<table class="tablex" cellspacing="0" cellpadding="2px" style="margin-bottom:5px">
								<tr class="tablexhead">
									<th width="590px">Nama Organisasi</th>
									<th width="204px">Posisi</th>
									<th width="84px">Tahun</th>

								</tr>
								<?php
								for($kk=0;$kk<10;$kk++){ ?>
								<tr id="org_r<?=$kk?>" style="display:<?=(($kk>2)?"none":"")?>"><input type="hidden" name="org_urut<?=$kk?>" value="<?=$kk?>"/>
									<td align="center"><input style="width:586px" type="text" class="ifield" name="org_name<?=$kk?>"/></td>
									<td align="center"><input style="width:200px" type="text" class="ifield" name="org_position<?=$kk?>"/></td>
									<td align="center"><input style="width:80px" type="text" class="ifield" name="org_year<?=$kk?>"/></td>
								<?php }?>
								</tr>
							</table>
							<a class="linkl11" href="javascript:addorg()"/>Tambah baris organinasi...</a>
						</td>
					</tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>D.</b></td><td colspan="2"><strong>Kesehatan</strong></td></tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2">Jelaskan bagaimana kesehatan anda secara umum:</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2"><textarea style="width:100%;" rows="3" type="text" class="ifield" name="healt_description"><?=$empp['healt_description']?></textarea></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Bagaimana pendengaran anda?</td>
						<td><input type="text" class="ifield" style="width:100%" name="healt_hearing"  value="<?=$empp['healt_hearing']?>" id="healt_hearing"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Bagaimana penglihatan anda?</td>
						<td><input type="text" class="ifield" style="width:100%" name="healt_eyesight" value="<?=$empp['healt_eyesight']?>" id="healt_eyesight"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Golongan darah anda</td>
						<td><input type="text" class="ifield" style="width:100%" name="healt_bloodtype" value="<?=$empp['healt_bloodtype']?>" id="healt_bloodtype"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Adakah kecacatan, atau kondisi khusus lainnya?</td>
						<td><input type="text" class="ifield" style="width:100%" name="healt_disabilities" value="<?=$empp['healt_disabilities']?>" id="healt_disabilities"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="200px">Tanggal pemeriksaan dokter terakhir</td>
						<td><input type="text" class="ifield" style="width:100%" name="healt_lastex" value="<?=$empp['healt_lastex']?>" id="healt_lastex"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2">Apakah pernah menjalani perawatan di rumah sakit?, Untuk keperluan apa dan selama berapa lama?</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['healt_circumtance']?>" name="healt_circumtance" id="healt_circumtance"/></td>
					</tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>E.</b></td><td colspan="2"><strong>Informasi Umum</strong></td></tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Apakah anda pernah melamar pekerjaan di sini?</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi1']?>" name="gi1" id="gi1"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Apakah anda mempunyai teman atau anggota keluarga yang bekerja di sini?</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi2']?>" name="gi2" id="gi2"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Apakah anda pernah mengikuti tes pekerjaan? Kapan dan di mana? Apakah nama tes-tes tersebut?</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi3']?>" name="gi3" id="gi3"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Pada jenjang yang manakah anda mampu dan bersedia mengajar? (khusus guru)</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi4']?>" name="gi4" id="gi4"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Apakah tujuan profesional anda yang paling tinggi dan apakah rencana anda untuk meraihnya?</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi5']?>" name="gi5" id="gi5"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Apakah anda memiliki rumah sendiri?</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi6']?>" name="gi6" id="gi6"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Apakah anda memiliki kendaraan sendiri? (tentukan)</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi7']?>" name="gi7" id="gi7"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Bisakan anda memainkan alat musik? (tentukan)</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi8']?>" name="gi8" id="gi8"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Apakah anda berkebiasaan merokok, minum munuman keras, menggunakan napza/narkoba, berjudi?</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi9']?>" name="gi9" id="gi9"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Apakah anda pernah terlibat dalam masalah krimina? Jelaskan bila ya. Tuliskan tahun dan tempat di mana itu terjadi!</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi10']?>" name="gi10" id="gi10"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Apakah anda bersedia mengikuti semua peraturan dan prosedur Sekolah VITA, termasuk mengenai moral, seragam, dan kekristenan?</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi11']?>" name="gi11" id="gi11"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Apakah anda bersedia bekerja melebihi jam kerja bila diperlukan?</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi12']?>" name="gi12" id="gi12"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Kapan anda bisa mulai bekerja?</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi13']?>" name="gi13" id="gi13"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Perkiraan gaji yang diharapkan?</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['gi14']?>" name="gi14" id="gi14"/></td>
					</tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>F.</b></td><td colspan="2"><strong>Data Pekerjaan</strong></td></tr>
					<tr><td><b>&nbsp;</b></td><td colspan="2"><strong>Anda memiliki pengalaman dan kemampuan di bidang:</strong></td></tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2">
						<?php
							$job_data=explode("~",$empp['job_data']);
						?>
						<table cellspacing="2px" cellpadding="0" width="100%">
							<tr>
								<td width="20px"><input type="checkbox" <?=isCheck($job_data[0],"1")?> name="job_data1" id="job_data1" value="1"/></td><td width="300px">Pengurusan perpustakaan</td>
								<td width="20px"><input type="checkbox" <?=isCheck($job_data[1],"1")?> name="job_data2" id="job_data2" value="1"/></td><td>Pembukuan</td>
							</tr>
							<tr>
								<td width="20px"><input type="checkbox" <?=isCheck($job_data[2],"1")?> name="job_data3" id="job_data3" value="1"/></td><td>Mengajar</td>
								<td width="20px"><input type="checkbox" <?=isCheck($job_data[3],"1")?> name="job_data4" id="job_data4" value="1"/></td><td>Asisten guru</td>
							</tr>
							<tr>
								<td width="20px"><input type="checkbox" <?=isCheck($job_data[4],"1")?> name="job_data5" id="job_data5" value="1"/></td><td>Menulis dan mengedit</td>
								<td width="20px"><input type="checkbox" <?=isCheck($job_data[5],"1")?> name="job_data6" id="job_data6" value="1"/></td><td>Konseling</td>
							</tr>
							<tr>
								<td width="20px"><input type="checkbox" <?=isCheck($job_data[6],"1")?> name="job_data7" id="job_data7" value="1"/></td><td colspan="3">Kesiswaan</td>
							</tr>
							<tr>
								<td width="20px"><input type="checkbox" <?=isCheck($job_data[7],"1")?> name="job_data8" id="job_data8" value="1"/></td><td colspan="3">Kemamppuan komputer (tentukan)</td>
							</tr>
							<tr>
								<td width="20px">&nbsp;</td><td colspan="3"><input type="text" class="ifield" style="width:100%" value="<?=$empp['job_data_comp']?>" name="job_data_comp" id="job_data_comp"/></td>
							</tr>
							<tr>
								<td width="20px"><input type="checkbox" <?=isCheck($job_data[8],"1")?> name="job_data9" id="job_data9" value="1"/></td><td colspan="3">Kemamppuan lainnya (tentukan)</td>
							</tr>
							<tr>
								<td width="20px">&nbsp;</td><td colspan="3"><input type="text" class="ifield" style="width:100%" value="<?=$empp['job_data_other']?>" name="job_data_other" id="job_data_other"/></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>G.</b></td><td colspan="2"><strong>Riwayat Pekerjaan (dimulai dari yang terbaru)</strong></td></tr>
					<tr><td>&nbsp;</td><td colspan="2">
						<script type="text/javascript" language="javascript">
							var job_r=1;
							function  addjob(){
								if(job_r<10){
								E('job_r'+job_r).style.display='';
								job_r++;
								}
							}
						</script>
						<?php for($jj=0;$jj<10;$jj++){?>
						<table  id="job_r<?=$jj?>" style="display:<?=(($jj>0)?"none":"")?>" cellspacing="0" cellpadding="2px" width="100%">
							<input type="hidden" name="his_urut<?=$jj?>" value="<?=$jj?>"/>
							<tr><td width="20px"><?=($jj+1)?>.</td><td width="200px">Nama Perusahaan</td><td><input type="text" class="ifield" style="width:100%" name="his_name<?=$jj?>" id="his_name<?=$jj?>"/></td></tr>
							<tr><td>&nbsp;</td><td>Alamat</td><td><input type="text" class="ifield" style="width:100%" name="his_address<?=$jj?>" id="his_address<?=$jj?>"/></td></tr>
							<tr><td>&nbsp;</td><td>Mulai bekerja</td><td>
								<?=inputTanggal("his_date_from".$jj)?>
							</td></tr>
							<tr><td>&nbsp;</td><td>Hingga</td><td>
								<?=inputTanggal("his_date_to".$jj)?>
							</td></tr>
							<tr><td>&nbsp;</td><td>Posisi</td><td><input type="text" class="ifield" style="width:100%" name="his_position<?=$jj?>" id="his_position<?=$jj?>"/></td></tr>
							<tr><td>&nbsp;</td><td>Gaji per bulan</td><td><input type="text" class="ifield" style="width:100%" name="his_salary<?=$jj?>" id="his_salary<?=$jj?>"/></td></tr>
							<tr><td>&nbsp;</td><td>Alasan meninggalkan pekerjaan</td><td><input type="text" class="ifield" style="width:100%" name="his_reason<?=$jj?>" id="his_reason<?=$jj?>"/></td></tr>
						</table>
						<?php }?>
						<br/>
						<a class="linkl11" href="javascript:addjob()"/>Tambah riwayat pekerjaan...</a>
					</td></tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>H.</b></td><td colspan="2"><strong>Referensi (tidak termasuk keluarga)</strong></td></tr>
					<tr><td>&nbsp;</td><td colspan="2">
						<script type="text/javascript" language="javascript">
							var ref_r=1;
							function  addref(){
								if(ref_r<10){
								E('ref_r'+ref_r).style.display='';
								ref_r++;
								}
							}
						</script>
						<?php for($jj=0;$jj<10;$jj++){?>
						<table id="ref_r<?=$jj?>" style="display:<?=(($jj>0)?"none":"")?>" cellspacing="0" cellpadding="2px" width="100%">
							<input type="hidden" name="ref_urut<?=$jj?>" value="<?=$jj?>"/>
							<tr><td width="20px"><?=($jj+1)?>.</td><td width="200px">Nama</td><td><input type="text" class="ifield" style="width:100%" name="ref_name<?=$jj?>" id="ref_name<?=$jj?>"/></td></tr>
							<tr><td>&nbsp;</td><td>Alamat</td><td><input type="text" class="ifield" style="width:100%" name="ref_address<?=$jj?>" id="ref_address<?=$jj?>"/></td></tr>
							<tr><td>&nbsp;</td><td>Telepon</td><td><input type="text" class="ifield" style="width:100%" name="ref_phone<?=$jj?>" id="ref_phone<?=$jj?>"/></td></tr>
							<tr><td>&nbsp;</td><td>Pekerjaan</td><td><input type="text" class="ifield" style="width:100%" name="ref_occupation<?=$jj?>" id="ref_occupation<?=$jj?>"/></td></tr>
							<tr><td>&nbsp;</td><td>Mengetahui sejak</td><td><input type="text" class="ifield" style="width:100%" name="ref_year<?=$jj?>" id="ref_year<?=$jj?>"/></td></tr>
							<tr><td>&nbsp;</td><td>Hubungan</td><td><input type="text" class="ifield" style="width:100%" name="ref_relation<?=$jj?>" id="ref_relation<?=$jj?>"/></td></tr>
						</table>
						<?php }?>
						<br/>
						<a class="linkl11" href="javascript:addref()"/>Tambah referensi...</a>
					</td></tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>I.</b></td><td colspan="2"><strong>Informasi Tambahan</strong></td></tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Apakah anda sudah lahir kembali dalam Kristus? (bila ya, tuliskan kapan anda mengalaminya)</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['ai1']?>" name="ai1" id="ai1"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Jelaskan mengenai keadaan kelahiran baru tersebut dan apa dampaknya bagi kehidupan anda</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['ai2']?>" name="ai2" id="ai2"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Tuliskan ungkapan/pernyataan iman anda</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['ai3']?>" name="ai3" id="ai3"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Tuliskan pendapat anda mengenai Tritunggal</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['ai4']?>" name="ai4" id="ai4"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td colspan="2">Tuliskan pendapat anda mengenai pendidikan berdasarkan Kristiani</td></tr>
						<tr><td>&nbsp;</td><td colspan="2"><input type="text" class="ifield" style="width:100%" value="<?=$empp['ai5']?>" name="ai5" id="ai5"/></td>
					</tr>
					
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>&bull;</b></td><td colspan="2"><strong>Keterangan</strong></td></tr>
					<tr>
						<td>&nbsp;</td><td colspan="2"><textarea class="ifield" style="width:100%" name="catatan" id="catatan" rows="5"><?=$empp['catatan']?></textarea></td>
					</tr>
					
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr><td><b>&bull;</b></td><td colspan="2"><strong>Lampiran berkas</strong></td></tr>
					<tr>
						<td>&nbsp;</td><td colspan="2"><input id="file" type="file" name="file"/></td>
					</tr>
					
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					
					<tr>
						<td>&nbsp;</td><td colspan="2" style="text-align:justify">Saya telah secara penuh membaca dan engisi keseluruhan formulir ini yang lima lembar banyaknya. Saya memberi ijin bagi Sekolah VITA untuk melakukan penyelidikan lebih lanjut atas semua yang telah saya tuliskan. Dengan tanda tangan saya ini, saya menyatakan bahwa semua yang telah saya tuliskan adalah sebenarnya dan benar sebatas pengetahuan dan kepercayaan saya. Saya mengerti bahwa dengan tanda tangan ini saya memberi ijin bagi Sekolah Vita untuk mendapatkan informasi lebih lanjut tentang saya (bila diperlukan) dari pihak kepolisian atau pihak hukum lainnya, dari kontak-kontak referensi, ataupun dari pihak lain yang diperlukan. Saya juga bersedia bila sidik jari saya diambil. Saya mengerti bahwa bila ditemukan adanya informasi yang tidak jujur atau tidak sesuai dengan sebenarnya maka saya akan didiskualifikasi diminta mengundirkan diri, dan atau dikenakan sanksi lainnya.</td></tr>
					</tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<script type="text/javascript" language="javascript">
						function cekAccept(a){
							if(a){
								document.getElementById('simpan').style.display='';
							} else {
								document.getElementById('simpan').style.display='none';
							}
						}
					</script>
					<tr><td>&nbsp;</td><td colspan="2">
						<table cellspacing="0" cellpadding="0" style="display:none"><tr><td>
						<input type="checkbox" onclick="cekAccept(this.checked)" /></td><td>&nbsp;Saya membenarkan pernyataan di atas.
						</td></tr></table>
					</td></tr>
					<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
					<tr height="30px">
						<td align="center" colspan="3">
						<input type="button" class="btn" onclick="<?php if(gets('lnk')==''){?>history.back()<?php }else {echo "jumpTo('".RLNK."employee.php')";}?>" value="Batal" />&nbsp;
						<input type="submit" class="btnx" id="simpan" value="Simpan" />
						</td>
					</tr>
					
				</table>
				</form>
			</div>
		</td>
	</tr>
	</table>
</td></tr>
</table>
</div>
</body>
</html>
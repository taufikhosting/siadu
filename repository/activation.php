<?php session_start(); require_once('../shared/config.php'); require_once('system/config.php'); $tl=1;

$t=mysql_query("SELECT * FROM appactivate WHERE app='".APID."' LIMIT 0,1");
$r=mysql_fetch_array($t);
if($r['aktif']=='1'){
	header('location:./');
}

$wrong=0; $ukey=''; $vkey='';
if(gpost('accept')=='YES'){
	$ukey=gpost('cuser');
	$vkey=gpost('cverify');
	
	$t=mysql_query("SELECT * FROM appactivate WHERE user='$ukey' AND kunci='$vkey' AND aktif='0' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$pwd=md5($vkey);
		mysql_query("UPDATE appactivate SET aktif='1' WHERE user='$ukey' AND kunci='$vkey'");
		mysql_query("INSERT INTO admin SET nama='Admin',uname='$ukey',passwd='$pwd',app='rep',level='1'");
		header('location:./');
	} else {
		$wrong=1;
	}
}
// APP:
$APP_TITLE='Repository';
$APP_PAGETITLES=Array('file'=>'File','grup'=>'Grup');
$APP_HOMETITLE='Home';
$APP_PLUGIN="flot|tinymce";

?>
<html><head>
<title>SIADU :: <?=$APP_TITLE?></title>
<?php require_once(SHAREDMAINSTYLE);require_once(MODDIR.'control.php');?>
<script type="text/javascript" language="javascript" src="../shared/jquery.js"></script>
<?php if($api_flot){?>
<script type="text/javascript" language="javascript" src="../shared/jquery.flot.js"></script>
<script type="text/javascript" language="javascript" src="../shared/jquery.flot.categories.js"></script>
<?php }?>
<script type="text/javascript" language="javascript">
var HomeTitle="<?=$APP_HOMETITLE?>"; var pagetitle=new Array();
<?php foreach($APP_PAGETITLES as $k=>$v) echo 'pagetitle["'.$k.'"]="'.$v.'";'; ?>
</script>
<script type="text/javascript" src="../shared/maincontrol.js"></script>
<script type="text/javascript" src="controller.js"></script>
<?php if($api_tmce){?>
<script type="text/javascript" src="../shared/tinymce/tiny_mce.js"></script>
<?php }?>
</head><body>
<div id="topsection">
	<div id="logo"></div>
	<div id="ltitle"><?=$APP_TITLE?></div>
	<div id="tabmenu"><ul id="tablist"></ul></div>
	<div id="tabmenu3" style="display:none"><button class="smbtn" title="" onclick="Logout()">Logout</button></div>
</div>
<div id="global">
<div id="cbox" style="display:none">
	
</div>
<div id="maincontainer" style="overflow:hidden">
	<input type="hidden" id="cpage" value="matapelajaran" />
	<div id="pagetitle" class="pagetitle" style="display:none"><?=$APP_HOMETITLE?></div>
	<div id="pagebox" style="display:">
		<table width="100%" cellspacing="20px" cellpadding="0"><tr><td>
			<div id="loader" class="loader" style="display:none"></div>
			<div id="page">
				<div class="hl1" style="margin-bottom:20px">Aktifasi Aplikasi - Repository</div>
				
				<div class="sfont" style="margin-bottom:6px;margin-top:10px"><b>Deskripsi aplikasi:</b></div>
				<div class="psf12155"><b>Repository</b> adalah aplikasi untuk meng-upload file pada file server yang kami sediakan secara online.<br/>User dapat mengupload file melalui antar muka aplikasi yang kami sediakan dan membagi file tersebut kepada member grup.<br/>Grup dalam aplikasi ini bersifat tertutup. Manajemen file dan registrasi anggota hanya dilakukan oleh admin. Anggota grup hanya dapat mendownload file yang disediakan oleh admin.</div>
				<div class="sfont" style="margin-bottom:6px;margin-top:10px"><b>Fitur aplikasi:</b></div>
				<div class="psf12155">Aplikasi ini menyediakan antar muka untuk mengupload file dan membagi file tersebut kepada anggota grup.<br/>
				Tipe file yang didukung oleh aplikasi ini adalah word document, excel, pdf, dan file gambar jpg, gif dan png.<br/>
				Ukuran maksimum sebuah file yang dapat diterima adalah 5MB.
				</div>
				<div class="sfont" style="margin-bottom:6px;margin-top:10px"><b>Ketentuan layanan:</b></div>
				<div class="psf12155">Penyedia layanan ini adalah <b>Johan Kharisma</b> yang kemudian disebut sebagai <b>Penyedia layanan</b> atau johankharisma.com.<br/>
				Pengguna layanan adalah pengguna aplikasi yang terdaftar sebagai admin maupun anggota grup dalam aplikasi ini.<br/>
				Penyedia layanan menyediakan antar muka bagi pengguna layanan untuk melakukan upload file dan membagi file tersebut kepada anggota grup.<br/>
				Penyedia layanan tidak bertanggung jawab atas kontent yang diupload oleh pengguna layanan.<br/>
				File-file ilegal maupun yang mengandung konten yang melanggar norma atau hukum yang diupload oleh pengguna adalah sepenuhnya tanggung jawab dari pengguna layanan.<br/> Temuan bentuk penyalah gunaan aplikasi ini dapat berakibat pemblokiran hak akses pengguna layanan dan penghapusan seluruh file yang telah diupload oleh pengguna layanan.</div>
				
				
				<div class="sfont" style="padding:10px;border:1px solid #bbb;border-radius:5px;background:#f0f0f0;width:290px;margin-top:30px;text-align:center">
				<form action="activation.php" method="post">
				<input type="hidden" name="accept" value="YES"/>
				<?php if($wrong!=0){?><div class="sfont" style="text-align:justify;margin-bottom:5px;color:#ff0000">Kode admin atau kode verifikasi tidak valid.</div><?php }?>
				<table class="stable" cellspacing="0" cellpadding="0" width="100%">
					<tr height="30px"><td width="120px"><b>Kode admin:</b></td><td align="right"><?=iText('cuser',$ukey,'width:160px')?></td></tr>
					<tr height="30px"><td><b>Kode verifikasi:</b></td><td align="right"><?=iText('cverify',$vkey,'width:160px')?></td></tr>
				</table>
				<div class="sfont" style="text-align:justify;margin-top:20px">Dengan mengklik tombol 'Setuju dan Aktifkan' di bawah ini anda menyetujui dan menerima ketentuan layanan tersebut diatas.</div>
				<input class="btnz" type="submit" value="Setuju dan Aktifkan" style="margin-top:20px;width:100%"/>
				</form>
				</div>
			</div>
		</td></tr></table>
	</div>
<div id="panel" style="display:none">
</div>
</div>
</div>
</div>
<div id="copyright">Copyright &copy; Johan Kharisma - All right reserved &nbsp;&nbsp;&nbsp;</div>
<?php require_once(MODDIR.'fform.php'); ?>
<?php require_once(MODDIR.'fform2.php'); ?>
<div id="pagepreview">
</div>
</body></html>
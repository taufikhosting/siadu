<?php
error_reporting(1);
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

//$index_hal = 1;
if (!cek_login ()){   
	
$admin .='<p class="judul">Access Denied !!!!!!</p>';
}else{
$backup_file = 'db-backup-asfa-solution'.date('Y-m-d').'.sql';

// get backup
$mybackup = backup_tables("localhost","root","","sister","*");

// save to file
$handle = fopen($backup_file,'w+');
fwrite($handle,$mybackup);
fclose($handle);

$admin.= "
	<div class='message success'>
		<h5>Success!</h5>
		<p>Backup data telah berhasil, silahkan klik link download dibawah untuk menyimpan ke dalam PC local Anda.</p>
	</div>";
	
$admin.= "<a href='$backup_file'><button type='button' class='btn btn-primary'>Download Disini</button></a>";
}
echo $admin;
?>
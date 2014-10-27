<?php
$un=dbFetch("alias","mstr_user","W/dcid='1'");
?>
<td style="padding:0 0 10px 0">
<img src="<?=IMGR?>banner.png" height="80px"/>
</td>
<td align="right" class="adms">
	Welcome: <b>Admin</b>&nbsp;&bull;&nbsp;
	Login at: <?=ftgl(date("Y-m-d"))?>, <?=date("H:i:s")?>&nbsp;&bull;&nbsp;
	<a class="alink" href="<?=RLNK?>login.php">Logout</a>
</td>

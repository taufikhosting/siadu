<?php

$mtitle="User";

$opt=gpost('opt');
$cid=gpost('cid');
$name=gpost('name');
$alias=gpost('alias');
$password0=gpost('password0');
$password1=gpost('password1');
$password2=gpost('password2');

if($opt=='a'){
	if($password1==$password2){
		$password=md5($password1);
		$n=dbSRow("mstr_user","W/name='$name'");
		if($n==0){
			dbInsert("mstr_user",Array('name'=>$name,'alias'=>$alias,'password'=>$password));
		}
	}
	require_once(APPDIR.'m_user_table.php');
}
else if($opt=='u'){
	$r=dbSFA("*","mstr_user","W/dcid='$cid'");
	if($password0!=''){
		$password=md5($password0);
		if($r['password']=$password && $password1==$password2){
			$password=md5($password1);
			dbUpdate("mstr_user",Array('alias'=>$alias,'password'=>$password),"dcid='$cid'");
		}
	} else {
		dbUpdate("mstr_user",Array('alias'=>$alias),"dcid='$cid'");
	}
	require_once(APPDIR.'m_user_table.php');
}
else if($opt=='d'){
	dbDel("mstr_user","dcid='$cid'");
	require_once(APPDIR.'m_user_table.php');
}
else if($opt=='af') { // Add Form
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
<div class="fformbox" style="width:400px">
	<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
		<b>Add New <?=$mtitle?></b>
	</div>
	<div style="text-align:left;padding:10px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="380px">
			<tr><td width="120px">User name:</td><td><input type="text" class="ifield" id="name" value="" style="width:250px"/></td></tr>
			<tr><td width="120px">Display name:</td><td><input type="text" class="ifield" id="alias" value="" style="width:250px"/></td></tr>
			<tr style="display:none"><td width="120px">Old password:</td><td><input type="password" class="ifield" id="password0" value="" style="width:250px"/></td></tr>
			<tr><td width="120px">Password:</td><td><input type="password" class="ifield" id="password1" value="" style="width:250px"/></td></tr>
			<tr><td width="120px">Retype password:</td><td><input type="password" class="ifield" id="password2" value="" style="width:250px"/></td></tr>
		</table>
		<table cellspacing="0" cellpadding="3px" width="100%" style="margin-top:20px"><tr>
			<td align="center">
				<input type="button" class="btn" onclick="close_fform()" value="Cancel"/>
				<input type="button" class="btnx" value="Save" onclick="m_user('a',true)"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php }
else if($opt=='uf') { // Edit Form
$r=dbSFA("*","mstr_user","W/dcid='$cid'");
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
<div class="fformbox" style="width:400px">
	<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
		<b>Edit <?=$mtitle?></b>
	</div>
	<div style="text-align:left;padding:10px">
		<input type="hidden" id="name" value="0" />
		<table class="stable" cellspacing="0" cellpadding="4px" width="380px">
			<tr><td width="120px">User name:</td><td><b><?=$r['name']?></b></td></tr>
			<tr><td width="120px">Display name:</td><td><input type="text" class="ifield" id="alias" value="<?=$r['alias']?>" style="width:250px"/></td></tr>
			<tr><td width="120px"></td><td>&nbsp;</td></tr>
			<tr><td width="120px">Old password:</td><td><input type="password" class="ifield" id="password0" value="" style="width:250px"/></td></tr>
			<tr><td width="120px">Password:</td><td><input type="password" class="ifield" id="password1" value="" style="width:250px"/></td></tr>
			<tr><td width="120px">Retype password:</td><td><input type="password" class="ifield" id="password2" value="" style="width:250px"/></td></tr>
			<tr><td width="120px"></td><td><span style="font-size:10px"><i>Leave passwords blank if you do not want to change the password.</i></span></td></tr>
		</table>
		<table cellspacing="0" cellpadding="3px" width="100%" style="margin-top:20px"><tr>
			<td align="center">
				<input type="button" class="btn" onclick="close_fform()" value="Cancel"/>
				<input type="button" class="btnx" value="Save" onclick="m_user('u',true,<?=$cid?>)"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php }
else if($opt=='df') { // Delete Form
$r=dbSFA("*","mstr_user","W/dcid='$cid'");
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
<div class="fformbox" style="width:500px">
	<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
		<b>Delete <?=$mtitle?></b>
	</div>
	<div style="text-align:left;padding:10px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="480px">
			<tr><td><p class="line150">Are you sure you want to delete "<b><?=$r['alias']?></b>"?</p></td></tr>
		</table>
		<table cellspacing="0" cellpadding="3px" width="100%" style="margin-top:20px"><tr>
			<td align="center">
				<input type="button" class="btn" onclick="close_fform()" value="Cancel"/>
				<input type="button" class="btnx" value="Delete" onclick="m_user('d',0,<?=$cid?>)"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php } ?>
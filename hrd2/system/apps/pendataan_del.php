<?php
$opt=gpost('opt');
$cid=gpost('id');
$name=gpost('name');

if($opt=='d'){
	$sql="DELETE FROM hrd_pegawai WHERE replid='$cid'";
	if(mysql_query($sql)) $_SESSION[ASID.'notifbox']='<div id="notifbox" class="infobox" style="float:left">Data pegawai telah dihapus.</div>';
	else $_SESSION[ASID.'notifbox']='<div id="notifbox" class="warnbox" style="float:left">Data pegawai tidak dapat dihapus. Terjadi kesalahan teknis program. Silahkan menghubungi administrator.</div>';
}else{
// Form dimension
$fwidth=400; $lwidth=100; if($opt=='df') $fwidth=500;
$iTextFw="width:".($fwidth-$lwidth-18)."px";
$mdialog=Array();
$mdialog['df']='Hapus Data Pegawai';
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt" align="center" style="padding-top:150px">
<div id="fformbox" class="fformbox" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div style="padding:15px;text-align:left;color:#646464;font:18px <?=SFONTL?>">
		<?=$mdialog[$opt]?>
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<tr><td>
			<div class="sfont" style="line-height:150%;margin-bottom:5px">Apakah anda yakin untuk menghapus data <b><?=$name?></b>?</div>
		</td></tr>
		</table>
		<table cellspacing="0" cellpadding="3px" width="<?=$fwidth?>px" style="margin-top:20px"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform()" value="Tidak"/>
				<input type="button" class="btnx" value="Hapus" onclick="pendataan_delete(<?=$cid?>)"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php } ?>
<?php
function iPopbox($d,$t,$p="",$cb=""){
	if($p=="") $p=$t;
	$s="<div id=\"popd_".$d."\" style=\"float:left;margin-left:2px\">";
	$s.="<button type=\"button\" class=\"obtna\" title=\"Add new ".$t."\" onclick=\"open_popbox('".$d."')\" style=\"margin-left:2px\">";
	$s.="<img src=\"".IMGR."add.png\" /></button>";
	$s.="<div id=\"popb_".$d."\" class=\"popblock2\" style=\"display:none;position:fixed;top:0;left:0\" onclick=\"close_popbox('".$d."')\"></div>";
	$s.="<div id=\"popx_".$d."\" class=\"popbox\" style=\"background-position:0 0;display:none\">";
	$s.="<table cellspacing=\"0\" cellpadding=\"0\" width=\"310px\"><tr height=\"58px\" style=\"padding-top:10px\">";
	$s.="<td width=\"35px\" align=\"right\"><input type=\"button\" class=\"popx\" title=\"Cancel\" onclick=\"close_popbox('".$d."')\"/></td>";
	$s.="<td align=\"center\">".iText("popi_".$d,'',"width:220px","New ".$p)."</td>";
	$s.="<td width=\"35px\" align=\"left\"><input type=\"button\" class=\"popy\" title=\"Add\" onclick=\"popbox_save('".$d."',function(){".$cb."})\"/></td>";
	$s.="</tr></table>";
	$s.="</div>";
	$s.="</div>";
	return $s;
}
?>
<style type="text/css">
.popblock{
	background:rgba(0,0,0,0.1);width:1500px;height:800px;position:absolute;top:-400px;left:-500px
}
.popblock2{
	background:rgba(255,255,255,0.4);width:1500px;height:800px;position:absolute;top:-400px;left:-500px
}
.popbox{
	width:310px;height:55px;position:absolute;top:20px;left:-141px;background:url('<?=IMGR?>pbox.png') center no-repeat;
}
.popbox2{
	width:310px;height:55px;position:absolute;top:20px;left:-257px;background:url('<?=IMGR?>popbox2.png') center no-repeat;
}
.popx{
	width:20px; height:20px;
	border:none;
	background:url('<?=IMGR?>popx.png');
	background-position:0 0;
	cursor:pointer;
}
.popx:hover{
	background-position:-20px 0;
}
.popy{
	width:20px; height:20px;
	border:none;
	background:url('<?=IMGR?>popy.png');
	background-position:0 0;
	cursor:pointer;
}
.popy:hover{
	background-position:-20px 0;
}
</style>
<script type="text/javascript" language="javascript">
function open_popbox(a){
	E('popd_'+a).style.position='relative';
	E('popb_'+a).style.display=''; E('popx_'+a).style.display='';
	E('popi_'+a).focus();
}
function close_popbox(a){
	E('popb_'+a).style.display='none'; E('popx_'+a).style.display='none';
	E('popd_'+a).style.position='static';
	E('popi_'+a).value='';
}
function popbox_save(a,b){
	var v=E('popi_'+a).value;
	if(v!=''){
		_('popbox&t='+a+'&opt=a&v='+v,function(r){E(a).innerHTML=r;close_popbox(a);b()});
	} else {
		close_popbox(a);
	}
}
</script>
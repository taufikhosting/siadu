<?php
$r=mysql_fetch_array($t);
$lbc=dbFetch("barcode","book","O/barcode DESC");
echo $lbc;
if($lbc=='')$lbc=1;
else $lbc=intval($lbc)+1;
$lbc=strval($lbc);
if(strlen($lbc)<5){
	for($i=strlen($lbc);$i<5;$i++){
		$lbc='0'.$lbc;
	}
}
$f['dcid']=0;
$blink=gets('back')=='view'?"&act=view&nid=".$nid:"";
$f['nid']=$lbc.'/'.dbFetch("val","mstr_setting","W/dcid=4");
?>
<div class="hl1">Add new book:</div>
<form id="bform" action="<?=RLNK?>request.php?q=addbook" method="post" enctype="multipart/form-data" style="padding:0;margin:0">
<?php require_once(VWDIR.'p_book_form2.php');?>
</form>
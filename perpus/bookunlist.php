<?php
session_start();

require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

$r['ntable']=getsx('ntable');
?>
<html><head>
<?php require_once(SYDIR.'main.php');?>
<?php require_once(MODDIR.'control.php');?>
<style type="text/css">
.box1{
	color:#fff;width:76px;margin:0 2px 2px 0;float:left;background:#40e62a;text-align:center
}
.box0{
	color:#999;width:76px;margin:0 2px 2px 0;float:left;background:#f0f0f0;text-align:center
}
</style>
<script type="text/javascript" src="jsscript/jquery.js"></script>
<script type="text/javascript">
function relod(){
	location.reload(true);
	//alert('a');
	//E('box').innerHTML='';
}
</script>
</head><body>
<?php
	$t=mysql_query("SELECT * FROM `".$r['ntable']."new`"); $i=0;
	$cn=mysql_num_rows($t);
?>
<script type="text/javascript" language="javascript">
//parent.setProc(<?=$cn?>);
</script>
<div id="box" style="width:410px">
<?php $k=0;
	while($f=dbFA($t)){ $k++;?>
	<div id="box<?=$k?>" class="box1"><?=$f['barcode']?></div>
<?php }?>
</div>
<script type="text/javascript" language="javascript">
var bk=<?=$k?>;
if(bk > 50) {
	bk=bk-20;
	E('box'+bk).scrollIntoView(true);
}
parent.setUnlist(<?=$cn?>);
</script>
</body></html>
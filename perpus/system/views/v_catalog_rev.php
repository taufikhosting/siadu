<?php
$f=mysql_fetch_array($t);
$lbc=$f['barcode'];
$t=dbSel("*","catalog","W/dcid='".$f['catalog']."' LIMIT 0,1");
$r=dbFA($t);
$blink="&act=view&nid=".$f['catalog'];
?>
<div class="hl1">Edit book:</div>
<form id="bform" action="<?=RLNK?>request.php?q=revbook" method="post" enctype="multipart/form-data" style="padding:0;margin:0">
<?php require_once(VWDIR.'p_book_form2.php');?>
</form>
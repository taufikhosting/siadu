<?php
$r['language']=1;
$r['author']=0;
$r['author2']=0;
$r['publisher']=0;
$r['release']=date("Y");
?>
<div class="hl1">New catalog:</div>
<form action="<?=RLNK?>request.php?q=newcatalog" method="post" enctype="multipart/form-data" style="padding:0;margin:0">
<?php require_once(VWDIR.'p_book_form.php');?>
</form>
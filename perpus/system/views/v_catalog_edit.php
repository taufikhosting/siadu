<?php
$r=mysql_fetch_array($t);
?>
<div class="hl1">Edit catalog:</div>
<form action="<?=RLNK?>request.php?q=editcatalog" method="post" enctype="multipart/form-data" style="padding:0;margin:0">
<?php require_once(VWDIR.'p_book_form.php');?>
</form>
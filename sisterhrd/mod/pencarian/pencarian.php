<?php
ob_start();
?>
<form method="get" action="index.php">
<input type="text" value="Pencarian Halaman..." onFocus="if (this.value == 'Pencarian Halaman...') {this.value ='';}" onBlur="if (this.value == '') {this.value = 'Pencarian Halaman...';}" name="query" class="textbox" />
<input type="submit" name="submit" class="button" value="Cari" />
<input type="hidden" name="pilih" value="search" />
</form>
<?php
$out = ob_get_contents();
ob_end_clean();
?>
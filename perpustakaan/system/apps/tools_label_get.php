<?php $ssid=session_id(); require_once(MODDIR.'control.php'); dbDel("pus_tpjm","ssid='$ssid'"); ?>
<table cellspacing="10px" cellpadding="0" border="0" style="border:1px solid rgba(0,0,0,0.3);background:#fcfcff;margin-top:10px;margin-bottom:10px"><tr valign="top"><td>
<div style="float:left;width:500px;margin-right:20px">
	<div class="sfont" style="margin-top:0px;height:24px;width:100%"><b>Daftar label item yang dicetak:</b></div>
	<div class="tbltopbar" style="width:100%">
		<?=iText('sbuku','','width:300px;margin-right:4px','barkode atau judul item','onkeyup="tools_label_buku_list_cari(event)"')?>
		<button title="Cari" class="btn" style="margin-right:4px" onclick="tools_label_buku_list_open()"><div class="bi_srcb">&nbsp;</div></button>
	</div>
	<div id="box_tools_label_buku" style="float:left;width:100%;margin-bottom:10px">
		<?php require_once(APPDIR.'tools_label_buku_get.php'); ?>
	</div>
</div>
<div style="float:left;width:250px">
	<div class="sfont" style="margin-top:0px;height:24px;width:100%"><b>Pilih informasi yang dicetak:</b></div>
		<table cellspacing="0" cellpadding="0">
			<tr height="24px"><td><?=iCheckx('cetak_header','Header',1)?></td></tr>
			<tr height="24px"><td><?=iCheckx('cetak_callnumber','Callnumber',1)?></td></tr>
			<tr height="24px"><td><?=iCheckx('cetak_barkode','Barkode',1)?></td></tr>
		</table>
	<div class="sfont" style="margin-top:0px;height:24px;width:100%;margin-top:20px"><b>Pengaturan cetak label:</b></div>
		<table class="sfont" cellspacing="0" cellpadding="0">
			<tr height="30px"><td width="100px">Lebar label:</td><td><?=iText('cetak_lebar',6,'width:30px;text-align:center')?> cm</td></tr>
			<tr height="30px"><td>Ukuran kertas:</td><td><?=iSelect('cetak_ukuran',array('F4'=>'F4 &nbsp; 210x330mm','A4'=>'A4 &nbsp; 210x297mm','A5'=>'A5 &nbsp; 148x210mm'),'F4')?></td></tr>
			<tr height="30px"><td>Orientasi kertas:</td><td><?=iSelect('cetak_orientasi',array('P'=>'Potrait','L'=>'Landscape'),'P')?></td></tr>
		</table>
</div>
<div class="sfont" style="float:left;width:100%;margin-top:10px">
	<button class="btn" style="float:left" onclick="tools_label_cancel()">Batal</button>
	<button class="btnz" style="float:right" onclick="tools_label_cetak()">Cetak &raquo;</button>
</div>
</td></tr></table>
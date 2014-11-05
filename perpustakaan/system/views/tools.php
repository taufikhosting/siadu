<div class="sfont" style="float:left;width:100%;font-size:15px;border-bottom: 1px solid #eaeaea;padding-bottom: 5px;margin-bottom:20px;margin-top:0px;">Pengaturan Nomor Item</div>
<div style="float:left;width:100%;margin-bottom:30px;padding-left:10px">
	<div class="sfont" style="float:left;width:100%;margin-bottom:10px">Format nomor ID (identitas):</div>
	<div style="float:left;width:100%;margin-bottom:10px">
		<?=iText('idfmt',setting_getnilai('idfmt'),'float:left;margin-right:4px;width:400px','','readonly')?>
		<button class="btn" style="float:left" onclick="tools_idbuku_form('uf',<?=setting_getid('idfmt')?>)"><div class="bi_edit">Edit</div></button>
	</div>
	<div class="sfont" style="float:left;width:100%;margin-bottom:20px">Contoh: <?=buku_makeid(array('nomorauto'=>1,'kodelokasi'=>'*','kodetingkat'=>'*'))?></div>
	<div class="sfont" style="float:left;width:100%;margin-bottom:10px">Format barkode:</div>
	<div style="float:left;width:100%;margin-bottom:10px">
		<?=iText('bkfmt',setting_getnilai('bkfmt'),'float:left;margin-right:4px;width:400px','','readonly')?>
		<button class="btn" style="float:left" onclick="tools_barkode_form('uf',<?=setting_getid('bkfmt')?>)"><div class="bi_edit">Edit</div></button>
	</div>
	<div class="sfont" style="float:left;width:100%;margin-bottom:20px">Contoh: <?=buku_makebarkode(array('nomorauto'=>1,'kodelokasi'=>'*','kodetingkat'=>'*'))?></div>
</div>
<div class="sfont" style="float:left;width:100%;font-size:15px;border-bottom: 1px solid #eaeaea;padding-bottom: 5px;margin-bottom:20px;margin-top:0px;">Cetak Label Buku</div>
<div style="float:left;width:100%;margin-bottom:30px;padding-left:10px">
	<div id="box_tools_label_form" class="sfont" style="float:left;width:100%;margin-bottom:10px">
		<?php require_once(APPDIR.'tools_label_form_get.php'); ?>
	</div>
	<div id="box_tools_label" class="sfont" style="display:none;float:left;width:100%">
		
	</div>
	<div id="box_btn_cetaklabel" class="sfont" style="float:left;width:100%;margin-bottom:10px">
		<button class="btn" style="float:left" onclick="tools_label_get()">Cetak label</button>
	</div>
</div>
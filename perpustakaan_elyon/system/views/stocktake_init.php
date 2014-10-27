<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;

$fmod='stocktake';
$xform=new xform($fmod,$opt,$cid);
$xform->tablewidth='Mulai';
$xform->btn_yes='Mulai';
$xform->tablestyle='float:left;background:#fff;padding:10px;margin-bottom:10px';

stocktake_ptrack(1);

$xform->title('Inisialisasi Stock Opname',0);
$xform->table_begin();
	$xform->col_begin();
	$xform->group_begin('Informasi Stock opname',150);
		$xform->fi('Tanggal mulai',fftgl(date("Y-m-d")));
		hiddenval('tanggal1',date("Y-m-d"));
		$xform->fi('Nama stock opname',iText('nama','',$xform->fieldws));
		$xform->fi('Keterangan',iTextArea('keterangan','',$xform->fieldws,5));
		//hiddenval('keterangan','');
		
$xform->table_end(0);

echo '<div style="float:left;width:410px;text-align:right;margin-bottom:10px;margin-top:10px">';
echo '<button class="btn" style="margin-right:4px" onclick="stocktake_get()">Batal</button>';
echo '<button class="btnz" onclick="stocktake_init(1)">Mulai</button>';
echo '</div>';
?>
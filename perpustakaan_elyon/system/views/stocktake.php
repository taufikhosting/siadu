<?php
$opt=gpost('opt');
if($opt=='init'){
	require_once(VWDIR.'stocktake_init.php');
} else if($opt=='batch'){
	require_once(VWDIR.'stocktake_batch.php');
} else if($opt=='cek'){
	require_once(VWDIR.'stocktake_cek.php');
} else if($opt=='note'){
	require_once(VWDIR.'stocktake_note.php');
} else if($opt=='finish'){
	require_once(VWDIR.'stocktake_finish.php');
} else if($opt=='report'){
	require_once(VWDIR.'stocktake_report.php');
} else if($opt=='hist'){
	require_once(VWDIR.'stocktake_hist.php');
} else {
	$t=mysql_query("SELECT * FROM pus_stockhist WHERE status<>5 LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		if($r['status']==1){ ?>
			<div class="sfont" style="font-size:16px;margin-bottom:10px;margin-top:0px;">Inisialisasi Stock Opname</div>
			<div class="sfont" style="line-height:200%;width:600px;margin-bottom:10px">Stok opname <b>"<?=$r['nama']?>"</b> belum selesai.</div>
			<input type="button" class="btnz" value="Lanjutkan stock opname" onclick="stocktake_init(2)"/>
		<?php
		} else if($r['status']==2){ ?>
			<div class="sfont" style="font-size:16px;margin-bottom:10px;margin-top:0px;">Inisialisasi Stock Opname</div>
			<div class="sfont" style="line-height:200%;width:600px;margin-bottom:10px">Stok opname <b>"<?=$r['nama']?>"</b> belum selesai.</div>
			<input type="button" class="btnz" value="Lanjutkan stock opname" onclick="stocktake_cek()"/>
		<?php
		} else if($r['status']==3){ ?>
			<div class="sfont" style="font-size:16px;margin-bottom:10px;margin-top:0px;">Inisialisasi Stock Opname</div>
			<div class="sfont" style="line-height:200%;width:600px;margin-bottom:10px">Stok opname <b>"<?=$r['nama']?>"</b> belum selesai.</div>
			<input type="button" class="btnz" value="Lanjutkan stock opname" onclick="stocktake_note()"/>
		<?php
		}
	
	} else {?>
	<div class="sfont" style="font-size:15px;margin-bottom:10px;margin-top:0px;">Inisialisasi Stock Opname</div>
	<div class="sfont" style="line-height:200%;width:600px;margin-bottom:10px">Aplikasi ini akan memandu anda selama proses stock opname. Anda tidak dapat melakukan proses lain hingga proses stock opname selesai.</div>
	<input type="button" class="btnz" value="Mulai stock opname baru" onclick="stocktake_init(0)"/>
	
	<div class="sfont" style="font-size:15px;margin-bottom:10px;margin-top:30px;">Riwayat Stock Opname</div>
	<div class="sfont" style="line-height:200%;width:600px;margin-bottom:10px">Melihat kembali rangkuman atau mencetak laporan stock opname yang telah dilakukan.</div>
	<input type="button" class="btn" value="Riwayat stock opname" onclick="stocktake_hist()"/>
	<?php
	}
}
?>
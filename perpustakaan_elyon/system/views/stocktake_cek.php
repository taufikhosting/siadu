<?php require_once(MODDIR.'control.php');
$tbl=stocktake_ctable();
$ncek_y=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl." WHERE cek='Y'"));
$ncek=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl));
$wcek=intval($ncek_y*400/$ncek);
stocktake_ptrack(2);
//<button class="btn" onclick="stocktake_cek()">Reload</button>
?>
<div style="padding:10px">
	<div style="width:100%;float:left;margin-bottom:10px;margin-top:10px">
		<div class="sfont" style="font-size:13px;">Cek buku:</div>
	</div>
	<div style="width:100%;float:left;padding-bottom:20px;border-bottom:1px solid #ccc;margin-bottom:10px">
		<?=iText('barkode','','width:300px;height:26px;font-size:14px;float:left;margin-right:4px','barkode','onkeyup="stocktake_cekbarkode(event)"')?>
		<button class="btnz" style="height:26px;width:60px" onclick="stocktake_cek_barkode()">Cek</button>
	</div>
	<div class="sfont" style="float:left;width:100%;margin-bottom:10px">Item terpindai: <span id="scinfo"></span></div>
	<div class="sfont" style="float:left;width:100%;margin-bottom:10px;padding-bottom:20px;border-bottom:1px solid #ccc;">
		<table cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td><button title="Batal" class="btn" style="border-radius:15px;margin-right:6px" onclick="stocktake_cancel()"><div class="bi_canb">&nbsp;</div></button></td>
			<td><div id="scbcd" class="scbcd"></div><input type="hidden" id="buku_id" value="0"/></td>
			<td><button id="okbtn" class="btn" style="display:none;width:50px;height:30px;margin-right:20px" onclick="stocktake_cek_buku()"><b>OK</b></button></td>
		</tr>
		<tr><td></td>
			<td>
				<label id="oklbl" style="float:left;margin-top:10px;margin-left:6px;"><input type="checkbox" class="iCheck" id="aoke" style="float:left"><div class="sfont" style="color:#666;float:left">&nbsp;OK otomatis untuk mengecek buku yang ditemukan belum di cek</div></label>
			</td>
		</table>
	</div>
	<div style="width:100%;float:left;margin-bottom:10px;margin-top:10px">
		<div class="sfont" style="font-size:13px;">Daftar pengecekan buku:</div>
	</div>
	<div style="width:100%;float:left;margin-bottom:10px">
		<table cellspacing="0" cellpadding="0" style="margin-bottom:10px"><tr>
			<td><div style="border-radius:5px;width:400px;height:6px;border:1px solid #4b8fff;margin-right:10px">
				<div id="pbar" style="width:<?=$wcek?>px;height:6px;background:#5595ff"></div>
			</div></td>
			<td> <span style="<?=SFONT12?>;color:<?=CLGREY?>"><span id="cekedbook"><?=$ncek_y?></span> dari <?=$ncek?> item</span></td>
			<td><img id="barload" style="margin-left:10px;display:none" src="<?=IMGR?>iclite.gif"/></td>
		</tr></table>
	</div>
	<div class="sfont" style="float:left;width:100%;margin-bottom:10px">
		<div class="sfont" style="float:left;width:100%">
			<div class="sfont" style="float:left;width:600px;margin-bottom:4px">
				<div class="sfont" style="float:left;margin-top:2px">Riwayat item yang sudah dicek:</div>
				<button class="btn" style="float:right" title="Lihat daftar semua pengecekan buku." onclick="stocktake_daftar_get(0)"><div class="bi_lis">Daftar pengecekan</div></button>
			</div>
		</div>
		<textarea id="schist" style="width:600px;height:150px"></textarea>
	</div>
	<div class="sfont" style="float:left;width:100%;margin-bottom:10px">
		<div class="sfont" style="float:left;width:600px;margin-bottom:4px">
			<button class="btnz" onclick="stocktake_cek_done('af')" style="float:right">Lanjutkan</button>
		</div>
	</div>
</div>
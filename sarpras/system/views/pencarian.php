<?php require_once(MODDIR.'control.php');
$fmod='pencarian';
$xtable=new xtable($fmod,'Pencarian barang');

$filter='';
$fmsg='';

$lok=gpost('lokasi');
$lokasi=lokasi_r($lok,1);

if($lok!=0){
	$filter.=" sar_barang.lokasi='$lok'";
	$fmsg.=" lokasi: <b>".lokasi_name($lok)."</b>";
}

$gru=gpost('grup');
$grup=grup_r($gru,1);

if($gru!=0){
	if($filter!='') {
		$filter.=" AND";
		$fmsg.=', dan';
	}
	$filter.=" sar_barang.grup='$gru'";
	$fmsg.=" grup barang: <b>".grup_name($gru)."</b>";
}

$jen=gpost('jenis');
$jenis=jenis_r($jen,1);

if($jen!=0){
	if($filter!=''){
		$filter.=" AND";
		$fmsg.=', dan';
	}
	$filter.=" sar_katalog.jenis='$jen'";
	$fmsg.=" jenis barang: <b>".jenis_name($jen)."</b>";
}

$keyword=gpost('keyword');
if($keyword!=''){
	if($filter!=''){
		$filter.=" AND";
		$fmsg.=", dan";
	}
	$filter.=" (sar_katalog.nama LIKE '%$keyword%' OR sar_barang.kode='$keyword')";
	$fmsg.=" kode atau nama barang: <b>".$keyword."</b>";
}

$filter=$filter==''?'':" WHERE ".$filter;

// Query
$t=mysql_query("SELECT sar_barang.*,sar_katalog.nama FROM sar_barang JOIN sar_katalog ON sar_katalog.replid=sar_barang.katalog ".$filter." ORDER BY sar_barang.kode");
$xtable->ndata=mysql_num_rows($t);

$fmsg=$fmsg==''?'':'<div class="infobox">Hasil pencarian '.$fmsg.' ditemukan <b>'.$xtable->ndata.'</b> unit.</div>';
if($xtable->ndata==0) $fmsg="";

$combow="width:400px";
$labelw="150px";
?>
<div class="tbltopmbar">
<table class="stable" cellspacing="0" cellpadding="0" width="100%">
<tr height="26px">
	<?php if(count($lokasi)>1){?>
	<td width="<?=$labelw?>" align="left"><b>Lokasi:</b></td>
	<td width="200px"><?=iSelect('lokasi',$lokasi,$lok,$combow,$fmod."_get()")?></td>
	<?php } else { ?>
	<td width="*">&nbsp;</td></tr></table></div>
	<input type="hidden" id="lokasi" value="<?=$lok?>"/>
	<input type="hidden" id="grup" value="<?=$grup?>"/>
	<input type="hidden" id="jenis" value="<?=$jen?>"/>
	<?php lokasi_warn(); exit();}?>
<td width="*">&nbsp;</td></tr>

<tr height="26px">
	<?php if(count($lokasi)>1){?>
	<td width="<?=$labelw?>" align="left"><b>Grup:</b></td>
	<td width="200px"><?=iSelect('grup',$grup,$gru,$combow,$fmod."_get()")?></td>
	<?php } else { ?>
	<td width="*">&nbsp;</td></tr></table></div>
	<input type="hidden" id="grup" value="<?=$grup?>"/>
	<input type="hidden" id="jenis" value="<?=$jen?>"/>
	<?php grup_warn(); exit();}?>
<td width="*">&nbsp;</td></tr>

<tr height="26px">
	<?php if(count($jenis)>1){?>
	<td width="<?=$labelw?>" align="left"><b>Jenis:</b></td>
	<td width="200px"><?=iSelect('jenis',$jenis,$jen,$combow,$fmod."_get()")?></td>
	<?php } else { ?>
	<td width="*">&nbsp;</td></tr></table></div>
	<input type="hidden" id="jenis" value="<?=$jen?>"/>
	<?php jenis_warn(); exit();}?>
<td width="*">&nbsp;</td></tr>

<tr height="26px">
	<td width="<?=$labelw?>" align="left"><b>Kode atau nama barang:</b></td>
	<td width="200px">
	<?=iText('keyword',$keyword,'width:'.'375px;float:left;margin-right:2px')?>
			<button class="find21" style="float:left;margin-top:2px" title="Cari" onclick="pencarian_get()"></button>
	</td>
<td width="*">&nbsp;</td></tr>		
</table></div>
<?php

$xtable->btnbar_f($fmsg);
$xtable->noopt=true;
if($xtable->ndata>0){
	// Table head
	$xtable->head('Kode','Nama','Keterangan');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		//$num_judul = @mysql_num_rows(mysql_query("SELECT * FROM sar_pustaka WHERE format=".$r['replid']));
		//$num_pustaka = @mysql_fetch_row(mysql_query("SELECT COUNT(d.replid) FROM sar_pustaka p, sar_daftarpustaka d WHERE d.pustaka=p.replid AND p.format=".$r['replid']));
				
		$xtable->td($r['kode'],120);
		$xtable->td($r['nama'],250);
		//$xtable->td($num_judul,100);
		//$xtable->td($num_pustaka[0],100);
		$xtable->td(nl2br($r['keterangan']));
		//$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata_cust('Tidak ditemukan hasil dari pencarian ini.');}
?>
<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'xform/xform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0; require_once(MODDIR.'control.php');

// form Module
$fmod='bahasa';
$dbtable='pus_katalog';
$fform=new fform($fmod,$opt,$cid);
$xform=new xform($fmod);

	$db=new xdb("pus_katalog");
	$db->field("pus_katalog:replid,judul,callnumber,penerjemah,editor,tahunterbit,kota,isbn,issn,seri,volume,edisi,photo","pus_pengarang:nama as npengarang","pus_klasifikasi:kode,nama as nklas","pus_bahasa:nama as nbahasa","pus_jenisbuku:nama as njenis");
	$db->join("pengarang","pus_pengarang");
	$db->join("klasifikasi","pus_klasifikasi");
	$db->join("bahasa","pus_bahasa");
	$db->join("jenisbuku","pus_jenisbuku");
	$db->where_and("pus_katalog.replid='$cid'");
	$t=$db->query();
	$r=mysql_fetch_array($t);
	
	$terbitan='';
	if($r['penerbit']!=0)$terbitan=penerbit_name($r['penerbit']);
	if($r['kota']!=''){
		if($terbitan!='')$terbitan.=', ';
		$terbitan.=$r['kota'];
	}
	if($r['tahunterbit']!=''){
		if($terbitan!='')$terbitan.=', ';
		$terbitan.=$r['tahunterbit'];
	}

	$tersedia=mysql_num_rows(mysql_query("SELECT * FROM pus_buku WHERE katalog='$cid' AND status='1'"));
	
	$fform->ptop=20;
	$fform->head('',0);
	?>
	<tr><td>
		<table cellspacing="0" cellpadding="0px" style="margin:auto;margin-bottom:10px" width="100%">
		<tr valign="top" style="height:110px">
			<?php if(strlen($r['photo'])>0 || true){ ?>
			<td width="60px">
				<?php $xform->photof($r['replid'],'katalog',80,100); ?>
			</td>
			<?php } ?>
			<td style="padding-left:10px">
				<div class="sfont" style="color:#000;font-size:14px;color:#444;margin-bottom:6px"><?=$r['judul']?></div>
				<?php if($r['npengarang']!=''){ ?>
				<div class="sfont" style="margin-bottom:6px">by <a class="linkb" href="<?=RLNK?>opac.php?keyon=pengarang&keyword=<?=$r['npengarang']?>" title="Tampilkan koleksi dari <?=$r['npengarang']?>"><?=$r['npengarang']?></a></div>
				<?php } ?>
			</td>
		</tr>
		</table>
		<table cellspacing="0" cellpadding="0px" style="margin:auto;margin-bottom:10px" width="100%">
		<tr><td width="100px">Klasifikasi</td><td width="10px">:</td><td><?=$r['kode'].' '.$r['nklas']?></td></tr>
		<tr><td>Pengarang</td><td>:</td><td><?=$r['npengarang']?></td></tr>
		<tr><td>Callnumber</td><td>:</td><td><?=$r['callnumber']?></td></tr>
		<tr><td>Penerjemah</td><td>:</td><td><?=$r['penerjemah']?></td></tr>
		<tr><td>Editor</td><td>:</td><td><?=$r['editor']?></td></tr>
		<tr><td>Terbitan</td><td>:</td><td><?=$terbitan?></td></tr>
		<tr><td>ISBN</td><td>:</td><td><?=$r['isbn']?></td></tr>
		<tr><td>ISSN</td><td>:</td><td><?=$r['issn']?></td></tr>
		<tr><td>Bahasa</td><td>:</td><td><?=$r['nbahasa']?></td></tr>
		<tr><td>Seri</td><td>:</td><td><?=$r['seri']?></td></tr>
		<tr><td>Volume</td><td>:</td><td><?=$r['volume']?></td></tr>
		<tr><td>Edisi</td><td>:</td><td><?=$r['edisi']?></td></tr>
		<tr><td>Jenis koleksi</td><td>:</td><td><?=$r['njenis']?></td></tr>
		<tr><td>Tersedia</td><td>:</td><td><?=$tersedia?> item</td></tr>
		</table>
	</td></tr>
	<?php
	$fform->reg['btnlabel_no']='Tutup';
	$fform->foot(0);
?>
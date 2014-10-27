<?php require_once(MODDIR.'xform/xform.php');
$fmod='inventory';
$xform=new xform($fmod);

echo '<table cellspacing="10px" cellpadding="0" width="100%"><tr valign="top">';
echo '<td width="300px">';
$s='<div style="float:right;margin-right:3px"><button title="Tambah grup barang" class="btn" onclick="inventory_grupbrg_form(\'af\')"><div class="bi_addb">&nbsp;</div></button></div>';
$xform->table_begin('<div style="float:left;margin-top:2px;margin-left:6px;height:24px">Grup barang</div>'.$s);
	$xform->col_begin();
	$xform->grupclass=''; $xform->grupstyle='float:left';
	
$fol=0; $fil=0;

$grupbrg=gpost('grupbrg',0);
if($grupbrg==0){
	$t=mysql_query("SELECT replid FROM keu_grupbrg ORDER BY nama LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		$grupbrg=$r['replid'];
	}
}
$kelompokbrg=gpost('kelompokbrg',0);
if($kelompokbrg==0){
	$t=mysql_query("SELECT replid FROM keu_kelompokbrg WHERE grupbrg='$grupbrg' ORDER BY nama LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		$kelompokbrg=$r['replid'];
	}
}

hiddenval('grupbrg',$grupbrg);
hiddenval('kelompokbrg',$kelompokbrg);

$t=mysql_query("SELECT * FROM keu_grupbrg ORDER BY nama");
if(mysql_num_rows($t)>0){ $fil=0;
while($r=mysql_fetch_array($t)){ $fol=$r['replid']; $n=0;
	$t1=mysql_query("SELECT keu_brg.unit FROM keu_brg LEFT JOIN keu_kelompokbrg ON keu_kelompokbrg.replid=keu_brg.kelompokbrg WHERE keu_kelompokbrg.grupbrg='".$r['replid']."'");
	while($r1=mysql_fetch_array($t1)){
		$n+=$r1['unit'];
	}
	
	
	echo '<div id="xt_'.$fol.'" class="xtree_folder1" onclick="xtree_folder_toggle(event,'.$fol.')" onmouseover="EShow(\'xto_'.$fol.'\');" onmouseout="EHide(\'xto_'.$fol.'\');" style="" unselectable="on" onselectstart="return false;" onmousedown="return false;">',$r['nama'],
		'<div class="xtree_folder_info"><b>'.$n.'</b></div>',
		'<div id="xto_'.$fol.'" class="xtree_folder_opt" style="display:none">',
			'<button title="Hapus" class="btn" style="float:right;margin-left:0px" onclick="inventory_grupbrg_form(\'df\','.$r['replid'].')"><div class="bi_delb">&nbsp;</div></button>',
			'<button title="Edit" class="btn" style="float:right;margin-left:4px" onclick="inventory_grupbrg_form(\'uf\','.$r['replid'].')"><div class="bi_editb">&nbsp;</div></button>',
			'<button title="Tambah jenis barang" class="btn" style="float:right;margin-left:0px" onclick="E(\'grupbrg\').value='.$r['replid'].';inventory_kelompokbrg_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>',
		'</div>',
		'</div>';
		
	echo '<div id="xtbox_'.$fol.'" style="float:left;width:280px;display:">';
	
	$t1=mysql_query("SELECT * FROM keu_kelompokbrg WHERE grupbrg='".$r['replid']."' ORDER BY nama");
	if(mysql_num_rows($t1)>0){
	while($r1=mysql_fetch_array($t1)){ //$fil=$r1['replid'];
		echo '<div id="xtf_'.$fil.'" class="xtree_file'.($kelompokbrg==$r1['replid']?'1':'0').'" onclick="E(\'xtf_sel\').value='.$fil.';E(\'grupbrg\').value='.$r['replid'].';E(\'kelompokbrg\').value='.$r1['replid'].';inventory_kelompokbrg_get()" onmouseover="EShow(\'xtfo_'.$fil.'\');" onmouseout="EHide(\'xtfo_'.$fil.'\');">',$r1['nama'],
			'<div id="xtfo_'.$fil.'" class="xtree_file_opt" style="display:none">',
				'<button title="Hapus" class="btn" style="float:right;margin-left:0px" onclick="inventory_kelompokbrg_form(\'df\','.$r1['replid'].')"><div class="bi_delb">&nbsp;</div></button>',
				'<button title="Edit" class="btn" style="float:right;margin-left:4px" onclick="inventory_kelompokbrg_form(\'uf\','.$r1['replid'].')"><div class="bi_editb">&nbsp;</div></button>',
			'</div>',
			'</div>';
		$fil++;
	}
	} else {
		echo '<div class="infobox">Tidak ada jenis barang</div>';
	}
	echo '</div>';
} hiddenval('xtf_num',$fil); hiddenval('xtf_sel',0);
} else {
	echo '<div class="infobox">Tidak ada grup barang</div>';
}
	
	


$xform->table_end(0);
echo '</td>';
echo '<td id="box_inventory_kelompokbrg">';
	require_once(APPDIR.'inventory_kelompokbrg_get.php');
echo '</td>';
echo '</tr></table>';
?>
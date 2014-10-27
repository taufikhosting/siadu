<?php
$cols=0; $rows=0; $ncols=3; $n=0;
	echo '<table cellspacing="10px" cellpadding="0" border="0" width="100%">';
	
	while($r=mysql_fetch_array($t)){
		if($cols==0){
			echo '<tr>';
		}
		
		echo '<td width="'.(100/$ncols).'%"><div class="katalog_box" style="overflow:hidden;display:block;text-decoration:none;position:relative;" onmouseout="EHide(\'katalog_box_opt'.$n.'\')" onmouseover="EShow(\'katalog_box_opt'.$n.'\')"><div id="katalog_box_opt'.$n.'" style="display:none;position:absolute;top:2px;right:2px"><button class="btn" title="Lihat Katalog" onclick="katalog_form_view(\''.$r['replid'].'\')"><div class="bi_srcb">&nbsp;</div></button>&nbsp;<button class="btn" title="Edit" onclick="katalog_form(\'uf\',\''.$r['replid'].'\')"><div class="bi_editb">&nbsp;</div></button>&nbsp;<button class="btn" title="Hapus" onclick="katalog_form(\'df\',\''.$r['replid'].'\')"><div class="bi_delb">&nbsp;</div></button>&nbsp;<button class="btn" title="Tambah koleksi baru" onclick="PCBCODE=201;katalog_form_view(\''.$r['replid'].'\')"><div class="bi_add">Koleksi</div></button></div><table cellspacing="10px" cellpadding="0"><tr><td>';
		
		$pubinfo=$r['kota'];
		if($pubinfo!='')$pubinfo.=' : ';
		$pubinfo.=$r['n3'];
		if($r['n3']!='')$pubinfo.=', ';
		$pubinfo.=$r['tahunterbit'];
		
		$des='';
		if($r['deskripsi']!=''){
			$des.='<br/><br/>';
			$des.=strtoupper(str_firstword($r['deskripsi'])).'<br/><br/>'.$r['deskripsi'];
		}
		
		echo '<table cellspacing="0px" cellpadding="0">',
				'<tr valign="top">',
					'<td width="50px" style="font:11px '.MSTYPEFONT.'">',$r['kode'],'<br/>',strtoupper(substr($r['nkutip'],0,3)),'<br/>',strtolower(substr($r['judul'],0,1)),'</td>',
					'<td style="font:11px '.MSTYPEFONT.'"><br/>',$r['nkutip'],'<br/><br/>',buku_judul($r['judul']),' / ',$r['nkutip'],' -- ',$pubinfo,'<br/><br/>',$r['halaman'],' Hlm<br/><br/>ISBN ',$r['isbn'],$des,'</td>',
				'</tr>',
			'</table>';
		
		echo '</td></tr></table></div></td>';
		
		$cols++; $n++;
		
		if($cols==$ncols){
			$cols=0;
			$rows++;
			echo '</tr>';
		}		
	}
	if($cols<$ncols && $cols!=0){
		for($i=$cols;$i<$ncols;$i++){
			echo '<td><div style="height:250px;width:100%"></div></td>';
		}
		echo '</tr>';
	}
	echo '</table>';
	
	echo '<table style="float:left" width="100%" cellspacing="0" cellpadding="0"><tr><td align="right">';
	$xtable->foot_pagging();
	echo '</td></tr></table>';
	
	echo '<input type="hidden" id="xtable_usesearch" value="1">';
?>
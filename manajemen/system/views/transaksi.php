<?php 
	appmod_use('keu/rekening');

	$ct_umum        =gpost('ct_umum',1);
	$ct_pemasukan   =gpost('ct_pemasukan',1);
	$ct_pengeluaran =gpost('ct_pengeluaran',1);
	$ct_siswa       =gpost('ct_siswa',1);
	$ct_calonsiswa  =gpost('ct_calonsiswa',1);
	$ct_barang      =gpost('ct_barang',1);
	
	$sel=0;
	if($ct_pemasukan!=0) 
		$sel++;
	if($ct_pengeluaran!=0) 
		$sel++;

	$tgl      =explode("-",date("Y-m-d")); $dim=cal_days_in_month(CAL_GREGORIAN,intval($tgl[1]),intval($tgl[0]));
	$tgl_f    =date("Y-m")."-1";
	$tgl_c    =date("Y-m-d");
	$tgl_l    =date("Y-m")."-".$dim;
	$tanggal1 =gpost('tanggal1',$tgl_f);
	$tanggal2 =gpost('tanggal2',$tgl_l);
	hiddenval('tanggal_f',$tgl_f);
	hiddenval('tanggal_c',$tgl_c);
	hiddenval('tanggal_l',$tgl_l);

	hiddenval('jenistransaksi',JT_UMUM);

	$s='';
	// 3 tombol 
	/*
	$s.='<button style="float:left;margin-right:4px;height:26px" class="btnz" onclick="E(\'jenistransaksi\').value='.JT_UMUM.';transaksi_form(\'af\')">
			<div class="bi_add2">Jurnal Umum</div>
		</button>';
	$s.='<button style="float:left;margin-right:4px;height:26px" class="btng" onclick="E(\'jenistransaksi\').value='.JT_INCOME.';transaksi_form(\'af\')">
			<table cellspacing="0" cellpadding="0"><tr>
			<td><div style="width:20px;height:20px;background:url('.IMGR.'inco.png) center no-repeat;margin-right:6px"></div></td><td><span style="font:bold 11px Verdana,Tahoma;color:#fff;margin-right:4px"><b>Pemasukan</b></span></td>
			</tr></table>
		</button>';
	$s.='<button style="float:left;margin-right:20px;height:26px" class="btnr" onclick="E(\'jenistransaksi\').value='.JT_OUTCOME.';transaksi_form(\'af\')">
			<table cellspacing="0" cellpadding="0"><tr>
			<td><div style="width:20px;height:20px;background:url('.IMGR.'outco.png) center no-repeat;margin-right:6px"></div></td><td><span style="font:bold 11px Verdana,Tahoma;color:#fff;margin-right:4px"><b>Pengeluaran</b></span></td>
			</tr></table>
		</button>';
	*/

	echo '<div class="tbltopbar" style="width:100%">'.$s.'</div>';
	echo '<div id="transaksi_tampil_menu">';

	echo '<div class="sfont" style="float:left;width:100%;margin-top:20px;margin-bottom:10px">
			<b>Tampilkan catatan transaksi:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
			'<a id="ctallbtn" href="javascript:void(0)" class="linkb" onclick="transaksi_ct_all()" style="display:'.($sel==2?'none':'').'">[semua]</a></div>';
	echo '<div style="float:left;width:100%;margin-bottom:10px">';
		echo '<div style="float:left">';
		echo '<table cellspacing="0" cellpadding="0">';
		echo '<tr height="24px">',
			'<td width="200px">'.iCheckx('ct_umum','jurnal umum',$ct_umum,'','onclick="transaksi_ct_cek()"').'</td>',
			'<td width="250px">'.iCheckx('ct_siswa','transaksi pemasukan dari siswa',$ct_siswa,'','onclick="transaksi_ct_cek()"').'</td>',
		'</tr>';
		echo '<tr height="24px">',
			'<td width="200px">'.iCheckx('ct_pemasukan','transaksi pemasukan',$ct_pemasukan,'','onclick="transaksi_ct_cek()"').'</td>',
			'<td width="250px">'.iCheckx('ct_calonsiswa','transaksi pemasukan dari calon siswa',$ct_calonsiswa,'','onclick="transaksi_ct_cek()"').'</td>',
		'</tr>';
		echo '<tr height="24px">',
			'<td width="200px">'.iCheckx('ct_pengeluaran','transaksi pengeluaran',$ct_pengeluaran,'','onclick="transaksi_ct_cek()"').'</td>',
			'<td width="250px">'.iCheckx('ct_barang','transaksi penerimaan barang',$ct_barang,'','onclick="transaksi_ct_cek()"').'</td>',
		'</tr>';
		echo '</table>';
		echo '</div>';
	echo '</div>';

	echo '<div class="sfont" style="float:left;width:100%;margin-bottom:15px"><b>tanggal:</b>';

	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="linkb" onclick="transaksi_ctgl_set(1)" >[hari ini]</a>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="linkb" onclick="transaksi_ctgl_set(2)" >[bulan ini]</a>';
	/*	if(date("d")!=1){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="linkb" onclick="transaksi_ctgl_set(3)" >[awal bulan sampai hari ini]</a>';
		}
	*/
	echo '</div>';

	echo '<div style="float:left;width:100%;margin-bottom:40px">';
		echo inputDate('tanggal1',$tanggal1).'<div class="sfont" style="float:left;margin-right:4px;margin-top:4px">&nbsp;sampai&nbsp;</div>'.inputDate('tanggal2',$tanggal2).'<button style="float:left;margin-left:30px;margin-right:4px" class="btnz" onclick="transaksi_get()"><div class="">Tampilkan &raquo;</div></button>';
	echo '</div>';

	echo '</div>';

	$gptab=gpost('gptab_index','1');
	echo '<div style="float:left;width:100%;margin-bottom:10px;border-bottom:1px solid #01a8f7">',
			'<div id="gptab1" class="gptab'.($gptab=='1'?'1':'').'" onclick="transaksi_tab_get(1)">Jurnal Umum</div>',
			'<div id="gptab2" class="gptab'.($gptab=='2'?'1':'').'" onclick="transaksi_tab_get(2)">Buku Besar</div>',
			'<div id="gptab3" class="gptab'.($gptab=='3'?'1':'').'" onclick="transaksi_tab_get(3)">Neraca Saldo</div>',
			'<div id="gptab4" class="gptab'.($gptab=='4'?'1':'').'" onclick="transaksi_tab_get(4)">Neraca Lajur</div>',
			'<div id="gptab5" class="gptab'.($gptab=='5'?'1':'').'" onclick="transaksi_tab_get(5)">Laporan Laba/Rugi</div>',
			'<div id="gptab6" class="gptab'.($gptab=='6'?'1':'').'" onclick="transaksi_tab_get(6)">Laporan Neraca</div>',
			'<div id="gptab7" class="gptab'.($gptab=='7'?'1':'').'" onclick="transaksi_tab_get(7)">Posisi Kas dan Bank</div>',
			'<div id="gptab8" class="gptab'.($gptab=='8'?'1':'').'" onclick="transaksi_tab_get(8)">Buku Tambahan</div>',
			'</div>';
	hiddenval('gptab_index',$gptab);

	echo '<div id="transaksi_tab_1" style="float:left;width:100%;display:'.($gptab=='1'?'':'none').'">';
		require_once(VWDIR.'transaksi_jurnalumum.php');
	echo '</div>';
	echo '<div id="transaksi_tab_2" style="float:left;width:100%;display:'.($gptab=='2'?'':'none').'">';
		require_once(VWDIR.'transaksi_bukubesar.php');
	echo '</div>';
	echo '<div id="transaksi_tab_3" style="float:left;width:100%;display:'.($gptab=='3'?'':'none').'">';
		require_once(VWDIR.'transaksi_neracasaldo.php');
	echo '</div>';
	echo '<div id="transaksi_tab_4" style="float:left;width:100%;display:'.($gptab=='4'?'':'none').'">';
		require_once(VWDIR.'transaksi_neracalajur.php');
	echo '</div>';
	echo '<div id="transaksi_tab_5" style="float:left;width:100%;display:'.($gptab=='5'?'':'none').'">';
		require_once(VWDIR.'transaksi_labarugi.php');
	echo '</div>';
	echo '<div id="transaksi_tab_6" style="float:left;width:100%;display:'.($gptab=='6'?'':'none').'">';
		require_once(VWDIR.'transaksi_neraca.php');
	echo '</div>';
	echo '<div id="transaksi_tab_7" style="float:left;width:100%;display:'.($gptab=='7'?'':'none').'">';
		require_once(VWDIR.'transaksi_kasbank.php');
	echo '</div>';
	echo '<div id="transaksi_tab_8" style="float:left;width:100%;display:'.($gptab=='8'?'':'none').'">';
		require_once(VWDIR.'transaksi_bukutambahan.php');
	echo '</div>';

	hiddenval('transaksi_tab_num',8);
?>
<?php 

	appmod_use('keu/budget'); #shared/libraries/modules/apps/keu/budget
	$fmod   ='budget';
	$xtable = new xtable($fmod,'anggaran'); #shared/libraries/xdb

	$tahunbuku =tahunbuku_getaktif();
	$tbuku     =$tahunbuku['replid'];
	// var_dump($tbuku);

	if($tbuku!=0){
		$PSBar = new PSBar_2(140);
		$PSBar->begin();
			$PSBar->selection('Tahun buku','<b>'.$tahunbuku['nama'].'</b>');
			hiddenval('tahunbuku',$tahunbuku['replid']);
			$PSBar->selection_departemen($fmod,$dept);
		$PSBar->end();

		$xtable->btnbar_f('add');

		$db = new xdb(
			"keu_budget,departemen",
			"keu_budget.*,departemen.nama as departemenx",
			"keu_budget.tahunbuku='$tbuku' and keu_budget.id_department=departemen.replid",
			"keu_budget.nama"
		);
		$t  = $db->query();
		$f 	= $db->field();
		$t2 = 'SELECT
					b.*,
					d.nama AS departemenx
				FROM
					keu_budget b,
					departemen d
				WHERE
					b.departemen = d.replid AND
					b.tahunbuku='.$tbuku;
		$t3 = mysql_query($t2) or die(mysql_error());
		$xtable->ndata=mysql_num_rows($t3);
		// $xtable->ndata=mysql_num_rows($t);
		if($xtable->ndata>0){
			$xtable->head('Nama Anggaran','Anggaran','Status anggaran','Departement','Keterangan');
			// while($r=mysql_fetch_array($t)){
			while($r=mysql_fetch_array($t3)){
				$xtable->row_begin();
			
				$xtable->td($r['nama'],200);
				$xtable->td(fRp($r['nominal']),110);
				$uses =budget_getuses($r['replid']);
				$sisa =$r['nominal']-$uses;
				$clr  =color_level($r['nominal'],$sisa<0?$r['nominal']:$uses);
				$bar  =$sisa<0?480:intval($uses*480/$r['nominal']);
				
				// view table
				$s='<div class="sfont" style="width:480px;height:20px;padding:1px;text-align:left">';
					$s.='<span style="float:left">Total anggaran: <b>'.fRp($r['nominal']).'</b></span>';
				$s.='</div>';
				$s.='<div style="width:480px;height:6px;border:1px solid #01a8f7;border-radius:3px">';
					$s.='<div style="width:'.$bar.'px;height:6px;background:'.$clr.'"></div>';
				$s.='</div>';
				$s.='<div class="sfont" style="width:480px;height:18px;padding:1px;padding-top:6px;text-align:left'.($sisa<0?';color:#ff0000':'').'">';
					$s.='<span style="float:left">terpakai: <b>'.fRp($uses).'</b> ( '.number_format($uses*100/$r['nominal'],2).'% )</span>';
					$s.='<span style="float:right">sisa anggaran: <b>'.fRp($sisa,1,1).'</b> ( '.number_format($sisa*100/$r['nominal'],2).'% )</span>';
				$s.='</div>';
				
				$xtable->td($s,484,'r');
				$xtable->td($r['departemenx']);
				$xtable->td(nl2br($r['keterangan']));
				$s='<button title="Daftar transaksi" class="btn"><div class="bi_lisb">&nbsp;</div></button>';
				$xtable->opt($r['replid'],'u','d');
				
			$xtable->row_end();}$xtable->foot();
		}else{
			$xtable->nodata();
		}
	} else {
		echo '<div class="infobox">Tidak ada tahun buku yang aktif.</div>';
	}
?>
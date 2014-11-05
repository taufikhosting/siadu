<?php
$t=mysql_query("SELECT * FROM admin WHERE app='".APID."' AND level='1' LIMIT 0,1");
$r=mysql_fetch_array($t);
$aid=$r['replid'];
$fmod='file';
$xtable = new xtable($fmod);

$xtable->btnbar_f('add');

// Query golongan >>
$t=mysql_query("SELECT rep_file.*,admin.nama as nadmin FROM rep_file LEFT JOIN admin ON rep_file.admin=admin.replid ".(admin_isadministrator()?"":" WHERE admin='".admin_getID()."' OR admin.level='1'")." ORDER BY nadmin,rep_file.nama");

$xtable->ndata=mysql_num_rows($t);
if($xtable->ndata>0){
$xtable->head('Pemilik file','Judul','Nama file','Deskripsi','Tanggal upload');
while($r=mysql_fetch_array($t)){$xtable->row_begin();
		$xtable->td($r['nadmin'],200);
		$xtable->td($r['nama'],200);
		$xtable->td($r['fname'],200);
		$xtable->td($r['keterangan']);
		$xtable->td(fftgljam($r['waktu']),200);
		if(admin_isadministrator()){
			$s='';
			$s.='<td width="60px" align="center">';
			$s.='<button class="btn" title="Download" onclick="file_download('.$r['replid'].')"><div class="bi_binb">&nbsp;</div></button>&nbsp;';
			$s.='<button class="btn" title="Hapus" onclick="'.$fmod.'_form(\'df\','.$r['replid'].')"><div class="bi_delb">&nbsp;</div></button>';
			$s.='</td>';
			echo $s;
		} else {
			$s='';
			$s.='<td width="90px" align="center">';
			$s.='<button class="btn" onclick="file_download('.$r['replid'].')"><div class="bi_bin">Download</div></button>&nbsp;';
			$s.='</td>';
			echo $s;
		}
	//$xtable->row_end();
}?>
</table>
<form target="_blank" id="getfile" method="post" action="download.php" class="iform"><input type="hidden" id="fid" name="fid" value="0" /></form>
<?php }else $xtable->nodata('','mengupload');
?>
<?php
$bcode=gpost('bcode');
$ntable=gpost('lst');
if($bcode!=''){
	if(preg_match("/^[0-9]+$/i", $bcode)){
	$t=mysql_query("SELECT dcid,barcode,catalog FROM book WHERE barcode='$bcode' LIMIT 0,1");
	$n=mysql_num_rows($t);
	if($n>0){
		$r=dbFAx($t);
		$ti=str_replace("\\","",dbFetch("title","catalog","W/dcid='".$r['catalog']."'"));
		$q=mysql_query("SELECT dcid,barcode FROM ".$ntable."cek WHERE barcode='$bcode' LIMIT 0,1");
		if(mysql_num_rows($q)>0){
			echo 'N~'.$r['barcode'].'~<span style="color:#008000">'.$bcode.' - '.$ti.'</span>~Already checked.';
		} else {
			if(strlen($ti)>45) $ti=substr($ti,0,42).'...';
			echo 'T~'.$r['barcode'].'~'.$bcode.' - '.$ti.'~Found one book in database.';
		}
	} else {
		$w=mysql_query("SELECT dcid,barcode FROM ".$ntable."new WHERE barcode='$bcode' LIMIT 0,1");
		if(mysql_num_rows($w)>0){
			echo 'A~'.$bcode.'~<span style="color:#008000">'.$bcode.'</span>~Already added to unlisted book.';
		} else {
			echo 'F~'.$bcode.'~<span style="color:#ff7000">'.$bcode.'</span>~Not found in database.';
		}
	}
	} else {
		echo 'A~'.$bcode.'~<span style="color:#ff0000">'.$bcode.'</span>~<span style="color:#ff0000">Invalid book barcode.</span>';
	}
}
?>
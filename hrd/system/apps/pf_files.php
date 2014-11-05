<?php
// Default Post Variables
$opt=gpost('opt');
$dcid=gpost('dcid'); if($dcid=='') $dcid=0;
$cid=gpost('cid'); if($cid=='') $cid=0;
$fname=gpost('fname');

// Form Title
if($opt=='af') $mtitle="Add new employee document for ".$fname;
else if($opt=='uf') $mtitle="Edit ".$fname."'s document";
else $mtitle="Delete ".$fname."'s document";
// Function Module 
$fmod="pf_files";
// db Table
$dbtable="emp_files";

// Global Variables
$mstr_document=MstrGet("mstr_document");

if($opt=='a'||$opt=='u'||$opt=='d'||$opt=='up'||$opt=='dn' || $opt=='rf'){
	// Post Variables
	$p=Array('docid','date1','date2');
	$ipost=Array();
	foreach($p as $k=>$v){$ipost[$v]=gpost($v);}
	
	if($opt=='a'){
		$ipost['empid']=$dcid;
		dbInsert($dbtable,$ipost);
		$cid=mysql_insert_id();
	}
	else if($opt=='u'){
		dbUpdate($dbtable,$ipost,"dcid='$cid'");
	}
	else if($opt=='d'){
		dbDel($dbtable,"dcid='$cid'");
	}
	$t=dbSel("*","employee","W/dcid='$dcid' LIMIT 0,1");
	$r=dbFA($t);
	require_once(VWDIR.$fmod.'.php');
} else {
	$sx=str_replace('f','',$opt); $nobtn="Cancel";
	// Preprocessing form
	$doctype=$mstr_document;
	if($opt=='uf'||$opt=='df'){
		$r=dbSFA("*",$dbtable,"W/dcid='$cid'");
	} else {
		$r['date1']=date("Y-m-d");
		$r['date2']=date("Y-m-d");
		$td=dbSel("*","emp_document");
		while($rd=dbFA($td)){
			unset($doctype[$rd['docid']]);
		}
	}
	// Form dimension
	$fwidth=$opt=='df'?500:400; $lwidth=100;
	$iTextFw="width:".($fwidth-$lwidth-16)."px";
	?>
	<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
	<div class="fformbox" style="width:<?=($fwidth+30)?>px;overflow:hidden">
		<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
			<b><?=$mtitle?><br/></b>
		</div>
		<div style="text-align:left;padding:15px 15px;width:<?=$fwidth?>px">
			<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<?php if($opt=='af' || $opt=='uf'){ $okbtn = ($opt=='af')?"Save":"OK"; $gd='true';
			// Add or Edit form ?>
			<tr><td width="<?=$lwidth?>px">Document:</td>
				<?php if($opt=='af'){?>
				<td><?=iSelect('docid',$doctype,$r['type'],"float:left")?><?=iAddMstrx('docid','document','document name')?></td>
				<?php }else{?>
				<td><b><?=$mstr_document[$r['docid']]?></b><input type="hidden" id="docid" value="<?=$r['docid']?>"/></td>
				<?php }?>
			</tr>
			<tr><td>Validity:</td><td><?=inputDate('date1',$r['date1'])?> until </td></tr>
			<tr><td>&nbsp;</td><td><?=inputDate('date2',$r['date2'])?></td></tr>
		<?php } else if($opt=='df'){ $okbtn = "Yes"; $nobtn="   No   "; $gd='false';
			// Delete form ?>
			<tr><td><p class="line150">Are you sure you want to delete "<b><?=$r['description']?></b>"?</p></td></tr>
		<?php } //'docid','date1','date2'
		?>
			</table>
			<table cellspacing="0" cellpadding="3px" width="<?=$fwidth?>px" style="margin-top:30px"><tr>
				<td align="center">
					<input type="button" class="btn" onclick="close_fform()" value="<?=$nobtn?>"/>
					<input type="button" class="btnx" value="<?=$okbtn?>" onclick="<?=$fmod?>('<?=$sx?>',<?=$cid?>,<?=$gd?>)"/>
				</td>
			</tr></table>
		</div>
	</div>
	</td></tr></table>
<?php 
} ?>
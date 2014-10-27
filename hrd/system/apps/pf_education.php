<?php
// Default Post Variables
$opt=gpost('opt');
$dcid=gpost('dcid'); if($dcid=='') $dcid=0;
$cid=gpost('cid'); if($cid=='') $cid=0;
$fname=gpost('fname');

// Form Title
if($opt=='af') $mtitle="Add new education history of ".$fname;
else if($opt=='uf') $mtitle="Edit ".$fname."'s education history";
else $mtitle="Delete ".$fname."'s education history";
// Function Module 
$fmod="pf_education";
// db Table
$dbtable="emp_education";

// Global Variables
$mstr_traintype=MstrGet("mstr_traintype");

if($opt=='a'||$opt=='u'||$opt=='d'||$opt=='rf'){
	// Post Variables
	$tfile=gpost('pf_train_file');
	$p=Array('university','year','title','field','score');
	$ipost=Array();
	foreach($p as $k=>$v){$ipost[$v]=gpost($v);}
	
	if($opt=='a'){
		if($tfile!=''){
			$description="Attachment of education - ".$ipost['university']."-".$ipost['year'];
			$filename=$tfile;
			$extension = end(explode(".", $filename));
			dbInsert("emp_files",Array('empid'=>$dcid,'description'=>$description,'file'=>$filename,'type'=>$extension));
			$fid=mysql_insert_id();
			$ipost['file']=$fid;
		}
		$ipost['empid']=$dcid;
		dbInsert($dbtable,$ipost);
		$cid=mysql_insert_id();
	}
	else if($opt=='u'){
		if($tfile!=''){
			dbDel("emp_files","`dcid`='".gpost('pf_train_current_file')."'");
			$description="Attachment of education - ".$ipost['university']."-".$ipost['year'];
			$filename=$tfile;
			$extension = end(explode(".", $filename));
			dbInsert("emp_files",Array('empid'=>$dcid,'description'=>$description,'file'=>$filename,'type'=>$extension));
			$fid=mysql_insert_id();
			$ipost['file']=$fid;
		}
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
	if($opt=='uf'||$opt=='df'){
		$r=dbSFA("*",$dbtable,"W/dcid='$cid'");
	}
	// Form dimension
	$fwidth=(strlen($r['title'])<25&&$opt=='df')?400:500; $lwidth=100;
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
			<tr><td>Name of school:</td><td><?=iText('university',$r['university'],$iTextFw)?></td></tr>
			<tr><td>Year Attended:</td><td><?=iText('year',$r['year'],$iTextFw)?></td></tr>
			<tr><td>Degree:</td><td><?=iText('title',$r['title'],$iTextFw)?></td></tr>
			<tr><td>Major:</td><td><?=iText('field',$r['field'],$iTextFw)?></td></tr>
			<tr><td>GPA:</td><td><?=iText('score',$r['score'],$iTextFw)?></td></tr>
			<tr><td>Attachment:</td><td>
				<iframe id="imgframe2" name="imgframe" scrolling="no" style="border:none;display:;height:25px;width:230px;overflow:hidden;margin:0;padding:0" src="trform.php?name=<?=$r['fname']?>"></iframe>
			</td></tr>
			<input type="hidden" id="pf_train_file" value="" />
			<input type="hidden" id="pf_train_current_file" value="<?=$r['file']?>" />
		<?php } else if($opt=='df'){ $okbtn = "Yes"; $nobtn="   No   "; $gd='false';
			// Delete form ?>
			<tr><td><p class="line150">Are you sure you want to delete "<b><?=$r['title']?></b>"?</p></td></tr>
		<?php } //'title','type','host','place','date1','date2','speaker','participant','certified'
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
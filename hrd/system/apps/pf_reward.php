<?php
// Default Post Variables
$opt=gpost('opt');
$dcid=gpost('dcid'); if($dcid=='') $dcid=0;
$cid=gpost('cid'); if($cid=='') $cid=0;
$fname=gpost('fname');

// Form Title
if($opt=='af') $mtitle="Give reward for ".$fname;
else if($opt=='uf') $mtitle="Change ".$fname."'s reward";
else $mtitle="Delete ".$fname."'s reward";
// Function Module 
$fmod="pf_reward";
// db Table
$dbtable="emp_reward";

// Global Variables

if($opt=='a'||$opt=='u'||$opt=='d'||$opt=='rf'){
	// Post Variables
	$p=Array('reward','rewardby','description','date','file');
	$ipost=Array();
	foreach($p as $k=>$v){$ipost[$v]=gpost($v);}
	
	if($opt=='a'){
		$ipost['empid']=$dcid; $fid=0;
		if($ipost['file']!=''){
			$description="Attachment of reward - ".$ipost['description'];
			$filename=$ipost['file'];
			$extension = end(explode(".", $filename));
			dbInsert("emp_files",Array('empid'=>$dcid,'description'=>$description,'file'=>$filename,'type'=>$extension));
			$fid=mysql_insert_id();
		}
		$ipost['file']=$fid;
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
	if($opt=='uf'||$opt=='df'){
		$r=dbSFA("*",$dbtable,"W/dcid='$cid'");
	} else {
		$r['date']=date("Y-m-d");
	}
	// Form dimension
	$fwidth=$opt=='df'?400:400; $lwidth=100;
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
			<tr><td width="<?=$lwidth?>px">Reward:</td><td><?=iText('reward',$r['host'],$iTextFw)?></td></tr>
			<tr><td width="<?=$lwidth?>px">By:</td><td><?=iText('rewardby',$r['rewardby'],$iTextFw)?></td></tr>
			<tr valign="top"><td>Description:</td><td><?=iTextarea('description',$r['participant'],$iTextFw,2)?></td></tr>
			<tr><td>Date:</td><td><?=inputDate('date',$r['date'])?></td></tr>
			<tr><td>Attachment:</td><td>
				<button class="btn" onclick="pf_files('af')" style="margin-right:20px;margin-top:10px">
					<div style="background:url('<?=IMGR?>bi_afile.png') no-repeat;padding-left:16px">Attach a file</div>
				</button>
			</td></tr>
		<?php } else if($opt=='df'){ $okbtn = "Yes"; $nobtn="   No   "; $gd='false';
			// Delete form ?>
			<tr><td><p class="line150">Are you sure you want to delete "<b><?=$r['reward']?></b>"?</p></td></tr>
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
<?php
// Default Post Variables
$opt=gpost('opt');
$cid=gpost('cid'); if($cid=='') $cid=0;
$name=gpost('name');

// Form Title
$mtitle="Employee Status";
$mdialog=Array('af'=>'Add new','uf'=>'Edit','df'=>'Delete');
// Function Module 
$fmod="m_status";
// db Table
$dbtable="mstr_status";

// Post Variables

if($opt=='a'||$opt=='u'||$opt=='d'||$opt=='up'||$opt=='dn'){
	if($opt=='a'){
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut));
		$cid=mysql_insert_id();
	}
	else if($opt=='u'){
		dbUpdate($dbtable,Array('name'=>$name),"dcid='$cid'");
	}
	else if($opt=='d'){
		dbUpdate("employee",Array('status'=>0),"status='$cid'");
		dbDel($dbtable,"dcid='$cid'");
	}
	else if($opt=='up'){
		$a=MstrGetNextUrut($dbtable,$cid);
		if($a[0]!=-1){
			dbUpdate($dbtable,Array('urut'=>$a[1]),"dcid='$cid'");
			dbUpdate($dbtable,Array('urut'=>$a[2]),"dcid='".$a[0]."'");
		}
	}
	else if($opt=='dn'){
		$a=MstrGetNextUrut($dbtable,$cid,"DESC");
		if($a[0]!=-1){
			dbUpdate($dbtable,Array('urut'=>$a[1]),"dcid='$cid'");
			dbUpdate($dbtable,Array('urut'=>$a[2]),"dcid='".$a[0]."'");
		}
	}
	require_once(VWDIR.$fmod.'.php');
} else {
	$sx=str_replace('f','',$opt); $nobtn="Cancel";
	// Form dimension
	$fwidth=400; $lwidth=100;
	$iTextFw="width:".($fwidth-$lwidth-16)."px";
	// Preprocessing form
	if($opt=='uf'||$opt=='df'){
		$r=dbSFA("*",$dbtable,"W/dcid='$cid'");
	}
	$mstr_status=MstrGet("mstr_status");
	?>
	<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
	<div class="fformbox" style="width:<?=($fwidth+20)?>px">
		<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
			<b><?=$mdialog[$opt]." ".$mtitle?><br/></b>
		</div>
		<div style="text-align:left;padding:15px 10px;width:<?=$fwidth?>px">
			<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<?php if($opt=='af' || $opt=='uf'){ $okbtn = ($opt=='af')?"Save":"OK"; $gd='true';
			// Add or Edit form ?>
			<tr><td width="100px">Status name:</td><td><?=iText('name',$r['name'],$iTextFw)?></td></tr>
		<?php } else if($opt=='df'){ $okbtn = "Yes"; $nobtn="   No   "; $gd='false';
			// Delete form ?>
			<tr><td><p class="line150">Are you sure you want to delete "<b><?=$r['name']?></b>"? All employee who had status "<?=$r['name']?>" will set to "No Status".</p></td></tr>
		<?php }?>
			</table>
			<table cellspacing="0" cellpadding="3px" width="<?=$fwidth?>px" style="margin-top:20px"><tr>
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
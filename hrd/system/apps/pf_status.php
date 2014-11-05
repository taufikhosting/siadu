<?php
// Default Post Variables
$opt=gpost('opt');
$dcid=gpost('dcid'); if($dcid=='') $dcid=0;
$cid=gpost('cid'); if($cid=='') $cid=0;
$fname=gpost('fname');

// Form Title
if($opt=='af') $mtitle="Add new employe status for ".$fname;
else if($opt=='uf') $mtitle="Edit ".$fname."'s employe status";
else $mtitle="Delete ".$fname."'s employe status";
// Function Module 
$fmod="pf_status";
// db Table
$dbtable="emp_status";

// Global Variables
$mstr_status=MstrGet("mstr_status");

if($opt=='a'||$opt=='u'||$opt=='d'||$opt=='up'||$opt=='dn'){
	// Post Variables
	$status=gpost('status');
	$date1=gpost('date1');
	$date2=gpost('date2');
	$position=gpost('position');
	$active=gpost('active');
	if($opt=='a'){
		dbInsert($dbtable,Array('empid'=>$dcid,'status'=>$status,'date1'=>$date1,'date2'=>$date2,'position'=>$position));
		$t=dbUpdate($dbtable,Array('active'=>'N'),"empid='$dcid'");
		dbUpdate("employee",Array('status'=>0),"dcid='$dcid'");
		$datenow=date("Y-m-d");
		$t=mysql_query("SELECT * FROM ".$dbtable." WHERE empid='$dcid' AND ( date1<='".$datenow."' AND date2>='".$datenow."' ) ORDER BY date2 DESC LIMIT 0,1");
		if(mysql_num_rows($t)>0){
			$r=mysql_fetch_array($t);
			dbUpdate("employee",Array('status'=>$r['status']),"dcid='$dcid'");
			dbUpdate($dbtable,Array('active'=>'Y'),"dcid='".$r['dcid']."'");
		}
	}
	else if($opt=='u'){
		dbUpdate($dbtable,Array('status'=>$status,'date1'=>$date1,'date2'=>$date2,'position'=>$position),"dcid='$cid'");
		$t=dbUpdate($dbtable,Array('active'=>'N'),"empid='$dcid'");
		dbUpdate("employee",Array('status'=>0),"dcid='$dcid'");
		$datenow=date("Y-m-d");
		$t=mysql_query("SELECT * FROM ".$dbtable." WHERE empid='$dcid' AND ( date1<='".$datenow."' AND date2>='".$datenow."' ) ORDER BY date2 DESC LIMIT 0,1");
		if(mysql_num_rows($t)>0){
			$r=mysql_fetch_array($t);
			dbUpdate("employee",Array('status'=>$r['status']),"dcid='$dcid'");
			dbUpdate($dbtable,Array('active'=>'Y'),"dcid='".$r['dcid']."'");
		}
	}
	else if($opt=='d'){
		if($active=='Y'){
			dbUpdate("employee",Array('status'=>0),"dcid='$dcid'");
		}
		dbDel($dbtable,"dcid='$cid'");
		
		$t=dbUpdate($dbtable,Array('active'=>'N'),"empid='$dcid'");
		dbUpdate("employee",Array('status'=>0),"dcid='$dcid'");
		$datenow=date("Y-m-d");
		$t=mysql_query("SELECT * FROM ".$dbtable." WHERE empid='$dcid' AND ( date1<='".$datenow."' AND date2>='".$datenow."' ) ORDER BY date2 DESC LIMIT 0,1");
		if(mysql_num_rows($t)>0){
			$r=mysql_fetch_array($t);
			dbUpdate("employee",Array('status'=>$r['status']),"dcid='$dcid'");
			dbUpdate($dbtable,Array('active'=>'Y'),"dcid='".$r['dcid']."'");
		}
	}
	$t=dbSel("*","employee","W/dcid='$dcid' LIMIT 0,1");
	$r=dbFA($t);
	require_once(VWDIR.$fmod.'.php');
} else {
	$sx=str_replace('f','',$opt); $nobtn="Cancel";
	// Form dimension
	$fwidth=$opt=='df'?500:400; $lwidth=80;
	$iTextFw="width:".($fwidth-$lwidth-16)."px";
	// Preprocessing form
	if($opt=='uf'||$opt=='df'){
		$r=dbSFA("*",$dbtable,"W/dcid='$cid'");
		$date1=$r['date1']; $date2=$r['date2'];
	} else {
		$date1=date("Y-m-d"); $date2=date("Y-m-d");
	}
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
			<tr><td width="<?=$lwidth?>px">Status:</td>
				<td><?=iSelect('status',$mstr_status,$r['status'],"float:left")?><?=iAddMstrx('status','status','status name')?></td>
			</tr>
			<tr><td>Period:</td><td><?=inputDate('date1',$date1)?> to </td></tr>
			<tr><td>&nbsp;</td><td><?=inputDate('date2',$date2)?></td></tr>
			<tr><td>Position:</td><td><?=iText('position',$r['position'],$iTextFw)?></td></tr>
		<?php } else if($opt=='df'){ $okbtn = "Yes"; $nobtn="   No   "; $gd='false';
			// Delete form ?>
			<tr><td><p class="line150">Are you sure you want to delete "<b><?=$mstr_status[$r['status']]?></b>" in period <?=ftgl($r['date1'])." to ".ftgl($r['date2'])?>?<?php if($r['active']=='Y'){?> This status is <span style="color:#008000"><b>active</b></span>. If it deleted, status of <?=$fname?> will set to "No Status".<?php }?></p></td></tr>
		<?php }?>
			</table>
			<input type="hidden" id="active" name="active" value="<?=$r['active']?>"/>
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
<?php
$opt=gpost('opt');
$cid=gpost('cid'); if($cid=='') $cid=0;

// Form Title
$mtitle="training";
$mdialog=Array('af'=>'Add new','uf'=>'Edit','df'=>'Delete');
// Function Module 
$fmod="p_train";
// db Table
$dbtable="training";

// Post Variables
$p=Array('title','type','host','place','date1','date2','speaker','participant');
$ipost=Array();
foreach($p as $k=>$v){$ipost[$v]=gpost($v);}

if($opt=='a'||$opt=='u'||$opt=='d'){
	if($opt=='a'){
		dbInsert($dbtable,$ipost);
		$cid=mysql_insert_id();
	}
	else if($opt=='u'){
		dbUpdate($dbtable,$ipost,"dcid='$cid'");
	}
	else if($opt=='d'){
		dbDel($dbtable,"dcid='$cid'");
	}
	require_once(VWDIR.$fmod.'.php');
} else {
	$sx=str_replace('f','',$opt); $nobtn="Cancel"; $fwidth=500;
	// Preprocessing form
	if($opt=='uf'||$opt=='df'){
		$r=dbSFA("*",$dbtable,"W/dcid='$cid'");
	} else {
		$r['date1']=date("Y-m-d");
		$r['date2']=date("Y-m-d");
	}
	$mstr_traintype=MstrGetTraintype();
	?>
	<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
	<div class="fformbox" style="width:<?=($fwidth+20)?>px">
		<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
			<b><?=$mdialog[$opt]." ".$mtitle?><br/></b>
		</div>
		<div style="text-align:left;padding:15px 10px;width:<?=$fwidth?>px;overflow:hidden">
			<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<?php if($opt=='af' || $opt=='uf'){ $okbtn = ($opt=='af')?"Save":"OK"; $gd='true';
			// Add or Edit form ?>
			<tr><td width="100px">Title:</td><td><?=iText('title',$r['title'],"width:400px")?></td></tr>
			<tr><td>Type:</td><td><?=iSelect('type',$mstr_traintype,$r['type'],"float:left")?>
				<div style="position:relative;float:left">
					<button class="obtna" title="Add new training type" onclick="open_popbox()" style="margin-left:2px">
					<img src="<?=IMGR?>add.png" />
					</button>
					<div id="popblock" style="display:none;background:rgba(0,0,0,0.1);width:1000px;height:800px;position:absolute;top:-400px;left:-500px" onclick="close_popbox()"></div>
					<div id="popbox" style="display:none;width:310px;height:55px;position:absolute;top:20px;left:-141px;background:url('<?=IMGR?>pbox.png') center no-repeat">
						<table cellspacing="0" cellpadding="0" width="310px"><tr height="58px" style="padding-top:10px">
							<td width="35px" align="right"><button class="popx" title="Cancel" onclick="close_popbox()"></button></td>
							<td align="center"><?=iText('popinput','',"width:220px",'New training type')?></td>
							<td width="35px" align="left"><button class="popy" title="Add" onclick="popbox_save()"></button></td>
						</tr></table>
					</div>
				</div>
				
			</td></tr>
			<tr><td>Host:</td><td><?=iText('host',$r['host'],"width:400px")?></td></tr>
			<tr><td>Place:</td><td><?=iText('place',$r['place'],"width:400px")?></td></tr>
			<tr><td>Date:</td><td><?=inputDate('date1',$r['date1'])?> to </td></tr>
			<tr><td>&nbsp;</td><td><?=inputDate('date2',$r['date2'])?></td></tr>
			<tr><td>Speaker:</td><td><?=iText('speaker',$r['speaker'],"width:400px")?></td></tr>
			<tr valign="top"><td>Participant:</td><td><?=iTextarea('participant',$r['participant'],"width:400px",3)?></td></tr>
		<?php } else if($opt=='df'){ $okbtn = "Yes"; $nobtn="   No   "; $gd='false';
			// Delete form ?>
			<tr><td><p class="line150">Are you sure you want to delete "<b><?=$r['title']?></b>"?</p></td></tr>
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
<?php
// Default Post Variables
$opt=gpost('opt');
$cid=gpost('cid'); if($cid=='') $cid=0;
$name=gpost('name');

// Form Title
$mtitle="Document Reminders";
$mdialog=Array('af'=>'Add new','uf'=>'Set','df'=>'Delete');
// Function Module 
$fmod="m_remdoc";
// db Table
$dbtable="mstr_document";

// Post Variables

if($opt=='u'||$opt=='rf'){
	if($opt=='u'){
		$mstr_document=MstrGet("mstr_document");
		foreach($mstr_document as $cid=>$val){
			$rem=gpost('remdoc'.$cid);
			dbUpdate($dbtable,Array('reminder'=>$rem),"dcid='$cid'");
		}
	}
	require_once(VWDIR.$fmod.'.php');
} else {
	$sx=str_replace('f','',$opt); $nobtn="Cancel";
	// Form dimension
	$fwidth=280; $lwidth=180;
	// Preprocessing form
	$t=dbSel("*","mstr_document","O/ urut,name");
	?>
	<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
	<div class="fformbox" style="width:<?=($fwidth+20)?>px">
		<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
			<b><?=$mdialog[$opt]." ".$mtitle?><br/></b>
		</div>
		<div style="text-align:left;padding:15px 10px;width:<?=$fwidth?>px">
			<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<?php $okbtn = ($opt=='af')?"Save":"OK"; $gd='true'; // Edit form ?>
			<?php $inparray=""; $n=0; while($r=dbFA($t)){ if($n==0) $n=1; else $inparray.="-"; $inparray.="remdoc".$r['dcid'];?>
			<tr><td width="<?=$lwidth?>px"><?=$r['name']?>:</td><td><?=iText('remdoc'.$r['dcid'],$r['reminder'],"width:40px;text-align:center")?> day(s)</td></tr>
			<?php }?>
			</table>
			<input type="hidden" id="inparray" value="<?=$inparray?>"/>
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
<?php
// Default Post Variables
$opt=gpost('opt');
$cid=gpost('cid'); if($cid=='') $cid=0;
$name=gpost('name');
$phone=gpost('phone');
$address=gpost('address');
$nsel=intval(gpost('nsel'));

// form Module
$fmod="publisher";

// Form Title
$mtitle="Publihser";
$mdialog=Array('af'=>'Add new','uf'=>'Edit','df'=>'Delete');
// db Table
$dbtable="mstr_publisher";

// Post Variables

if($opt=='a'||$opt=='u'||$opt=='d'||$opt=='m'){
	if($opt=='a'){ // Add db
		if(dbInsert($dbtable,Array('name'=>$name,'phone'=>$phone,'address'=>$address))){
			$cid=mysql_insert_id();
			$_SESSION['newentry']=$cid;
			$_SESSION['newentrymsg']='<span class="notifl">New publisher has been added.</span>';
		} else {
			$_SESSION['newentrymsg']='<span class="notife">Failed to add new publisher. Please contact your administrator [APU01].</span>';
			echo "R"; // Redirect
		}
	}
	else if($opt=='u'){ // Update db
		if(dbUpdate($dbtable,Array('name'=>$name,'phone'=>$phone,'address'=>$address),"dcid='$cid'")){
			$_SESSION['newentrymsg']='<span class="notifl">Publisher information has been updated.</span>';
		} else {
			$_SESSION['newentrymsg']='<span class="notife">Failed to update this publisher information. Please contact your administrator [APU02].</span>';
		}
		$_SESSION['newentry']=$cid;
	}
	else if($opt=='d'){ // Delete db
		$nm=stripslashes(dbFetch("name","mstr_publisher","W/dcid='$cid'"));
		if(dbDel($dbtable,"dcid='$cid'")){
			dbUpdate("catalog",Array('publisher'=>0),"publisher='$cid'");
			$_SESSION['newentrymsg']='<span class="notifl"><b>'.$nm.'</b> has been deleted.</span>';
			echo "R"; // Redirect
		} else {
			$_SESSION['newentry']=$cid;
			$_SESSION['newentrymsg']='<span class="notife">Unable to delete publisher. Please contact your administrator [APU03].</span>';
		}
	}
	else if($opt=='m'){ // Delete db
		$sc=true; $nd=0;
		for($i=0;$i<$nsel;$i++){
			$cid=gpost('dm'.$i);
			if(dbDel($dbtable,"dcid='$cid'")){
				dbUpdate("catalog",Array('publisher'=>0),"publisher='$cid'");
				$nd++;
			} else {
				$sc=false;
			}
		}
		if($sc){
			$_SESSION['newentrymsg']='<span class="notifl">'.$nd.' publisher'.($nd>1?'s':'').' has been deleted.</span>';
			echo "R"; // Redirect
		} else {
			//$_SESSION['newentry']=$cid;
			$_SESSION['newentrymsg']='<span class="notife">Unable to delete publisher. Please contact your administrator [APU04].</span>';
		}
	}
	//require_once(VWDIR."v_".$fmod.'.php');
} else {
	if($opt!='df') require_once(MODDIR.'control.php');
	$sx=str_replace('f','',$opt); $nobtn="Cancel";
	// Form dimension
	$fwidth=400; $lwidth=100;
	$iTextFw="width:".($fwidth-$lwidth-16)."px";
	// Preprocessing form
	if($opt=='uf'||$opt=='df'){
		$r=dbSFA("*",$dbtable,"W/dcid='$cid'");
	}
	?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt" align="center" style="padding-top:220px">
<div id="fformbox" class="fformbox" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:15px">
		<?=$mdialog[$opt]." ".$mtitle?>
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
	<?php if($opt=='af' || $opt=='uf'){ $okbtn = ($opt=='af')?"Save":"OK"; $gd='true';
		// Add or Edit form ?>
		<tr><td width="100px">Publiser name:</td><td><?=iText('name',stripslashes($r['name']),$iTextFw)?></td></tr>
		<tr><td width="100px">Phone:</td><td><?=iText('phone',$r['phone'],$iTextFw)?></td></tr>
		<tr valign="top"><td width="100px">Address:</td><td><?=iTextarea('address',$r['address'],$iTextFw,3)?></td></tr>
	<?php } else if($opt=='df'){ $okbtn = "Yes"; $nobtn="   No   "; $gd='false';
		// Delete form ?>
		<tr><td><p class="line150">Are you sure you want to delete "<b><?=$r['name']?></b>"?</p></td></tr>
	<?php } else if($opt=='mf'){ $okbtn = "Yes"; $nobtn="   No   "; $gd='false';
		// Delete form ?>
		<tr><td><p class="line150">Are you sure you want to delete <?=$nsel.' selected publisher'.($nsel>1?'s':'')?>?</p></td></tr>
	<?php }?>
		</table>
		<table cellspacing="0" cellpadding="3px" width="<?=$fwidth?>px" style="margin-top:20px"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform()" value="<?=$nobtn?>"/>
				<input type="button" class="btnx" value="<?=$okbtn?>" onclick="cfform('<?=$sx?>',<?=$cid?>,<?=$gd?>)"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php 
} ?>
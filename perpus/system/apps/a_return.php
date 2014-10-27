<?php
require_once(MODDIR.'masterdb.php');
require_once(MODDIR.'date.php');

// Default Post Variables
$opt=gpost('opt');
$cid=gpost('cid'); if($cid=='') $cid=0;
$name=gpost('name');
$prefix=gpost('prefix');
$nsel=intval(gpost('nsel'));

// form Module
$fmod="author";

// Form Title
$mtitle="Author";
$mdialog=Array('af'=>'Add new','uf'=>'Edit','df'=>'Delete');
// db Table
$dbtable="loan";

// Post Variables

if($opt=='a'||$opt=='u'||$opt=='d'||$opt=='m'){
	if($opt=='a'){ // Add db
		if(dbInsert($dbtable,Array('name'=>$name,'prefix'=>$prefix))){
			$cid=mysql_insert_id();
			$_SESSION['newentry']=$cid;
			$_SESSION['newentrymsg']='<span class="notifl">New author has been added.</span>';
		} else {
			$_SESSION['newentrymsg']='<span class="notife">Failed to add new author. Please contact your administrator [AAU01].</span>';
			echo "R"; // Redirect
		}
	}
	else if($opt=='u'){ // Update db
		$loan=dbSFA("*","loan","W/dcid='$cid'");
		$book=$loan['book'];
		$status=gpost('status');
		$fine=gpost('fine');
		$dater=gpost('dater');
		if(dbUpdate($dbtable,Array('status'=>$status,'fine'=>$fine,'dater'=>$dater),"dcid='$cid'")){
			dbUpdate("book",Array('available'=>'Y'),"dcid='$book'");
			$_SESSION['newentrymsg']='<span class="notifl">Author information has been updated.</span>';
		} else {
			$_SESSION['newentrymsg']='<span class="notife">Failed to update this author information. Please contact your administrator [AAU02].</span>';
		}
		$_SESSION['newentry']=$cid;
	}
	else if($opt=='d'){ // Delete db
		$nm=stripslashes(dbFetch("name","mstr_author","W/dcid='$cid'"));
		if(dbDel($dbtable,"dcid='$cid'")){
			dbUpdate("catalog",Array('author'=>0),"author='$cid'");
			$_SESSION['newentrymsg']='<span class="notifl"><b>'.$nm.'</b> has been deleted.</span>';
			echo "R"; // Redirect
		} else {
			$_SESSION['newentry']=$cid;
			$_SESSION['newentrymsg']='<span class="notife">Unable to delete author. Please contact your administrator [AAU03].</span>';
		}
	}
	else if($opt=='m'){ // Delete db
		$sc=true; $nd=0;
		for($i=0;$i<$nsel;$i++){
			$cid=gpost('dm'.$i);
			if(dbDel($dbtable,"dcid='$cid'")){
				dbUpdate("catalog",Array('author'=>0),"author='$cid'");
				$nd++;
			} else {
				$sc=false;
			}
		}
		if($sc){
			$_SESSION['newentrymsg']='<span class="notifl">'.$nd.' author'.($nd>1?'s':'').' has been deleted.</span>';
			echo "R"; // Redirect
		} else {
			//$_SESSION['newentry']=$cid;
			$_SESSION['newentrymsg']='<span class="notife">Unable to delete author. Please contact your administrator [AAU04].</span>';
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
		$r=dbSFA("*",$dbtable,"W/`dcid`='$cid' LIMIT 0,1");
		$b=dbSFA("*","book","W/`dcid`='".$r['book']."' LIMIT 0,1");
		$c=dbSFA("*","catalog","W/`dcid`='".$b['catalog']."' LIMIT 0,1");
		$m=mysql_fetch_array(mysql_query("SELECT * FROM ".DB_HRD." WHERE `nip`='".$r['member']."' LIMIT 0,1"));
		$author=stripslashes(dbFetch("name","mstr_author","W/`dcid`='".$c['author']."'"));
		$publisher=dbFetch("name","mstr_publisher","W/`dcid`='".$c['publisher']."'");
		$cla=dbSFA("name,code","mstr_class","W/`dcid`='".$c['class']."' LIMIT 0,1");
	}
	?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt" align="center" style="padding-top:115px">
<div id="fformbox" class="fformbox" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:15px">
		Return book
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
	<?php if($opt=='af' || $opt=='uf'){ $okbtn = ($opt=='af')?"Save":"Return this book"; $gd='true';
		// Add or Edit form ?>
		<tr><td>
			<table class="stable2" border="0" cellspacing="0" cellpadding="5px" width="400px" style="cursor:default;margin-bottom:20px">
			<tr valign="top">
				<td width="70px" align="left">
					<img src="<?=IMGC.($c['cover']==''?"nocover.jpg":$c['cover'])?>" width="60px"/>
				</td>
				<td>
					<div style="font:15px <?=SFONT?>;color:<?=CDARK?>"><b><?=stripslashes($c['title'])?></b></div>
					<div style="font:12px <?=SFONT?>;color:<?=CDARK?>;margin-top:4px">by <a class="linkb" target="_blank" href="<?=RLNK?>book.php?get=author&getid=<?=$r['author']?>" title="View all book by <?=$author?>"><?=$author?></a></div>
					<div class="hl2" style="margin-top:14px">Book details:</div>
					<table cellspacing="0" cellpadding="0">
					<tr>
						<td width="100px"><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">Book number</div></td>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">: <span style="color:<?=CLBLUE?>"><?=$b['nid']?></span></div></td>
					</tr>
					<tr>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">Call number</div></td>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">: <span style="color:<?=CLBLUE?>"><?=$b['callnumber']?></span></div></td>
					</tr>
					</table>
					
					<div class="hl2" style="margin-top:14px">Loan details:</div>
					<table cellspacing="0" cellpadding="0">
					<tr>
						<td width="100px"><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">Member name</div></td>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">: <?=$m['name']?></div></td>
					</tr>
					<tr>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">Member ID</div></td>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">: <?=$m['nip']?></div></td>
					</tr>
					<tr>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">Member type</div></td>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">: Staff</div></td>
					</tr>
					<tr>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">Loan date</div></td>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">: <?=fftgl($r['date1'])?></div></td>
					</tr>
					<tr>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">Due date</div></td>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">: <?php
							$dd=diffDay($r['date2']); 
							if($dd<0) echo '<span style="color:#ff0000">'.fftgl($r['date2']).' ( '.abs($dd).' day'.($dd<-1?'s':'').' over )</span>';
							else if($dd==0) echo '<span style="color:#0000ff">'.fftgl($r['date2']).' ( Today )</span>';
							else echo '<span style="color:#008000">'.fftgl($r['date2']).'</span>';
						?></div></td>
					</tr>
					<?php $fine=0; $status=0;
					if($dd<0){
					$fine=floatval(dbFetch("val","mstr_setting","W/dcid=8"))*abs($dd); $status=2;
					?>
					<tr>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">Fine</div></td>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">: Rp <?=number_format($fine,2,',','.')?></div></td>
					</tr>
					<?php }?>
					</table>
					<input type="hidden" id="dater" value="<?=date("Y-m-d")?>" />
					<input type="hidden" id="fine" value="<?=$fine?>" />
					<input type="hidden" id="status" value="<?=$status?>" />
				</td>
			</tr>
			</table>
		</td></tr>
	<?php } else if($opt=='df'){ $okbtn = "Yes"; $nobtn="   No   "; $gd='false';
		// Delete form ?>
		<tr><td><p class="line150">Are you sure you want to delete "<b><?=$r['name']?></b>"?</p></td></tr>
	<?php } else if($opt=='mf'){ $okbtn = "Yes"; $nobtn="   No   "; $gd='false';
		// Delete form ?>
		<tr><td><p class="line150">Are you sure you want to delete <?=$nsel.' selected author'.($nsel>1?'s':'')?>?</p></td></tr>
	<?php }?>
		</table>
		<table cellspacing="0" cellpadding="3px" width="<?=$fwidth?>px" style="margin-top:20px"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform()" value="<?=$nobtn?>"/>
				<input type="button" class="btnx" value="<?=$okbtn?>" onclick="bookreturn('<?=$sx?>',<?=$cid?>,<?=$gd?>)"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php 
} ?>
<?php
/** Global Variables */
$mstr_status=MstrGet("mstr_status");
$mstr_level=MstrGet("mstr_level");
$mstr_group=MstrGet("mstr_group");
$mstr_division=MstrGet("mstr_division");
$mstr_position=MstrGet("mstr_position");

/* Pre Data Processing */
// Searching:
$keyw=getsx('q');
$search="";
if($keyw!=""){
	$search=" WHERE name LIKE '%$keyw%' OR nip='$keyw'";
}
function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<b>\$0</b>", $v);}

// Sorting:
$sortby=getsx('sortby');
$sortmode=getsx('mode');
$sf=false;
$sm=($sortmode=='1')?" DESC":"";
if($sortby=='status'){
	$sql="SELECT t1.* FROM employee t1 LEFT JOIN mstr_status t2 ON t1.status = t2.dcid LEFT JOIN mstrx t3 ON t1.status = t3.dcid ORDER BY t2.name, t3.name".$sm;
	$sf=true;
} else {
	// Sorting filelds
	$sfa=Array('name','nip');
	foreach($sfa as $k=>$v){
		if($sortby==$v){ $sf=true; $sfi=$v; }
	}
	if(!$sf){
		$sfi="name"; $sortby="";
	}
	$sql="SELECT * FROM employee ".$search." ORDER BY ".$sfi.$sm;
}
if($sf){
	if($sortmode!='1') $smode='1';
	else $smode='0';
}

//echo "<span style='color:red'>".$sql."</span><br/>";

// Queries:
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

// Paging:
$page_link=RLNK."employee.php";
// number per page
$npp=20;
// number of page
$nop = ceil($ndata/$npp);
// current page
$page=getsx('page');
if($page=='') $page=1;
if(intval($page)>$ndata) $page=$ndata;
if(intval($page)<1) $page=1;
// number in page row start
$nps = $npp*($page-1);
// number in page row last
$npl = $nps+$npp;

// find item update location
$l=-1;
if($opt=='a' || $opt=='u'){
	$l=1;
	while($k=mysql_fetch_array($t)){
		if($cid==$k['dcid']){ // found!
			// Re-Calculate page:
			$page=ceil(($l)/$npp);
			$nps = $npp*($page-1);
			$npl = $nps+$npp;
			break;
		}
		$l++;
	}
	// Re-Queries:
	$t=mysql_query($sql);
	$ndata=mysql_num_rows($t);
}

function rLink($a){
	return "style=\"cursor:pointer\" onclick=\"jumpTo('".RLNK."employee_view.php?nid=".$a."')\" ";
}

require_once(APPDIR.'emp_reminder_status.php');
require_once(APPDIR.'emp_reminder_document.php');

?>
<table cellspacing="0" cellpadding="0" width="940px" style="margin-bottom:2px"><tr height="30px">
<td>
<?php if($keyw==''){?>
	<button class="btn" title="Add new employee" onclick="jumpTo('<?=RLNK?>employee_add.php')">
		<div style="background:url('<?=IMGR?>addico.png') no-repeat;padding-left:16px">New employee</div>
	</button>
<?php } else {?>
	<div class="sfont">
		<button class="btn" title="Show all employee" onclick="jumpTo('<?=$page_link?>')" style="margin-right:20px">
			<div style="background:url('<?=IMGR?>larrow.png') no-repeat;padding-left:16px">All employee</div>
		</button>
	<?php if($ndata>0){ ?>
		Searching <b>"<?=$keyw?>"</b>, found <?=$ndata?> result:
	<?php } else {?>
		<b><?=$keyw?></b> no match with any employee.
	<?php } ?>
	</div>
<?php } ?>
</td>
<td align="right">
<table cellspacing="0" cellpadding="0" align="right"><tr height="30px">
<td width="60px"><?php if($nop>1){?><span class="sfont">Pages:</span><?php }?></td>
<td align="right">
	<?php
	if($nop>1){?>
	<table cellspacing="4px" cellpadding="0" style="margin-top:2px"><tr>
		<td><a class="plink<?=(($page>1)?"\" title=\"Go to previous page\" href=\"".pageLink($page-1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> < </a></td>
		<?php for($n=1;$n<=$nop;$n++){ ?>
		<td><a class="plink<?=(($n!=$page)?"\" title=\"Go to page $n\" href=\"".pageLink($n,gets('sortby'),gets('mode'),gets('q')):"a")?>"><?=$n;?></a></td>
		<?php }?>
		<td><a class="plink<?=(($page<$nop)?"\" title=\"Go to next page\" href=\"".pageLink($page+1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> > </a></td>
	</tr></table>
	<?php }?>
</td>
</tr></table>
</td>
</tr></table>
<input type="hidden" id="pagelink" value="<?=(($page!='')?"&page=".$page:"")?><?=(($sortby!='')?"&sortby=".$sortby:"")?><?=(($smode!='')?"&mode=".$sortmode:"")?><?=(($keyw!='')?"&q=".$keyw:"")?>"/>
<?php if($ndata>0){?>
<table class="xtable" border="0" cellspacing="1px" width="940px">
	<tr>
		<td class="xtdh" style="text-align:center">No</td>
		<?=iThx("Name",'name',$page,$sortby,$smode,$keyw)?>
		<?=iThx("NIP",'nip',$page,$sortby,$smode,$keyw)?>
		<?=iThx("Status",'status',$page,$sortby,$smode,$keyw)?>
		<?=iThx("Level",'level',$page,$sortby,$smode,$keyw)?>
		<?=iThx("Group",'group',$page,$sortby,$smode,$keyw)?>
		<?=iThx("Division",'division',$page,$sortby,$smode,$keyw)?>
		<?=iThx("Position",'position',$page,$sortby,$smode,$keyw)?>
		<td class="xtdh" style="text-align:center">Option</td>
	</tr>
<?php
$n=0; $rt=0; $rc=1; //$p=Array('name','nip','status','level','group','division','position');
while($r=mysql_fetch_array($t)){ if($n>=$nps && $n<$npl){ $rt++; if($rc==0){$rc=1;}else{$rc=0;}; $date1=ftgl($r['date1']); $date2=ftgl($r['date2']);
	?>
	<tr id="p_employee<?=$r['dcid']?>" class="xr<?=$rc?>">
		<td width="30px" align="center"><?=($n+1)?></td>
		<td <?=rLink($r['dcid'])?>width="*"><?=src_replace($r['name'])?></td>
		<td <?=rLink($r['dcid'])?>width="80px"><?=src_replace($r['nip'])?></td>
		<td <?=rLink($r['dcid'])?>width="110px" ><?=$mstr_status[$r['status']]?></td>
		<td <?=rLink($r['dcid'])?>width="100px" ><?=$mstr_level[$r['level']]?></td>
		<td <?=rLink($r['dcid'])?>width="100px" ><?=$mstr_group[$r['group']]?></td>
		<td <?=rLink($r['dcid'])?>width="100px" ><?=$mstr_division[$r['division']]?></td>
		<td <?=rLink($r['dcid'])?>width="100px" ><?=$mstr_position[$r['position']]?></td>
		<td width="60px" align="center">
			<button class="btnedit" title="Edit" onclick="jumpTo('<?=RLNK."employee_edit.php?nid=".$r['dcid']?>&opt=table')"></button>
			<!--button class="btndel" title="Delete" onclick="p_train('df',<?=$r['dcid']?>)"></button-->
		</td>
	</tr>
<?php } $n++; } ?>
</table>
<?php if($rt>=19){ ?>
<div style="margin-top:2px;width:940px;margin-bottom:20px">
<table cellspacing="0" cellpadding="0" align="right"><tr height="30px">
<td width="60px"><?php if($nop>1){?><span class="sfont">Pages:</span><?php }?></td>
<td align="right">
	<?php
	if($nop>1){?>
	<table cellspacing="4px" cellpadding="0" style="margin-top:2px"><tr>
		<td><a class="plink<?=(($page>1)?"\" title=\"Go to previous page\" href=\"".pageLink($page-1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> < </a></td>
		<?php for($n=1;$n<=$nop;$n++){ ?>
		<td><a class="plink<?=(($n!=$page)?"\" title=\"Go to page $n\" href=\"".pageLink($n,gets('sortby'),gets('mode'),gets('q')):"a")?>"><?=$n;?></a></td>
		<?php }?>
		<td><a class="plink<?=(($page<$nop)?"\" title=\"Go to next page\" href=\"".pageLink($page+1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> > </a></td>
	</tr></table>
	<?php }?>
</td>
</tr></table></div>
<?php }?>
<input type="hidden" id="newentry" value="<?=(($opt=='u' || $opt=='a')?"p_train".$cid:"E")?>"/>
<?php }?>
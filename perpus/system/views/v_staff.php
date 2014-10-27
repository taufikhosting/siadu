<?php
// Searching:
$keyw=getsx('q');
$search="";
if($keyw!=""){
	$search=" WHERE name LIKE '$keyw %' OR name LIKE '% $keyw' OR name LIKE '% $keyw %' OR name LIKE '$keyw,%' OR name='$keyw'";
}
function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<b>\$0</b>", $v);}

// Sorting:
$sortby=getsx('sortby');
$sortmode=getsx('mode');
$sf=false;
$sm=($sortmode=='1')?" DESC":"";
// Sorting filelds
$sfa=Array('name','nip');
foreach($sfa as $k=>$v){
	if($sortby==$v) $sf=true;
}
if($sf){
	$sfi=$sortby;
} else {
	$sfi="name"; $sortby="";
}
$sql="SELECT * FROM ".DB_HRD." ".$search." ORDER BY ".$sfi.$sm;
if($sf){
	if($sortmode!='1') $smode='1';
	else $smode='0';
}

// Queries:
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

// Paging:
$page_link=RLNK."members.php?tab=staff";
// number per page
$npp=30;
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
// Re Query only in page
$sql.=" LIMIT $nps,$npp";
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);
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
if(!empty($_SESSION['newentry'])){
	$sql="SELECT * FROM mstr_author WHERE dcid='".$_SESSION['newentry']."' LIMIT 0,1";
	$t=mysql_query($sql);
	$ndata=mysql_num_rows($t); $nop=ceil($ndata/$npp);
	$keyw='';
}
$tablew='700px';
$ntot=mysql_num_rows(mysql_query("SELECT * FROM ".DB_HRD));
?>
<input type="hidden" id="redir" value="<?=str_replace("?","&",getCPageLink())?>"/>
<div style="width:<?=$tablew?>;margin-bottom:6px;margin-top:0px;height:24px">
<?php if(!empty($_SESSION['newentrymsg']) || $keyw!=''){ ?>
	<div id="newemsg" class="sfont" style="text-align:center;padding:2px 6px;background:#f4f4f4;border-radius:5px">
		<?php
		if(!empty($_SESSION['newentrymsg'])){ // conditional message
			echo $_SESSION['newentrymsg'];
		} else if($keyw!=''){
			if($ndata>0){ 
				echo 'Searching author with name <b>"'.$keyw.'"</b>, found '.$ndata.' result:';
			} else {
				echo '<b>'.$keyw.'</b> does not match with any author name.';
			} 
		}
		?>
	</div>
<?php }?>
</div>
<div class="btnbar" style="width:<?=$tablew?>">
<?php
if($keyw=='' && empty($_SESSION['newentry']) ){ // Normal or conditional view option ?>
	<div class="sfont" style="float:left;margin-top:6px">Total member: <?=$ntot?></div>
	<!--button class="btn_fl" title="Add new author" onclick="cfform('af')">
		<div class="bi_add">New author</div>
	</button-->
<?php } else {?>
	<button class="btn_fl" title="Show all author" onclick="jumpTo('<?=RLNK?>members.php?tab=staff')">
		<div class="bi_arrow">All staff</div>
	</button>
<?php } if(empty($_SESSION['newentry'])){?>
	<!--button class="btn_fl" onclick="checkAll(true)">Check all</button>
	<button class="btn_fl" onclick="checkAll(false)">Uncheck all</button>
	<button id="xdel1" class="btn_fl" onclick="cfform('mf')" style="display:none">Delete selected</button-->
<?php }?>
	<form style="padding:0;margin:0" action="<?=RLNK?>members.php" method="get">
	<button class="btn" style="float:right;width:24px;margin:0" title="Search"><div class="bi_srcb">&nbsp;</div></button>
	<div style="float:right;margin-right:4px"><input type="hidden" name="tab" value="staff"/>
		<?=iText('q','',"width:150px",'Search staff name')?></div>
	</form>
</div>
<input type="hidden" id="pagelink" value="<?=(($page!='')?"&page=".$page:"")?><?=(($sortby!='')?"&sortby=".$sortby:"")?><?=(($smode!='')?"&mode=".$sortmode:"")?><?=(($keyw!='')?"&q=".$keyw:"")?>"/>
<?php if($ndata>0){?>
<table class="xtable" border="0" cellspacing="0" width="<?=$tablew?>">
	<tr>
		<?=iThxp("Name",'name',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("NIP",'nip',$page,$sortby,$smode,$keyw)?>
		<td class="xtdh" style="text-align:center">Book in loan</td>
		<td class="xtdh" style="text-align:left">Options</td>
	</tr>
<?php
$n=$nps; $rc=1; $k=1; $rh=$cover?'height="100px"':'';
while($r=dbFAx($t)){ if($n>=$nps && $n<$npl){ if($rc==0){$rc=1;}else{$rc=0;};
	?>
	<tr id="xrow<?=$r['dcid']?>" class="xxr<?=$rc?>" <?=$rh?>>
		<td width="*"><?=src_replace($r['name'])?></td>
		<td width="120px"><?=src_replace($r['nip'])?></td>
		<td width="120px" align="center">
		<?php
			echo dbSRow("loan","W/member='".$r['nip']."' AND status='1'");
		?>
		</td>
		<td width="55px" align="left">
			<?php echo optionbtn_view("jumpTo('".RLNK."members.php?tab=staff&act=view&nid=".$r['nip']."')",1);?>
		</td>
	</tr>
<?php $k++;}$n++;} ?>
</table>
<input type="hidden" id="xnrow" value="<?=$k?>"/>
<input type="hidden" id="newentry" value="<?=(($opt=='u' || $opt=='a')?"xrow".$cid:"E")?>"/>
<div class="btnbar" style="width:<?=$tablew?>;margin-top:6px;display:<?=($ndata>10?'':'none')?>">
	<!--button class="btn_fl" onclick="checkAll(true)">Check all</button>
	<button class="btn_fl" onclick="checkAll(false)">Uncheck all</button>
	<button id="xdel2" class="btn_fl" onclick="cfform('mf')" style="display:none">Delete selected</button-->
	<div style="float:right">
		<?php require(WGDIR.'pagelink.php'); // pagelink ?>
	</div>
</div>
<?php }
if(!empty($_SESSION['newentrymsg'])){ ?>
<script type="text/javascript" language="javascript">
	setTimeout("EHide('newemsg')",5000);
</script>
<?php }
$_SESSION['newentry']='';
$_SESSION['newentrymsg']='';
?>
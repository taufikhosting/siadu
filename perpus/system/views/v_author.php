<?php
$t=mysql_query("SELECT * FROM so_history WHERE status='1'");
if(mysql_num_rows($t)>0) $stocktaking=true;
else $stocktaking=false;

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
$sfa=Array('name','prefix');
foreach($sfa as $k=>$v){
	if($sortby==$v) $sf=true;
}
if($sf){
	$sfi=$sortby;
} else {
	$sfi="prefix"; $sortby="";
}
$sql="SELECT * FROM mstr_author ".$search." ORDER BY ".$sfi.$sm;
if($sf){
	if($sortmode!='1') $smode='1';
	else $smode='0';
}

// Queries:
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

// Paging:
$page_link=RLNK."bibliographic.php?tab=author";
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
$tablew='800px';
?>
<input type="hidden" id="redir" value="<?=str_replace("?","&",getCPageLink())?>"/>
<div style="width:<?=$tablew?>;margin-bottom:6px;margin-top:-25px;height:24px">
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
<?php if(!$stocktaking){?>
	<button class="btn_fl" title="Add new author" onclick="cfform('af')">
		<div class="bi_add">New author</div>
	</button>
<?php }} else {?>
	<button class="btn_fl" title="Show all author" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=author')">
		<div class="bi_arrow">All author</div>
	</button>
<?php } if(empty($_SESSION['newentry'])){?>
	<?php if(!$stocktaking){?>
	<button class="btn_fl" onclick="checkAll(true)">Check all</button>
	<button class="btn_fl" onclick="checkAll(false)">Uncheck all</button>
	<button id="xdel1" class="btn_fl" onclick="cfform('mf')" style="display:none">Delete selected</button>
<?php }}?>
	<form style="padding:0;margin:0" action="<?=RLNK?>bibliographic.php" method="get">
	<button class="btn" style="float:right;width:24px;margin:0" title="Search"><div class="bi_srcb">&nbsp;</div></button>
	<div style="float:right;margin-right:4px"><input type="hidden" name="tab" value="author"/>
		<?=iText('q','',"width:150px",'Search author name')?></div>
	</form>
</div>
<input type="hidden" id="pagelink" value="<?=(($page!='')?"&page=".$page:"")?><?=(($sortby!='')?"&sortby=".$sortby:"")?><?=(($smode!='')?"&mode=".$sortmode:"")?><?=(($keyw!='')?"&q=".$keyw:"")?>"/>
<?php if($ndata>0){?>
<table class="xtable" border="0" cellspacing="0" width="<?=$tablew?>">
	<tr>
		<td class="xtdh" width="1">
			<input type="checkbox" class="iCheck" id="xcek0" value="<?=$r['dcid']?>" onclick="checkAll(this.checked)"/>
		</td>
		<?=iThxp("Prefix",'prefix',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Name",'name',$page,$sortby,$smode,$keyw)?>
		<?php if(!$stocktaking){?><td class="xtdh" style="text-align:left">Options</td><?php }?>
	</tr>
<?php
$n=$nps; $rc=1; $k=1; $rh=$cover?'height="100px"':'';
while($r=dbFAx($t)){ if($n>=$nps && $n<$npl){ if($rc==0){$rc=1;}else{$rc=0;};
	?>
	<tr id="xrow<?=$r['dcid']?>" class="xxr<?=$rc?>" <?=$rh?>>
		<td width="1">
			<input type="checkbox" class="iCheck" id="xcek<?=$k?>" value="<?=$r['dcid']?>" onclick="checkRow(<?=$k?>,this.checked)"/>
		</td>
		<td width="80px" onclick="selectRow(<?=$k?>)"><?=src_replace($r['prefix'])?></td>
		<td width="*" onclick="selectRow(<?=$k?>)"><?=src_replace($r['name'])?></td>
		<?php if(!$stocktaking){?>
		<td width="55px" align="left">
			<?php echo optionbtn_edit("cfform('uf',".$r['dcid'].")"); echo optionbtn_del("cfform('df',".$r['dcid'].")",1); ?>
		</td>
		<?php }?>
	</tr>
<?php $k++;}$n++;} ?>
</table>
<input type="hidden" id="xnrow" value="<?=$k?>"/>
<input type="hidden" id="newentry" value="<?=(($opt=='u' || $opt=='a')?"xrow".$cid:"E")?>"/>

<div class="btnbar" style="width:<?=$tablew?>;margin-top:6px;display:<?=($ndata>10?'':'none')?>">
	<?php if(!$stocktaking){?>
	<button class="btn_fl" onclick="checkAll(true)">Check all</button>
	<button class="btn_fl" onclick="checkAll(false)">Uncheck all</button>
	<button id="xdel2" class="btn_fl" onclick="cfform('mf')" style="display:none">Delete selected</button>
	<?php }?>
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
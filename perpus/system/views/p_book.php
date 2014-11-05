<?php
$get=gets('get');
$cid=gets('getid');
$setview=gets('setview');
if($setview=='list'){
	$_SESSION['bookview']='list';
} else if($setview=='grid'){
	$_SESSION['bookview']='grid';
}
if($_SESSION['bookview']=='list'){ ?>
<button class="viewopt" style="background:url('<?=IMGR?>vw_grid.png') left center no-repeat;" onclick="jumpTo('<?=RLNK?>book.php?setview=grid')">Grid view</button>
<button class="viewopta" style="background:url('<?=IMGR?>vw_list.png') left center no-repeat;margin-left:20px" onclick="jumpTo('<?=RLNK?>book.php?setview=list')">List view</button>
<?php 
require_once(VWDIR.'p_book_list.php');
} else { ?>
<table cellspacing="0" cellpadding="0" border="0"><tr>
<td>
	<button class="viewopta" style="background:url('<?=IMGR?>vw_grid.png') left center no-repeat;" onclick="jumpTo('<?=RLNK?>book.php?setview=grid')">Grid view</button>
	<button class="viewopt" style="background:url('<?=IMGR?>vw_list.png') left center no-repeat;margin-left:20px" onclick="jumpTo('<?=RLNK?>book.php?setview=list')">List view</button>
</td>
<td>
	<table cellspacing="0" cellpadding="0"><tr>
	<?php if(gets('get')!=''){?>
	<td>
	<div style="height:16px;width:250px;border:none;padding:2px 0 0 24px;margin:0 4px 12px 0;font: 13px 'Segoe UI',Verdana;color:#999">
		<div style="float:left">Viewing books by :&nbsp;</div>
		<div style="color:#1c64d1"><?=dbFetch("name","mstr_author","W/`dcid`='".gets('getid')."'")?></div>
	</div>
	</td>
	<?php }?>
	<td>
	<div style="height:16px;width:200px;border:none;padding:2px 0 0 24px;margin:0 4px 12px 0;font: 13px 'Segoe UI',Verdana;color:#999">
		<div style="float:left">Sorted by :&nbsp;</div>
		<div style="color:#1c64d1;float:left;cursor:pointer;padding-right:16px;background:url('<?=IMGR?>dnarrow.png') right 4px no-repeat">newest</div>
	</div>
	</td>
	</tr></table>
</td>
</tr></table>
<?php
require_once(VWDIR.'p_book_grid.php');
}
?>
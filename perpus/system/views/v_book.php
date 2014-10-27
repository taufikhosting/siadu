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
<button class="viewopt" style="background:url('<?=IMGR?>vw_grid.png') left center no-repeat;" onclick="jumpTo('<?=RLNK?>bookshelf.php?setview=grid')">Grid view</button>
<button class="viewopta" style="background:url('<?=IMGR?>vw_list.png') left center no-repeat;margin-left:20px" onclick="jumpTo('<?=RLNK?>bookshelf.php?setview=list')">List view</button>
<?php 
require_once(VWDIR.'p_book_list.php');
} else { ?>
<script type="text/javascript" language="javascript">
var selbook=0;
var enhsm=false;
var enhrm=false;
function ffade(a,o){
	E(a).style.opacity=o;
	if(o<1.0){
		o+=0.1;
		setTimeout("ffade('"+a+"',"+o+")",20);
	}
}
function retDetail(a){
	_('pb_detail&cid='+a,function(r){E('book_info').innerHTML=r;ffade('book_info',0.3)});
	//E('book_info').style.opacity='1';
}
function getBookDetail(a){
	var cid=E('bookid').value;
	if(cid!=a){
	E('book_info').style.opacity='0.25';
	setTimeout("retDetail("+a+")",250);
	}
}
function showSortMenu(){
	EShow('sortmenu');
	E('xxx').focus();
}
function hideSortMenu(){
	if(enhsm){
		EHide('sortmenu');
	}
}
function showRowMenu(){
	EShow('rowmenu');
	E('yyy').focus();
}
function hideRowMenu(){
	if(enhrm){
		EHide('rowmenu');
	}
}
function selectBook(s,a){
	//E('cbook'+selbook).className='pf_photo';
	selbook=s;
	//E('cbook'+s).className='pf_photo2';
	getBookDetail(a);
}
</script>
<?php
require_once(VWDIR.'v_book_grid.php');
}
?>
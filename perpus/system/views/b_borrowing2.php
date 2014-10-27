<?php
/** Global Variables */

/* Pre Data Processing */
$mtype=gets('mtype');
$mid=gets('mid');

if($mtype=='m'){
	$sql="SELECT * FROM catalog ".$filt." ORDER BY title";
	$mmt="student name or NIS";
} else {
	$sql="SELECT * FROM `joshr`.`employee` WHERE `name` LIKE '%$mid%' OR `nip` LIKE '$mid%'";
	$mmt="staff name or NIP";
}
$tpf=mysql_query($sql);
$npf=mysql_num_rows($tpf);

$txtWidth="width:344px";

/*<td><input type="button" class="findbtn" title="Search" onclick="ri_emp('find')"/></td>*/
?>
<script type="text/javascript">
function lookUp(){
	var v="&mtype="+E('mtype').value;
		v+="&mid="+E('mid').value;
	_("ri_member&opt=lookup"+v,function(r){
		E('emp_result').innerHTML=r;
		if(parseInt(E('ri_emp_num').value)!=0){
			E('ri_next1').style.display='';
		} else {
			E('ri_next1').style.display='none';
		}
	});
}
function ri_emp_cek(e){
    if (e.keyCode == 13) {
        ri_emp('find');
    }
}

function gotoProgress(a){
	for(var i=1;i<=2;i++){
		E('prog'+i).style.display='none';
		E('ps'+i+'a').className='ptracknumber0';
		E('ps'+i+'b').className='ptracktext0';
	}
	E('prog'+a).style.display='';
	E('ps'+a+'a').className='ptracknumber';
	E('ps'+a+'b').className='ptracktext';
}
function checkAll(a){
	var n=parseInt(E('ri_emp_num').value);
	for(var i=1;i<=n;i++){
		E('ri_emp'+i).checked=a;
	}
	selCheck();
}
function selCheck(){
	var n=parseInt(E('ri_emp_num').value);
	var k=0; var ids="0";
	for(var i=1;i<=n;i++){
		if(E('ri_emp'+i).checked)k++;
		ids+=E('ri_emp'+i).checked?"-"+E('ri_emp'+i).value:"";
	}
	if(k==0){
		E('ri_next1').style.display='none';
	} else {
		E('ri_next1').style.display='';
	}
	if(n>1){
		E('ri_emp0').checked=(k==n);
	}
	E('ri_emp_ids').value=ids;
}
function gotoStep(a){
	if(a==1){
		E('prog2').style.display='none';
		E('prog1').style.display='';
		E('ps1a').className='ptracknumber';
		E('ps1b').className='ptracktext';
		E('ps2a').className='ptracknumber0';
		E('ps2b').className='ptracktext0';
	} else {
		E('ps1a').className='ptracknumber0';
		E('ps1b').className='ptracktext0';
		E('ps2a').className='ptracknumber';
		E('ps2b').className='ptracktext';
		E('prog2').style.display='';
		E('prog1').style.display='none';
	}
}
function dpCheck(){
	var dp="0";
	for(var i=1;i<=9;i++){
		dp+=E('dp'+i).checked?"-1":"-0";
	}
	E('dps').value=dp;
}
function getForm(o,v){
	_("pb_dynform2&opt="+o+"&v="+v,function(r){
		E(o).innerHTML=r;
	});
}
function doSumbitForm(){
	E('rauthor').value=E('author').value;
	E('rpublisher').value=E('publisher').value;
	E('rlanguage').value=E('language').value;
	//alert('yay');
	document.ri_form.submit();
}
function changeType(a){
	if(a=='m'){
		E('midlabel').innerHTML='Name or NIS';
	}
	else if(a=='s'){
		E('midlabel').innerHTML='Name or NIP';
	}
	else if(a=='o'){
		E('midlabel').innerHTML='Name or member ID';
	}
}
</script>
<div style="padding:10px 0 10px 0">
<table id="prog_track" cellspacing="5px" cellpadding="0"><tr>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps1a" class="ptracknumber0" align="center">1</td>
		<td id="ps1b" class="ptracktext0">Select<br/>member</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber" align="center">2</td>
		<td id="ps2b" class="ptracktext">Choose<br/>books</td>
	</tr></table>
	</div>
</td>
</tr></table>
</div>
<div style="width:600px;height:400px">
	<table cellspacing="0" cellpadding="0" width="850px" style="margin-bottom:2px"><tr height="30px">
	<td>
		<button class="btn" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog')" style="margin-right:4px">
			<div style="background:url('<?=IMGR?>larrow.png') no-repeat;padding-left:16px">Back</div>
		</button><button class="btn" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=add&nid=<?=$r['dcid']?>')">
			Add Book
		</button>
	</td>
	</tr></table>
	<input type="hidden" id="pagelink" value="<?=(($page!='')?"&page=".$page:"")?><?=(($sortby!='')?"&sortby=".$sortby:"")?><?=(($smode!='')?"&mode=".$sortmode:"")?><?=(($keyw!='')?"&q=".$keyw:"")?>"/>
	<?php if($ndata>0){?>
	<table class="stable2" cellspacing="0" cellpadding="5px" width="600px" style="margin-top:10px">
	<tr valign="top" style="height:110px">
		<td width="60px">
			<img src="<?=IMGC.($rc['cover']==''?"nocover.jpg":$rc['cover'])?>" width="60px"/>
		</td>
		<td style="padding-left:10px">
			<div style="font-size:16px"><b><?=str_replace("\'","'",$rc['title'])?></b></div>
			<div>by <a class="linkl11" style="font:12px 'Segoe UI',Verdana,Arial" target="_blank" href="<?=RLNK?>book.php?get=author&getid=<?=$rc['author']?>" title="View all book by <?=$author?>"><?=$author?></a></div>
			<div style="margin-top:10px">Call number: <strong><?=$rc['callnumber']?></strong></div>
		</td>
	</tr>
	</table>
	<table class="xtable" border="0" cellspacing="1px" width="600px">
		<tr>
			<td class="xtdh" style="text-align:center">No.</td>
			<?=iThxp("Barcode",'barcode',$page,$sortby,$smode,$keyw)?>
			<?=iThxp("Availability",'available',$page,$sortby,$smode,$keyw)?>
			<td class="xtdh">Borrowed by</td>
			<td class="xtdh" style="text-align:center">Options</td>
		</tr>
	<?php
	$n=0; $rc=1; //$p=Array('title','type','host','place','date1','date2','speaker','participant');
	while($r=mysql_fetch_array($t)){ if($n>=$nps && $n<$npl){ if($rc==0){$rc=1;}else{$rc=0;}; $date1=ftgl($r['date1']); $date2=ftgl($r['date2']);
		?>
		<tr id="p_train<?=$r['dcid']?>" class="xxr<?=$rc?>">
			<td width="30px" align="center"><?=(++$n)?></td>
			<td width="*"><?=$r['barcode']?></td>
			<td width="120px"><?=($r['available']=='Y'?"Available":"Borrowed")?></td>
			<td width="200px"><?=($r['brid']==0?"-":"")?></td>
			<td width="75px" align="center">
				<?php if($r['available']=='Y'){?>
				<button class="btnx" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=add&nid=<?=$r['dcid']?>')">Borrow</button>
				<?php }else{?>
				<button class="btnz" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=add&nid=<?=$r['dcid']?>')">Return</button>
				<?php }?>
			</td>
		</tr>
	<?php } $n++; } ?>
	</table>
	<input type="hidden" id="newentry" value="<?=(($opt=='u' || $opt=='a')?"p_train".$cid:"E")?>"/>
	<div style="margin-top:2px;width:700px;margin-bottom:20px">
	<table cellspacing="0" cellpadding="0" align="right"><tr height="30px">
	<td width="60px"><?php if($nop>1){?><span class="sfont">Pages:</span><?php }?></td>
	<td align="right">
		<?php
		if($nop>1){?>
		<table cellspacing="4px" cellpadding="0" style="margin-top:2px"><tr>
			<td><a class="plink<?=(($page>1)?"\" title=\"Go to previous page\" href=\"".pageLinkp($page-1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> < </a></td>
			<?php for($n=1;$n<=$nop;$n++){ ?>
			<td><a class="plink<?=(($n!=$page)?"\" title=\"Go to page $n\" href=\"".pageLinkp($n,gets('sortby'),gets('mode'),gets('q')):"a")?>"><?=$n;?></a></td>
			<?php }?>
			<td><a class="plink<?=(($page<$nop)?"\" title=\"Go to next page\" href=\"".pageLinkp($page+1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> > </a></td>
		</tr></table>
		<?php }?>
	</td>
	</tr></table></div>
	<?php }?>
</div>
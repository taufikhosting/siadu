<?php
$mid=gets('mid');
$sql="SELECT * FROM joshr.employee WHERE `nip`='$mid' LIMIT 0,1";
//echo $sql;
$t=dbQsql($sql);
$ndata=dbNRow($t);
$mtype='';
if($ndata>0) $mtype='s';
if($mtype!=''){
$r=dbFAx($t);
if($mtype=='s'){ ?>
<style type="text/css">
#pf_photo {
	border:4px solid #ffffff;
	width:60px;
	box-shadow: 0px 2px 5px rgba(0, 0, 0, .25);
}
.mem_info tr td{
	font:12px 'Segoe UI',Verdana,Tahoma;
	color:#444;
}
.mem_info tr{
	height:20px;
}
</style>
<script type="text/javascript" language="javascript">
function getBookLookup(){
	var keyw=E('keyw').value;
	_('b_loan&opt=avlist&q='+keyw,function(r){
		E('bookshelf').innerHTML=r;
	});
}
function getBookShelf(o){
	_('b_loan&opt='+o,function(r){
		E('bookshelf').innerHTML=r;
	});
}
function showBookNotif(a){
	E('booknotif').innerHTML=a;
	setTimeout("E('booknotif').innerHTML='&nbsp;'",2000);
}
function getBook(code){
	_('b_loan&opt=getbook&code='+code,function(r){
		if(r.length<100){
			showBookNotif(r+' does match with any book barcode.');
		} else {
			var a=-1;
			for(var i=0;i<10;i++){
				if(E('loanlist'+i).style.display=='none'){
					a=i; break;
				}
			}
			if(a!=-1){
				E('loanlist'+a).innerHTML=r;
				E('loanlist'+a).style.display='';
			}
		}
		E('bookid').focus();
	});
}
function enterBookcode(e){
	if(e.keyCode==13){
		var cd=E('bookid').value;
		if(cd!=''){
			getBook(cd);
		}
	}
}
function clickBookCode(){
	var cd=E('bookid').value;
	if(cd!=''){
		getBook(cd);
	} else {
		E('bookid').focus();
	}
}
$("document").ready(function(){
	getBookShelf('avlist');
	E('bookid').focus();
});
</script>
<div style="font:15px 'Segoe UI', Verdana, Tahoma;color:#1c64d1;margin-bottom:6px">In transaction with:</div>
<table class="stable" cellspacing="0" cellpadding="4px" width="100%" style="" border="0"><tr valign="top" height="130px">
	<td width="70px" align="center" style="padding-top:10px">
		<?php 
		$sql="SELECT * FROM joshr.emp_photo WHERE empid='".$r['dcid']."'";
		$np=mysql_num_rows(mysql_query($sql));
		if($np>0){ ?>
			<div id="pf_photo"><img src="<?=HRD_RLNK?>photo.php?id=<?=$r['dcid']?>" width="60px"/></div><br/>
		<?php } else {?>
			<div id="pf_photo"><img src="<?=HRD_IMGR?>nophoto.png" width="60px"/></div><br/>
		<?php } ?>
	</td>
	<td style="padding-top:10px">
		<table class="mem_info" cellspacing="0" cellpadding="0" style="margin-left:8px;">
			<tr><td colspan="2" style="padding-bottom:4px"><span style="font-size:14px"><b><?=($r['gender']=='Male'?"Mr. ":"Mrs. ").$r['name']?></b></span></td></tr>
			<tr><td width="100px">Member ID</td><td>: <strong><?=$r['nip']?></strong></td></tr>
			<tr><td>Member type</td><td>: Staff</td></tr>
			<tr><td>Current loan</td><td>: <?php
				$tb=mysql_query("SELECT * FROM `loan` WHERE `brid`='$mid'");
				$ndata=mysql_num_rows($tb);
				echo $ndata." book".($ndata>1?"s":"");
			?></td></tr>
			<!--tr>
				<td colspan="2" style="padding-top:10px">
				<input class="btnx" type="button" value="Borrow" style="width:65px"/>
				<input class="btnz" type="button" value="Return" style="width:65px"/>
				</td>
			</tr-->
		</table>
	</td>
	<td rowspan="2" width="600px">
		<div class="pfsub" style="margin-top:0">or find available in book shelf: <?=iText('keyw','',"width:320px;margin-left:20px",'title or id number','onkeyup="getBookLookup()"')?>
		<input type="button" class="find21" />
		</div>
		<div id="bookshelf" style="height:700;overflow:auto">
		</div>
	</td>
</tr>
<tr valign="top">
<td colspan="2">
	<div class="pfsub">Enter book barcode number: &nbsp;<?=iText('bookid','',"margin-left:12px;width:210px;height:24px",'','onkeyup="enterBookcode(event)"')?>
		<input type="button" class="btn" value="Borrow" onclick="clickBookCode()"/>
	</div>
	<div id="booknotif" style="padding:2px;<?=SFONT12?>;color:#999">&nbsp;</div>
	<?php $brid=$r['nip']; require_once(VWDIR.'b_loan_list.php');?>
</td>
</tr>
</table>

<?php }} else if($mid!=''){ ?>
<div class="pdiv"><strong><?=$mid?></strong> is not a valid member ID.<br/> Please enter another member id to begin transaction with:</div>
<form action="<?=RLNK?>loan.php" method="get" style="padding:0;margin:0">
<table class="stable" cellspacing="0" cellpadding="0"><tr>
	<td><?=iText('mid','','width:200px;height:24px','member id')?></td>
	<td>
		<input id="btnstart" type="submit" class="btnx" value="Start" style="margin-left:5px"/>
	</td>
</tr></table>
</form>
<?php } else { ?>
<form action="<?=RLNK?>loan.php" method="get" style="padding:0;margin:0">
<table class="stable" cellspacing="0" cellpadding="0"><tr>
	<td width="150px">Begin transaction with:</td>
	<td><?=iText('mid','','width:200px;height:24px','member id')?></td>
	<td>
		<input id="btnstart" type="submit" class="btnx" value="Start" style="margin-left:5px"/>
	</td>
</tr></table>
</form>
<?php }?>
<?php
/* Global Variables */

/* Pre Data Processing */
$dcid=gets('nid');

require_once(SYDIR.'ptrack.php');
						
$txtWidth="width:344px";

/*<td><input type="button" class="findbtn" title="Search" onclick="ri_emp('find')"/></td>*/
?>
<script type="text/javascript">
function lookUp(){
	var k=E('keyw').value;
	k=k.trim();
	if(k!=''){
	_("a_label&opt=lookup&k="+k,function(r){
		E('emp_result').innerHTML=r;
	});
	}
}
function elookUp(e){
	if (e.keyCode == 13) {
        lookUp();
    }
}
function pqueue(o,k){
	var v="";
	if(o=='aq'){
	var a=k.split("~");
		v="&cid="+a[0];
		v+="&ctt="+a[1];
		v+="&bcd="+a[2];
	} else {
		v="&cid="+k;
	}
	v="a_label&opt="+o+v;
	_(v,function(r){
		if(r.substr(0,13)!='<span></span>'){
		E('qtbl').innerHTML=r;
		var n=E('qtrn').value;
		E('pqq').innerHTML=parseInt(n)>1?n+' labels':n+' label';
		//if(parseInt(n)==50) 
		if(parseInt(n)>0){
			EShow('cqbtn');
		} else EHide('cqbtn');
		lookUp();
		} else {
			E('pqq').innerHTML='<span style="color:#ff0000">'+E('pqq').innerHTML+'</span>';
			alert('Maximum print queue is 50 labels');
		}
	});
}
function addAlltoQueue(){
	var a=E('bliss').innerHTML;
	//var b=a.split('^');
	//for(var i=1;i<b.length;i++){
	pqueue('bq',a);
	//}
}
function clearQueue(){
	pqueue('cq',0);
}
function sendHeader(){
	var v="&title="+E('title').value;
		v+="&description="+E('description').value;
	_("a_label&opt=sethead"+v,function(r){
		E('sh1').style.display='none';
		E('sh2').innerHTML=r;
		E('sh2').style.display='';
		setTimeout("E('sh2').style.display='none';E('sh0').style.display='';",2000);
	});
}
function setHeader(){
	E('sh0').style.display='none';
	E('sh1').style.display='';
	setTimeout("sendHeader()",250);
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
function getForm(o,v){
	_("pb_dynform2&opt="+o+"&v="+v,function(r){
		E(o).innerHTML=r;
	});
}
function doSumbitForm(){
	E('rauthor').value=E('author').value;
	E('rpublisher').value=E('publisher').value;
	E('rlanguage').value=E('language').value;
	E('rtitle').value=E('title').value;
	E('rdesc').value=E('description').value;
	//alert('yay');
	document.ri_form.submit();
}
</script>
<div style="padding:10px 0 10px 0;margin-bottom:20px">
<table id="prog_track" cellspacing="5px" cellpadding="0"><tr>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps1a" class="ptracknumber" align="center">1</td>
		<td id="ps1b" class="ptracktext">Select<br/>books</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber0" align="center">2</td>
		<td id="ps2b" class="ptracktext0">Select information & <br/>generate label</td>
	</tr></table>
	</div>
</td>
</tr></table>
</div>
<div style="position:relative;width:900px;height:400px">
	<div id="prog1" style="padding-left:10px;display:">
		<table class="stable" cellspacing="0" cellpadding="0" border="0"><tr valign="top" height="380px">
			<td width="430px">
				<div class="hl2">Find book with...</div>
				<table class="stable" cellspacing="0" cellpadding="0" border="0" width="430px"><tr>
					<td width="*">barcode or title:</td>
					<td width="270px"><?=iText('keyw','','width:260px','','onkeyup="elookUp(event)"')?></td>
					<td width="24px" align="left"><input title="find" type="button" class="find21" onclick="lookUp()"/></td>
				</tr>
				<tr>
					<td></td><td  width="270px" style="padding-top:2px;font:11px <?=SFONT?>;color:#aaa">Use numeric characters to find barcode or alphanumeric to find title. Use barcode range, for example 0024-0030.</td><td></td>
				</tr>
				</table>
				<div id="emp_result" style="420px;margin-top:20px">
					<?php require_once(VWDIR.'vi_loan.php');?>
				</div>
			</td>
			<td style="padding-left:30px" width="400px">
				<table cellspacing="0" cellpadding="0" width="360px"><tr>
				<td width="90px"><div class="hl2">Print queue:</div></td><td><span style="font-size:12px" id="pqq">0</span> <span style="color:<?=CLGREY?>">(50 max)</span></td>
				<td align="right"><a id="cqbtn" class="linkb" href="javascript:clearQueue()" style="display:none">Clear all</a></td>
				</tr></table>
				<div style="height:360px;width:400px;overflow:auto">
				<table id="qtbl" class="stable" border="0" cellspacing="0" width="360px" style="margin-top:10px">
				</table>
				</div>
			</td>
		</tr>
		</table>
		<div class="pfsub" style="border-top:1px solid #eaeaea;margin-top:20px"></div>
		<table id="prog2btntbl" class="stable" cellspacing="0" cellpadding="0" style="width:430px;margin-top:10px"><tr>
		<td align=""><button id="ri_next1" class="btnx" onclick="gotoStep(2)" style="padding:0 10px"> Next </button></td>
		<td><button style="display:none" class="btn" onclick="jumpTo('<?=RLNK?>report.php')">Back</button></td>
		</td></tr></table>
	</div>
	<div id="prog2" style="padding-left:10px;display:none">
	<form action="<?=RLNK?>printlabel.php" target="_blank" method="post">
		<table class="stable" cellspacing="0" cellpadding="0"><tr valign="top" height="380px">
			<td style="padding-right:10px" width="400px">
				<div class="hl2">Set label header...</div>
				<?php
					$dT=dbFetch("val","mstr_setting","W/`kiy`='htitle'");
					$dD=dbFetch("val","mstr_setting","W/`kiy`='hdesc'");
				?>
				<table class="stable" cellspacing="0" cellpadding="0" style="margin-top:10px">
					<tr height="30px">
						<td width="80px">Title:</td><td><?=iText('title',$dT,'width:320px')?></td>
					</tr>
					<tr height="30px">
					<td>Description:</td><td><?=iText('description',$dD,'width:320px')?></td>
					<tr height="36px"><td colspan="2" align="right">
						<div id="sh2" style="padding:2px;font:11px 'Segoe UI',Verdana,Tahoma;color:#999;display:none">
							Header has been set as default.
						</div>
						<div id="sh1" style="padding:2px;display:none;margin-right:40px">
							<img src="<?=IMGR?>sload.gif"/>
						</div>
						<div id="sh0" style="padding:2px;">
						<a id="btn_specific" class="linkb" href="javascript:setHeader()">Set as default header...</a>
						</div>
					</td>
				</tr></table>
				<div class="hl2" style="border-top:1px solid #eaeaea;padding-top:15px;margin-top:10px;margin-bottom:10px">Select informations to be printed:</div>
				<table class="stable24" cellspacing="0" cellpadding="0"><?php $l=1;?>
					<tr><td width="24px"><input name="plhead" checked id="dp<?=($l)?>" class="iCheck" type="checkbox" value="Y"/></td><td><label for="dp<?=$l++?>">Header</label></td></tr>
					<tr><td width="24px"><input name="plcnum" checked id="dp<?=($l)?>" class="iCheck" type="checkbox" value="Y"/></td><td><label for="dp<?=$l++?>">Call number</label></td></tr>
					<tr><td width="24px"><input name="plbcode" checked id="dp<?=($l)?>" class="iCheck" type="checkbox" value="Y"/></td><td><label for="dp<?=$l++?>">Barcode</label></td></tr>
				</table>
			</td>
			<td style="padding-left:30px">
				<div class="pfsub" style="padding-top:15px;margin-top:10px;">Print Setup:</div>
				<table class="stable" cellspacing="0" cellpadding="0"><?php $l=1;?>
					<tr height="30px"><td width="120px">Label width:</td><td><?=iText('lwidth',6,"width:30px;text-align:center;height:21px",'','oblur="cekLwidth()"')?> cm</td></tr>
					<tr height="30px"><td width="120px">Paper size:</td><td><?=iSelect('psize',Array('F4'=>'F4 &nbsp; 210x330mm','A4'=>'A4 &nbsp; 210x297mm','A5'=>'A5 &nbsp; 148x210mm'))?></td></tr>
					<tr height="30px"><td width="120px">Paper orientation:</td><td>
						<table cellspacing="0" cellpadding="0"><tr>
							<td width="20px"><input id="po1" type="radio" name="pori" checked value="P" class="iCheck"/></td><td width="60px"><label for="po1">Potrait</label></td>
							<td width="20px"><input id="po2" type="radio" name="pori" value="L" class="iCheck"/></td><td><label for="po2">Landscape</label></td>
						</tr></table>
					</td></tr>
				</table>
			</td>
		</tr>
		</table>
		<div class="pfsub" style="border-top:1px solid #eaeaea;margin-top:20px"></div>
		<table id="prog2btntbl" class="stable" cellspacing="0" cellpadding="0" style="width:400px;margin-top:10px"><tr>
		<td><input type="button" class="btn" onclick="gotoStep(1)" value="Back"/></td>
		<td align="right"><input type="submit" id="ri_next1" class="btnx" style="padding:0 10px" value="Generate label"/></td>
		</td></tr></table>
	</form>
	</div>
</div>
<script type="text/javascript" language="javascript">
$('document').ready(function(){
	 E('keyw').focus();
	 pqueue('cq',0);
});
</script>
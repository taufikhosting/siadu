<?php
// Reminder Status
$nr_document=0;
$t0=mysql_query("SELECT emp_document.*,mstr_document.name as docname,mstr_document.reminder as batas,employee.name,employee.nip FROM emp_document LEFT JOIN employee ON employee.dcid=emp_document.empid LEFT JOIN mstr_document ON mstr_document.dcid=emp_document.docid");
$n=0; $rt=0; $rc=1; //$p=Array('name','nip','status','level','group','division','position');
while($r=mysql_fetch_array($t0)){
	$batas=$r['batas'];
	$tglhabis=$r['date2'];
	$sisa=diffDay($tglhabis);
	if($sisa<=$batas){
		$nr_document++;
	}
}

if($nr_document>0){
?>
<div style="width:938px;border:1px solid #ffa200;margin-bottom:20px;border-radius:5px">
<div class="sfont" style="width:930px;background:#ffa200;padding:4px 4px;font-size:13px;color:#fff">
<b>Reminder: Validity of employee's document listed below will be over</b>
</div>
<div style="width:918px;padding:10px;background:#fff6f0;border-radius:0px 0px 5px 5px">
<table class="xtable" border="0" cellspacing="1px" width="918px">
	<tr>
		<td class="xtdh" style="text-align:center">No</td>
		<td class="xth"><button class="xlink">Name</button></td>
		<td class="xth"><button class="xlink">NIP</button></td>
		<td class="xth"><button class="xlink">Document name</button></td>
		<td class="xth"><button class="xlink">Date Over</button></td>
	</tr>
<?php
$t0=mysql_query("SELECT emp_document.*,mstr_document.name as docname,mstr_document.reminder as batas,employee.name,employee.nip FROM emp_document LEFT JOIN employee ON employee.dcid=emp_document.empid LEFT JOIN mstr_document ON mstr_document.dcid=emp_document.docid");
$n=0; $rt=0; $rc=1;
while($r=mysql_fetch_array($t0)){	
	$batas=$r['batas'];
	$tglhabis=$r['date2'];
	$sisa=diffDay($tglhabis);
	if($sisa<=$batas){
	?>
	<tr id="p_employee<?=$r['empid']?>" class="xr<?=$rc?>">
		<td width="30px" align="center"><?=($n+1)?></td>
		<td <?=rLink($r['empid'])?>width="*"><?=src_replace($r['name'])." ".$batas?></td>
		<td <?=rLink($r['empid'])?>width="200px"><?=src_replace($r['nip'])?></td>
		<td <?=rLink($r['empid'])?>width="200px" ><?=$r['docname']?></td>
		<td <?=rLink($r['empid'])?>width="250px" ><?=fftgl($tglhabis)." (".$sisa." day".($sisa>1?"s":"")." remaining)"?></td>
	</tr>
<?php } $n++; } ?>
</table>
</div>
</div>
<?php } ?>
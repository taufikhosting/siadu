<?php
// Reminder Status
$nr_status=0;
$t0=mysql_query("SELECT * FROM employee");
$n=0; $rt=0; $rc=1; //$p=Array('name','nip','status','level','group','division','position');
while($r=mysql_fetch_array($t0)){
	// 1. Status reminder get employee status
	$t1=mysql_query("SELECT * FROM emp_status WHERE empid='".$r['dcid']."' AND active='Y' LIMIT 0,1");
	if(mysql_num_rows($t1)>0){
		$status=mysql_fetch_array($t1);
		$tglmulai=$status['date1'];
		$tglhabis=$status['date2'];
		$idstatus=$status['status'];
		
	// 2. Get status reminder setup
		$t2=mysql_query("SELECT * FROM mstr_status WHERE dcid='$idstatus'");
		$rem=mysql_fetch_array($t2);
		$reminder=$rem['reminder'];
		// $tglreminder=date("Y-m-d",strtotime("-".$reminder." day"));

	// 3. Hitung selisih hari
		// $diff=diffDay($tglhabis,$tglreminder);
		$sisa=diffDay($tglhabis);
	
	// 4. Cek apakah mau habis?
		if($sisa<=$reminder){
			$nr_status++;
		}
	}
}

if($nr_status>0){
?>
<div style="width:938px;border:1px solid #ffa200;margin-bottom:20px;border-radius:5px">
<div class="sfont" style="width:930px;background:#ffa200;padding:4px 4px;font-size:13px;color:#fff">
<b>Reminder: Status of employee listed below will be over</b>
</div>
<div style="width:918px;padding:10px;background:#fff6f0;border-radius:0px 0px 5px 5px">
<table class="xtable" border="0" cellspacing="1px" width="918px">
	<tr>
		<td class="xtdh" style="text-align:center">No</td>
		<td class="xth"><button class="xlink">Name</button></td>
		<td class="xth"><button class="xlink">NIP</button></td>
		<td class="xth"><button class="xlink">Status</button></td>
		<td class="xth"><button class="xlink">Date Over</button></td>
	</tr>
<?php
$t0=mysql_query("SELECT * FROM employee");

$n=0; $rt=0; $rc=1; //$p=Array('name','nip','status','level','group','division','position');
while($r=mysql_fetch_array($t0)){ if($n>=$nps && $n<$npl){ $rt++; if($rc==0){$rc=1;}else{$rc=0;}; $date1=ftgl($r['date1']); $date2=ftgl($r['date2']);
	// 1. Status reminder get employee status
	$t1=mysql_query("SELECT * FROM emp_status WHERE empid='".$r['dcid']."' AND active='Y' LIMIT 0,1");
	if(mysql_num_rows($t1)>0){
		$status=mysql_fetch_array($t1);
		$tglmulai=$status['date1'];
		$tglhabis=$status['date2'];
		$idstatus=$status['status'];
		
	// 2. Get status reminder setup
		$t2=mysql_query("SELECT * FROM mstr_status WHERE dcid='$idstatus'");
		$rem=mysql_fetch_array($t2);
		$reminder=$rem['reminder'];
		// $tglreminder=date("Y-m-d",strtotime("-".$reminder." day"));

	// 3. Hitung selisih hari
		// $diff=diffDay($tglhabis,$tglreminder);
		$sisa=diffDay($tglhabis);
	
	// 4. Cek apakah mau habis?
	if($sisa<=$reminder){
	?>
	<tr id="p_employee<?=$r['dcid']?>" class="xr<?=$rc?>">
		<td width="30px" align="center"><?=($n+1)?></td>
		<td <?=rLink($r['dcid'])?>width="*"><?=src_replace($r['name'])." ".$reminder?></td>
		<td <?=rLink($r['dcid'])?>width="200px"><?=src_replace($r['nip'])?></td>
		<td <?=rLink($r['dcid'])?>width="200px" ><?=$mstr_status[$r['status']]?></td>
		<td <?=rLink($r['dcid'])?>width="250px" ><?=fftgl($tglhabis)." (".$sisa." day".($sisa>1?"s":"")." remaining)"?></td>
	</tr>
<?php } } } $n++; } ?>
</table>
</div>
</div>
<?php } ?>
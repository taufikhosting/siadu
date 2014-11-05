<?php
$t=dbSel("*","so_history","W/status='1' OR status='2' LIMIT 0,1");
$nso=dbNRow($t);
?>
<div class="hl2" style="font-size:16px;margin-bottom:10px;padding-top:20px;">Initialize stock take</div>
<?php if($nso==0){
?>
<div class="sfont" style="line-height:200%;width:600px;margin-bottom:10px">This application wil guide you through stock take process. Once you initialize a stock take process you may not to initialize another process until current process are finished.</div>
<input type="button" class="btnx" value="Start new stock take" onclick="jumpTo('<?=RLNK?>stockopname.php?tab=init')"/>
<?php }else{
$r=dbFA($t); $tt=Array('1'=>'cek','2'=>'note','3'=>'finish');?>
<div class="sfont" style="line-height:200%;width:600px;margin-bottom:10px">Current stock take process <b>"<?=$r['name']?>"</b> is not finish yet.</div>
<input type="button" class="btnz" value="Continue current stock take" onclick="jumpTo('<?=RLNK?>stockopname.php?tab=<?=$tt[$r['status']]?>')"/>
<?php }?>

<div class="hl2" style="font-size:16px;margin-bottom:10px;margin-top:30px;padding-top:20px;">Stock opname history</div>
<div class="sfont" style="line-height:200%;width:800px;margin-bottom:10px">Review finished stock take.</div>
<input type="button" class="btn" value="View history" onclick="jumpTo('<?=RLNK?>stockopname.php?tab=history')"/>
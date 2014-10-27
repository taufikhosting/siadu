<?php
$nid=getsx('nid');
$t=mysql_query("SELECT * FROM ".DB_HRD." WHERE nip='$nid' LIMIT 0,1");
$f=dbFAx($t);
$member=$f['nip']; $membername=$r['fname'];
?>
<div class="hl2" style="margin-bottom:6px">Member who wants to return book:</div>
<?php
	require_once(VWDIR.'v_cir_staff_info.php');
	require_once(VWDIR.'v_cir_staff_list.php');
?>
</div>
<script type="text/javascript" language="javascript">
<?php if($act=='loan'){?>
$('document').ready(function(){
	 pqueue('cq',0);
	 E('keyw').focus();
});
<?php }?>
</script>
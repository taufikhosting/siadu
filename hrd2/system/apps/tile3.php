<?php $tw=155; ?>
<div class="tilebox" style="width:<?=($tw+48)?>px;top:286px;left:0px">
	<a id="tile<?=$tilecount++?>" href="#&<?=$p['key']?>" onclick="PCBCODE=2;openPage(<?=$t?>,'<?=$p['key']?>',false)" class="tile" style="background:url('<?=IMGR?>stats.png') center 20px no-repeat <?=$p['color']?>;width:<?=$tw?>px">
		<div class="tiletitle2"><?=$p['title']?></div>
	</a>
</div>
<?php $tw=155; ?>
<div class="tilebox" style="width:<?=($tw+48)?>px;top:143px;left:0px">
	<a id="tile<?=$tilecount++?>" href="#&<?=$p['key']?>" onclick="openPage(<?=$t?>,'<?=$p['key']?>',true)" class="tile" style="background:url('<?=IMGR.$p['icon']?>') 20px 18px no-repeat <?=$p['color']?>;width:<?=$tw?>px">
		<div style="margin-left:40px">
		<div class="tiletitle"><?=$p['title']?></div>
		<div class="tiledesc"><?=$p['desc']?></div>
		</div>
	</a>
</div>
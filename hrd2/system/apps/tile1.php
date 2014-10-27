<?php $tw=325; $th=223; ?>
<style type="text/css">
.tile1{
	padding:15px 20px 40px 20px;
	color:#fff;
	margin:4px;
	display:block;
	text-decoration:none;
	height:<?=$th?>px !important
}
.tilebox1{
	position:absolute;
	height:<?=($th+63)?>px !important
}
.tile1:hover{
	box-shadow:0px 0px 6px rgba(0,0,0,0.75);
	margin:3px;
	border:1px solid #fff;
}
</style>
<div class="tilebox1" style="width:<?=($tw+48)?>px;top:143px;left:203px">
	<a id="tile<?=$tilecount++?>" class="tile1" style="cursor:default;background:url('<?=IMGR.$p['icon']?>') 20px 16px no-repeat <?=$p['color']?>;width:<?=$tw?>px;">
		<div style="margin-left:40px">
		<div class="tiletitle" style="width:100%"><?=$p['title']?></div>
		<div class="tiledesc">Tidak ada catatan.</div>
		</div>
	</a>
</div>
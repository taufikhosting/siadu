<?php 
	$r['ntable']=getsx('lst');
	$t=mysql_query("SELECT * FROM `".$r['ntable']."cek`"); $i=0;
	$cn=mysql_num_rows($t);
	$an=strval($cn);
	if(strlen($an)<10){
		for($i=strlen($an);$i<5;$i++){
			echo "0";
		}
	}
	echo $cn;
	$k=0;
	while($f=dbFA($t)){ $k++;?>
	<div id="box<?=$k?>" class="box1"><?=$f['barcode']?></div>
<?php }
	$t=mysql_query("SELECT * FROM `".$r['ntable']."` WHERE cek='N'"); $i=0;
	while($f=dbFA($t)){?>
	<div class="box0"><?=$f['barcode']?></div>
<?php }?>
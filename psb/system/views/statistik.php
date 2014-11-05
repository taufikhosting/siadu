<?php
require_once(MODDIR.'control.php');
$opt=gpost('opt');

// departemen >>
$dept=gpost('departemen');
$departemen=departemen_r($dept);
if($ADMIN_DEPT!=0)$dept=$ADMIN_DEPT;

$optcari=Array('agama'=>'Agama','kelamin'=>'Jenis kelamin','kelompok'=>'Kelompok','periode'=>'Periode');
$ocari=gpost('optcari');
if($ocari=='')$ocari='agama';
?>
<div class="tbltopbar" style="width:100%">
<div class="sfont" style="margin-top:4px;margin-right:10px;float:left"><b>Departemen:</b></div>
<?php if($ADMIN_DEPT==0){?>
<?=iSelect('departemen',$departemen,$dept,'float:left;margin-right:40px','statistik_get()')?>
<?php } else {?>
<div class="sfont" style="margin-top:4px;margin-right:40px;float:left"><b><?=departemen_name($dept)?></b></div>
<input type="hidden" id="departemen" value="<?=$dept?>"/>
<?php }?>
<div class="sfont" style="margin-top:4px;margin-right:10px;float:left"><b>Tampilkan berdasarkan:</b></div>
<?=iSelect('optcari',$optcari,$ocari,'float:left;margin-right:10px','statistik_get()')?>
<button class="find21" title="Tampilkan" style="float:left;margin-top:2px" onclick="statistik_get()"></button>
</div>
<div id="gbox0" style="display:none;float:left;position:relative;padding:10px 10px 20px 10px;border:1px solid #ccc;border-radius:5px;background:#fff;margin-top:20px">
<div class="sfont" style="width:600px;text-align:center;margin-top:10px;margin-bottom:10px"><b>Statistik Calon Siswa Berdasarkan Agama</b></div>
<div id="placeholder0" style="width:600px;height:300px;margin-left:10px"></div>
</div>
<div id="gbox1" style="display:none;float:left;position:relative;padding:10px 10px 20px 10px;border:1px solid #ccc;border-radius:5px;background:#fff;margin-top:20px">
<div class="sfont" style="width:600px;text-align:center;margin-top:10px;margin-bottom:10px"><b>Statistik Calon Siswa Berdasarkan Jenis Kelamin</b></div>
<div id="placeholder1" style="width:600px;height:300px;margin-left:10px"></div>
</div>
<div id="gbox2" style="display:none;float:left;position:relative;padding:10px 10px 20px 10px;border:1px solid #ccc;border-radius:5px;background:#fff;margin-top:20px">
<div class="sfont" style="width:600px;text-align:center;margin-top:10px;margin-bottom:10px"><b>Statistik Calon Siswa Berdasarkan Kelompok</b></div>
<div id="placeholder2" style="width:600px;height:300px;margin-left:10px"></div>
</div>
<div id="gbox3" style="display:none;float:left;position:relative;padding:10px 10px 20px 10px;border:1px solid #ccc;border-radius:5px;background:#fff;margin-top:20px">
<div class="sfont" style="width:600px;text-align:center;margin-top:10px;margin-bottom:10px"><b>Statistik Calon Siswa Berdasarkan Periode</b></div>
<div id="placeholder3" style="width:600px;height:300px;margin-left:10px"></div>
</div>
<div id="nodata" style="display:none" class="infobox">Tidak data calon siswa pada departemen ini.</div>
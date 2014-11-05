<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='stocktake';
$dbtable='pus_stockhist';
$fform=new fform($fmod,'a',$cid);

$inp=app_form_gpost('tanggal1','nama','keterangan');
$q=dbInsert($dbtable,$inp);
if($q){
$id=mysql_insert_id();
$tbl="so_".$id;
$sql="CREATE TABLE IF NOT EXISTS `joshso`.`".$tbl."` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `buku` int(10) unsigned NOT NULL DEFAULT '0',
  `barkode` char(50) NOT NULL,
  `note` varchar(200) NOT NULL,
  `cek` enum('N','Y') NOT NULL DEFAULT 'N',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
mysql_query($sql);
dbUpdate($dbtable,Array('tabel'=>$tbl),"replid='$id'");
}
$fform->notif($q);
?>
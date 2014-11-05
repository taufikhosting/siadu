<?php
session_start();

// System files
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

if(dbInsert("so_history",Array('date'=>gpost('date'),'name'=>gpost('name'),'description'=>gpost('description')))){
	$id=mysql_insert_id();
	$tbl="so_".$id;
	$sql="CREATE TABLE  `joshlib`.`".$tbl."` (
	`dcid` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`shelf` SMALLINT UNSIGNED NOT NULL DEFAULT  '1',
	`catalog` SMALLINT UNSIGNED NOT NULL DEFAULT  '0',
	`barcode` CHAR( 20 ) NOT NULL ,
	`note` varchar(200) NOT NULL,
	`cek` ENUM(  'Y',  'N' ) NOT NULL DEFAULT  'N'
	) ENGINE = MYISAM ;";
	mysql_query($sql);
	dbUpdate("so_history",Array('ntable'=>$tbl),"dcid='$id'");
	
	$sql="CREATE TABLE IF NOT EXISTS `".$tbl."cek` (
	  `dcid` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `book` int(10) unsigned NOT NULL,
	  `barcode` char(20) NOT NULL,
	  PRIMARY KEY (`dcid`),
	  UNIQUE KEY `barcode` (`barcode`),
	  UNIQUE KEY `barcode_2` (`barcode`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
	mysql_query($sql);
	
	$sql="CREATE TABLE IF NOT EXISTS `".$tbl."new` (
	`dcid` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`barcode` char(20) NOT NULL,
	PRIMARY KEY (`dcid`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
	mysql_query($sql);
	
	dbUpdate("mstr_setting",Array('val'=>'Y'),"dcid=3");
	
	header('location:'.RLNK.'stockopname.php?tab=cek');
}
else {
	header('location:'.RLNK.'stockopname.php');
}
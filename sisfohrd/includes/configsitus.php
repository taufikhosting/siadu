<?php
/**
 * Teamworks v2.3
 * http://www.teamworks.co.id
 * December 03, 2007 07:29:56 AM 
 * Author: Teamworks Creative - reky@teamworks.co.id - +6285732037068 - pin 25b7edd4
 */
 
$hasil =  $koneksi_db->sql_query( "SELECT * FROM situs " );
$data = $koneksi_db->sql_fetchrow($hasil);
$email_master=$data['email_master'];
$judul_situs =$data['judul_situs'];
$url_situs =$data['url_situs'];
$slogan=$data['slogan'];
$description=$data['description'];
$keywords=$data['keywords'];
$_META['description'] =$description;
$_META['keywords'] = $keywords;
$maxkonten=$data['maxkonten'];
$maxadmindata = $data['maxadmindata'];
$maxdata = $data['maxdata'];
$maxgalleri = $data['maxgalleri'];
$widgetshare = $data['widgetshare'];
$widgetkomentar = $data['widgetkomentar'];
$widgetpenulis = $data['widgetpenulis'];
$theme=$data['theme'];
$detect = new Mobile_Detect();
/*
$detect = new Mobile_Detect();
if ($detect->isMobile()) {
$theme='mobile';
}else{
$theme=$data['theme'];
}
*/
$author=$data['author'];
$_META['author'] = $author;
$alamatkantor=$data['alamatkantor'];
$publishwebsite=$data['publishwebsite'];
$publishnews=$data['publishnews'];
$tags=$_META['keywords'];
$maxgalleridata = $data['maxgalleridata'];
?>
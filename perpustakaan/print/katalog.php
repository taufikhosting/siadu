<?php
  // print_r($_GET);exit();
  session_start();
  // error_reporting(0);
  require_once('../../shared/config.php');
  require_once('../system/config.php');
  // require_once '../../shared/db.php';
  // require_once(DBFILE);
  // require_once(LIBDIR.'common.php');
  require_once(MODDIR.'date.php');
  require_once(MODDIR.'xtable/xtablepf.php');
  require_once '../../shared/libraries/mpdf/mpdf.php';
  require_once '../../shared/tglindo.php';
  
  $token = base64_encode(md5('katalog'.$_SESSION['pus_admin_id'].$_SESSION['pus_admin_name']));
  // print_r($token);exit();
  if(!isset($_SESSION)){ // login 
    echo 'user has been logout';
  }else{ // logout
    if(isset($_GET['token']) and $token===$_GET['token']){

          // var_dump($_GET['kat']);exit();
            ob_start(); // digunakan untuk convert php ke html
          $out='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>SIADU::Perpus - Katalog</title>
              </head>
  
              <body>
                <table width="100%">
                  <tr>
                    <td align="left" width="40%"><img width="150px" src="../../shared/images/logo.png" alt="" /></td>
                    <td width="60%">Daftar Katalog</td>
                  </tr>
                </table>';
                  $s = 'SELECT
                          kg.judul,
                          CONCAT("[",kg.`klasifikasi-kode`,"]",kf.nama)klasifikasi,
                          pr.nama pengarang,
                          pb.nama penerbit,
                          kg.callnumber, 
                          (SELECT count(*) from pus_buku where katalog=kg.replid)jum
                        FROM
                          pus_katalog kg
                          LEFT JOIN pus_pengarang pr ON pr.replid = kg.pengarang
                          LEFT JOIN pus_penerbit pb ON pb.replid = kg.penerbit
                          LEFT JOIN pus_klasifikasi kf ON kf.replid = kg.klasifikasi
                        order BY
                          kg.judul asc';
                          //.($_GET['nopendaftaran']!='where nopendaftaran '.$_GET['nopendaftaran']?'');
                  $e = mysql_query($s);
                  $n = mysql_num_rows($e);
                  $out.='<b>Total :</b> '.$n.' katalog';
                          // var_dump($n);exit();

                $out.='<table class="isi" width="100%">';
                $out.='<tr class="head">
                        <td align="center">Judul</td>
                        <td align="center" >Klasifikasi</td>
                        <td align="center">Pengarang</td>
                        <td align="center">Penerbit</td>
                        <td align="center">Callnumber</td>
                        <td align="center">Jumlah Koleksi</td>
                      </tr>
                    ';
                    if($n==0){
                      $out.='<tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                              </tr>';
                    }else{
                      while ($r=mysql_fetch_assoc($e)) {
                        $out.='<tr >
                                  <td>'.$r['judul'].'</td>
                                  <td>'.$r['klasifikasi'].'</td>
                                  <td>'.$r['pengarang'].'</td>
                                  <td>'.$r['penerbit'].'</td>
                                  <td>'.$r['callnumber'].'</td>
                                  <td align="center">'.$r['jum'].'</td>
                              </tr>';
                      }
                    }
            $out.='</table><br>';
          echo $out; 
          // exit();
  
        #generate html -> PDF ------------
          $out2 = ob_get_contents();
          ob_end_clean(); 
          $mpdf=new mPDF('c','A4','');   
          $mpdf->SetDisplayMode('fullpage');   
          $stylesheet = file_get_contents('../../shared/libraries/mpdf/r_cetak.css');
          $mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text
          $mpdf->WriteHTML($out);
          $mpdf->Output();
    }else{
      echo 'maaf token - url tidak valid';
    }
}
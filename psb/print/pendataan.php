<?php
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
  
  $token = base64_encode(md5('pendataan'.$_SESSION['psb_admin_id'].$_SESSION['psb_admin_name']));
  // print_r($token);exit();
  if(!isset($_SESSION)){ // login 
    echo 'user has been logout';
  }else{ // logout
    if(isset($_GET['token']) and $token===$_GET['token']){
          $dep = mysql_fetch_assoc(mysql_query('select nama as departemen from Departemen where replid='.$_GET['departemen']));
          $pros= mysql_fetch_assoc(mysql_query('select proses from psb_proses  where replid='.$_GET['proses']));
          $kel = mysql_fetch_assoc(mysql_query('select kelompok from psb_kelompok where replid='.$_GET['kelompok']));
          // var_dump($pros['proses']);exit();
            ob_start(); // digunakan untuk convert php ke html
          $out='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>SIADU::Sar - inventaris</title>
              </head>
  
              <body>
                <table width="100%">
                  <tr>
                    <td align="left" width="40%"><img width="150px" src="../../shared/images/logo.png" alt="" /></td>
                    <td width="60%">Pendataan Calon Siswa</td>
                  </tr>
                </table>

                <table>
                  <tr>
                    <td>Departemen</td>
                    <td>: '.$dep['departemen'].'</td>
                  </tr>
                  <tr>
                    <td>Periode</td>
                    <td>: '.$pros['proses'].'</td>
                  </tr>
                  <tr>
                    <td>Kelompok</td>
                    <td>: '.$kel['kelompok'].'</td>
                  </tr>
                </table>
                ';

                $out.='<table class="isi" width="100%">';
                $out.='<tr class="head">
                      <td align="center" rowspan="2">No. Pendaftaran</td>
                      <td align="center"  rowspan="2">Nama</td>
                      <td align="center" rowspan="2">Uang Pangkal</td>
                      <td align="center" colspan="3">Discount</td>
                      <td align="center" rowspan="2">Denda</td>
                      <td align="center" rowspan="2">Uang Pangkal Net</td>
                      <td align="center">Angsuran</td>
                      <td align="center" rowspan="2">Joining Fee</td>
                    </tr>
                    <tr class="head">
                      <td align="center">Subsidi</td>
                      <td align="center">Tunai</td>
                      <td align="center">Tunai</td>
                      <td align="center">x Bulan</td>
                    </tr>
                    ';

                    $s = 'SELECT
                            nopendaftaran,
                            nama,
                            disctb,
                            discsaudara,
                            disctunai,
                            denda,
                            sumnet,
                            joiningf,
                            angsuran
                          FROM
                            psb_calonsiswa
                          where 
                            kelompok='.$_GET['kelompok'];
                            //.($_GET['nopendaftaran']!='where nopendaftaran '.$_GET['nopendaftaran']?'');
                    $e = mysql_query($s);
                    $n = mysql_num_rows($e);
                            // var_dump($n);exit();
                    $nox = 1;
                    if($n==0){
                      $out.='<tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                      </tr>';
                    }else{
                      while ($r=mysql_fetch_assoc($e)) {
                        // var_dump($r);
                        $out.='<tr >
                                  <td>'.$r['nopendaftaran'].'</td>
                                  <td>'.$r['nama'].'</td>
                                  <td align="right">'.fRp($r['sumpokok']).'</td>
                                  <td align="right">'.fRp($r['disctb']).'</td>
                                  <td align="right">'.fRp($r['discsaudara']).'</td>
                                  <td align="right">'.fRp($r['disctunai']).'</td>
                                  <td align="right">'.fRp($r['denda']).'</td>
                                  <td align="right">'.fRp($r['sumnet']).'</td>
                                  <td align="right">'.fRp($r['angsuran']).'</td>
                                  <td align="right">'.fRp($r['joiningf']).'</td>
                              </tr>';
                        // $nox++;
                      }
                    }
            $out.='</table><br>';
          echo $out; 
          // exit();
  
        #generate html -> PDF ------------
          $out2 = ob_get_contents();
          ob_end_clean(); 
          $mpdf=new mPDF('c','A4-L','');   
          $mpdf->SetDisplayMode('fullpage');   
          $stylesheet = file_get_contents('../../shared/libraries/mpdf/r_cetak.css');
          $mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text
          $mpdf->WriteHTML($out);
          $mpdf->Output();
    }else{
      echo 'maaf token - url tidak valid';
    }
}
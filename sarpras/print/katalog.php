<?php
  session_start();
  require_once('../../shared/config.php');
  require_once('../system/config.php');
  require_once '../../shared/db.php';
  require_once(DBFILE);
  require_once(LIBDIR.'common.php');
  require_once(MODDIR.'date.php');
  require_once(MODDIR.'xtable/xtablepf.php');
  require_once '../../shared/libraries/mpdf/mpdf.php';
  require_once '../../shared/tglindo.php';
  
  $token = base64_encode(md5('katalog'.$_SESSION['sar_admin_id'].$_SESSION['sar_admin_name']));
  // print_r($token);exit();
  if(!isset($_SESSION)){ // login 
    echo 'user has been logout';
  }else{ // logout
    if(isset($_GET['token']) and $token===$_GET['token']){
        // echo 'token udah bener n tampil';
          ob_start(); // digunakan untuk convert php ke html
          $out='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>SIADU::Sar - Katalog</title>
              </head>

              <body>
                <p align="center">
                  <b>
                    Katalog<br>
                  </b>
                </p>

                <table class="isi" width="100%">
                    <tr class="head">
                      <td align="center">Kode</td>
                      <td align="center">Nama Barang</td>
                      <td align="center">Jenis</td>
                      <td align="center">Jumlah Unit</td>
                      <td align="center">Aset</td>
                      <td align="center">Penyusutan/th</td>
                      <td align="center">Keterangan</td>
                    </tr>';

                    $s = 'SELECT
                            k.replid,
                            k.kode,
                            k.nama,
                            j.nama jenis,
                            COUNT(*) jum_unit,
                            SUM(b.harga) aset,
                            k.susut,
                            k.keterangan
                          FROM  
                            sar_katalog k
                            LEFT JOIN sar_jenis  j on j.replid = k.jenis
                            LEFT JOIN sar_barang b on b.katalog = k.replid
                          WHERE
                            k.grup = '.$_GET['grup'].' 
                          GROUP BY 
                            k.replid
                          ORDER BY
                            k.kode asc';
                            // var_dump($s);exit();
                    $e = mysql_query($s);
                    $n = mysql_num_rows($e);
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
                        $out.='<tr>
                                  <td>'.$r['kode'].'</td>
                                  <td>'.$r['nama'].'</td>
                                  <td>'.$r['jenis'].'</td>
                                  <td>'.$r['jum_unit'].'</td>
                                  <td>'.fRp($r['aset']).'</td>
                                  <td>'.$r['susut'].'</td>
                                  <td>'.$r['keterangan'].'</td>
                            </tr>';
                        $nox++;
                      }
                    }
            $out.='</table><br>';
          echo $out;
  
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
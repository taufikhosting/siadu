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
  // require_once '../../shared/tglindo.php';
  
  // $token = base64_encode(md5('transaksi_jurnalumum'.$_SESSION['keu_admin_id'].$_SESSION['keu_admin_name']));
  $token = base64_encode(md5('katalog_unit'.$_SESSION['sar_admin_id'].$_SESSION['sar_admin_name']));
  if(!isset($_SESSION)){ // login 
    echo 'user has been logout';
  }else{ // logout
  	// echo 'gak logout';
    if(isset($_GET['token']) and $token===$_GET['token']){
    	// echo 'oleh token';

          ob_start(); // digunakan untuk convert php ke html
          // $out='okokokok';
          $out='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>SIADU::Sar - katalog unit</title>
              </head>

              <body>
                <p align="center">
                  <b>
                    Katalog Unit Barang <br>
                  </b>
                </p>

                <table class="isi" width="100%">
                    <tr class="head">
                      <td align="center">Kode</td>
                      <td align="center">Barkode</td>
                      <td align="center">Tempat</td>
                      <td align="center">Sumber</td>
                      <td align="center">Harga</td>
                      <td align="center">Kondisi</td>
                      <td align="center">Status</td>
                      <td align="center">Keterangan</td>
                    </tr>';

                    $sql = 'SELECT (
                              SELECT 
                                CONCAT(ll.kode,"/",gg.kode,"/",tt.kode,"/",kk.kode,"/",LPAD(b.urut,5,0))
                              from 
                                sar_katalog kk,
                                sar_grup gg,
                                sar_tempat tt,
                                sar_lokasi ll
                              where 
                                kk.replid = b.katalog AND
                                kk.grup   = gg.replid AND
                                b.tempat  = tt.replid AND
                                tt.lokasi = ll.replid
                            )as kode,
                            b.replid,
                            LPAD(b.urut,5,0) as barkode,(
                              case b.sumber
                                when 0 then "Beli"
                                when 1 then "Pemberian" 
                                when 2 then "Membuat Sendiri" 
                              end
                            )as sumber,
                            b.harga,
                            IF(b. STATUS=1,"Tersedia","Dipinjam")AS status,
                            k.nama as kondisi,
                            t.nama as tempat,
                            b.keterangan
                          FROM
                            sar_barang b 
                            LEFT JOIN sar_kondisi k on k.replid = b.kondisi
                            LEFT JOIN sar_tempat t on t.replid = b.tempat
                          WHERE
                            b.katalog = '.$_GET['katalog'];
                            // var_dump($sql);exit();
                    $exe = mysql_query($sql);
                    $jum = mysql_num_rows($exe);
                    $nox = 1;
                    if($jum==0){
                      $out.='<tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                      </tr>';
                    }else{
                      while ($res=mysql_fetch_assoc($exe)) {
                        $out.='<tr>
                                <td>'.$res['kode'].'</td>
                                <td>'.$res['barkode'].'</td>
                                <td>'.$res['tempat'].'</td>
                                <td>'.$res['sumber'].'</td>
                                <td>'.$res['harga'].'</td>
                                <td>'.$res['kondisi'].'</td>
                                <td>'.$res['status'].'</td>
                                <td>'.$res['keterangan'].'</td>
                              </tr>';
                        $nox++;
                      }
                    }
            $out.='</table><br>';
          echo $out;
          // echo 'WOKE WOKE';
  
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
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
  // $tanggal1 =gpost('tanggal1',$tgl_f);
  // $tanggal2 =gpost('tanggal2',$tgl_l);
  // var_dump($tanggal2);
  // exit();

  $token = base64_encode(md5('transaksi_bukubesar'.$_SESSION['keu_admin_id'].$_SESSION['keu_admin_name']));
  if(!isset($_SESSION)){ // login 
    echo 'user has been logout';
  }else{ // logout
    if(isset($_GET['token']) and $token===$_GET['token']){
          ob_start(); // digunakan untuk convert php ke html
          $sql = "SELECT 
                    keu_jurnal.rek,
                    keu_rekening.kode as koderek,
                    keu_rekening.nama as nrek 
                  FROM
                    keu_jurnal 
                    LEFT JOIN keu_rekening ON keu_rekening.replid=keu_jurnal.rek 
                    LEFT JOIN keu_transaksi ON keu_transaksi.replid=keu_jurnal.transaksi 
                  WHERE 
                    keu_transaksi.tahunbuku='1' AND 
                    keu_transaksi.tanggal >= '2015-03-1' AND 
                    keu_transaksi.tanggal <= '2015-03-31'  AND (
                      keu_transaksi.jenis='0' OR keu_transaksi.jenis='3' OR 
                      keu_transaksi.jenis='4' OR keu_transaksi.jenis='1' OR 
                      keu_transaksi.jenis='2' OR keu_transaksi.jenis='7'
                    ) 
                  GROUP BY 
                    keu_jurnal.rek 
                  ORDER BY
                    keu_rekening.kategorirek,
                    keu_rekening.kode";
          $exe = mysql_query($sql);
          $jum = mysql_num_rows($exe);

          $out='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>SIADU::Keu - Buku Besar</title>
              </head>

              <body>
                <table width="100%">
                  <tr>
                    <td align="left" width="45%"><img width="150px" src="../../shared/images/logo.png" alt="" /></td>
                    <td width="55%">Buku Besar</td>
                  </tr>
                </table>

                <b>Total '.$jum.' Data</b><br />';

                    $nox = 1;
                    if($jum==0){
                      $out.='';
                    }else{
                      while ($res=mysql_fetch_assoc($exe)) {
                        $out.= '['.$res['koderek'].'] '.$res['nrek'].'.<br />';                        
                        // detil jurnal --------
                          $sql2  = "SELECT
                                      keu_jurnal.*, 
                                      keu_rekening.kode AS koderek,
                                      keu_rekening.nama AS nrek,
                                      keu_transaksi.tanggal,
                                      keu_transaksi.nomer,
                                      keu_transaksi.uraian
                                    FROM
                                      keu_jurnal
                                    LEFT JOIN keu_transaksi ON keu_transaksi.replid = keu_jurnal.transaksi
                                    LEFT JOIN keu_rekening ON keu_rekening.replid = keu_jurnal.rek
                                    WHERE
                                      keu_transaksi.tahunbuku = '1'
                                      AND keu_jurnal.rek = '0'
                                      AND keu_transaksi.tanggal >= '2015-03-1'
                                      AND keu_transaksi.tanggal <= '2015-03-31'
                                      AND (
                                        keu_transaksi.jenis = '0'
                                        OR keu_transaksi.jenis = '3'
                                        OR keu_transaksi.jenis = '4'
                                        OR keu_transaksi.jenis = '1'
                                        OR keu_transaksi.jenis = '2'
                                        OR keu_transaksi.jenis = '7'
                                      ) 
                                    order BY  
                                      keu_transaksi.tanggal,keu_transaksi.nomer";  
                          $exe2 = mysql_query($sql2);
                          $out.='<table class="isi" width="100%" >
                                  <tr class="head">
                                    <td align="center">Tanggal</td>
                                    <td align="center">No. Transaksi</td>
                                    <td align="center">Uraian</td>
                                    <td align="center">Kode Rekening</td>
                                    <td align="center">Debet</td>
                                    <td align="center">Kredit</td>
                                  </tr>';
                              // print_r($sql2);exit();
                          while($res2=mysql_fetch_assoc($exe2)){
                            // echo '<pre>';
                            //   print_r($res2);
                            //   // exit();
                            // echo'</pre>';exit();
                            $out.='<tr>
                                    <td >'.tgl_indo($res2['tanggal']).'</td>
                                    <td >'.$res2['nomer'].'</td>
                                    <td >'.$res2['uraian'].'</td>
                                    <td >'.$res2['kode'].'</td>
                                    <td align="right">'.fRp($res2['debet']).'</td>
                                    <td >'.fRp($res2['kredit']).'</td>
                                  </tr>';
                          }
                          $out.='</table><br />';
                        // end of detil jurnal --------
                          // $out.='</td>';
                        // $out.='</tr>';
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
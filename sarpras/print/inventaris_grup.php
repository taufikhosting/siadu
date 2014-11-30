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
  
  $token = base64_encode(md5('inventaris_grup'.$_SESSION['sar_admin_id'].$_SESSION['sar_admin_name']));
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
                <title>SIADU::Sar - inventaris grup</title>
              </head>

              <body>
                <p align="center">
                  <b>
                    grup barang <br>
                  </b>
                </p>

                <table class="isi" width="100%">
                    <tr class="head">
                      <td align="center">Kode</td>
                      <td align="center">Grup Barang</td>
                      <td align="center">Jumlah Unit</td>
                      <td align="center">Unit Tersedia</td>
                      <td align="center">Unit Dipinjam</td>
                      <td align="center">Total Aset</td>
                      <td align="center">Keterangan</td>
                    </tr>';

                    $s = 'SELECT
                            g.replid,
                            g.kode,
                            g.nama,
                            IFNULL(tbtot.jum,0) u_total,
                            IFNULL(tbpjm.jum,0) u_dipinjam,
                            IFNULL(tbtot.jum,0) - IFNULL(tbpjm.jum,0) u_tersedia,
                            IFNULL(tbaset.aset,0) aset,
                            g.keterangan
                          FROM
                            sar_grup g
                            LEFT JOIN (
                              SELECT 
                                k.grup,
                                count(*) jum 
                              from 
                                sar_katalog k
                                left JOIN sar_barang b on b.katalog = k.replid
                              GROUP BY
                                k.grup
                            )tbtot on tbtot.grup = g.replid
                            
                            LEFT JOIN(
                              SELECT 
                                k.grup,
                                count(*)jum
                              from 
                                sar_peminjaman pj
                                left JOIN sar_pengembalian kb on kb.peminjaman = pj.replid
                                LEFT JOIN sar_barang b on b.replid = pj.barang
                                left JOIN sar_katalog k on k.replid = b.katalog
                              WHERE
                                kb.replid is NULL
                              GROUP BY  
                                k.grup
                            )tbpjm on tbpjm.grup = g.replid

                            LEFT JOIN(
                              SELECT
                                k.grup,
                                SUM(b.harga)aset
                              from 
                                sar_barang b
                                join sar_katalog k on k.replid = b.katalog
                              GROUP BY 
                                k.grup
                            )tbaset on tbaset.grup = g.replid
                          WHERE
                            g.lokasi = '.$_GET['lokasi'].' 
                          ORDER BY
                            g.kode asc';
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
                                  <td>'.$r['u_total'].'</td>
                                  <td>'.$r['u_dipinjam'].'</td>
                                  <td>'.$r['u_tersedia'].'</td>
                                  <td>'.fRp($r['aset']).'</td>
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
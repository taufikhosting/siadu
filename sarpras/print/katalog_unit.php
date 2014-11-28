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
                      <td align="center">Tanggal</td>
                      <td align="center">No. Jurnal / No. Bukti</td>
                      <td align="center">Uraian</td>
                      <td align="center">Detil Jurnal</td>
                    </tr>';

                    $sql = 'SELECT * FROM keu_transaksi';
                    $exe = mysql_query($sql);
                    $jum = mysql_num_rows($exe);
                    $nox = 1;
                    if($jum==0){
                      $out.='<tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                      </tr>';
                    }else{
                      while ($res=mysql_fetch_assoc($exe)) {
                        $out.='<tr>
                                <td>'.tgl_indo4($res['tanggal']).'</td>
                                <td>'.$res['nomer'].'</td>
                                <td>'.$res['uraian'].'</td>
                                <td valgin="top">';
                        
                        // detil jurnal --------
                          $sql2  = 'SELECT 
                                      kr.nama,  
                                      kr.kode,  
                                      kj.debet,  
                                      kj.kredit  
                                    from 
                                      keu_jurnal kj, 
                                      keu_rekening kr 
                                    where 
                                      kj.rek=kr.replid and 
                                      kj.transaksi='.$res['replid'].' 
                                    order by 
                                      kj.kredit asc';  
                          $exe2 = mysql_query($sql2);
                          $out.='<table class="isi" >';
                          while($res2=mysql_fetch_assoc($exe2)){
                            $out.='<tr>
                                    <td width="200px">'.$res2['nama'].'</td>
                                    <td width="60px">'.$res2['kode'].'</td>
                                    <td width="80px">'.fRp($res2['debet']).'</td>
                                    <td width="80px">'.fRp($res2['kredit']).'</td>
                                  </tr>';
                          }
                          $out.='</table>';
                        // end of detil jurnal --------
                          $out.='</td>';
                        $out.='</tr>';
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
          // $stylesheet = file_get_contents('../../shared/libraries/mpdf/r_cetak.css');
          $mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text
          $mpdf->WriteHTML($out);
          $mpdf->Output();
    }else{
      echo 'maaf token - url tidak valid';
    }
}
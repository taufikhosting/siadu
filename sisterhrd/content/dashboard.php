<?php
	include "includes/libchart/libchart/classes/libchart.php";
	

	$chart = new PieChart();
	$dataSet = new XYDataSet();
	$total =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where kelamin='1'" );
	$jumlah = $koneksi_db->sql_numrows( $total );
     $total2 =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where kelamin='2'" );
	$jumlah2 = $koneksi_db->sql_numrows( $total2 );
	$dataSet->addPoint(new Point("Laki-Laki ($jumlah)", $jumlah));
	$dataSet->addPoint(new Point("Perempuan ($jumlah2)", $jumlah2));
	$chart->setDataSet($dataSet);
	$chart->setTitle("Jenis Kelamin");
	$chart->render("generated/kelamin.png");
	
    $chart2 = new PieChart();
	$dataSet2 = new XYDataSet();
	$totala =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where status='9'" );
	$jumlaha = $koneksi_db->sql_numrows( $totala );
     $totala2 =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where status='10'" );
	$jumlaha2 = $koneksi_db->sql_numrows( $totala2 );
     $totala3 =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where status='11'" );
	$jumlaha3 = $koneksi_db->sql_numrows( $totala3 );
     $totala4 =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where status='12'" );
	 	$jumlaha4 = $koneksi_db->sql_numrows( $totala4 );
	$dataSet2->addPoint(new Point("GTT ($jumlaha)", $jumlaha));
	$dataSet2->addPoint(new Point("GTY ($jumlaha2)", $jumlaha2));
	$dataSet2->addPoint(new Point("MAGANG ($jumlaha3)", $jumlaha3));
	$dataSet2->addPoint(new Point("KONTRAK ($jumlaha4)", $jumlaha4));
	$chart2->setDataSet($dataSet2);
	$chart2->setTitle("Status Karyawan");
	$chart2->render("generated/status.png");
	///////////////////////////
if (!defined('AURACMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}

global $koneksi_db;
$style_include[] = '
<style type="text/css">
/*<![CDATA[*/
    .box{
        padding: 20px;
        display: none;
        margin-top: 20px;
    }
/*]]>*/
</style>';
$JS_SCRIPT= <<<js
<script type="text/javascript">
    $(document).ready(function(){
        $("select").change(function(){
            $( "select option:selected").each(function(){
                if($(this).attr("value")=="kelamin"){
                    $(".box").hide();
                    $(".kelamin").show();
                }
                if($(this).attr("value")=="status"){
                    $(".box").hide();
                    $(".status").show();
                }
            });
        }).change();
    });
</script>
js;

$script_include[] = $JS_SCRIPT;
$tengah .='<legend>Dashboard</legend>';

if ($_SESSION['LevelAkses']){
$username = $_SESSION['UserName'];
$query =  $koneksi_db->sql_query( "SELECT * FROM useraura where user = '$username'" );
$data = $koneksi_db->sql_fetchrow( $query );
$last_ping = datetimes($data['last_ping'],true);

#####################################
# Administrator
#####################################
if ($_SESSION['LevelAkses']=="Administrator"){

$tengah .='<div class="border"><font style="color:#21759B;"><b>Last Login :</b> '.$last_ping.'</font></div>';

$tengah .='<div class="row">';
/////////////////////////////////////////////////////////////////////////////////////////////
$tengah .='<div class="col-xs-6">';
$tengah .='<div class="panel panel-info">
<div class="panel-heading"><h3 class="panel-title">Statistik Karyawan</h3></div>
<table class="table"><tr><td>';
$tengah .='    <div>
        <select>
            <option>Choose Statistik</option>
            <option value="kelamin">Statistik Jenis Kelamin</option>
            <option value="status">Statistik Status Karyawan</option>
        </select>
    </div>
    <div class="kelamin box"><img alt="Statistik Jenis Kelamin"  src="generated/kelamin.png"/></div>
    <div class="status box"><img alt="Statistik Status Karyawan"  src="generated/status.png"/></div>';
//$tengah .='<img alt="Statistik Jenis Kelamin"  src="generated/kelamin.png" style="border: 1px solid gray;"/>';
//$tengah .='<img alt="Statistik Status Karyawan"  src="generated/status.png" style="border: 1px solid gray;"/>';
$tengah .='</td></tr></table>';
$tengah .='</div>';

$tengah .='</div>';
/////////////////////////////////////////////////////////////////////////////////////////////
$tengah .='<div class="col-xs-6">';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan " );
$tengah .='<div class="panel panel-info">
<div class="panel-heading"><h3 class="panel-title">Reminder Status</h3></div>
<table class="table">';
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$id 	= $data['id'];
$nip 	= $data['nip'];
$nama 	= $data['nama'];
$date1 	= $data['tglpercobaan'];
$date2 	= $data['tglkontrak'];
$date3 = date("Y-m-d");
$telatkontrak =  daysBetween($date3, $date2);
$telatpercobaan =  daysBetween($date3, $date1);
$tglpercobaan= datetimes($date1,False,False);
$tglkontrak= datetimes($date2,False,False);
if(($telatkontrak<=90)and($telatkontrak>=0)){
$tengah .="<tr><td>$nama - $telatkontrak Hari ($tglkontrak) - Kontrak</td></tr>";
}
if(($telatpercobaan<=14)and($telatpercobaan>=0)){
$tengah .="<tr><td>$nama - $telatpercobaan Hari ($tglpercobaan) - Percobaan</td></tr>";
}

}
$tengah .='</table>';
$tengah .='</div>';

$tengah .='</div>';
///////////////////////////////////////////////////////////////////////////
$tengah .='<div class="col-xs-6">';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan " );
$tengah .='<div class="panel panel-info">
<div class="panel-heading"><h3 class="panel-title">Reminder Masa Cuti</h3></div>
<table class="table">';
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$id 	= $data['id'];
$nip 	= $data['nip'];
$nama 	= $data['nama'];
$jatahcuti 	= $data['jatahcuti'];
$tahun = date("Y");
$total = $koneksi_db->sql_query( "SELECT * FROM hrd_cuti where karyawan = '".$id."' and tahun = '$tahun'");
$jmlcuti = $koneksi_db->sql_numrows( $total );
$sisacuti = $jatahcuti - $jmlcuti;
if (($sisacuti==1)){
$tengah .="<tr><td>$nama - $sisacuti Hari (Sisa Cuti) - Kontrak</td></tr>";
}
}
$tengah .='</table>';
$tengah .='</div>';
$tengah .='</div>';
///////////////////////////////////////////////////////////////////////////
$tengah .='<div class="col-xs-6">';
// baca tanggal sekarang
$tglNow = date("d");
// baca bulan sekarang
$blnNow = date("m");
// baca tahun-bulan-tanggal sekarang
$now = date("Y-m-d");
$hasil =  $koneksi_db->sql_query( "SELECT id,nip,nama,tgllahir,(year(curdate())-year(tgllahir)) as umur FROM hrd_karyawan  WHERE MONTH(tgllahir) = '$blnNow '");
$tengah .='<div class="panel panel-info">
<div class="panel-heading"><h3 class="panel-title">Reminder Ultah Bulan Ini</h3></div>
<table class="table">';
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$id 	= $data['id'];
$nip 	= $data['nip'];
$nama 	= $data['nama'];
$umur 	= $data['umur'];
$tgllahir 	= datetimes($data['tgllahir'],False,False);
$tengah .="<tr><td>$nama - $tgllahir - $umur Tahun</td></tr>";
}
$tengah .='</table>';
$tengah .='</div>';
$tengah .='</div>';



///////////////////////////////////////////////////////////////////////////
$tengah .='</div>';
}
}
echo $tengah;
?>
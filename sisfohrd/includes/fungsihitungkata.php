<?php
//----BAGIAN PERTAMA : INISIALISASI
$kata="Aku adalah seorang superman, sekarang aku ada di udara";
echo $kata."<br>"; // MENAMPILKAN KATA YANG AKAN DIPROSES
$pemisahan=".,"; // VARIABEL INI DIISI OLEH PEMISAHAN KATA, SEPERTI DIPISAH OLEH TITIK, KOMA, dst
for ($i=0;$i<strlen($pemisahan);$i++){ //MELAKUKAN LOOPING UNTUK MEMISAHKAN KATA BERDASARKAN $PEMISAHAN
$current_pemisahan=substr($pemisahan,$i,1);
$kata=str_replace($current_pemisahan,"",$kata);	
}
$kata=explode(" ",$kata); //MEMECAH KATA MENJADI ARRAY BERDASARKAN KARAKTER SPASI

// ----BAGIAN KEDUA : PENGECEKAN KATA
$arr_kata=array(); 
foreach ($kata as $a=>$b){
$add_new=1; //UNTUK PERTAMA KALI $ADD_NEW DISET 1, ARTINYA BELUM DITEMUKAN KATA YANG SAMA
$current_kata=$kata[$a];
foreach ($arr_kata as $c=>$d){ //MENGECEK ITEM-ITEM DI $ARR_KATA
if (strtolower($current_kata)==strtolower($arr_kata[$c][kata])){ //JIKA ADA KATA YANG SAMA
$arr_kata[$c][hits]++; //NAIKAN NILAI HITS
$add_new=0; //SET $ADD_NEW JADI 0, ARTINYA KATA YANG SAMA UDAH DITEMUKAN
}	
}
if ($add_new==1){ //JIKA $ADD_NEW MASIH 1, ARTINYA TIDAK DITEMUKAN KATA YANG SAMA
$arr_kata[]=array(hits=>1,kata=>$current_kata);	 // BUAT ARRAY BARU
}
}

// -----BAGIAN KETIGA : MENAMPILKAN KATA
$i=0;
$batas=3; //--BATAS PENGURUTAN KATA
rsort($arr_kata); //MENGURUTKAN $ARR_KATA BERDASARKAN NILAI HITS YANG TERBESAR
foreach ($arr_kata as $a=>$b){
$i++;
if ($i<=$batas){ //JIKA NILAI $I LEBIH KECIL DARI $BATAS, TAMPILKAN HASILNYA
$current_kata=$arr_kata[$a][kata];
$current_hits=$arr_kata[$a][hits];
echo $current_kata." : ".$current_hits."<br>";
}
}
?>
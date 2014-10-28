<?php
	function tgl_indo($tgl){
			$tanggal= substr($tgl,8,2);
			$bulan 	= getBulan(substr($tgl,5,2));
			$tahun 	= substr($tgl,0,4);
			$jam	= substr($tgl,11,2);
			$menit	= substr($tgl,14,2);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function tgl_indo2($tgl){
			$tanggal= substr($tgl,8,2);
			$bulan 	= getBulan(substr($tgl,5,2));
			$tahun 	= substr($tgl,0,4);
			$jam	= substr($tgl,11,2);
			$menit	= substr($tgl,14,2);
			return $tanggal.' '.$bulan.' '.$tahun.' ('.$jam.':'.$menit.')' ;		 
	}	

	function tgl_indo3($tgl){ // 05/25/2012
			$bulan		= substr($tgl,0,2);
			$tanggal 	= substr($tgl,3,2);
			$tahun 		= substr($tgl,6,4);
			return $tahun.'-'.$bulan.'-'.$tanggal;		 
	}	

	function tgl_indo4($tgl){ //09-27-1990 
			$tahun 		= substr($tgl,0,4);
			$bulan		= substr($tgl,5,2);
			$tanggal 	= substr($tgl,8,2);
			return $bulan.'/'.$tanggal.'/'.$tahun;		 
	}	

	function tgl_indo5($tgl){ //2012-01-29 
			$tahun 		= substr($tgl,0,4);
			$tahun 		= substr($tgl,2,2);
			$bulan 		= getBulan(substr($tgl,5,2));
			$bulan		= substr($bulan,0,3);
			$tanggal 	= substr($tgl,8,2);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
?>
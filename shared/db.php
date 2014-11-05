<?php
mysql_connect(DBHOST,DBUSER,DBPSWD)or die("Database connection failed: ".DBUSER."@".DBHOST);
mysql_select_db(DBNAME)or die("Can't open database: ".DBNAME);
function dbQsql($s){
$_SESSION['libdb_dbQsql']=$s;
return mysql_query($s);
}
function dbFA($q){
return mysql_fetch_array($q);
}
function dbQFA($s){
return dbFA(dbQsql($s));
}
function dbNRow($q){
return mysql_num_rows($q);
}
function dbSel($s,$t,$f=""){
$h=array("W/","O/","D/","L/");
$r=array(" WHERE "," ORDER BY "," DESC "," LIMIT ");
if($f!="")$f=str_replace($h,$r,$f);
return dbQsql("SELECT ".$s." FROM ".$t." ".$f);
}  
function dbSFA($s,$t,$f=""){
return dbFA(dbSel($s,$t,$f));
}
function dbSRow($t,$f=""){
return dbNRow(dbSel("*",$t,$f));
}
function dbRow($tbl){
return dbSRow($tbl,"");
}
function dbUpdate($t,$f,$r=""){
	$i=true;
	if(count($f)>0){$s="";
		foreach($f as $k => $v){
			if(!$i)$s.=",";else $i=false;
			$s.="`".$k."`='".addslashes($v)."'";
		}
		$q="UPDATE ".$t." SET ".$s.($r==""?"":" WHERE ".$r);
		$_SESSION['libdb_dbUpdate']=$q;
		return dbQsql($q);
	}else return false;
}

function dbInsert($t,$f){
	$i=true;
	if(count($f)>0){$s="";
		foreach($f as $k => $v){
			if(!$i)$s.=",";else $i=false;
			$s.="`".$k."`='".addslashes($v)."'";
		}
		$q="INSERT INTO ".$t." SET ".$s;
		$_SESSION['libdb_dbIsert']=$q;
		return dbQsql($q);
	}else return false;
}

function dbDel($t,$r){
return dbQsql("DELETE FROM ".$t." WHERE ".$r);
}
function dbFetch($s,$t,$f=""){
$t=dbSel($s,$t,$f." LIMIT 0,1");if(dbNRow($t)==1){
$r=dbFA($t);return $r[$s];
}
else{
return '';
}
}
/*
function dbTF(){
	$a=func_get_args();
	$n=count($a);
	$t=$a[0]; $s="";
	for($i=1;$i<$n;$i++){
		if($s!="")$s.=",";
		$s.=$t.".".$a[$i];
	}
	return $s;
}*/
function dbTF(){
	$a=func_get_args();
	$n=count($a); $s="";
	for($i=0;$i<$n;$i++){
		$t=explode(":",$a[$i]);
		//if($s!="")$s.=",";
		//$s.=$t[0];
		if(count($t)>1){
			$f=explode(",",$t[1]);
			$nf=count($f);
			for($j=0;$j<$nf;$j++){
				if($s!="")$s.=",";
				$s.=$t[0].".".$f[$j];
			}
		}
	}
	return $s;
}
function dbLJoin($t1,$f1,$t2,$f2){
	return " LEFT JOIN ".$t2." ON ".$t2.".".$f2."=".$t1.".".$f1." ";
}

require_once(LIBDIR.'xdb.php');

//$f="pus_katalog.judul,pus_katalog.klasifikasi,pus_katalog.pengarang,pus_katalog.penerbit,pus_klasifikasi.nama as nkla,pus_pengarang.nama as npeng,pus_penerbit.nama as npene";
//$j="LEFT JOIN pus_klasifikasi ON pus_klasifikasi.replid=pus_katalog.klasifikasi";
?>
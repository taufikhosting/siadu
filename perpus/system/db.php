<?php mysql_connect(DBHOST,DBUSER,DBPSWD)or die("Database connection failed: ".DBUSER."@".DBHOST);mysql_select_db(DBNAME)or die("Can't open database: ".DBNAME);function dbQsql($s){return mysql_query($s);}function dbQFT($f,$t){return mysql_query("SELECT ".$f." FROM ".$t);}function dbFA($q){return mysql_fetch_array($q);}function dbQFA($s){return dbFA(dbQsql($s));}function dbNRow($q){return mysql_num_rows($q);}function dbSel($sel,$tbl,$filter=""){$h=array("W/","O/","D/","L/");$r=array(" WHERE "," ORDER BY "," DESC "," LIMIT ");if($filter!="")$filter=str_replace($h,$r,$filter);return dbQsql("SELECT ".$sel." FROM `".$tbl."` ".$filter);}function dbSAF($tbl,$filter=""){$h=array("W/","O/","D/","L/");$r=array(" WHERE "," ORDER BY "," DESC "," LIMIT ");if($filter!="")$filter=str_replace($h,$r,$filter);return dbQsql("SELECT * FROM ".$tbl.$filter);}  function dbSFA($sel,$tbl,$filter=""){return dbFA(dbSel($sel,$tbl,$filter));}function dbSRow($tbl,$filter=""){return dbNRow(dbSel("*",$tbl,$filter));}function dbRow($tbl){return dbSRow($tbl,"");}function dbUpdate($table,$field,$row){$i=0;$n=count($field);foreach($field as $key => $value){$f.="`".$key."`='".addslashes($value)."'";$i++;if($i<$n)$f.=",";}$sql.="UPDATE ".$table." SET ".$f." WHERE ".$row;return dbQsql($sql);}function dbInsert($table,$data){$f="";$n=count($data);$v="";$i=0;foreach($data as $key => $value){$f.="`".$key."`";$v.="'".addslashes($value)."'";$i++;if($i<$n){$f.=",";$v.=",";}}$sql = "INSERT INTO ".$table." (".$f.") VALUES (".$v.")";return dbQsql($sql);}function dbDel($t,$r=""){$s="DELETE FROM ".$t." WHERE ".$r;return dbQsql($s);}
function dbFetch($sel,$tbl,$filter=""){
	$t=dbSel($sel,$tbl,$filter." LIMIT 0,1");
	if(dbNRow($t)==1){
		$res=dbFA($t);
		return $res[$sel];
	} else {
		return '';
	}
}
function dbFAx($t){
	$r=mysql_fetch_array($t);
	if($r){
		foreach($r as $k=>$v){
			$r[$k]=str_replace("\\'","'",$v);
		}
		return $r;
	}
	return $r;
}
 function dbSFAx($sel,$tbl,$filter=""){return dbFAx(dbSel($sel,$tbl,$filter));}
?>
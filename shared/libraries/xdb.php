<?php
class xdb{
	public $table='';
	public $f='';
	public $j='';
	public $w='';
	public $g='';
	public $o='';
	public $l='';
	public $sql='';
	function __construct($ta="",$fi="*",$wh="",$od=""){
		$this->table=$ta;
		$this->f=$fi==""?"*":$fi;
		$this->j="";
		$this->w=$wh;
		$this->g="";
		$this->o=$od;
		$this->l="";
		$this->sql="";
	}
	function field(){
		if($this->f=="*")$this->f="";
		$a=func_get_args();
		$n=count($a); $s="";
		for($i=0;$i<$n;$i++){
			$a[$i]=str_replace(":=","~as",$a[$i]);
			$t=explode(":",$a[$i]);
			//if($s!="")$s.=",";
			//$s.=$t[0];
			if(count($t)>1){
				$f=explode(",",$t[1]);
				$nf=count($f);
				for($j=0;$j<$nf;$j++){
					if($s!="")$s.=", ";
					$s.=$t[0].".".$f[$j];
				}
			} else {
				if($s!="")$s.=", ";
				$s.=$t[0];
			}
		}
		if($this->f!="")$this->f.=", ";
		$s=str_replace("~as",":=",$s);
		$this->f.=$s;
	}
	function join($f0,$t,$f='replid'){
		$this->j.=" LEFT JOIN ".$t." ON ".$t.".".$f."=".$this->table.".".$f0." ";
	}
	function joinother($t1,$f1,$t2,$f2='replid'){
		$this->j.=" LEFT JOIN ".$t2." ON ".$t2.".".$f2."=".$t1.".".$f1." ";
	}
	function join_cust($a){
		$s=str_replace("LEFT","",$a);
		$s=str_replace("JOIN","",$a);
		$this->j.=" LEFT JOIN ".$a;
	}
	function where($a){
		if(substr($a,0,1)=="!"){
			$a=substr($a,1);
			$this->w=$a;
		} else {
			$a=preg_replace("/^\s*WHERE\s*/","",$a);
			$this->w=$a;
		}
	}
	function where_ands(){
		$a=func_get_args();
		$n=count($a);
		for($i=0;$i<$n;$i++){
			$s=explode(":",$a[$i]);
			if(count($s)>1){
				$tbl=$s[0];
				$ct=explode(",",$s[1]);
				$nct=count($ct);
				for($l=0;$l<$nct;$l++){
					$this->where_and($tbl.".".$ct[$l]);
				}
			} else {
				$this->where_and($a[$i]);
			}
		}
	}
	function where_and($a){
		if(substr($a,0,1)=="!"){
			$a=substr($a,1);
			if($a!=""){
				if($this->w!="") $this->w.=" AND ";
				$this->w.=$a;
			}
		} else {
			$a=str_replace("WHERE","",$a);
			$a=preg_replace("/[\s]*AND[\s]+/","",$a);
			if($a!=""){
				if($this->w!="") $this->w.=" AND ";
				$this->w.=$a;
			}
		}
	}
	function where_and_iffnn($f,$v){
		if($v!=0){
			$this->where_and($f."='".$v."'");
		}
	}
	function where_or($a){
		$a=str_replace("WHERE","",$a);
		$a=preg_replace("/[\s]*OR[\s]+/","",$a);
		if($a!=""){
			if($this->w!="") $this->w.=" OR ";
			$this->w.=$a;
		}
	}
	function limit($a){
		$this->l=$a;
	}
	function group($a){
		$this->g=$a;
	}
	function order($a){
		if($this->o!="")$this->o.=", ";
		$this->o.=$a;
	}
	function setsql($s){
		$this->sql=$s;
	}
	function getsql(){
		return "SELECT ".($this->f==""?"*":$this->f)." FROM ".$this->table.($this->j!=""?" ".$this->j." ":"").($this->w!=""?" WHERE ".$this->w." ":"").($this->g!=""?" GROUP BY ".$this->g." ":"").($this->o!=""?" ORDER BY ".$this->o." ":"").($this->l!=""?" LIMIT ".$this->l." ":"");
	}
	function query($a="",$s=0){
		if($this->sql==""){
			$this->sql=$this->getsql();
		}
		if($a!="") $this->sql.=$a;
		if($s) echo $this->sql;
		return mysql_query($this->sql);
	}
	function go(){
		return $this->query();
	}
	function gofetch(){
		$sql=$this->getsql();
		if($this->l=='')$sql.=" LIMIT 0,1";
		$t=mysql_query($sql);
		if(mysql_num_rows($t)>0){
			return mysql_fetch_array($t);
		} else {
			return '';
		}
	}
}
?>
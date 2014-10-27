<script type="text/javascript" language="javascript">
function cfform(o,cid,g){
	//alert(o); return 0;
	var fmod="author";
	var f=new Array('name','prefix');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	if(o=='m'||o=='mf'){
		var nr=parseInt(E('xnrow').value);
		var nsel=0;
		for(var i=1;i<nr;i++){
			if(E('xcek'+i).checked){
				v+="&dm"+nsel+"="+E('xcek'+i).value;
				nsel++;
			}
		}
		v+="&nsel="+nsel;
		
	}
	var ps="a_"+fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df'||o=='mf')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();if(o=='af')E('name').focus()});}
	else{_(ps,function(r){if(r=='R') document.location='<?=RLNK?>bibliographic.php?tab=author'; else document.location.reload()});}
}
function goSearch(a){
	jumpTo('<?=$page_link?>&q='+a);
}
</script>
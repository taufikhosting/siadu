<?php
if(preg_match('/'.basename(__FILE__).'/',$_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}
ob_start();
/*
echo '<div style="text-align:center;"><!-- Histats.com  START  -->
<script  type="text/javascript" >
var s_sid = 508946; var st_dominio = 4; 
var cimg = 30; var cwi =130; var che =80;
</script>
<script  type="text/javascript" language="javascript" src="http://s10.histats.com/js9.js"></script>
<noscript><p>
<img  src="http://s4.histats.com/stats/0.gif?508946&1" alt="cool hit counter" /></p>
</noscript>
<!-- Histats.com  END  --></div>';
*/
echo "<table><tr><td>";
include "mod/statistik/counter.php";
include "mod/statistik/online.php";
include "mod/statistik/hits.php";
include "mod/statistik/useronline.php";
include "includes/configsitus.php";
echo "
<img src=\"$url_situs/mod/statistik/images/visitor.png\" border=\"0\" alt=\"\" /> Visitors :<b>$theCount</b> Users<br />
<img src=\"$url_situs/mod/statistik/images/hits.png\" border=\"0\" alt=\"\" /> Hits : <b>$hits</b> hits<br />
<img src=\"$url_situs/mod/statistik/images/month.png\" border=\"0\" alt=\"\" /> Month : <b>".month ()."</b> Users<br />
<img src=\"$url_situs/mod/statistik/images/today.png\" border=\"0\" alt=\"\" /> Today : <b>".day ()."</b> Users<br />";
//<img src=\"$url_situs/mod/statistik/images/online.png\" border=\"0\" alt=\"\" /> Online : <b>".useronline()."</b> Member
echo "
</td></tr></table><br />";

$out = ob_get_contents();
ob_end_clean();
?>

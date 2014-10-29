<?php
function useronline(){
$qw = mysql_query("SELECT count(user) as total FROM useraura where is_online='1'");
$countdataquery = mysql_fetch_assoc($qw);
$jumlah= $countdataquery['total'];
return "<b>$jumlah</b>";
}

?>
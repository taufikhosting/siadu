<?php
echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
echo "<br/>";
echo "<br/>";
echo "<br/>";
$browser = get_browser(null, true);
print_r($browser);
?>
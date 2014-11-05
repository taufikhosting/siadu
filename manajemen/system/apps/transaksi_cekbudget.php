<?php appmod_use('keu/budget');
$budget=gpost('budget');
if($budget!=0){
$sisa=budget_getnominal($budget)-budget_getuses($budget);
echo $sisa;
} else {
echo "x";
}
?>
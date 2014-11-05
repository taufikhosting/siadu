<?php
if($nop>1){ $fp=true;?>
<table cellspacing="4px" cellpadding="0" style="margin-top:2px"><tr>
	<td width="40px"><span class="sfont">Pages:</span></td>
	<td width="24px" align="center"><a class="plink<?=(($page>1)?"\" title=\"Go to previous page\" href=\"".pageLinkp($page-1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> < </a></td>
	<?php for($n=1;$n<=$nop;$n++){ if(($n>=($page-3) && $n<=($page+3)) || $n==$nop || $n==1){ $fp=true;?>
	<td width="24px" align="center"><a class="plink<?=(($n!=$page)?"\" title=\"Go to page $n\" href=\"".pageLinkp($n,gets('sortby'),gets('mode'),gets('q')):"a")?>"><?=$n;?></a></td>
	<?php } else if($fp) { $fp=false; echo '<td width="24px" align="center"><span class="sfont">...</span></td>';
	}}?>
	<td width="24px" align="center"><a class="plink<?=(($page<$nop)?"\" title=\"Go to next page\" href=\"".pageLinkp($page+1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> > </a></td>
</tr></table>
<?php }?>
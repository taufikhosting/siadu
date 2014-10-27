						<?php
						$tpf=mysql_query("SELECT * FROM emp_files WHERE empid='".$r['dcid']."' ORDER BY description");
						$npf=mysql_num_rows($tpf);
						if($npf>0){
						$rpf=mysql_fetch_array($t);
						?>
						<div class="sfont" style="padding:5px 0 5px 0;background:#ededff;">
							<b><?=$r['fname']?>'s File<?=($npf>1?"s":"")?>:</b>
						</div><br/>
						<table class="tablex" border="0" cellspacing="1px">
						<tr class="tablexhead">
							<th>File Description</th>
							<th style="text-align:center">Type</th>
							<th style="text-align:center">Option</th>
						</tr>
						<?php $is=0; while($rpf=mysql_fetch_array($tpf)){
						$dd=diffDay($rpf['date2']);
						$active=$dd<0?"Expired":"Valid";?>
						<tr>
							<td width="550px"><a class="linkl11" title="Open file" target="_blank" href="<?=FLNK.$rpf['file']?>"><?=$rpf['description']?><img src="<?=IMGR?>link.png" border="0"/></a></td>
							<td width="60px" align="center"><?=$rpf['type']?></td>
							<td width="60px" align="center">
								<button class="btndel" title="Delete" onclick="pf_files('df',<?=$rpf['dcid']?>)"></button>
							</td>
						</tr>
						<?php }?>
						</table>
						<?php } else {?>
							<div class="sfont" style="padding:5px 0 5px 0">
								<i>There is no file of <?=$r['fname']?></i>
							</div><br/>
						<?php } ?>
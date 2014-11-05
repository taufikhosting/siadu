						<?php
						$tpf=mysql_query("SELECT * FROM emp_status WHERE empid='".$r['dcid']."' ORDER BY dcid DESC");
						if(mysql_num_rows($tpf)>0){
						$rpf=mysql_fetch_array($t);
						
						if(intval($r['status'])<2) $dc="";
						else {
							$cs=EmpGetCStatus($r['dcid']);
							$dd=diffDay($cs['date2']);
							$dt=(abs($dd)>1)?"s":"";
							$dt=abs($dd)." Day".$dt;
							$dt.=($dd<0)?" over":" remaining";
							$dr=MstrGetReminder("status",$cs['status']);
							$dc=($dd<=$dr)?" &nbsp;<span class=\"sfont\" style=\"color:#ff0000\"><b>(".$dt.")</b></span>":"";
						}						
						?>
						<div class="sfont" style="padding:5px 0 5px 0;background:#ededff;">
							<b><?=$r['fname']?>'s current status: <?="<span style=\"color:#".($r['status']!=0?"008000\">".$mstr_status[$r['status']]:"ff0000\">No Status")."</span>".$dc?></b>
						</div><br/>
						<div class="sfont" style="height:24px">Employee status history:</div>
						<table class="tablex" border="0" cellspacing="1px" width="600px">
						<tr class="tablexhead">
							<th style="text-align:left">Status</th>
							<th>Period</th>
							<th style="text-align:left">Position</th>
							<th style="text-align:center">Option</th>
						</tr>
						<?php $is=0; while($rpf=mysql_fetch_array($tpf)){?>
						<tr>
							<td width="120px"><?php if($rpf['active']=='Y'){ ?><img src="<?=IMGR?>cek.png"/><?php }?> <?=$mstr_status[$rpf['status']]?></td>
							<td width="150px"><?=ftgl($rpf['date1'])?> to <?=ftgl($rpf['date2'])?></td>
							<td width="120px"><?=$rpf['position']?></td>
							<td width="60px" align="center">
								<button class="btnedit" title="Edit" onclick="pf_status('uf',<?=$rpf['dcid']?>)"></button>
								<button class="btndel" title="Delete" onclick="pf_status('df',<?=$rpf['dcid']?>)"></button>
							</td>
						</tr>
						<?php }?>
						</table>
						<?php } else {?>
							<div class="sfont" style="padding:5px 0 5px 0">
								<i><?=$r['fname']?> is currently have no status.</i>
							</div><br/>
						<?php }?>
						<?php
						//$tpf=mysql_query("SELECT * FROM emp_document WHERE empid='".$r['dcid']."' ORDER BY dcid");
						$tpf=mysql_query("SELECT t1.* FROM emp_document t1 LEFT JOIN mstr_document t2 ON t1.docid = t2.dcid WHERE t1.empid='".$r['dcid']."' ORDER BY t2.urut");
						$npf=mysql_num_rows($tpf);
						if($npf>0){
						$rpf=mysql_fetch_array($t);
						$mstr_document=MstrGet("mstr_document");
						?>
						<div class="sfont" style="padding:5px 0 5px 0;background:#ededff;">
							<b><?=$r['fname']?>'s Document<?=($npf>1?"s":"")?>:</b>
						</div><br/>
						<table class="tablex" border="0" cellspacing="1px">
						<tr class="tablexhead">
							<th>Document</th>
							<th>Validity</th>
							<th>Document Status</th>
							<th style="text-align:center">Option</th>
						</tr>
						<?php $is=0; while($rpf=mysql_fetch_array($tpf)){
						$dd=diffDay($rpf['date2']);
						$active=$dd<0?"Expired":"Valid";?>
						<tr>
							<td width="160px"><?=$mstr_document[$rpf['docid']]?></td>
							<td width="220px"><?=ftgl($rpf['date1'])?> to <?=ftgl($rpf['date2'])?></td>
							<td width="120px"><?=$active?></td>
							<td width="60px" align="center">
								<button class="btnedit" title="Edit" onclick="pf_document('uf',<?=$rpf['dcid']?>)"></button>
								<button class="btndel" title="Delete" onclick="pf_document('df',<?=$rpf['dcid']?>)"></button>
							</td>
						</tr>
						<?php }?>
						</table>
						<?php } else {?>
							<div class="sfont" style="padding:5px 0 5px 0">
								<i>There is no document of <?=$r['fname']?></i>
							</div><br/>
						<?php }
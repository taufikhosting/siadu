						<?php
						$tpf=mysql_query("SELECT * FROM emp_family WHERE empid='".$r['dcid']."' ORDER BY dcid DESC");
						$npf=mysql_num_rows($tpf);
						if($npf>0){
						$rpf=mysql_fetch_array($t);
						
						$tf=dbSel("*","mstr_family");
						while($rf=dbFA($tf)){
							$mstr_family[$rf['dcid']]=$rf['name'];
						}
						
						?>
						<div class="sfont" style="padding:5px 0 5px 0;background:#ededff;">
							<b><?=$r['fname']?>'s Family:</b>
						</div><br/>
						<table class="tablex" border="0" cellspacing="1px" width="850px">
						<tr class="tablexhead">
							<th>Relatives</th>
							<th>Name</th>
							<th>Address</th>
							<th>Education</th>
							<th>Birth place</th>
							<th>Birth date</th>
							<th>Occupation</th>
							<th style="text-align:center">Option</th>
						</tr>
						<?php $is=0; while($rpf=mysql_fetch_array($tpf)){?>
						<tr>
							<td width="70"><?=$mstr_family[$rpf['family']]?></td>
							<td width="*"><?=$rpf['name']?></td>
							<td width="180px"><?=$rpf['address']?></td>
							<td width="70px"><?=$rpf['education']?></td>
							<td width="100px"><?=$rpf['birthplace']?></td>
							<td width="100px"><?=fftgl($rpf['birthdate'])?></td>
							<td width="100px"><?=$rpf['job']?></td>
							<td width="60px" align="center">
								<button class="btnedit" title="Edit" onclick="pf_family('uf',<?=$rpf['dcid']?>)"></button>
								<button class="btndel" title="Delete" onclick="pf_family('df',<?=$rpf['dcid']?>)"></button>
							</td>
						</tr>
						<?php }?>
						</table>
						<?php } else {?>
							<div class="sfont" style="padding:5px 0 5px 0">
								<i>There is no family data.</i>
							</div><br/>
						<?php }?>
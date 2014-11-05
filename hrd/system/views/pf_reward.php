						<?php
						$tpf=mysql_query("SELECT * FROM emp_reward WHERE empid='".$r['dcid']."' ORDER BY dcid");
						$npf=mysql_num_rows($tpf);
						if($npf>0){
						$rpf=mysql_fetch_array($t);
						$filelist=Array();
						$tf=dbSel("dcid,file","emp_files","W/empid='".$r['dcid']."'");
						while($rf=dbFA($tf)){
							$filelist[$rpf['dcid']]=$rf['file'];
						}
						?>
						<div class="sfont" style="padding:5px 0 5px 0;background:#ededff;">
							<b><?=$r['fname']?>'s Reward<?=($npf>1?"s":"")?>:</b>
						</div><br/>
						<table class="tablex" border="0" cellspacing="1px">
						<tr class="tablexhead">
							<th>Reward</th>
							<th>Date</th>
							<th>Description</th>
							<th style="text-align:center">Attachment</th>
							<th style="text-align:center">Option</th>
						</tr>
						<?php $is=0; while($rpf=mysql_fetch_array($tpf)){?>
						<tr>
							<td width="160px"><?=$rpf['reward']?></td>
							<td width="220px"><?=ftgl($rpf['date'])?></td>
							<td width="160px"><?=$rpf['description']?></td>
							<td width="60px" align="center"><table style="border:none;background:none" cellspacing="0" cellpadding="0"><tr>
							<?php if($rpf['file']!=0){
								$tfile=dbSel("file","emp_files","W/dcid='".$rpf['file']."'");
								if(mysql_num_rows($tfile)>0){
								$rfile=mysql_fetch_array($tfile);
								?><td style="border:none;background:none">
								<a class="filebtn" href="<?=FLNK.$rfile['file']?>" target="_blank" title="Open attachment file">
									<div style="background:url('<?=IMGR?>bi_file.png') no-repeat;width:24px;height:24px"></div>
								</a></td>
							<?php } else {
								dbUpdate("emp_education",Array('file'=>0),"dcid='".$rpf['dcid']."'");
							}}?>
							</tr></table></td>
							<td width="60px" align="center">
								<!--button class="btnedit" title="Edit" onclick="pf_document('uf',<?=$rpf['dcid']?>)"></button-->
								<button class="btndel" title="Delete" onclick="pf_reward('df',<?=$rpf['dcid']?>)"></button>
							</td>
						</tr>
						<?php }?>
						</table>
						<?php } else {?>
							<div class="sfont" style="padding:5px 0 5px 0">
								<i><?=$r['fname']?> is have no reward.</i>
							</div><br/>
						<?php }
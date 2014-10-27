						<?php
						$tpf=mysql_query("SELECT * FROM emp_education WHERE empid='".$r['dcid']."' ORDER BY dcid DESC");
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
							<b><?=$r['fname']?>'s Education histor<?=($npf>1?"ies":"y")?>:</b>
						</div><br/>
						<table class="tablex" border="0" cellspacing="1px" width="700px">
						<tr class="tablexhead">
							<th>University</th>
							<th>Year</th>
							<th>Title</th>
							<th>Field</th>
							<th>GPA</th>
							<th style="text-align:center">Document</th>
							<th style="text-align:center">Option</th>
						</tr>
						<?php $is=0; while($rpf=mysql_fetch_array($tpf)){?>
						<tr>
							<td width="*"><?=$rpf['university']?></td>
							<td width="100px"><?=$rpf['year']?></td>
							<td width="100px"><?=$rpf['title']?></td>
							<td width="100px"><?=$rpf['field']?></td>
							<td width="100px"><?=$rpf['score']?></td>
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
								<button class="btnedit" title="Edit" onclick="pf_education('uf',<?=$rpf['dcid']?>)"></button>
								<button class="btndel" title="Delete" onclick="pf_education('df',<?=$rpf['dcid']?>)"></button>
							</td>
						</tr>
						<?php }?>
						</table>
						<?php } else {?>
							<div class="sfont" style="padding:5px 0 5px 0">
								<i>There is no training record of <?=$r['fname']?>.</i>
							</div><br/>
						<?php }?>
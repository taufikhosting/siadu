						<?php
						$mtype=gpost('mtype');
						$mid=trim(gpost('mid'));
						if($mid!=''){
						if($mtype=='m'){
							$sql="SELECT * FROM catalog ".$filt." ORDER BY title";
							$mmt="student name or NIS";
						} else {
							$sql="SELECT * FROM `joshr`.`employee` WHERE `name` LIKE '%$mid%' OR `nip` LIKE '$mid%'";
							$mmt="staff name or NIP";
						}
						$tpf=mysql_query($sql);
						$npf=mysql_num_rows($tpf);
						//echo $sql;
						function src_replace($v){global $mid;return preg_replace("/".$mid."/i", "<strong>\$0</strong>", $v);}
						if($npf>0){ $l=1;
						?>
						<div class="pfsub" style="">Select member:</div>
						<div style="width:480px;height:280px;overflow:auto;margin-top:0px">
							<table class="sfont" border="0" cellspacing="0" width="100%">
							<?php $is=0; while($rpf=mysql_fetch_array($tpf)){ $k=$k=="#f4f4f4"?"#ffffff":"#f4f4f4"; $ids.="-".$rpf['dcid'];?>
							<tr height="30px" style="background:<?=$k?>">
								<td class="sfont" width="*" style="padding-left:6px"><?=str_replace("\'","'",src_replace($rpf['name']))?></td>
								<td class="sfont" width="100px" align="right" style="padding-right:10px"><?=src_replace($rpf['nip'])?></td>
								<td class="sfont" width="50px">
									<input type="button" class="btn" value="Select" onclick="jumpTo('<?=RLNK?>borrowing.php?mtype=<?=$mtype?>&mid=<?=$rpf['dcid']?>')"/>
								</td>
							</tr>
							<?php }?>
							</table>
						</div>
						<?php } else {?>
							<div class="sfont" style="color:#008ee8;padding-top:38px"><?=$mid!="-"?"<b>".$mid."</b> does not match with any ".$mmt:"Selected criteria does not match with any ".$mmt?>.</div>
						<?php }}  ?>
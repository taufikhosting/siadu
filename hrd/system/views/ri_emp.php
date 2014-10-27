						<?php
						$mstr_status=MstrGet("mstr_status",true,"any status");
						$mstr_level=MstrGet("mstr_level",true,"any level");
						$mstr_group=MstrGet("mstr_group",true,"any group");
						$mstr_division=MstrGet("mstr_division",true,"any division");

						$keyw=trim(getsx('k'));
						$npf=0; $ids="ALL";
						if($keyw!=''){
						$ids="0";
						// Searching
						$filt=$keyw=="-"?"":"(name LIKE '%$keyw%' OR nip='$keyw')";
						
						$filt.=(gpost('status')=="0"||gpost('status')=="")?"":($filt==""?"":" AND ")."`status`='".gpost('status')."'";
						$filt.=(gpost('group')=="0"||gpost('group')=="")?"":($filt==""?"":" AND ")."`group`='".gpost('group')."'";
						$filt.=(gpost('level')=="0"||gpost('level')=="")?"":($filt==""?"":" AND ")."`level`='".gpost('level')."'";
						$filt.=(gpost('division')=="0"||gpost('division')=="")?"":($filt==""?"":" AND ")."`division`='".gpost('division')."'";
						if($filt!="") $filt=" WHERE ".$filt;
						$sql="SELECT * FROM employee ".$filt." ORDER BY name";
						$tpf=mysql_query($sql);
						$npf=mysql_num_rows($tpf);
						//echo $sql;
						function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<b>\$0</b>", $v);}
						if($npf>0){ $l=1;
						?>
						<div class="pfsub" style="padding-left:10px">Select employee(s):</div>
						<div style="width:380px;height:240px;border-left:1px solid #f4f4f4;padding-left:10px;overflow:auto;margin-top:0px">
							<table class="sfont" border="0" cellspacing="0" width="100%">
							<?php if($npf>1){ $l=0;?>
							<tr height="24px" style="background:#ffffff">
								<td align="center" width="24px"><input checked id="ri_emp<?=($l++)?>" class="iCheck" type="checkbox" value="" onclick="checkAll(this.checked)"/></td>
								<td class="sfont" width="" style="color:#008ee8"><label for="ri_emp0"><b>All</b></label></td>
								<td class="sfont" width=""></td>
							</tr>
							<?php } $is=0; while($rpf=mysql_fetch_array($tpf)){ $k=$k=="#f4f4f4"?"#ffffff":"#f4f4f4"; $ids.="-".$rpf['dcid'];?>
							<tr height="24px" style="background:<?=$k?>">
								<td align="center" width="24px"><input checked id="ri_emp<?=($l++)?>" class="iCheck" type="checkbox" value="<?=$rpf['dcid']?>" onclick="selCheck()"/></td>
								<td class="sfont" width="*"><label for="ri_emp<?=($l-1)?>"><div style="width:100%"><?=src_replace($rpf['name'])?></div></label></td>
								<td class="sfont" width="100px"><?=src_replace($rpf['nip'])?></td>
							</tr>
							<?php }?>
							</table>
						</div>
						<?php } else {?>
							<div class="sfont" style="color:#008ee8;padding-top:38px"><?=$keyw!="-"?"<b>".$keyw."</b> does not match with any employee name or nip":"Selected criteria does not match with any employee"?>.</div>
						<?php } } ?>
						<input type="hidden" id="ri_emp_num" value="<?=$npf?>"/>
						<form name="ri_form" action="<?=RLNK?>report_individual.php" target="_blank" method="get" style="display:hidden">
						<input type="hidden" name="ids" id="ri_emp_ids" value="<?=$ids?>"/>
						<input type="hidden" name="dps" id="dps" value="0-1-1-1-1-1-1-1-1-1-1"/>
						</form>
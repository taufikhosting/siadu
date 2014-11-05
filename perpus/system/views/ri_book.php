						<?php
						$mstr_author=Array();
						$t=dbSel("*","mstr_author","O/ prefix");
						$mstr_author[0]='any author';
						while($r=dbFA($t)){
							$mstr_author[$r['dcid']]=$r['name']." (".$r['prefix'].")";
						}
						$mstr_publisher=Array();
						$mstr_publisher[0]='any publisher';
						$t=dbSel("*","mstr_publisher","O/ name");
						while($r=dbFA($t)){
							$mstr_publisher[$r['dcid']]=$r['name'];
						}
						$mstr_language=Array();
						$mstr_language[0]='any language';
						$t=dbSel("*","mstr_language","O/ name");
						while($r=dbFA($t)){
							$mstr_language[$r['dcid']]=$r['name'];
						}
						//$mstr_class=MstrGetx("mstr_class","code");
						//$mstr_language=MstrGet("mstr_language");

						$keyw=trim(getsx('k'));
						$npf=0; $ids="ALL";
						if($keyw!=''){
						$ids="0";
						// Searching
						$filt=$keyw=="-"?"":"(title LIKE '%$keyw%' OR callnumber LIKE '%$keyw%')";
						
						$filt.=(gpost('author')=="0"||gpost('author')=="")?"":($filt==""?"":" AND ")."`author`='".gpost('author')."'";
						$filt.=(gpost('publisher')=="0"||gpost('publisher')=="")?"":($filt==""?"":" AND ")."`publisher`='".gpost('publisher')."'";
						$filt.=(gpost('language')=="0"||gpost('language')=="")?"":($filt==""?"":" AND ")."`language`='".gpost('language')."'";
						if($filt!="") $filt=" WHERE ".$filt;
						$sql="SELECT * FROM catalog ".$filt." ORDER BY title";
						$tpf=mysql_query($sql);
						$npf=mysql_num_rows($tpf);
						//echo $sql;
						function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<strong>\$0</strong>", $v);}
						if($npf>0){ $l=1;
						?>
						<div class="pfsub" style="padding-left:10px">Select catalog(s):</div>
						<div style="width:480px;height:240px;border-left:1px solid #f4f4f4;padding-left:10px;overflow:auto;margin-top:0px">
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
								<td class="sfont" width="*"><label for="ri_emp<?=($l-1)?>"><div style="width:100%"><?=str_replace("\'","'",src_replace($rpf['title']))?></div></label></td>
								<td class="sfont" width="100px"><?=src_replace($rpf['callnumber'])?></td>
							</tr>
							<?php }?>
							</table>
						</div>
						<?php } else {?>
							<div class="sfont" style="color:#008ee8;padding-top:38px"><?=$keyw!="-"?"<b>".$keyw."</b> does not match with any catalog title or callnumber":"Selected criteria does not match with any catalog"?>.</div>
						<?php } } ?>
						<input type="hidden" id="ri_emp_num" value="<?=$npf?>"/>
						<form name="ri_form" action="<?=RLNK?>stockopname.php" target="_blank" method="get" style="display:hidden">
						<input type="hidden" name="ids" id="ri_emp_ids" value="<?=$ids?>"/>
						<input type="hidden" name="dps" id="dps" value="0-1-1-1-1-1-1-1-1-1"/>
						<input type="hidden" id="rauthor" name="author" value=""/>
						<input type="hidden" id="rpublisher" name="publisher" value=""/>
						<input type="hidden" id="rlanguage" name="language" value=""/>
						</form>
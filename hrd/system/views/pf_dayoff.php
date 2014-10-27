<?php
						if(true){
						//$MNTHNX=Array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
						//$cmonth = intval(date("m"));
						$cmonth=intval($cmonth);
						$xcmonth=intval($cmonth);
						$cyear=intval(date("Y")); $xcyear=$cyear;
						$num=cal_days_in_month(CAL_GREGORIAN,$cmonth,$cyear);
						
						$dcuti=Array();
						for($i=1;$i<=num;$i++){
							$dcuti[$i]=Array();
							$dcuti[$i]['v']=0;
							$dcuti[$i]['f']=0;
							$dcuti[$i]['id']=0;
							$dcuti[$i]['tgrup']='';
							$dcuti[$i]['info']='';
							$dcuti[$i]['tgl1']='0000-00-00';
							$dcuti[$i]['tgl2']='0000-00-00';
						}
						$tpf=mysql_query("SELECT * FROM emp_dayoff WHERE `empid`='".$r['dcid']."' AND `date1y`='$cyear' AND `date2y`='$cyear'");
						$hcuti=0;
						while($rpf=mysql_fetch_array($tpf)){
							$hcuti+=$rpf['count'];
							if($rpf['date1m']==$cmonth){
							$d1=$rpf['date1d'];
							$d2=$rpf['date2d'];
							$tg=EmpDayoffGroup($rpf['date1'],$rpf['date2']);
							if($rpf['count']>1){
								$tg="new Array(".$tg.")";
							}
							for($i=$d1;$i<=$d2;$i++){
								$dcuti[$i]['v']=1;
								$dcuti[$i]['id']=$rpf['dcid'];
								$dcuti[$i]['tgrup']=$tg;
								$dcuti[$i]['tgl1']=$rpf['date1'];
								$dcuti[$i]['tgl2']=$rpf['date2'];
								if($rpf['note']!='')
								$dcuti[$i]['info']=$rpf['note'];
								else
								$dcuti[$i]['info']="?";
								if($i==$d1){
									$dcuti[$i]['f']=1;
								}
							}
							}
						}
						//$scuti=getMaxCuti($r['empbagian'])-$hcuti;
						$mc=EmpGetMaxDayoff($r['division']);
						if($mc!="E") $scuti=$mc-$hcuti;
						else $scuti=12-$hcuti;
						?>
						<input type="hidden" id="scuti" value="<?=$scuti?>"/>
						<div class="sfont" style="padding:5px 0 5px 0;background:#ededff;">
							<b><?=$r['fname']?>'s day off in this year is <span style="color:#008000"><?=$hcuti?> Day<?=$hcuti>1?"s":""?></span></b><?php if($mc!="E"){?>&nbsp;&nbsp;
							&bull; &nbsp;&nbsp;Day off remaining: <span <?=(($scuti<=0)?"style=\"color:#ff0000\"":"")?>><b><?=$scuti?> dari<?=$scuti>1?"s":""?></b></span><?php }?>.
						</div><br/>
						<table cellspacing="0" cellpadding="0" style="margin-bottom:10px" width="880px"><tr>
						<td>
							<button id="addStatBtn" class="btn" onclick="addCuti()">
							<div style="background:url('<?=IMGR?>addico.png') no-repeat;padding-left:16px">Day off request</div>
							</button>
						</td>
						<td align="right">
							<a href="javascript:void(0)" onclick="switch_cmon(-1)" class="linkb11">< Previuous month</a> <a title="Now" href="javascript:void(0)" onclick="switch_cmon(0)" class="linkb11">[&bull;]</a> <a href="javascript:void(0)" onclick="switch_cmon(1)" class="linkb11">Next month ></a>
						</td>
						</tr></table>
						<div id="pfb_cuti_data" style="padding:10px;background:#ededff;border:1px solid #cdcdef">
							<div class="sfont" style="height:24px">
								<b><?=$MNTHN[$cmonth]?> <?=$cyear?></b>
							</div>
							<table class="tablex" cellspacing="0" cellpadding="2px">
							<tr>
								<td align="">Monday</td>
								<td align="">Tuesday</td>
								<td align="">Wednesday</td>
								<td align="">Thursday</td>
								<td align="">Friday</td>
								<td align="">Saturday</td>
								<td align="">Monday</td>
							</tr>
							<?php
							$fday = date("N", mktime(0, 0, 0, $cmonth, 1, $cyear));
							if($cmonth==1){
								$cmonth=12;
								$cyear-=1;
							} else {
								$cmonth-=1;
							}
							//$lnum = cal_days_in_month(CAL_GREGORIAN,$cmonth, $cyear);
							$sd=false; $ddt=1; $nweek=5;
							if(($fday+$num)>36) $nweek=6;
							for($y=0;$y<$nweek;$y++){ ?>
							<tr height="100px">
							<?php for($i=1;$i<8;$i++){if($y==0 && $i==$fday) $sd=true;if($sd){
							
							
							/* Date Box here */
							if($dcuti[$ddt]['v']==1){?>
								<td id="ctgl<?=$ddt?>" width="115px" style="opacity:1;cursor:default" onmouseover="hltgl(<?=$dcuti[$ddt]['tgrup']?>)" onmouseout="dhltgl(<?=$dcuti[$ddt]['tgrup']?>)">
									<table class="ctgl_box" cellspacing="0" cellpadding="2px" width="115px" style="border:none">
										<tr><td>
										<input type="button" class="ceditbtn" style="display:none" id="ceimg<?=$ddt?>" title="Edit" onclick="editCuti(<?=$dcuti[$ddt]['id']?>)"/>
										<input type="button" class="cdelbtn" style="margin-left:6px;display:none" id="cdimg<?=$ddt?>" title="Delete" onclick="delCuti(<?=$dcuti[$ddt]['id']?>)"/>
										</td><td align="right"><div class="tglcuti"><?=$ddt?></div></td></tr>
										<tr height="56px" align="center"><td colspan="2"><?=$dcuti[$ddt]['info']?></td></tr>
									</table>
								</td>
							<?php } else { ?>
								<td id="ctgl<?=$ddt?>" width="115px" style="background:#f8fbfd" onmouseover="htgl(<?=$ddt?>)" onmouseout="dhtgl(<?=$ddt?>)">
									<table class="ctgl_box" cellspacing="0" cellpadding="2px" width="115px" style="border:none">
										<tr><td align="right"><div><?=$ddt?></div></td></tr>
										<tr height="56px" align="center"><td><input type="button" class="cplusbtn" style="display:none" id="cpimg<?=$ddt?>" title="Add day off" onclick="addDCuti('<?=($xcyear."-".$xcmonth."-".$ddt)?>')"/></td></tr>
									</table>
								</td>
							<?php } } else { ?><td width="115px"></td><?php } if($sd)$ddt++; if($ddt>$num) $sd=false; } ?>
							</tr>
							<?php } ?>
							</table>
						</div>
						<? } else {?>
							<span class="sfont"><i>Cuti hanya diperbolehkan bagi karyawan <b>Non-Akademik</b>.</i></span><br/><br/>
						<?php }?>
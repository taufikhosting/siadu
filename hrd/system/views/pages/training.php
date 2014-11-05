						<div id="pfb_training_data">
						<?php
						$tpf=mysql_query("SELECT * FROM jbssdm.empapp_training WHERE empappid='".$r['dcid']."' ORDER BY dcid");
						if(mysql_num_rows($tpf)>0){
						?>
						<div class="sfont" style="height:24px"><b>Riwayat Training <?=$r['fname']?>:</b></div>
						<table class="tablex" border="0" cellspacing="1px">
						<tr class="tablexhead">
							<th>Judul</th>
							<th>Jenis</th>
							<th>Penyelenggara</th>
							<th>Tempat</th>
							<th>Tanggal</th>
							<th>Peserta</th>
							<th>Pilihan</th>
						</tr>
						<?php while($rpf=mysql_fetch_array($tpf)){?>
						<tr>
							<td width="200px"><?=$rpf['judul']?></td>
							<td width="70px" align="center"><?=$rpf['jenis']?></td>
							<td width="100px"><?=$rpf['penyelenggara']?></td>
							<td width="120px"><?=$rpf['tempat']?></td>
							<td width="160px" align="center"><?php echo ftgl($rpf['tanggal1']); if(diffDay($rpf['tanggal1'],$rpf['tanggal2'])>1) echo " s/d ".ftgl($rpf['tanggal2']);?></td>
							<td width="120px"><?=$rpf['peserta']?></td>
							<td width="60px" align="center">
								<button class="btnedit" title="Edit data training" onclick="editTrain(<?=$rpf['dcid']?>)"></button>
								<button class="btndel" title="Hapus data training" onclick="delTrain(<?=$rpf['dcid']?>)"></button>
							</td>
						</tr>
						<?php }?>
						</table>
						<?php } else {?>
							<span class="sfont"><i>Belum ada data training karyawan.</i></span><br/><br/>
						<?php }?>
						</div>
						<button id="addStatBtn" class="btn" title="Menambah data training baru" onclick="addTrain()" style="margin-top:10px">
						<div style="background:url('<?=IMGR?>addico.png') no-repeat;padding-left:16px">Data Training</div>
						</button>
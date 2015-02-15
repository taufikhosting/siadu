<?php
echo '<table cellspacing="0" cellpadding="0" width="100%"><tr valign="top">';
	echo '<td width="300px"><div style="margin-right:10px">';
		require_once(APPDIR.'pembayaran_siswa_get.php');
	echo '</div></td>';
	echo '<td width="*"><div style="">';
		require_once(APPDIR.'pembayaran_data_get.php');
	echo '</div></td>';
echo '</tr><tr>';
	echo '<td colspan="2">';
		require_once(APPDIR.'pembayaran_transaksi_get.php');
	echo '</td>';
echo '</tr></table>';
?>
<h4 class="page-header">Laporan Biaya Pengeluaran</h4>
<table class="table table-striped">
	<thead>
		<tr>
			<th width="50">No</th>
			<th>Pengguna</th>
			<th>Tanggal</th>
			<th>Nama</th>
			<th>Total Biaya</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
			foreach($lists as $l){
				$tgl = strtotime($l->DATE); $tgl = date('d M Y', $tgl);
				$rows = '<tr>';
				$rows .= '<td>'.$no.'</td>';
				$rows .= '<td>'.$l->USER_NAME.'</td>';
				$rows .= '<td>'.$tgl.'</td>';
				$rows .= '<td>'.$l->NAME.'</td>';
				$rows .= '<td>'.currency_idr($l->TOTAL_COST).'</td>';
				$rows .= '</tr>';
				
				$dari = strtotime($min); $dari = date('Y-m-d', $dari);
				$sampai = strtotime($max); $sampai = date('Y-m-d', $sampai);
				$tanggal = strtotime($l->DATE); $tanggal = date("Y-m-d", $tanggal);
				
				if($user != "" && $min != "" && $max != ""){
					if($l->USER_ID == $user && $tanggal >= $dari && $tanggal <= $sampai){
						echo $rows;
						$no += 1;
					}
				}elseif($user != "" && $min == "" && $max == ""){
					if($l->USER_ID == $user){
						echo $rows;
						$no += 1;
					}
				}elseif($user == "" && $min != "" && $max != ""){
					if($tanggal >= $dari && $tanggal <= $sampai){
						echo $rows;
						$no += 1;
					}
				}else{
					echo $rows;
					$no += 1;
				}
			}
		?>
	</tbody>
</table>
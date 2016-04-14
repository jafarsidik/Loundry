<h4 class="page-header">Laporan Pelanggan</h4>
<table class="table table-striped">
	<thead>
		<tr>
			<th width="50">No</th>
			<th>Jenis</th>
			<th>Pengguna</th>
			<th>Pemilik</th>
			<th>Pelanggan</th>
			<th>Alamat</th>
			<th>Telepon</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
			foreach($lists as $l){
				$rows = '<tr>';
				$rows .= '<td>'.$no.'</td>';
				$rows .= '<td>'.$l->TYPE_NAME.'</td>';
				$rows .= '<td>'.$l->USER_NAME.'</td>';
				$rows .= '<td>'.$l->OWNER.'</td>';
				$rows .= '<td>'.$l->NAME.'</td>';
				$rows .= '<td>'.$l->ADDRESS.'</td>';
				$rows .= '<td>'.$l->PHONE.'</td>';
				$rows .= '<td>'.$l->EMAIL.'</td>';
				$rows .= '</tr>';
				
				if($type != ""){
					if($l->CUSTOMER_TYPE_ID == $type){
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
	</form>
</table>
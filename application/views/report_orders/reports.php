<h4 class="page-header">Laporan Pesanan</h4>
<table class="table table-striped">
	<thead>
		<tr>
			<th width="50">No</th>
			<th>No Pesanan</th>
			<th>Tanggal Pesan</th>
			<th>Tenggat Waktu</th>
			<th>Tanggal Pengambilan</th>
			<th>Kasir</th>
			<th>Pelanggan</th>
			<th>Total Bayar</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
			foreach($lists as $l){
				date_default_timezone_set('Asia/Jakarta');
				$date_order = strtotime($l->DATE_ORDER); $date_order = date("d M Y", $date_order);
				$deadline = strtotime($l->DEADLINE); $deadline = date("d M Y", $deadline);
				if($l->DATE_RETRIEVAL != ""){
					$date_retrieval = strtotime($l->DATE_RETRIEVAL); 
					$date_retrieval = date("d M Y", $date_retrieval);
				}else{ $date_retrieval = "-"; }
				switch($l->ORDER_STATUS){
					case 0: $status_order = "Expired / In Process"; break;
					case 1: $status_order = "Pending"; break;
					case 2: $status_order = "Ready / In Delivery"; break;
					case 3: $status_order = "Complete"; break;
				}
				$rows = '<tr>';
				$rows .= '<td>'.$no.'</td>';
				$rows .= '<td>'.$l->ORDER_NUMBER.'</td>';
				$rows .= '<td>'.$date_order.'</td>';
				$rows .= '<td>'.$deadline.'</td>';
				$rows .= '<td>'.$date_retrieval.'</td>';
				$rows .= '<td>'.$l->USER_NAME.'</td>';
				$rows .= '<td>'.$l->CUSTOMER_NAME.'</td>';
				$rows .= '<td>'.currency_idr($l->TOTAL_PAYMENT).'</td>';
				$rows .= '<td>'.$status_order.'</td>';
				$rows .= '</tr>';

				$rows .= '<tr>';
					$rows .= '<td colspan="9">';
						$rows .= '<h5 class="page-header">Daftar Item No Pesanan : '.$l->ORDER_NUMBER.'</h5>';
						$rows .= '<table class="table">';
							$rows .= '<thead>';
								$rows .= '<tr>';
									$rows .= '<th>Item Layanan</th>';
									$rows .= '<th>Harga</th>';
									$rows .= '<th>Jumlah</th>';
									$rows .= '<th>Total</th>';
								$rows .= '</tr>';
							$rows .= '</thead>';
							$rows .= '<tbody>';
							$ci =& get_instance();
							$detail_lists = $ci->call_sp("sel_ORDER_DETAILS", array($l->ORDER_ID));
							foreach($detail_lists as $det){
								$rows .= '<tr>';
									$rows .= '<td>'.$det->SERVICE_NAME.'</td>';
									$rows .= '<td>'.currency_idr($det->PRICE).'</td>';
									$rows .= '<td>'.$det->AMOUNT.'</td>';
									$rows .= '<td>'.currency_idr($det->TOTAL).'</td>';
								$rows .= '</tr>';
							}
							$rows .= '</tbody>';
						$rows .= '</table>';
					$rows .= '</td>';
				$rows .= '</tr>';
				
				$dari = strtotime($min); $dari = date('Y-m-d', $dari);
				$sampai = strtotime($max); $sampai = date('Y-m-d', $sampai);
				$tanggal_order = strtotime($l->DATE_ORDER); $tanggal_order = date("Y-m-d", $tanggal_order);
				if($cust != "" && $status != "" && $min != "" && $max != ""){
					if($l->CUSTOMER_ID == $cust && $l->ORDER_STATUS == $status && $tanggal_order >= $dari && $tanggal_order <= $sampai){
						echo $rows;
						$no += 1;
					}
				}elseif($cust != "" && $status != "" && $min == "" && $max == ""){
					if($l->CUSTOMER_ID == $cust && $l->ORDER_STATUS == $status){
						echo $rows;
						$no += 1;
					}
				}elseif($cust != "" && $status == "" && $min != "" && $max != ""){
					if($l->CUSTOMER_ID == $cust && $tanggal_order >= $dari && $tanggal_order <= $sampai){
						echo $rows;
						$no += 1;
					}
				}elseif($cust != "" && $status == "" && $min == "" && $max == ""){
					if($l->CUSTOMER_ID == $cust){
						echo $rows;
						$no += 1;
					}
				}elseif($cust == "" && $status != "" && $min != "" && $max != ""){
					if($l->ORDER_STATUS == $status && $tanggal_order >= $dari && $tanggal_order <= $sampai){
						echo $rows;
						$no += 1;
					}
				}elseif($cust == "" && $status != "" && $min == "" && $max == ""){
					if($l->ORDER_STATUS == $status){
						echo $rows;
						$no += 1;
					}
				}elseif($cust == "" && $status == "" && $min != "" && $max != ""){
					if($tanggal_order >= $dari && $tanggal_order <= $sampai){
						echo $rows;
						$no += 1;
					}
				}else{
					echo $rows; $no += 1;
				}
			}
		?>
	</tbody>
</table>
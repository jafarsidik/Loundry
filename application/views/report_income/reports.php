<h2 class="page-header">Laporan Pendapatan</h2>
<div class="form-group">
	<label class="control-label col-sm-2">Tanggal</label>
	<?php
		if($min != ""){
			$dari = strtotime($min); $dari = date('d M Y', $dari);
		}else{
			$dari = "-";
		}
		if($max != ""){
			$sampai = strtotime($max); $sampai = date('d M Y', $sampai);
		}else{
			$sampai = "-";
		}
	?>
	<div class="col-sm-10">: <?= $dari ?> s/d <?= $sampai ?></div>
</div>
<div style="clear:both;"></div>

<h4 class="page-header">Daftar Pendapatan</h4>
<table class="table table-striped">
	<thead>
		<tr>
			<th width="50">No</th>
			<th>Tanggal</th>
			<th>Pelanggan</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$grand_total_pendapatan = 0;
		$dari_tgl = strtotime($min); $dari_tgl = date('Y-m-d', $dari_tgl);
		$sampai_tgl = strtotime($max); $sampai_tgl = date('Y-m-d', $sampai_tgl);
		foreach($order_lists as $l){
			if($l->ORDER_STATUS==3){
				date_default_timezone_set('Asia/Jakarta');
				$tgl = strtotime($l->DATE_ORDER); $tgl = date('d M Y', $tgl);

				$rows = '<tr>';
				$rows .= '<td>'.$no.'</td>';
				$rows .= '<td>'.$tgl.'</td>';
				$rows .= '<td>'.$l->CUSTOMER_NAME.'</td>';
				$rows .= '<td>'.currency_idr($l->TOTAL_PAYMENT).'</td>';
				$rows .= '</tr>';

				$order_tgl = strtotime($l->DATE_ORDER); $order_tgl = date('Y-m-d', $order_tgl);
				if($min != "" && $max != ""){
					if($order_tgl >= $dari_tgl && $order_tgl <= $sampai_tgl){
						echo $rows; $no += 1; $grand_total_pendapatan += $l->TOTAL_PAYMENT;	
					}
				}elseif($min != "" && $max == ""){
					if($order_tgl >= $dari_tgl){
						echo $rows; $no += 1; $grand_total_pendapatan += $l->TOTAL_PAYMENT;	
					}
				}elseif($min == "" && $max != ""){
					if($order_tgl <= $sampai_tgl){
						echo $rows; $no += 1; $grand_total_pendapatan += $l->TOTAL_PAYMENT;	
					}
				}else{
					echo $rows; $no += 1; $grand_total_pendapatan += $l->TOTAL_PAYMENT;
				}
			}
		}
	?>
	</tbody>
</table>
<div class="row">
	<div class="col-md-offset-7 col-md-5">
		<div class="form-group">
			<label class="control-label col-sm-4">Total Pendapatan</label>
			<div class="col-sm-8">: <?= currency_idr($grand_total_pendapatan) ?></div>
		</div>
	</div>
</div>

<h4 class="page-header">Daftar Pengeluaran</h4>
<table class="table table-striped">
	<thead>
		<tr>
			<th width="50">No</th>
			<th>Tanggal</th>
			<th>Nama</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$grand_total_pengeluaran = 0;
		foreach($operational_cost_lists as $l){
			date_default_timezone_set('Asia/Jakarta');
			$tgl = strtotime($l->DATE); $tgl = date('d M Y', $tgl);

			$rows = '<tr>';
			$rows .= '<td>'.$no.'</td>';
			$rows .= '<td>'.$tgl.'</td>';
			$rows .= '<td>'.$l->NAME.'</td>';
			$rows .= '<td>'.currency_idr($l->TOTAL_COST).'</td>';
			$rows .= '</tr>';

			$tanggal = strtotime($l->DATE); $tanggal = date('Y-m-d', $tanggal);
			if($min != "" && $max != ""){
				if($tanggal >= $dari_tgl && $tanggal <= $sampai_tgl){
					echo $rows; $no += 1; $grand_total_pengeluaran += $l->TOTAL_COST;
				}
			}elseif($min != "" && $max == ""){
				if($tanggal >= $dari_tgl){
					echo $rows; $no += 1; $grand_total_pengeluaran += $l->TOTAL_COST;
				}
			}elseif($min == "" && $max != ""){
				if($tanggal <= $sampai_tgl){
					echo $rows; $no += 1; $grand_total_pengeluaran += $l->TOTAL_COST;
				}
			}else{
				echo $rows; $no += 1; $grand_total_pengeluaran += $l->TOTAL_COST;
			}
		}
	?>
	</tbody>
</table>
<div class="row">
	<div class="col-md-offset-7 col-md-5">
		<div class="form-group">
			<label class="control-label col-sm-4">Total Pengeluaran</label>
			<div class="col-sm-8">: <?= currency_idr($grand_total_pengeluaran) ?></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-offset-7 col-md-5">
		<div class="form-group">
			<label class="control-label col-sm-4">Total Laba / Rugi</label>
			<div class="col-sm-8">: <?= currency_idr($grand_total_pendapatan - $grand_total_pengeluaran) ?></div>
		</div>
	</div>
</div>
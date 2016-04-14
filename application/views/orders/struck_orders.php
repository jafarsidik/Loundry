<h4 class="page-header">Struk Pesanan</h4>
<table width="100%">
	<tr>
		<td width="15%">No Pesanan</td>
		<td width="35%">: <?= $orders->ORDER_NUMBER ?></td>
		<td width="15%">Kasir</td>
		<td width="35%">: <?= $orders->USER_NAME ?></td>
	</tr>
	<tr>
		<td width="15%">Tanggal Pesan</td>
		<td width="35%">: <?= $orders->DATE_ORDER ?></td>
		<td width="15%"></td>
		<td width="35%"></td>
	</tr>
	<tr>
		<td width="15%">Tenggat Waktu</td>
		<td width="35%">: <?= $orders->DEADLINE ?></td>
		<td width="15%"></td>
		<td width="35%"></td>
	</tr>
</table>
<hr>
<table width="100%">
	<tr>
		<td width="15%">Pelanggan</td>
		<td width="35%">: <?= $orders->CUSTOMER_NAME ?></td>
		<td width="15%">Alamat</td>
		<td width="35%">: <?= $orders->ADDRESS ?></td>
	</tr>
	<tr>
		<td width="15%">Telepon</td>
		<td width="35%">: <?= $orders->PHONE ?></td>
		<td width="15%"></td>
		<td width="35%"></td>
	</tr>
	<tr>
		<td width="15%">Email</td>
		<td width="35%">: <?= $orders->EMAIL ?></td>
		<td width="15%"></td>
		<td width="35%"></td>
	</tr>
</table>
<hr>
<table width="100%">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="35%">Item Layanan</th>
			<th width="20%">Harga</th>
			<th width="20%">Jumlah</th>
			<th width="20%">Total</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		foreach($detail_lists as $l){
			echo '<tr>';
			echo '<td>'.$no.'</td>';
			echo '<td>'.$l->SERVICE_NAME.'</td>';
			echo '<td>'.currency_idr($l->PRICE).'</td>';
			echo '<td>'.$l->AMOUNT.'</td>';
			echo '<td>'.currency_idr($l->TOTAL).'</td>';
			echo '</tr>';
			$no++;
		}
	?>
	</tbody>
</table>
<hr>
<table width="100%">
	<tr>
		<td width="15%">Total Bayar</td>
		<td width="35%">: <?= currency_idr($orders->TOTAL_PAYMENT) ?></td>
		<td width="15%"></td>
		<td width="35%"></td>
	</tr>
	<tr>
		<td width="15%">Uang Muka</td>
		<td width="35%">: <?= currency_idr($orders->DOWN_PAYMENT) ?></td>
		<td width="15%"></td>
		<td width="35%"></td>
	</tr>
</table>
<h4 class="page-header">Laporan Daftar Layanan</h4>
<table class="table table-striped">
	<thead>
		<tr>
			<th width="50">No</th>
			<th>Kategori</th>
			<th>Item Layanan</th>
			<th>Ukuran</th>
			<th>Satuan</th>
			<th>Harga</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		foreach($lists as $l){
			$rows = '<tr>';
			$rows .= '<td>'.$no.'</td>';
			$rows .= '<td>'.$l->CATEGORY_NAME.'</td>';
			$rows .= '<td>'.$l->NAME.'</td>';
			$rows .= '<td>'.$l->SIZE.'</td>';
			$rows .= '<td>'.$l->UNIT.'</td>';
			$rows .= '<td>'.currency_idr($l->PRICE).'</td>';
			$rows .= '</tr>';
			
			if($category != "" && $min != "" && $max != ""){
				if($l->SERVICE_CATEGORY_ID == $category && $l->PRICE >= $min && $l->PRICE <= $max){
					echo $rows; 
					$no += 1;
				}
			}elseif($category != "" && $min != "" && $max == ""){
				if($l->SERVICE_CATEGORY_ID == $category && $l->PRICE >= $min){
					echo $rows; 
					$no += 1;
				}
			}elseif($category != "" && $min == "" && $max != ""){
				if($l->SERVICE_CATEGORY_ID == $category && $l->PRICE <= $max){
					echo $rows; 
					$no += 1;
				}
			}elseif($category != "" && $min == "" && $max == ""){
				if($l->SERVICE_CATEGORY_ID == $category){
					echo $rows; 
					$no += 1;
				}
			}elseif($category == "" && $min != "" && $max != ""){
				if($l->PRICE >= $min && $l->PRICE <= $max){
					echo $rows; 
					$no += 1;
				}
			}elseif($category == "" && $min != "" && $max == ""){
				if($l->PRICE >= $min){
					echo $rows; 
					$no += 1;
				}
			}elseif($category == "" && $min == "" && $max != ""){
				if($l->PRICE <= $max){
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
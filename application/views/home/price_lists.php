<?= $breadcrumb ?>
<div class="form-scroller">
	<h2 class="page-header">Daftar Harga</h2>
	<form action="<?= base_url($controller."/".$method) ?>" method="post">
		<div class="row">
			<div class="col-md-10">
				<input type="text" class="form-control search_typing" name="<?= $controller ?>[SEARCH_BY]" value="<?= (isset($search) ? $search['SEARCH_BY'] : "") ?>" maxlength="50" placeholder="Cari : Kategori, Nama" autofocus>
			</div>
			<div class="col-md-2 text-right">
				<button type="submit" class="btn btn-primary tooltips" title="Cari"><i class="fa fa-search"></i> <span>Cari</span></button>
			</div>
		</div>
	</form>
	<hr>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th width="40">No</th>
					<th>Kategori</th>
					<th>Nama</th>
					<th>Ukuran</th>
					<th>Satuan</th>
					<th>Harga</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$this->uri->segment(3)==true ? $num = $this->uri->segment(3) + 1 : $num = 1;
					foreach($lists as $l){
						echo '<tr>';
						echo '<td>'.$num.'</td>';
						echo '<td>'.$l->CATEGORY_NAME.'</td>';
						echo '<td>'.$l->NAME.'</td>';
						echo '<td>'.$l->SIZE.'</td>';
						echo '<td>'.$l->UNIT.'</td>';
						echo '<td>'.currency_idr($l->PRICE).'</td>';
						echo '</tr>';
						$num += 1;
					}
				?>
			</tbody>
		</table>
	</div>
	<?= $pagination ?>
</div>
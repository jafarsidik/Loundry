<?= $breadcrumb ?>
<h2 class="page-header">Daftar Pesanan</h2>
<div class="page-wrapper">
	<form action="<?= base_url($controller."/".$method) ?>" method="post">
	<div class="page-search">
		<div class="row">
			<div class="col-md-8">
				<input type="text" class="form-control search_typing" name="<?= $controller ?>[SEARCH_BY]" value="<?= (isset($search) ? $search['SEARCH_BY'] : "") ?>" maxlength="50" placeholder="Cari : No Pesanan, Tanggal Pesan" autofocus>
			</div>
			<div class="col-md-4">
				<button type="submit" class="btn btn-primary tooltips" style="float:left;margin-right:5px;" title="Cari"><i class="fa fa-search"></i> <span>Cari</span></button>
	</form>
				<a href="<?= base_url($controller.'/order') ?>" class="btn btn-primary tooltips" style="float:left;margin-right:5px;" title="Tambah"><i class="fa fa-plus"></i> <span>Tambah</span></a>
		<form action="<?= base_url($controller.'/order_delete') ?>" method="post">
				<button type="submit" class="btn btn-danger tooltips" style="float:left;margin-right:5px;" title="Hapus"><i class="fa fa-trash-o"></i> <span>Hapus</span></button>
			</div>
		</div>
	</div>
</div>
<div style="clear:both;"></div>
<hr>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th width="40">No</th>
				<th>No Pesanan</th>
				<th>Tanggal Pesan</th>
				<th>Uang Muka</th>
				<th>Total Bayar</th>
				<th>Sisa Bayar</th>
				<th>Status</th>
				<th class="dropdown" width="100">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Aksi <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
							<a href="javascript:void(0)" class="chkbox check-all tooltips" title="Pilih Semua">
								<label>
									<input type="checkbox" class="hidden">
									<span class="fa fa-lg"></span> Pilih Semua
								</label>
							</a>
						</li>
          </ul>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$this->uri->segment(3)==true ? $num = $this->uri->segment(3) + 1 : $num = 1;
				foreach($lists as $l){
					if($l->CUSTOMER_ID==$customer_id){
						switch($l->ORDER_STATUS){
							case 0: $status = "In Process"; $flag_status = 0; break;
							case 1: $status = "Pending"; $flag_status = 1; break;
							case 2: $status = "In Delivery"; $flag_status = 2; break;
							case 3: $status = "Complete"; $flag_status = 3; break;
						}
						echo '<tr>';
						echo '<td>'.$num.'</td>';
						echo '<td>'.$l->ORDER_NUMBER.'</td>';
						echo '<td>'.$l->DATE_ORDER.'</td>';
						echo '<td>'.currency_idr($l->DOWN_PAYMENT).'</td>';
						echo '<td>'.currency_idr($l->TOTAL_PAYMENT).'</td>';
						echo '<td>'.currency_idr($l->TOTAL_PAYMENT - $l->DOWN_PAYMENT).'</td>';
						echo '<td>'.$status.'</td>';
						echo '<td>';
							echo '<a href="'.base_url($controller.'/order_struck/'.$l->ORDER_ID).'" target="_blank" class="tooltips" title="Print"><i class="fa fa-print fa-lg"></i></a> ';
							if($flag_status==1){
								echo '<a href="'.base_url($controller.'/order_edit/'.$l->ORDER_ID).'" class="tooltips" title="Ubah"><i class="fa fa-edit fa-lg"></i></a> ';
								echo '<a href="'.base_url($controller.'/order_delete/'.$l->ORDER_ID).'" class="tooltips" title="Hapus"><i class="fa fa-trash-o fa-lg"></i></a> ';
								echo '<a href="javascript:void(0)" class="chkbox tooltips" title="Pilih"><label><input type="checkbox" class="hidden" name="'.$controller.'[DEL][]" value="'.$l->ORDER_ID.'"><span class="fa fa-lg"></span></label></a> ';
							}
						echo '</td>';
						echo '</tr>';
						$num += 1;
					}
				}
			?>
		</tbody>
		</form>
	</table>
</div>
<?= $pagination ?>
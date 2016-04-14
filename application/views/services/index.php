<?= $breadcrumb ?>
<h2 class="page-header">Daftar Layanan</h2>
<div class="page-wrapper">
	<form action="<?= base_url($controller) ?>" method="post">
	<div class="page-search">
		<div class="row">
			<div class="col-md-12">
				<input type="text" class="form-control search_typing" name="<?= $controller ?>[SEARCH_BY]" value="<?= (isset($search) ? $search['SEARCH_BY'] : "") ?>" maxlength="50" placeholder="Cari : Kategori, Item Layanan" autofocus>
			</div>
		</div>
	</div>
	<div class="page-button">
		<button type="submit" class="btn btn-primary tooltips" title="Cari"><i class="fa fa-search"></i> <span>Cari</span></button>
	</form>
		<a href="<?= base_url($controller.'/create') ?>" class="btn btn-primary tooltips" title="Tambah"><i class="fa fa-plus"></i> <span>Tambah</span></a>
		<form action="<?= base_url($controller.'/delete') ?>" method="post">
		<button type="submit" class="btn btn-danger tooltips" title="Hapus"><i class="fa fa-trash-o"></i> <span>Hapus</span></button>
	</div>
</div>
<div style="clear:both;"></div>
<hr>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="40">No</th>
				<th>Kategori</th>
				<th>Item Layanan</th>
				<th>Ukuran</th>
				<th>Satuan</th>
				<th>Harga</th>
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
					echo '<tr>';
					echo '<td>'.$num.'</td>';
					echo '<td>'.$l->CATEGORY_NAME.'</td>';
					echo '<td>'.$l->NAME.'</td>';
					echo '<td>'.$l->SIZE.'</td>';
					echo '<td>'.$l->UNIT.'</td>';
					echo '<td>'.currency_idr($l->PRICE).'</td>';
					echo '<td>';
						echo '<a href="'.base_url($controller.'/edit/'.$l->SERVICE_ID).'" class="tooltips" title="Ubah"><i class="fa fa-edit fa-lg"></i></a> ';
						echo '<a href="'.base_url($controller.'/delete/'.$l->SERVICE_ID).'" class="tooltips" title="Hapus"><i class="fa fa-trash-o fa-lg"></i></a> ';
						echo '<a href="javascript:void(0)" class="chkbox tooltips" title="Pilih"><label><input type="checkbox" class="hidden" name="'.$controller.'[DEL][]" value="'.$l->SERVICE_ID.'"><span class="fa fa-lg"></span></label></a> ';
					echo '</td>';
					echo '</tr>';
					$num += 1;
				}
			?>
		</tbody>
		</form>
	</table>
</div>
<?= $pagination ?>
<?= $breadcrumb ?>
<h2 class="page-header">Tambah Group Pengguna</h2>
<form class="form-horizontal" action="<?= base_url($controller.'/'.$method) ?>" method="post">
	<div class="form-group">
		<label class="control-label col-sm-2">Nama</label>
		<div class="col-sm-10">
			<input type="text" class="form-control required" name="<?= $controller ?>[NAME]" maxlength="100" placeholder="Nama" autofocus>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Keterangan</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="<?= $controller ?>[DESC]" maxlength="255" placeholder="Keterangan" rows="4"></textarea>
		</div>
	</div>

	<h4 class="page-header">Akses Group Pengguna</h4>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="dropdown">
						<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Kategori <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>
								<a href="javascript:void(0)" class="chkbox check-all-module tooltips" title="Pilih Semua">
									<label>
										<input type="checkbox" class="hidden">
										<span class="fa fa-lg"></span> Pilih Semua
									</label>
								</a>
							</li>
						</ul>
					</th>
					<th class="dropdown">
						<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Sub Kategori <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>
								<a href="javascript:void(0)" class="chkbox check-all-function tooltips" title="Pilih Semua">
									<label>
										<input type="checkbox" class="hidden">
										<span class="fa fa-lg"></span> Pilih Semua
									</label>
								</a>
							</li>
						</ul>
					</th>
					<th class="dropdown text-center" width="100">
						<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Baca <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>
								<a href="javascript:void(0)" class="chkbox check-all-read tooltips" title="Pilih Semua">
									<label>
										<input type="checkbox" class="hidden">
										<span class="fa fa-lg"></span> Pilih Semua
									</label>
								</a>
							</li>
						</ul>
					</th>
					<th class="dropdown text-center" width="100">
						<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Tambah <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>
								<a href="javascript:void(0)" class="chkbox check-all-create tooltips" title="Pilih Semua">
									<label>
										<input type="checkbox" class="hidden">
										<span class="fa fa-lg"></span> Pilih Semua
									</label>
								</a>
							</li>
						</ul>
					</th>
					<th class="dropdown text-center" width="100">
						<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Ubah <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>
								<a href="javascript:void(0)" class="chkbox check-all-edit tooltips" title="Pilih Semua">
									<label>
										<input type="checkbox" class="hidden">
										<span class="fa fa-lg"></span> Pilih Semua
									</label>
								</a>
							</li>
						</ul>
					</th>
					<th class="dropdown text-center" width="100">
						<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Hapus <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>
								<a href="javascript:void(0)" class="chkbox check-all-delete tooltips" title="Pilih Semua">
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
				foreach($module_lists as $module){
					echo '<tr group-module="'.$module->MODULE_ID.'">';
					echo '<td class="col-module"><a href="javascript:void(0)" class="chkbox chk-module tooltips" title="Pilih" val="'.$module->MODULE_ID.'"><label><input type="checkbox" class="hidden"><span class="fa fa-lg"></span></label></a> '.$module->MODULE_NAME.'</td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '</tr>';
					foreach($module_function_lists as $function){
						if($function->MODULE_ID==$module->MODULE_ID){
							echo '<tr group-module="'.$module->MODULE_ID.'" group-function="'.$function->MODULE_FUNCTION_ID.'">';
							echo '<td></td>';
							echo '<td class="col-function"><a href="javascript:void(0)" class="chkbox chk-function tooltips" title="Pilih" val="'.$function->MODULE_FUNCTION_ID.'"><label><input type="checkbox" class="hidden"><span class="fa fa-lg"></span></label></a> '.$function->MODULE_FUNCTION_NAME.'</td>';
							echo '<td class="col-read text-center"><a href="javascript:void(0)" class="chkbox tooltips" title="Pilih"><label><input type="checkbox" class="hidden" name="'.$controller.'[READ][]" value="'.$function->MODULE_FUNCTION_ID.'"><span class="fa fa-lg"></span></label></a></td>';
							echo '<td class="col-create text-center"><a href="javascript:void(0)" class="chkbox tooltips" title="Pilih"><label><input type="checkbox" class="hidden" name="'.$controller.'[CREATE][]" value="'.$function->MODULE_FUNCTION_ID.'"><span class="fa fa-lg"></span></label></a></td>';
							echo '<td class="col-edit text-center"><a href="javascript:void(0)" class="chkbox tooltips" title="Pilih"><label><input type="checkbox" class="hidden" name="'.$controller.'[EDIT][]" value="'.$function->MODULE_FUNCTION_ID.'"><span class="fa fa-lg"></span></label></a></td>';
							echo '<td class="col-delete text-center"><a href="javascript:void(0)" class="chkbox tooltips" title="Pilih"><label><input type="checkbox" class="hidden" name="'.$controller.'[DELETE][]" value="'.$function->MODULE_FUNCTION_ID.'"><span class="fa fa-lg"></span></label></a></td>';
							echo '</tr>';
						}
					}
				}
			?>
			</tbody>
		</table>
	</div>
	
  <div class="form-group">
    <div class="col-sm-12 text-center">
      <button type="submit" class="btn btn-primary validation"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Batal</button>
    </div>
  </div>
</form>
<script type="text/javascript" src="<?= js_url('modules/'.$controller.'/default.js') ?>"></script>
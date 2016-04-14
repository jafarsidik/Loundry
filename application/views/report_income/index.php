<?= $breadcrumb ?>
<h2 class="page-header">Laporan Pendapatan</h2>
<div class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-sm-2">Tanggal</label>
		<div class="col-sm-5">
			<input type="date" class="form-control" id="DATE_MIN" placeholder="Min">
		</div>
		<div class="col-sm-5">
			<input type="date" class="form-control" id="DATE_MAX" placeholder="Max">
		</div>
	</div>
	
	<div class="page-header"></div>
  <div class="form-group">
    <div class="col-sm-12 text-center">
      <button type="button" class="btn btn-primary btn-print"><i class="fa fa-print"></i> Print</button>
      <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Batal</button>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?= js_url('modules/'.$controller.'/default.js') ?>"></script>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= base_url() ?>" tabindex="-1">Pelangi Laundry & Dry Clean</a>
		</div>
		<div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
				<li><a href="<?= base_url() ?>"><span class="fa fa-home"></span> Home</a></li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-user"></span> <?= $current_user->USER_NAME ?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="javascript:void(0)">Info Akun</a></li>
            <li class="divider"></li>
            <li><a href="<?= base_url('home/signout') ?>">Keluar</a></li>
          </ul>
        </li>
      </ul>
		</div>
	</div>
</div>
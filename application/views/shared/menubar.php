<h3 class="masthead-brand">Pelangi Laundry & Dry Clean</h3>
<ul class="nav masthead-nav">
	<li <?php if($method=="index"){ ?> class="active" <?php } ?>><a href="<?= base_url($controller) ?>">Home</a></li>
	<li <?php if($method=="price_lists"){ ?> class="active" <?php } ?>><a href="<?= base_url($controller.'/price_lists') ?>">Daftar Harga</a></li>

	<?php if($this->session->userdata('current_user')==true){ ?>
		<li <?php if($method=="order_lists"){ ?> class="active" <?php } ?>><a href="<?= base_url($controller.'/order_lists') ?>">Daftar Pesanan</a></li>
		<li <?php if($method=="order"){ ?> class="active" <?php } ?>><a href="<?= base_url($controller.'/order') ?>">Pesanan</a></li>
	<?php } ?>

	<li <?php if($method=="contact"){ ?> class="active" <?php } ?>><a href="<?= base_url($controller.'/contact') ?>">Kontak</a></li>
</ul>
<h5 class="sidebartitle">Navigation</h5>
<ul class="nav nav-pills nav-stacked nav-bracket">
<li>
	<a href="<?php echo site_url('staff'); ?>">
  	<i class="fa fa-home"></i> <span>Anasayfa</span></a>
</li>

<li <?php echo $this->uri->segment('2') == 'hotels' ? 'class="active"' : ''; ?>>
	<a href="<?php echo site_url('staff/hotels'); ?>">
  	<i class="fa fa-building-o"></i> <span>Oteller</span></a>
</li>

<li <?php echo $this->uri->segment('2') == 'users' ? 'class="active"' : ''; ?>>
	<a href="<?php echo site_url('staff/users'); ?>">
  	<i class="fa fa-user"></i> <span>Kullanıcılar</span></a>
</li>
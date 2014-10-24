<?php
  $uri        = $this->uri->segment('2');
  $setup      = '';
  $setup_children = '';
  $prices     = '';
  $prices_children ='';
  $available  = '';
  $available_children ='';
?>

<h5 class="sidebartitle">Navigation</h5>
<ul class="nav nav-pills nav-stacked nav-bracket">
<li <?php echo $this->uri->segment('1') == 'dashboard' ? 'class="active"' : ''; ?>><a href="<?php echo site_url('dashboard'); ?>">
  <i class="fa fa-home"></i> <span><?php echo lang('dashboard'); ?></span></a>
</li>

<?php //'setup' menu active
if ($uri == 'hotels' or $uri == 'rooms' or $uri == 'extras' or $uri == 'extras' or $uri == 'seasons' or $uri == 'policies') {
 $setup = 'nav-active';
 $setup_children = 'style="display:block;"';
}
?>

<li class="nav-parent <?php echo $setup; ?>"><a href="#"><i class="fa fa-building-o"></i> <span><?php echo lang('setup_menu'); ?></span></a>
  <ul class="children" <?php echo $setup_children; ?>>
    <li <?php echo $uri=='hotels' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/hotels'); ?>"><i class="fa fa-caret-right"></i> <?php echo lang('hotels_menu'); ?></a>
    </li>
    <li <?php echo $uri=='rooms' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/rooms'); ?>"><i class="fa fa-caret-right"></i> <?php echo lang('rooms_menu'); ?></a>
    </li>
    <li <?php echo $uri=='extras' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/extras'); ?>"><i class="fa fa-caret-right"></i> <?php echo lang('extras_menu'); ?></a>
    </li>
    <li <?php echo $uri=='seasons' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/seasons'); ?>"><i class="fa fa-caret-right"></i> <?php echo lang('seasons_menu'); ?></a>
    </li>
    <li <?php echo $uri=='policies' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/policies'); ?>"><i class="fa fa-caret-right"></i> <?php echo lang('policies_menu'); ?></a>
    </li>
    <!-- 
    <li><a href="#"><i class="fa fa-caret-right"></i> İndirimler</a></li>
    <li><a href="#"><i class="fa fa-caret-right"></i> Ekstra Ücret</a></li>
    <li><a href="#"><i class="fa fa-caret-right"></i> Vergiler</a></li>
    -->
  </ul>
</li>

<?php //'prices' menu active
if ($uri == 'set_prices' or $uri=='price_plans') {
 $prices = 'nav-active';
 $prices_children = 'style="display:block;"';
}
?>

 <li class="nav-parent <?php echo $prices; ?>"><a href="#"><i class="fa fa-edit"></i> <span><?php echo lang('prices_menu'); ?></span></a>
  <ul class="children" <?php echo $prices_children; ?>>
    <li <?php echo $uri=='prices' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/prices'); ?>"><i class="fa fa-caret-right"></i> <?php echo lang('rate_available_menu'); ?></a>
    </li>
    <li <?php echo $uri=='set_prices' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/set_prices'); ?>"><i class="fa fa-caret-right"></i> <?php echo lang('price_update_menu'); ?></a>
    </li>
    <li <?php echo ($uri=='price_plans' and $this->uri->segment('3') =='') ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/price_plans'); ?>"><i class="fa fa-caret-right"></i> <?php echo lang('promotions_menu'); ?></a>
    </li>
    
    <li <?php echo $this->uri->segment('3') =='add_new' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/price_plans/add_new'); ?>"><i class="fa fa-caret-right"></i> <?php echo lang('add_promotion_menu'); ?></a>
    </li>

    
  </ul>
</li>

<?php  //'avalilable' menu active
if ($uri == 'prices') {
 $available = 'active';
 $available_children = 'style="display:block;"';
}
?>

<li class="<?php echo $available; ?>">
  <a href="<?php echo site_url('reservation/prices'); ?>"><i class="fa fa-file-text"></i> <span><?php echo lang('rate_available_menu'); ?></span></a>
</li>

</ul>

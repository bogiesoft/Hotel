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
  <i class="fa fa-home"></i> <span>Anasayfa</span></a>
</li>

<?php //'setup' menu active
if ($uri == 'hotels' or $uri == 'rooms' or $uri == 'extras' or $uri == 'extras' or $uri == 'seasons' or $uri == 'policies') {
 $setup = 'nav-active';
 $setup_children = 'style="display:block;"';
}
?>

<li class="nav-parent <?php echo $setup; ?>"><a href="#"><i class="fa fa-building-o"></i> <span>Setup</span></a>
  <ul class="children" <?php echo $setup_children; ?>>
    <li <?php echo $uri=='hotels' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/hotels'); ?>"><i class="fa fa-caret-right"></i> Tesisler</a>
    </li>
    <li <?php echo $uri=='rooms' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/rooms'); ?>"><i class="fa fa-caret-right"></i> Oda Tipleri</a>
    </li>
    <li <?php echo $uri=='extras' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/extras'); ?>"><i class="fa fa-caret-right"></i> Extralar</a>
    </li>
    <li <?php echo $uri=='seasons' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/seasons'); ?>"><i class="fa fa-caret-right"></i> Sezonlar</a>
    </li>
    <!-- 
    <li><a href="#"><i class="fa fa-caret-right"></i> İndirimler</a></li>
    <li><a href="#"><i class="fa fa-caret-right"></i> Ekstra Ücret</a></li>
    <li><a href="#"><i class="fa fa-caret-right"></i> Vergiler</a></li>
    -->
    <li><a href="#"><i class="fa fa-caret-right"></i> Poliçeler</a></li>
  </ul>
</li>

<?php //'prices' menu active
if ($uri == 'set_prices' or $uri=='price_plans') {
 $prices = 'nav-active';
 $prices_children = 'style="display:block;"';
}
?>

 <li class="nav-parent <?php echo $prices; ?>"><a href="#"><i class="fa fa-edit"></i> <span>Fiyatlar</span></a>
  <ul class="children" <?php echo $prices_children; ?>>
    <li <?php echo $uri=='prices' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/prices'); ?>"><i class="fa fa-caret-right"></i> Rate Availibility Plan</a>
    </li>
    <li <?php echo $uri=='set_prices' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/set_prices'); ?>"><i class="fa fa-caret-right"></i> Bulk Price Update</a>
    </li>
    <li <?php echo $this->uri->segment('3') =='add_new' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/price_plans/add_new'); ?>"><i class="fa fa-caret-right"></i> Add Promotion</a>
    </li>

    <li <?php echo ($uri=='price_plans' and $this->uri->segment('3') =='') ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('reservation/price_plans'); ?>"><i class="fa fa-caret-right"></i> Promotions</a>
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
  <a href="<?php echo site_url('reservation/prices'); ?>"><i class="fa fa-file-text"></i> <span>Rates & Availablity</span></a>
</li>

</ul>

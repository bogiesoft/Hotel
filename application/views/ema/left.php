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
<li <?php echo ($this->uri->segment('2') == 'index' or $this->uri->segment('2') == '' )? 'class="active"' : ''; ?>>
  <a href="<?php echo site_url('ema'); ?>">
  <i class="fa fa-home"></i> <span><?php echo lang('dashboard'); ?></span></a>
</li>

<?php //'setup' menu active
if ($uri == 'lists' or $uri == 'rooms' or $uri == 'extras' or $uri == 'extras' or $uri == 'seasons' or $uri == 'policies') {
 $setup = 'nav-active';
 $setup_children = 'style="display:block;"';
}
?>

<li class="nav-parent <?php echo $setup; ?>"><a href="#"><i class="fa fa-building-o"></i> <span><?php echo lang('setup_menu'); ?></span></a>
  <ul class="children" <?php echo $setup_children; ?>>
    <li <?php echo $uri=='accounts' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('ema/accounts'); ?>"><i class="fa fa-caret-right"></i> Accounts</a>
    </li>

    <li <?php echo $uri=='senders' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('ema/senders'); ?>"><i class="fa fa-caret-right"></i> Senders</a>
    </li>

    <li <?php echo $uri=='lists' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('ema/lists'); ?>"><i class="fa fa-caret-right"></i> Lists</a>
    </li>
    <li <?php echo $uri=='groups' ? 'class="active"' : ''; ?>>
      <a href="<?php echo site_url('ema/groups'); ?>"><i class="fa fa-caret-right"></i> Groups</a>
    </li>

    <!-- 
    <li><a href="#"><i class="fa fa-caret-right"></i> İndirimler</a></li>
    <li><a href="#"><i class="fa fa-caret-right"></i> Ekstra Ücret</a></li>
    <li><a href="#"><i class="fa fa-caret-right"></i> Vergiler</a></li>
    -->
  </ul>
</li>


<?php  //'campaigns' menu active
if ($uri == 'campaigns') {
 $available = 'active';
 $available_children = 'style="display:block;"';
}
?>

<li class="<?php echo $available; ?>">
  <a href="<?php echo site_url('ema/campaigns'); ?>"><i class="fa fa-file-text"></i> <span>Campaigns</span></a>
</li>

<?php 
$reservation = '';
//'avalilable' menu active
if ($uri == 'reservations') {
 $reservation = 'active';
}?>
<li class="<?php echo $reservation; ?>">
  <a href="<?php echo site_url('reservation/reservations'); ?>"><i class="fa fa-credit-card"></i> <span><?php echo lang('reservations'); ?></span></a>
</li>

</ul>

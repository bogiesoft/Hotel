<?php $this->load->view('header'); ?>
<link href="<?php echo site_url('assets/back'); ?>/css/fullcalendar.css" rel="stylesheet">
<script src="<?php echo site_url('assets/back'); ?>/js/fullcalendar.min.js"></script>

<!-- chart -->
<link href="<?php echo site_url('assets/back'); ?>/css/morris.css" rel="stylesheet">
<script src="<?php echo site_url('assets/back'); ?>/js/morris.min.js"></script>
<script src="<?php echo site_url('assets/back'); ?>/js/raphael-2.1.0.min.js"></script>


    <div class="pageheader">
      <h2><i class="fa fa-credit-card"></i> <?php echo lang('reservations'); ?></h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="index.html"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('reservations'); ?></li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      <!-- chart start -->
      <div class="row">
        <div class="col-sm-6 col-md-12">
            <div class="panel panel-default ">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a href="" class="panel-close">&times;</a>
                  <a href="" class="minimize">&minus;</a>
                </div><!-- panel-btns -->
                <h4 class="panel-title">Guest Detail</h4>
              </div><!-- panel-heading -->
              <div class="panel-body">
                  <div id="chart"></div>
              </div>
            </div>
        </div>
      </div>
      <!-- chart end -->

      <!--calendar start -->
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default ">
            <div class="panel-heading">
                <div class="panel-btns">
                  <a href="" class="panel-close">&times;</a>
                  <a href="" class="minimize">&minus;</a>
                </div><!-- panel-btns -->
                <h4 class="panel-title">Reservation Detail</h4>
              </div><!-- panel-heading -->
              <div class="panel-body">

              </div>
          </div>
      </div>
      <!-- calendar end -->
    </div>

<?php $this->load->view('footer'); ?>
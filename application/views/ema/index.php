<?php $this->load->view('ema/header'); ?>
<link href="<?php echo site_url('assets/back'); ?>/css/fullcalendar.css" rel="stylesheet">
<script src="<?php echo site_url('assets/back'); ?>/js/fullcalendar.min.js"></script>

<!-- chart -->
<link href="<?php echo site_url('assets/back'); ?>/css/morris.css" rel="stylesheet">
<script src="<?php echo site_url('assets/back'); ?>/js/morris.min.js"></script>
<script src="<?php echo site_url('assets/back'); ?>/js/raphael-2.1.0.min.js"></script>


    <div class="pageheader">
      <h2><i class="fa fa-home"></i> <?php echo lang('dashboard'); ?></h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="index.html"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('homepage'); ?></li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">

      <!-- Stats Start -->
      <div class="row">
        <div class="col-sm-6 col-md-4">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="<?php echo site_url('assets/back'); ?>/images/is-user.png" alt="">
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Reservations Today</small>
                    <h1>34</h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Last 7 Days</small>
                    <h4>234</h4>
                  </div>

                  <div class="col-xs-6">
                    <small class="stat-label">Last 30 Days</small>
                    <h4>4353</h4>
                  </div>
                </div><!-- row -->
              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->


        <div class="col-sm-6 col-md-4">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="<?php echo site_url('assets/back'); ?>/images/is-money.png" alt="">
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Today's Earnings</small>
                    <h1>234234</h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Last Week</small>
                    <h4>342</h4>
                  </div>

                  <div class="col-xs-6">
                    <small class="stat-label">Last Month</small>
                    <h4>5435</h4>
                  </div>
                </div><!-- row -->

              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->

        <div class="col-sm-6 col-md-4">
          <div class="panel panel-warning panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="<?php echo site_url('assets/back'); ?>/images/is-document.png" alt="">
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Page Views</small>
                    <h1>300k+</h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <small class="stat-label">% Bounce Rate</small>
                <h4>34.23%</h4>

              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->

      </div>
      <!-- stats end -->


<?php $this->load->view('footer'); ?>
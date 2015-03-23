<?php $this->load->view('header'); ?>
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
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="<?php echo site_url('assets/back'); ?>/images/is-user.png" alt="">
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Reservations Today</small>
                    <h1><?php echo $reservation_stats['today']; ?></h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Last 7 Days</small>
                    <h4><?php echo $reservation_stats['last_week']; ?></h4>
                  </div>

                  <div class="col-xs-6">
                    <small class="stat-label">Last 30 Days</small>
                    <h4><?php echo $reservation_stats['last_month']; ?></h4>
                  </div>
                </div><!-- row -->
              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->


        <div class="col-sm-6 col-md-3">
          <div class="panel panel-dark panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="<?php echo site_url('assets/back'); ?>/images/is-money.png" alt="">
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Today's Earnings</small>
                    <h1><?php echo $price_stats['today']; ?></h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Last Week</small>
                    <h4><?php echo $price_stats['last_week']; ?></h4>
                  </div>

                  <div class="col-xs-6">
                    <small class="stat-label">Last Month</small>
                    <h4><?php echo $price_stats['last_month']; ?></h4>
                  </div>
                </div><!-- row -->

              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-danger panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="<?php echo site_url('assets/back'); ?>/images/is-document.png" alt="">
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">% Unique Visitors</small>
                    <h1>54.40%</h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <small class="stat-label">Avg. Visit Duration</small>
                <h4>01:80:22</h4>

              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-primary panel-stat">
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


      <!-- chart start -->

      <div class="row">
        <div class="col-sm-6 col-md-12">
            <div class="panel panel-default ">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a href="" class="panel-close">&times;</a>
                  <a href="" class="minimize">&minus;</a>
                </div><!-- panel-btns -->
                <h4 class="panel-title">Last 30 Days Reservations</h4>
                <p>This chart shows data of daily reservation/total earnings</p>
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
                <h4 class="panel-title">Reservation Calendar</h4>
                <p>You can see you guests C-In/C-Out dates of monthly</p>
              </div><!-- panel-heading -->
              <div class="panel-body">
                <div id="calendar" class="fc fc-ltr"></div><!-- col-md-9 -->
              </div>
          </div>
      </div>
      <!-- calendar end -->
    </div>

<script>
  jQuery(document).ready(function() {
    "use strict";  
    /* initialize the calendar
    -----------------------------------------------------------------*/
    jQuery('#calendar').fullCalendar({
      eventSources: [{
        events: <?php echo json_encode($events); ?>,
        //color: 'black',
        //textColor: 'yellow' // an option!
      }],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'mont'
      },
      editable: false,
      droppable: false // this allows things to be dropped onto the calendar !!!
    });
    
    Morris.Bar({
      element: 'chart',
      data:  <?php echo json_encode($stats);?>,
      xkey: 'reservation_date',
      ykeys: ['total', 'total_price'],
      labels: ['Reservation', 'Earning'],
      hideHover : false
    });

  });

</script>

<?php $this->load->view('footer'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>Hotel Reservation Engine & Hotel Management</title>

  <link href="<?php echo site_url('assets/back'); ?>/css/style.default.css" rel="stylesheet">
  <link href="<?php echo site_url('assets/back'); ?>/css/style.inverse.css" rel="stylesheet">


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

  <script src="<?php echo site_url('assets/back'); ?>/js/jquery-1.10.2.min.js"></script>
  <script src="<?php echo site_url('assets'); ?>/jtable/jquery-ui.min.js"></script>

  <script src="<?php echo site_url('assets/back'); ?>/js/jquery-migrate-1.2.1.min.js"></script>
  <script src="<?php echo site_url('assets/back'); ?>/js/bootstrap.min.js"></script>
  <script src="<?php echo site_url('assets/back'); ?>/js/modernizr.min.js"></script>

  <script src="<?php echo site_url('assets/back'); ?>/js/jquery.cookies.js"></script>
  <script src="<?php echo site_url('assets/back'); ?>/js/chosen.jquery.min.js"></script>
  <script src="<?php echo site_url('assets/back'); ?>/js/custom.js"></script>

  <script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
  </script>
</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
  <div class="leftpanel">
    
    <div class="logopanel">
        <h1><span>[</span> reservation <span>]</span></h1>
    </div><!-- logopanel -->
    
    <div class="leftpanelinner">
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <div class="media-body">
                    <h4>John Doe</h4>
                    <span>"Life is so..."</span>
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href="#"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href="#"><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
              <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>
    <?php $this->load->view('reservation/left'); ?>
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
  
  <div class="mainpanel">
    
    <div class="headerbar">
      
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      <div class="btn-group">
      <button class="btn btn-default btn-sm" style="margin-top: 7px;">
       <a href="#">AAAAAAAAA</a>
      </button>
      </div>

      <div class="header-right">
        <ul class="headermenu">

          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
               <?php echo $this->session->userdata('hotel_name'); ?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
              <?php foreach (get_hotels() as $key => $value) : ?>
                <li>
                  <a href="<?php echo site_url('dashboard/set_hotel/?id='.$value->id.'&redirect='.$this->uri->uri_string); ?>">
                  <?php echo $value->name; ?>
                  </a>
                </li>
              <?php endforeach; ?>
              </ul>
            </div>
          </li>

          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
               <?php echo $this->session->userdata('name'); ?> <?php echo $this->session->userdata('surname'); ?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href="<?php echo site_url('account'); ?>"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                <li><a href="<?php echo site_url('logout'); ?>"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- header-right -->
      
    </div><!-- headerbar -->
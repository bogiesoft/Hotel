<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo site_url('assets/back'); ?>/images/favicon.png" type="image/png">

  <title>Reservation Online Login</title>

  <link href="<?php echo site_url('assets/back'); ?>/css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> Hotel Reservation <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>Welcome to Hotel Management System</strong></h5>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Fully Responsive Layout</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> HTML5/CSS3 Valid</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Retina Ready</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> WYSIWYG CKEditor</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> and much more...</li>
                    </ul>
                    <div class="mb20"></div>
                    <strong>Not a member? <a href="#">Sign Up</a></strong>
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
                
                <form method="post" action="<?php echo site_url('login/post'); ?>">
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                    <?php if($this->session->flashdata('error')){
                    echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>';
                    }?>
                    <input type="text" name="code" class="form-control uname" placeholder="User Code" />
                    <input type="password" name="password" class="form-control pword" placeholder="Password" />
                    <a href="#"><small>Forgot Your Password?</small></a>
                    <button class="btn btn-success btn-block">Sign In</button>
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2014. All Rights Reserved.
            </div>
            <div class="pull-right">
                Created By: <a href="#" target="_blank">Company</a>
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>


<script src="<?php echo site_url('assets/back'); ?>/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo site_url('assets/back'); ?>/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo site_url('assets/back'); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo site_url('assets/back'); ?>/js/modernizr.min.js"></script>
<script src="<?php echo site_url('assets/back'); ?>/js/retina.min.js"></script>

<script src="<?php echo site_url('assets/back'); ?>/js/custom.js"></script>

</body>
</html>

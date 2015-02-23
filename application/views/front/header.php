<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url('assets/front'); ?>/css/jquery.fancybox.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo site_url('assets/front'); ?>/css/style.css" media="all" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/front'); ?>/js/jquery.fancybox.js"></script>
    <script src="<?php echo site_url('assets/front'); ?>/js/main.js"></script>
</head>
<body>
<div id="main">
<div id="header">
<div class="container po-re">
    <div class="col-md-12 m2">
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> My Reservation</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> Packages Map &amp; Directions</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> See Our Hotels</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> Travel Agents </a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> My Reservation</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> Packages Map &amp; Directions</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> See Our Hotels</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> Travel Agents </a>
    </div>
    <div class="col-md-12 m3">
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> My Reservation</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> Packages Map &amp; Directions</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> See Our Hotels</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> Travel Agents </a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> My Reservation</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> Packages Map &amp; Directions</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> See Our Hotels</a>
        <a href=""><span class="glyphicon glyphicon-chevron-right"></span> Travel Agents </a>
    </div>
    <div class="row bg-333 c-fff">
        <div class="col-md-6">
            <div class="dropdown head-part">
                <a class="m1-link" id="dLabel" data-target="#" href="" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                    <img src="<?php echo site_url('assets/front');?>/img/upside.png" alt="" />
                </a>
                <div class="dropdown-menu m1" role="menu" aria-labelledby="dLabel">
                <h4>Sultania Hotel Istanbul</h4>
                <a href=""><span class="glyphicon glyphicon-chevron-right"></span> My Reservation</a>
                <a href=""><span class="glyphicon glyphicon-chevron-right"></span> Packages Map &amp; Directions</a>
                <a href=""><span class="glyphicon glyphicon-chevron-right"></span> See Our Hotels</a>
                <a href=""><span class="glyphicon glyphicon-chevron-right"></span> Travel Agents </a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="head-part">
                <a id="money-link" href="#">
                View Rates In <span class="sqr">EURO</span> <span class="caret"></span>
                </a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="head-part">
                <a id="lang-link" href="#">
                Languages <span class="sqr">EN</span> <span class="caret"></span>
                </a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="head-part">
                <a href="#">
                <span class="glyphicon glyphicon-edit"></span>My Reservation <span class="caret"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="row ptb-5">
        <div class="col-md-12">
            <img src="<?php echo site_url('assets/front');?>/img/logo.png" />
        </div>
    </div>
</div>
</div>
<div id="content">
<div class="container">
    <div class="row top1"><!-- tabs controls -->
        <div class="col-md-3" id="tc1">
            <a id="m-date">
                <img src="<?php echo site_url('assets/front');?>/img/modify.png" class="fl-l" alt="" /> Modify Date
            </a>
        </div>
        <div class="col-md-3" id="tc2">
            <a href="#tab_b" data-toggle="pill" class="active">1 Room &amp; Rates</a></li>
        </div>
        <div class="col-md-6" id="tc3">
            <a href="#tab_c" data-toggle="pill" id="ddd">2 Guest Details &amp;  Confirmation</a>
        </div>
    </div><!-- /tabs controls -->
    <div class="row top2" id="mdate">
        <form method="get" action="<?php echo site_url('hotel'); ?>">
        <input type="hidden" name="hotel_id" value="<?php echo $this->input->get('hotel_id'); ?>" />
            <div class="col-md-2">
                Check-In Date<br />
                <span class="glyphicon glyphicon-calendar calendar"></span><input id="check-in" name="checkin" type="text" class="datepicker" value="<?php echo date('d-m-Y', strtotime($options['checkin'])); ?>"/>
            </div>
            <div class="col-md-2">
                Check-out Date<br />
                <span class="glyphicon glyphicon-calendar calendar"></span><input id="check-out" name="checkout" type="text" class="datepicker" value="<?php echo date('d-m-Y', strtotime($options['checkout'])); ?>" />
            </div>
            <div class="col-md-1">
                Nights<br />
                <input id="nights" name="nights" type="text" class="small-input" placeholder="10" readonly="" />
            </div>
            <div class="col-md-1">
                Adults:<br />
                <select class="small-input" name="adults">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="col-md-1">
                Children<br />
                <select class="small-input" name="children">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="col-md-2">
                <br />
                <input type="submit" class="srch-btn" value="Search" />
            </div>
            <div class="col-md-2 cent">
                <br />
                <span>Best Price Guarantee</span> 
                <img src="<?php echo site_url('assets/front');?>/img/guarantee.png" />
            </div>
        </form>
    </div>
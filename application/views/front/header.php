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
    <link type="text/css" rel="stylesheet" href="<?php echo site_url('assets/front'); ?>/css/c_style.css" media="all" />
    <link type="text/css" rel="stylesheet" href="<?php echo site_url('assets/front'); ?>/css/animate.min.css" media="all" />
   
   
    <script type="text/javascript" src="https://www.google.com/jsapi"></script> 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/front'); ?>/js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/front'); ?>/js/notify.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/front'); ?>/js/jquery.zaccordion.min.js"></script>
    <script src="<?php echo site_url('assets/front'); ?>/js/countdown.js"></script>
    <script src="<?php echo site_url('assets/front'); ?>/js/main.js"></script>

    <script type="text/javascript">
    var base_url = '<?php echo site_url(); ?>';
    </script>
</head>
<body>
<div id="main">
<div id="header">
<div class="container po-re">
    <div class="col-md-12 m2">
        <a href="<?php echo current_full_url(); ?>&cur=AUD"><span class="glyphicon glyphicon-chevron-right"></span> AUD</a>
        <a href="<?php echo current_full_url(); ?>&cur=CAD"><span class="glyphicon glyphicon-chevron-right"></span> CAD</a>
        <a href="<?php echo current_full_url(); ?>&cur=CHF"><span class="glyphicon glyphicon-chevron-right"></span> CHF</a>
        <a href="<?php echo current_full_url(); ?>&cur=CZK"><span class="glyphicon glyphicon-chevron-right"></span> CZK</a>
        <a href="<?php echo current_full_url(); ?>&cur=DKK"><span class="glyphicon glyphicon-chevron-right"></span> DKK</a>
        <a href="<?php echo current_full_url(); ?>&cur=EUR"><span class="glyphicon glyphicon-chevron-right"></span> EUR</a>
        <a href="<?php echo current_full_url(); ?>&cur=GBP"><span class="glyphicon glyphicon-chevron-right"></span> GBP</a>
        <a href="<?php echo current_full_url(); ?>&cur=HKD"><span class="glyphicon glyphicon-chevron-right"></span> HKD</a>
        <a href="<?php echo current_full_url(); ?>&cur=HUF"><span class="glyphicon glyphicon-chevron-right"></span> HUF</a>
        <a href="<?php echo current_full_url(); ?>&cur=ILS"><span class="glyphicon glyphicon-chevron-right"></span> ILS</a>
        <a href="<?php echo current_full_url(); ?>&cur=INR"><span class="glyphicon glyphicon-chevron-right"></span> INR</a>
        <a href="<?php echo current_full_url(); ?>&cur=JPY"><span class="glyphicon glyphicon-chevron-right"></span> JPY</a>
        <a href="<?php echo current_full_url(); ?>&cur=KRW"><span class="glyphicon glyphicon-chevron-right"></span> KRW</a>
        <a href="<?php echo current_full_url(); ?>&cur=NOK"><span class="glyphicon glyphicon-chevron-right"></span> NOK</a>
        <a href="<?php echo current_full_url(); ?>&cur=PLN"><span class="glyphicon glyphicon-chevron-right"></span> PLN</a>
        <a href="<?php echo current_full_url(); ?>&cur=RON"><span class="glyphicon glyphicon-chevron-right"></span> RON</a>
        <a href="<?php echo current_full_url(); ?>&cur=RUB"><span class="glyphicon glyphicon-chevron-right"></span> RUB</a>
        <a href="<?php echo current_full_url(); ?>&cur=SEK"><span class="glyphicon glyphicon-chevron-right"></span> SEK</a>
        <a href="<?php echo current_full_url(); ?>&cur=SGD"><span class="glyphicon glyphicon-chevron-right"></span> SGD</a>
        <a href="<?php echo current_full_url(); ?>&cur=THB"><span class="glyphicon glyphicon-chevron-right"></span> THB</a>
        <a href="<?php echo current_full_url(); ?>&cur=TRY"><span class="glyphicon glyphicon-chevron-right"></span> TRY</a>
        <a href="<?php echo current_full_url(); ?>&cur=USD"><span class="glyphicon glyphicon-chevron-right"></span> USD</a>
        <a href="<?php echo current_full_url(); ?>&cur=ZAR"><span class="glyphicon glyphicon-chevron-right"></span> ZAR</a>
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
                View Rates In <span class="sqr"><?php echo $options['user_currency']; ?></span> <span class="caret"></span>
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
            <img src="<?php echo $hotel_info->hotel_logo;?>" />
        </div>
    </div>
</div>
</div>
<?php //print_r($this->input->get('children_ages')); ?>
<div id="content">
<div class="container">
    <div class="row top1"><!-- tabs controls -->
        <div class="col-md-3" id="tc1">
            <a class="m-date">
                <img src="<?php echo site_url('assets/front');?>/img/modify.png" class="fl-l" alt="" /> Modify Date
            </a>
        </div>
        <div class="col-md-3" id="tc2">
            <a href="#tab_b" data-toggle="pill" class="nav-pills active">1 Room &amp; Rates</a></li>
        </div>
        <div class="col-md-6" id="tc3">
            <a href="#tab_c" data-toggle="pill" class="nav-pills" id="ddd">2 Guest Details &amp;  Confirmation</a>
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
                <input id="nights" name="nights" type="text" class="small-input" value="<?php echo $options['nights'];?>" placeholder="10" readonly="" />
            </div>
            <div class="col-md-1" style="padding:0">
                Adults:<br />
                <select class="small-input" name="adults">
                <?php for ($i=0; $i < 6; $i++) { 
                    $selected = $options['adults'] == $i ? 'selected="selected"' : ''; ?>
                    <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="col-md-1" style="padding:0">
                Children<br />
                <select class="small-input" name="children" id="children">
                <?php for ($i=0; $i <=3; $i++) { 
                    $selected = $options['children'] == $i ? 'selected="selected"' : ''; ?>
                    <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                <?php } ?>
                </select>
            </div>

            <?php if ($this->input->get('children_ages')) : ?>
                <?php $a =0 ;foreach ($this->input->get('children_ages') as $key => $age) : $a++; ?>
                     <div class="col-md-1 child-ages">
                        Child <?php echo $a; ?> Age<br />
                        <select class="small-input" name="children_ages[]">
                        <?php for ($i=0; $i < 18; $i++) { 
                            $selected = $age== $i ? 'selected="selected"' : ''; ?>
                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>
            <div id="children-ages"></div>
            <div class="col-md-2">
                <br />
                <input type="submit" class="srch-btn" value="Search" />
            </div>
            <!--
            <div class="col-md-2 cent">
                <br />
                <span>Best Price Guarantee</span> 
                <img src="<?php echo site_url('assets/front');?>/img/guarantee.png" />
            </div>-->
        </form>
    </div>
<style type="text/css">
    .child-ages{
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
</style>

<script type="text/javascript">

$(document).ready(function(){
    $('#children').on('change',function(){
        var val = this.value;
        html ='';
        if (val>0) {
            $('.child-ages').remove();
            for (i = 1; i <= val; i++) {
                html += '<div class="col-md-1 child-ages">'+
                'Child '+i+' Age<br />'+
                '<select class="small-input" name="children_ages[]" id="children">'+
                '<?php for ($i=0; $i < 18; $i++) {  ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option>'+
                '<?php } ?>'+
                '</select>'+
            '</div>';
            }
        $('#children-ages').before(html).slideDown();
        }else{
            $('.child-ages').remove().slideUp();
        }

    });


});

</script>

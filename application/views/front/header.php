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
    <link type="text/css" rel="stylesheet" href="<?php echo site_url('assets/front'); ?>/css/sprites.css" media="all" />
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
            <div class="container" style="position: relative;">
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
                <?php $settings = is_object(json_decode($hotel_info->settings)) ? json_decode($hotel_info->settings,TRUE) : []; 
                //print_r($settings); exit;
                ?>
                <div class="row" style="background: #333;color: #fff;">
                    <div class="pull-left">
                        <div class="head-part">
                            <a class="dropdown-toggle" id="dLabel" data-target="#" href="" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                <?php echo $hotel_info->name; ?> | View Details 
                            </a>
                            <div id="hotel-details" class="drop-menu" role="menu">
                                <div>
                                    <div class="hsd-cont">
                                        <div class="hsd-shadow"></div>
                                        <div class="hsd-logo">
                                            <img src="<?php  echo $hotel_info->hotel_logo; ?>">
                                        </div>
                                        <div class="hsd-gallery">
                                            <?php 
                                            foreach ($hotel_photos as $key => $photo): ?>
                                            
                                            <a href="<?php echo $photo->photo_url; ?>" class="fancybox">
                                                <img src="http://i0.wp.com/<?php echo substr($photo->photo_url, 7);?>?resize=75,50"/>
                                        
                                            </a>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="hsd-title-o">
                                            Why stay at <?php echo $hotel_info->name; ?> ?
                                        </div>
                                        <div style="line-height:1.6em">
                                        
                                        <?php
                                        if (isset($settings['why_stay_at'])) :
                                        $why_stay_at = explode(PHP_EOL,$settings['why_stay_at']);
                                        
                                        foreach ($why_stay_at as $reason) :
                                        ?>
                                            <span class="bold">
                                                <span class="sprite check-green"></span>&nbsp;&nbsp;&nbsp;<?php echo $reason; ?>
                                            </span>
                                            <br>
                                        <?php endforeach; ?>
                                        <?php endif; ?>

                                        </div>
                                        <?php if (isset($settings['trip_connect_widget'])) : ?>
                                        <div class="hsd-ta-logo">
                                           <?php echo $settings['trip_connect_widget']; ?>
                                        </div>
                                        <?php endif; ?>

                                        <?php if (isset($settings['map_lat']) or isset($settings['map_long'])) : ?>
                                        <div class="hsd-title-b">
                                            Show map | <span style="font-weight:normal;font-style:italic">Were we are</span>
                                        </div>
                                        <div class="hsd-map">
                                        <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=13&size=235x200&maptype=roadmap&markers=color:blue%7Clabel:S%7C<?php echo $settings['map_lat']; ?>,<?php echo $settings['map_long']; ?>"; ?>
                                        </div>

                                        <?php endif; ?>
                                        <!-- <img src="img/adv.jpg"> -->
                                    </div>
                                    <div class="hrd-cont">
                                        <div class="hrd-desc">
                                            <span class="bold hrd-title">WELCOME TO HOTEL <?php echo $hotel_info->name; ?></span>
                                          </div>
                                        <div class="hrd-cover">
                                            <img src="<?php echo $hotel_info->cover_photo; ?>">
                                        </div>
                                        <div style="padding:0 0 0 20px">
                                            <br>
                                            <?php echo $hotel_info->description; ?>
                                            <div class="hrd-title2">3 reasons to choose  <?php echo $hotel_info->name; ?></div>

                                            <div class="hrd-box">
                                                <div class="col-md-6 hrd-rsn">
                                                    <span class="sprite check-rblue pull-left"></span>
                                                    <span class="hrd-rsn-text">
                                                        <span class="bold">We speak;</span>
                                                        <br>
                                                        <?php echo $hotel_info->name; ?>'s staff speak:

                                                        <?php
                                                        if (isset($settings['spoken_languages'])) :
                                                        foreach ($settings['spoken_languages'] as $lang) {
                                                           $langs = languages();
                                                           echo $langs[$lang]['name'].',';
                                                        }
                                                        endif;

                                                        ?>
                                                        <br>
                                                    </span>
                                                </div>
                                                <div class="col-md-6 hrd-rsn">
                                                    <span class="sprite check-rblue pull-left"></span>
                                                    <span class="hrd-rsn-text">
                                                        <span class="bold">The staff speak English</span><br>
                                                        Hotel Sultania's staff speak: Arabic, English, Russian and Spanish<br>
                                                    </span>
                                                </div>
                                                <div class="col-md-6 hrd-rsn">
                                                    <span class="sprite check-rblue pull-left"></span>
                                                    <span class="hrd-rsn-text">
                                                        <span class="bold">The staff speak English</span><br>
                                                        Hotel Sultania's staff speak: Arabic, English, Russian and Spanish<br>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="hrd-title2">Facilities of  <?php echo $hotel_info->name; ?></div>
                                            <div style="overflow:hidden">
                                                <div class="col-md-4 fac">
                                                    <ul>
                                                    <?php
                                                    if (NULL != $hotel_info->hotel_specs) :

                                                    $specs = explode(',', $hotel_info->hotel_specs);
                                                    foreach ($specs as $spec) : 
                                                    ?>
                                                    <li><span class="sprite check-sblue"></span>&nbsp;&nbsp;<?php echo hotel_specs($spec); ?></li>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4 fac">
                                                    <ul>
                                                    <?php 
                                                    if (NULL != $hotel_info->restourant_specs) :
                                                    $specs = explode(',', $hotel_info->restourant_specs);
                                                    foreach ($specs as $spec) : 
                                                    ?>
                                                    <li><span class="sprite check-sblue"></span>&nbsp;&nbsp;<?php echo restourant_specs($spec); ?></li>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4 fac">
                                                    <ul>
                                                    <?php 
                                                    if (NULL != $hotel_info->sport_specs) :
                                                    $specs = explode(',', $hotel_info->sport_specs);
                                                    foreach ($specs as $spec) : 
                                                    ?>
                                                    <li><span class="sprite check-sblue"></span>&nbsp;&nbsp;<?php echo sport_specs($spec); ?></li>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    </ul>
                                                </div>

                                            </div>
                                            
                                            <div class="hrd-box">

                                            <?php if (isset($settings['checkin_time'])) : ?>
                                                <div class="hrd-row">
                                                    <span class="hrd-label">Check-in</span>
                                                    <span class="hrd-val">From <?php echo $settings['checkin_time']; ?> </span>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (isset($settings['checkout_time'])) : ?>
                                                <div class="hrd-row">
                                                    <span class="hrd-label">Check-out</span>
                                                    <span class="hrd-val">From <?php echo $settings['checkout_time']; ?> hours </span>
                                                </div>
                                            <?php endif; ?>

                                                <div class="hrd-row">
                                                    <span class="hrd-label">Cancellation / prepayment</span>
                                                    <span class="hrd-val">
                                                        Cancellation and prepayment policies vary according to room type.<br>
                                                        Please check the room conditions when selecting your room above.
                                                    </span>
                                                </div>
                                                <div class="hrd-row">
                                                    <span class="hrd-label">Children and extra beds</span>
                                                    <span class="hrd-val">
                                                        All children are welcome.<br>
                                                        Free! All children under 7 years stay free of charge when using existing beds.<br>
                                                        Free! All children under 2 years stay free of charge for children's cots/cribs.<br>
                                                        The maximum number of children's cots/cribs in a room is 1.
                                                    </span>
                                                </div>
                                                <div class="hrd-row">
                                                    <span class="hrd-label">Pets</span>
                                                    <?php if(isset($settings['pets_allowed']) and $settings['pets_allowed'] == 'yes') : ?>
                                                    <span class="hrd-val">Pets are allowed.</span>
                                                    <?php else: ?>
                                                    <span class="hrd-val">Pets are not allowed.</span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="hrd-row">
                                                    <span class="hrd-label">Cards accepted at this property</span>
                                                    <span class="hrd-val">
                                                        <?php 
                                                        if (isset($settings['credit_cards'])) :
                                                        foreach ($settings['credit_cards'] as $card) {
                                                            echo '<span class="credit-card '.$card.'"></span>';
                                                        }
                                                        endif;
                                                        ?>
                                                        <br>
                                                        <br>
                                                        Hover over the cards for more details
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                            $(".fancybox").fancybox();
                                       
                                    </script>
                                </div>
                            </div><!-- detail end -->


                        </div>
                    </div>
                    <div class="pull-right" style="position:relative">
                        <div class="dropdown head-part">
                            <a id="dLabel2" href="#" data-toggle="dropdown" class="dropdown-toggle">
                                <span class="glyphicon glyphicon-edit"></span>My Reservation <span class="caret"></span>
                            </a>
                            <div id="reservation-menu" class="drop-menu">
                                <div class="reserv-manage">
                                    <div class="drop-menu-title">Manage An Exsiting Booking</div>
                                    <div class="reserror">No registration required</div>
                                    <form name="reserv-login" method="POST">
                                    <div class="reserv-form">
                                        <input type="text" name="code" placeholder="Booking Number" />
                                        <input type="text" name="pincode" placeholder="PIN Code" />
                                        <input type="hidden" name="hotel_id" value="<?php echo $this->input->get('hotel_id'); ?>" />
                                        <div style="width:122px;float:left;padding:2px 6px">
                                            Where can I find this information?
                                        </div>
                                        <div style="width:68px;float:left">
                                        <input type="submit" class="btn-go" value="Go">
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="reserv-info">
                                    <span class="sprite tick-green">Change dates</span><br />
                                    <span class="sprite tick-green">Edit guest details</span><br />
                                    <span class="sprite tick-green">Contact the property</span><br />
                                    <span class="sprite tick-green">Upgrade room</span><br />
                                    <span class="sprite tick-green">Cancel booking</span><br />
                                    <span class="sprite tick-green">And more...</span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="email-confirm">
                                    Can't find your confirmation email?&nbsp;
                                    <span class="sprite email-blue-sized"></span>&nbsp;<a href="http://google.com">We'll resend it to you</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="head-part">
                            <a id="lang-link" href="#" data-toggle="dropdown" class="dropdown-toggle">
                                Languages <span class="sqr">EN</span> <span class="caret"></span>
                            </a>
                            <div id="lang-menu" class="drop-menu">
                                <div href="#" id="btn-close-lang" class="btn-close-menu"></div>
                                <div class="drop-menu-title">Most often used by people in Turkey</div>
                                <div class="common-langs">
                                    <ul class="drop-col-short">
                                        <li>
                                            <a href="#"><span class="flag flag-68"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-33"></span> Lang 1</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-short">
                                        <li>
                                            <a href="#"><span class="flag flag-14"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-16"></span> Lang 1</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-short">
                                        <li>
                                            <a href="#"><span class="flag flag-39"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-26"></span> Lang 1</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-short">
                                        <li>
                                            <a href="#"><span class="flag flag-55"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-41"></span> Lang 1</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-short">
                                        <li>
                                            <a href="#"><span class="flag flag-5"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-28"></span> Lang 1</a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="drop-menu-title">All Languages</div>
                                <div class="all-langs">
                                    <ul class="drop-col-long">
                                        <li>
                                            <a href="#"><span class="flag flag-0"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a class="lang-selected" href="#"><span class="flag flag-1"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-2"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-3"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-4"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-5"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-6"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-7"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-8"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-9"></span> Lang 1</a>
                                        </li>

                                    </ul>
                                    <ul class="drop-col-long">
                                        <li>
                                            <a href="#"><span class="flag flag-10"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-11"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-12"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-13"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-14"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-15"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-16"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-17"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-18"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-19"></span> Lang 1</a>
                                        </li>

                                    </ul>
                                    <ul class="drop-col-long">
                                        <li>
                                            <a href="#"><span class="flag flag-20"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-21"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-22"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-23"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-24"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-25"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-26"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-27"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-28"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-29"></span> Lang 1</a>
                                        </li>

                                    </ul>
                                    <ul class="drop-col-long">
                                        <li>
                                            <a href="#"><span class="flag flag-30"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-31"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-32"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-33"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-34"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-35"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-36"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-37"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-38"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-39"></span> Lang 1</a>
                                        </li>

                                    </ul>
                                    <ul class="drop-col-long">
                                        <li>
                                            <a href="#"><span class="flag flag-40"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-41"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-42"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-43"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-44"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-45"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-46"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-47"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-48"></span> Lang 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="flag flag-49"></span> Lang 1</a>
                                        </li>

                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="head-part">
                            <a id="currency-link" href="#" data-toggle="dropdown" class="dropdown-toggle">
                                View Rates In <span class="sqr"><?php echo $options['user_currency']; ?></span> <span class="caret"></span>
                            </a>
                            <div id="currency-menu" class="drop-menu">
                                <div href="#" id="btn-close-lang" class="btn-close-menu"></div>
                                <div class="drop-menu-title">Top Currencies</div>
                                <div class="common-langs">
                                    <ul class="drop-col-short">
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=AUD"><span class="currency-symb">AUD</span> Australlian Dollar</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=CAD"><span class="currency-symb">CAD</span> Canadian Dollar</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=JPY"><span class="currency-symb">JPY</span> Australlian Dollar</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-short">
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=CHF"><span class="currency-symb">CHF</span> İsveç Frangı</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=CZK"><span class="currency-symb">CZK</span> Çek Cumhuriyeti Korunası</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=RUB"><span class="currency-symb">RUB</span> Rusya Rublesi</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-short">
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=DKK"><span class="currency-symb">DKK</span> Danimarka Kronu</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=EUR"><span class="currency-symb">EUR</span> Euro</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=TRY"><span class="currency-symb">TRY</span> Türk Lirası</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-short">
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=GBP"><span class="currency-symb">GBP</span> İngiltere Sterlini</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=HKD"><span class="currency-symb">HKD</span> Hong Kong Dolar</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=USD"><span class="currency-symb">USD</span> U.S. Dollar</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-short">
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=HUF"><span class="currency-symb">HUF</span> Macar Forinti </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=ILS"><span class="currency-symb">ILS</span> Yeni İsrail Şekeli</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo current_full_url(); ?>&cur=SEK"><span class="currency-symb">SEK</span> İsveç Kronu </a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                                <!--
                                <div class="drop-menu-title">All Currencies</div>
                                <div class="all-langs">
                                    <ul class="drop-col-long">
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-long">
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-long">
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-long">
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                    </ul>
                                    <ul class="drop-col-long">
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="currency-symb">USD</span> Currency 1</a>
                                        </li>
                                    </ul>

                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <img src="<?php echo $hotel_info->hotel_logo;?>" />
                    </div>
                </div>

            </div>
        </div>

<!--


    <div class="col-md-12 m2" id="cur-menu">
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

-->
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


    $('form[name=reserv-login]').submit(function(e) {
       e.preventDefault();

       var data = $(this).serialize();
       var url = base_url + "hotel/check_reservation";

   
        $.ajax({
           type: "POST",
           url: url,
           data: data, // serializes the form's elements.
           success: function(response){
           
                if (response.status=='error') {
                    $('.reserror').html(response.message);
                    $('.reserror').css('color','red');
                }

                if(response.status=='success'){
                    var re_url = base_url + "hotel/reservation?code=" +response.code+"&hash=" +response.hash+"&sess="+response.sess;
                
                    window.location.replace(re_url);
                }
           }
         });

        return false; // avoid to execute the actual submit of the form.
       
    });

});

</script>

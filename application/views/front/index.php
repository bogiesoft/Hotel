<?php
$this->load->view('front/header');
?>
    <div class="tab-content">
        <div class="tab-pane active po-re" id="tab_b"><!-- first tap -->
            <div class="row" id="fixed-row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3 nopadding">
                            <div class="c-fff bg-000 cent ptb-5">
                            Room type
                            </div>
                        </div>
                        <div class="col-md-9">
                        <div class="row"><!-- results header -->
                                <div class="col-md-3 hidden-xs cent nopadding">
                                    <div class="c-fff bg-000 cent ptb-5">
                                        <select id="persons"  name="" class="bg-000 sl-person">
                                            <option value="0">Max. People</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3  hidden-xs nopadding">
                                    <div class="c-fff bg-000 ptb-5 cent">
                                    Options
                                    </div>
                                </div>
                                <div class="col-md-3 hidden-xs nopadding">
                                    <div class="c-fff bg-000 ptb-5 blu-bg cent">
                                    Price including taxes
                                    </div>
                                </div>
                                <div class="col-md-3 hidden-xs nopadding">
                                    <div class="c-fff bg-000 ptb-5 cent">
                                    Nr Rooms
                                    </div>
                                </div>
                            </div><!-- /results header -->
                        </div>
                    </div>
                </div>
                <div class="col-md-2 nopadding">
                    <div class="c-fff bg-000 cent ptb-5">
                        <br />
                    </div>
                </div>
            </div>
            <div class="row"><!-- main row of results -->
                <div class="col-md-10 main-row">

                <!-- room details -->
                <?php foreach ($rooms as $rid => $room) : ?>
                <?php if($room_price->$rid != '0.00') : ?>
                <div class="row one-room max-person max-<?php echo $room['max_capacity']; ?>">
                        <div class="col-md-3 nopadding" id="slider-content">
                            <!--
                            <div id="red-offer">
                                <a href=""><b>50</b> % OFF</a>
                            </div>
                            -->
                            <div class="room-title c-fff bg-000">
                            <?php echo $room['title'] != '' ? $room['title'] : $room['name'];?>
                            </div>
                            <!-- slider -->
                            <div id="carousel" class="carousel slide magni" data-ride="carousel">
                                <div class="magnify">
                                    <img src="<?php echo site_url('assets/front');?>/img/magnify.png" />
                                </div>
                                <div class="carousel-inner">
                                <?php foreach ($room['photos'] as $pid => $photo) : ?>
                                    <div class="item <?php echo $pid==0 ? 'active' : ''; ?>" data-thumb="0">
                                        <a class="fancybox" rel="group<?php echo $rid; ?>" href="<?php echo $photo['photo_url'];?>">
                                        <img src="<?php echo $photo['photo_url'];?>" />
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div> 
                        <div class="clearfix">
                            <div id="thumbcarousel" class="carousel slide" data-interval="false">
                                <div class="carousel-inner">
                                    <div class="item active">
                                    <?php $i=0; foreach ($room['photos'] as $pid => $photo) : $i++;?>
                                        <div data-target="#carousel" data-slide-to="<?php echo $pid; ?>" class="thumb">
                                        <img src="<?php echo $photo['photo_url'];?>" />
                                        </div>
                                    <?php if($i % 4 ==0): ?>
                                    </div><!-- /item -->
                                    <div class="item">
                                    <?php endif; ?>
                                   
                                    <?php endforeach; ?>
                                    </div><!-- /item -->
                                </div><!-- /carousel-inner -->
                                <?php if(count($room['photos']) > 4 ): //if count greager than 4?>
                                <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                                <?php endif; ?>
                            </div> <!-- /thumbcarousel -->
                        </div><!-- /clearfix -->
                        </div><!-- /slider -->

                        <div class="col-md-9">
                            <div class="row data-row">
                                <div class="col-md-3 cent">
                                    <img src="<?php echo site_url('assets/front');?>/img/3persons.png" />
                                </div>
                                <div class="col-md-3">
                                    <abbr id="non-refundable" class="white-tooltip" data-toggle="tooltip" data-placement="top" data-html="true" title="<b>Special non-refundable rate</b><br /> This special discounted rate is non-refundable. If you choose to change or cancel this booking you will not be refunded any of the payment.">Non-refundable</abbr>
                                    <br /><br />
                                    <div class="ftr">
                                        <img src="<?php echo site_url('assets/front');?>/img/wifi.png" /> FREE WIFI
                                    </div>
                                    <div class="ftr">
                                        <img src="<?php echo site_url('assets/front');?>/img/spoon.png" /> INCLUDES ALL MEALS
                                    </div>
                                    <div class="ftr">
                                        <img src="<?php echo site_url('assets/front');?>/img/parking.png" /> FREE PARKING
                                    </div>
                                </div>
                                <div class="col-md-3 cent">
                                    <abbr class="price" title="<?php echo $room_price->$rid; ?>">&euro; <?php echo number_format($room_price->$rid, 2, '.', ''); ?> </abbr>
                                    <span class="white-tooltip" data-toggle="tooltip" data-placement="top" title="some title"><img src="<?php echo site_url('assets/front');?>/img/i.png" /></span><br />
                                    Price for <?php echo $options['nights']; ?> nights<br />
                                    
                                </div>
                                <div class="col-md-3">
                                <?php
                                //check stoped arrival or stoped departure
                                $stoped_a = false;
                                $check_a = @$room['prices'][$options['checkin']]['stoped_arrival'];
                                if (!is_null($check_a) and $check_a == 1) {
                                    $stoped_a = true;
                                }

                                $stoped_d = false;
                                $check_d = @$room['prices'][$options['checkout']]['stoped_departure'];
                                if (!is_null($check_d) and $check_d== 1) {
                                    $stoped_d = true;
                                }

                                $available_error = false;
                                //güne göre available kontrolü
                                foreach ($room['prices'] as $d => $a) {

                                    if (!is_null($a['available']) and $a['available'] < 1) {
                                        $available_error .= $d.',';
                                    }
                                }

                                //print_r($available_error);

                                if ($stoped_a) {
                                   echo 'Bu tarihte checkin olmaz';
                                }elseif($stoped_d){
                                    echo 'Bu tarihte checkout olmaz';
                                }elseif($available_error){
                                    echo $available_error.' dates are not available';
                                }else{
                                    $available = $room['prices'][$options['checkin']]['available'];
                                ?>
                                    <select class="sl-menu">
                                    <option data-room="<?php echo $rid; ?>" data-promotion="0" data-qty="0" data-price="0" data-type="delete" value="<?php echo $rid; ?>-0">Select</option>

                                    <?php for ($i=1; $i <= $available ; $i++) { ?>
                                        <option data-room="<?php echo $rid; ?>" data-promotion="0" data-qty="<?php echo $i; ?>" data-price="<?php echo $room_price->$rid *$i; ?>" data-type="add"><?php echo $i; ?> - <?php echo number_format($room_price->$rid*$i, 2, '.', ','); ?> &euro;</option>
                                    <?php } ?>
                                    </select><br />
                                     We Have <?php echo $room['prices'][$options['checkout']]['available']; ?> rooms left!
                                <?php } ?>
                                   
                                </div>
                            </div>
                            <!-- promotions of room start -->
                            <div class="row data-row">
                                <div class="col-md-3 cent">
                                    <img src="<?php echo site_url('assets/front');?>/img/2persons.png" />
                                </div>
                                <div class="col-md-3">
                                    <abbr id="free-cancellation" class="white-tooltip" data-toggle="tooltip" data-placement="top" data-html="true" title="You can cancel this booking right up to Feb 2, 2015 for free. You may be charged if you cancel or change your booking after that. And we can’t refund you if you check out early or don’t turn up at the hotel.">Free cancellation</abbr>
                                    <br />
                                    Until Feb 2, 2015
                                    <br />
                                    <div class="ftr">
                                        <img src="<?php echo site_url('assets/front');?>/img/wifi.png" /> FREE WIFI
                                    </div>
                                    <div class="ftr">
                                        <img src="<?php echo site_url('assets/front');?>/img/spoon.png" /> INCLUDES ALL MEALS
                                    </div>
                                    <div class="ftr">
                                        <img src="<?php echo site_url('assets/front');?>/img/parking.png" /> FREE PARKING
                                    </div>
                                </div>
                                <div class="col-md-3 cent">
                                    <abbr class="price" title="142">&euro; 142.00 </abbr>
                                    <span class="white-tooltip" data-toggle="tooltip" data-placement="top" title="some title"><img src="<?php echo site_url('assets/front');?>/img/i.png" /></span><br />
                                    Price for <?php echo $options['nights'];?> nights<br />
                                    <del class="c-f00 price"><abbr title="284">&euro; 284.00</abbr></del><br />
                                    You save &euro; 142.00
                                </div>
                                <div class="col-md-3">
                                    <select class="sl-menu">
                                        <option data-room="0" data-promotion="0" data-qty="0" data-price="0" value="0-0">Select</option>
                                        <option data-room="1" data-promotion="1" data-qty="1" data-price="100">1 - 100  &euro;</option>
                                        <option data-room="1" data-promotion="1" data-qty="2" data-price="200">2 - 200  &euro;</option>
                                        <option data-room="1" data-promotion="1" data-qty="3" data-price="300">3 - 300  &euro;</option>
                                    </select><br />
                                    We Have 3 rooms left!
                                </div>
                            </div>
                            <!-- promotions of room end -->
                        </div>
                    </div>
                    <div class="row max-person max-<?php echo $room['max_capacity']; ?>">
                        <div class="col-md-12 dtl-show" data-room-id="<?php echo $rid; ?>">
                            <img src="<?php echo site_url('assets/front');?>/img/room-inf.png" alt="" /><!-- -->
                            <span>Show room information</span>
                        </div>
                    </div>
                    
                    <div class="row dtl-<?php echo $rid; ?>" style="display:none">
                        <div class="col-md-5">
                            <p class="room-dtl">
                            <?php echo $room['content']; ?>
                            </p>
                        </div>
                        <div class="col-md-7">
                            <h4>Room Details</h4>
                            <?php 
                            $units = explode(',', $room['units']);
                            foreach ($units as $key => $unit) :
                            ?>
                            <span class="dtl"><?php echo room_specs($unit); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>


                </div>
                <div class="col-md-2 nopadding po-re">
                <div id="fixed-rez">
                    <form method="post" action="#">
                        <div id="reserve">
                            <input class="bb-no" type="submit" value="Reserve" />
                        </div>
                        <p class="cent">Confirmation is immediate</p>
                        <div class="best-price">
                            <p>
                            <input class="price hh1" id="rom" type="text" name="val[1][rooms]" value="0" readonly="" /> 
                             rooms for 
                             <input class="price hh1" id="nits" type="text" name="val[1][nights]" value="1" readonly="" /> 
                              night
                            </p>
                            &euro;<input class="price hh2" id="tot" type="text" name="val[1][price]" value="0" readonly="" />
                            <p class="c-f00">You got the best price</p>
                        </div>
                    </form>
                    <div class="all-green cent f-b">
                        <p>
                        FREE cancellation 
                        <abbr title="">before 17 Feb 2015</abbr>
                        Breakfast included
                        </p>
                    </div>
                </div>
                </div>
            </div><!-- main row of results -->
        </div><!-- end of first tap ------------------------------------------------------------- -->
        <div class="tab-pane" id="tab_c"><!-- second tap ------------------------------------------------------------- -->
            <div class="row">
                <div class="col-md-3 nopadding"><!-- left column ------------------------------------------------------ -->
                    <div id="fixed-part"><!-- second tap fixed part -->
                        <div id="lc-a">
                            <img src="<?php echo site_url('assets/front');?>/img/cal-white.png" width="" alt="" />
                            <span>Your Reservation</span>
                            <img src="<?php echo site_url('assets/front');?>/img/arr-dwn.png" class="fl-r mtb-5" width="" alt="" />
                        </div>
                        <div id="lc-a-in">
                            <div>Hotel Sultania</div>
                            <div>Istanbul , Tukey</div>
                            <div>Jan 30 , 2015- Jan 31 , 2015</div>
                            <div>1 room for 1 adult and  0  Child</div>
                        </div>
                        <div id="lc-b">
                            <img src="<?php echo site_url('assets/front');?>/img/ecal-white.png" width="" alt="" />
                            <span>Need to Change Reservation</span>
                            <img src="<?php echo site_url('assets/front');?>/img/arr-dwn.png" class="fl-r mtb-5" width="" alt="" />
                        </div>
                        <div id="lc-b-in">
                            <div>Best Flexible Rete</div>
                            <div>
                            Subject to 8 % VAT, Breakfast is exclusive. Breakfast is 48 EUR per person, per day.
                            </div>
                        </div>
                        <div class="items_in_cart"></div>
                        <!-- list items in cart -->
                        <div class="room">
	                        <div class="park-view">Park View Room</div>
	                        <div class="avrg">
	                            <div>Average rate per room/night</div>
	                            <div>EUR 340.00</div>
	                        </div>
                        </div>
                        <div class="room">
	                        <div class="park-view">Park View Room</div>
	                        <div class="avrg">
	                            <div>Average rate per room/night</div>
	                            <div>EUR 340.00</div>
	                        </div>
                        </div>
                        <!-- end items in cart-->

                        <div class="avrg">
                            <div>TOTAL</div>
                            <div class="c-090">340.00</div>
                            <div>Excluding Tax</div>
                        </div>
                        <div class="cancellation">
                            <div>Cancellation policy:</div>
                            <div>Cancel by 6 PM local hotel time on Feb 11, 2015 to avoid a penalty charge of EUR 367.20</div>
                            <div>Guarantee Policy:</div>
                            <div>A Guarantee is mandatory to reserve the room</div>
                        </div>
                        <div id="change-search">
                            <a href="">Need to Change Your Search ?</a>
                            <img src="<?php echo site_url('assets/front');?>/img/arr-rit.png" class="fl-r mtb-5" width="" alt="" />
                        </div>
                        <div class="scured-black">
                            <a href=""><img src="<?php echo site_url('assets/front');?>/img/scured-black.png" width="" alt="" /></a>
                        </div>
                    </div><!-- end of second tap fixed part -->
                </div><!-- end of left column ------------------------------------------------------ -->
                <div class="col-md-9"><!-- right column ------------------------------------------------------ -->
                    <div class="row">
                        <div class="col-md-12">
                        Guest Details
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Title
                        </div>
                        <div class="col-md-4">
                            <select name="" class="w-220 b1s-000 mtb-5">
                                <option>Mr.</option>
                                <option>Mrs.</option>
                                <option>Ms.</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <span class="c-f00">*</span> Required Field
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        First Name: <span class="c-f00">*</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="w-220 b1s-000 mtb-5" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Last Name <span class="c-f00">*</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="w-220 b1s-000 mtb-5" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Street 1:
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="w-220 b1s-000 mtb-5" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Street 2:
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="w-220 b1s-000 mtb-5" />                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Zip code / City: <span class="c-f00">*</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="w-95 b1s-000 mtb-5" />
                            <input type="text" name="" class="w-120 b1s-000 mtb-5" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Country: <span class="c-f00">*</span>
                        </div>
                        <div class="col-md-8">
                            <select name=""  class="w-220 b1s-000 mtb-5">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Telephone:
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="w-70 b1s-000 mtb-5" />
                            <input type="text" name="" class="w-70 b1s-000 mtb-5" />
                            <input type="text" name="" class="w-70 b1s-000 mtb-5" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Email: <span class="c-f00">*</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="w-220 b1s-000 mtb-5" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        
                        </div>
                        <div class="col-md-4">
                            <p class="mail-msg">
                            Please ensure that the email address is entered correctly. The confirmation of your booking will be sent to this email address.
                            </p> 
                        </div>
                        <div class="col-md-4">
                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        Card Details: <span class="c-f00">*</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Credit card type: <span class="c-f00">*</span>
                        </div>
                        <div class="col-md-4">
                            <select name=""  class="w-220 b1s-000 mtb-5">
                                <option>-----Please Select-----.</option>
                                <option>-----Please Select-----.</option>
                                <option>-----Please Select-----.</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <span class="c-f00">*</span> Required Field
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Credit card number <span class="c-f00">*</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="w-220 b1s-000 mtb-5" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Expiry date: <span class="c-f00">*</span>
                        </div>
                        <div class="col-md-8">
                            <select name="" class="w-95 b1s-000 mtb-5">
                                <option>01</option>
                            </select>
                            <select name="" class="w-95 b1s-000 mtb-5">
                                <option>2015</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">
                        Name of cardholder <span class="c-f00">*</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="w-220 b1s-000 mtb-5" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <p class="deposit">
                        A deposit is not required for guarantee of your reservation
                        </p>
                        </div>
                    </div>
                    <div class="row details">
                        <div class="col-md-6">
                        Enhance Your Stay
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="dtls" id="dtls-h1">Details Hide <img src="<?php echo site_url('assets/front');?>/img/zt-d-arrow.png" /></span>
                            <span class="dtls" id="dtls-sh1">Details View <img src="<?php echo site_url('assets/front');?>/img/zt-r-arrow.png" /></span>
                        </div>
                        <div class="col-md-12" id="dtl-dtl1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="accordion">
                                        <div class="stay">
                                            <div class="stay-show">
                                                <img src="<?php echo site_url('assets/front');?>/img/stay0.png" width="" alt="" />
                                                <div class="stay-txt">
                                                Welcome Service
                                                EURO 220,00 <a href="">BOOK</a>
                                                </div>
                                            </div>
                                            <div class="stay-hide">
                                            hide
                                            </div>
                                        </div>
                                        <div class="stay">
                                            <div class="stay-show">
                                                <img src="<?php echo site_url('assets/front');?>/img/stay.png" width="" alt="" />
                                                <div class="stay-txt">
                                                Welcome Service
                                                EURO 220,00 <a href="">BOOK</a>
                                                </div>
                                            </div>
                                            <div class="stay-hide">
                                            hide
                                            </div>
                                        </div>
                                        <div class="stay">
                                            <div class="stay-show">
                                                <img src="<?php echo site_url('assets/front');?>/img/stay2.png" width="" alt="" />
                                                <div class="stay-txt">
                                                Welcome Service
                                                EURO 220,00 <a href="">BOOK</a>
                                                </div>
                                            </div>
                                            <div class="stay-hide">
                                            hide
                                            </div>
                                        </div>
                                        <div class="stay">
                                            <div class="stay-show">
                                                <img src="<?php echo site_url('assets/front');?>/img/stay3.png" width="" alt="" />
                                                <div class="stay-txt">
                                                    <p>
                                                    Welcome Service
                                                    </p>
                                                    <p>
                                                    Welcome Service
                                                    </p>
                                                    <p class="c-b7b">
                                                    EURO 220,00 <a href="" class="sqr">BOOK</a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="stay-hide">
                                                <div class="text-right">
                                                    <img src="<?php echo site_url('assets/front');?>/img/close.png" id="close-img" width="16" alt="" />
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <p>
                                                        Start to an energetic day with a rich, organic breakfast with the Bosphorus view at the backdrop. The price is calculated per person per day and exclusive of 18% VAT.
                                                        </p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <form method="" action="">
                                                            <div class="row">
                                                                <div class="col-md-6 text-right">
                                                                Number of Persons 
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="">
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 text-right">
                                                                 Arrival Date 
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="datepicker w-120 c-000" />
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 text-right">
                                                                Arrival Time  
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="">
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                    </select> - 
                                                                    <select name="">
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 text-right">
                                                                    <span id="close-link">Cancel</span> 
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="submit" value="CONFIRM" />
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="stay">
                                            <div class="stay-show">
                                                <img src="<?php echo site_url('assets/front');?>/img/stay4.png" width="" alt="" />
                                                <div class="stay-txt">
                                                Welcome Service
                                                EURO 220,00 <a href="">BOOK</a>
                                                </div>
                                            </div>
                                            <div class="stay-hide">
                                            hide
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                            <span class="dtls" id="dtls-h1in"><img src="<?php echo site_url('assets/front');?>/img/zt-d-arrow.png" /> Show Fewer Packages</span>
                            <span class="dtls" id="dtls-sh1in"><img src="<?php echo site_url('assets/front');?>/img/zt-r-arrow.png" /> Show More Packages</span>
                        </div>
                        <div class="col-md-12" id="dtl-dtl1in">
                        show more
                        </div>
                        </div>
                    </div>
                    <div class="row details">
                        <div class="col-md-6">
                        Room Preferences
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="dtls" id="dtls-h2">Details Hide <img src="<?php echo site_url('assets/front');?>/img/zt-d-arrow.png" /></span>
                            <span class="dtls" id="dtls-sh2">Details View <img src="<?php echo site_url('assets/front');?>/img/zt-r-arrow.png" /></span>
                        </div>
                        <div class="col-md-12" id="dtl-dtl2">
                        show2
                        </div>
                    </div>
                    <div class="row details">
                        <div class="col-md-6">
                        Additional information regarding your arrival
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="dtls" id="dtls-h3">Details Hide <img src="<?php echo site_url('assets/front');?>/img/zt-d-arrow.png" /></span>
                            <span class="dtls" id="dtls-sh3">Details View <img src="<?php echo site_url('assets/front');?>/img/zt-r-arrow.png" /></span>
                        </div>
                        <div class="col-md-12" id="dtl-dtl3">
                        show3
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 welcome">
                            <div class="row">
                                <div class="col-md-3">
                                <img src="<?php echo site_url('assets/front');?>/img/logo.png" alt="" />
                                </div>
                                <div class="col-md-9">
                                <h3>We would love to welcome you.</h3>
                                <p>
                                Book online on hotelsultania.com and get the guaranteed best rates <br />
                                available at any  Hotel Sultania.
                                </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <span>
                                        Best Price Guarantee
                                    </span>
                                    <img src="<?php echo site_url('assets/front');?>/img/guarantee.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row details">
                        <div class="col-md-12">
                            Confirm Reservation 
                        </div>
                    </div>
                    <div class="row last-row">
                        <div class="col-md-3">
                            <input type="submit" value="SUBMIT" class="sbt-btn" />
                        </div>
                        <div class="col-md-1">
                            <input type="checkbox" name="" />
                        </div>
                        <div class="col-md-8 agree">
                        I have understood and agree to the <a href="#">Booking Conditions</a> and agree to Hotel Sultania <a href="#">Privacy Policy</a> .
                        </div>
                    </div>
                </div><!-- end of right column --------------------------------------------------- -->
            </div>
        </div><!-- end of second tap ------------------------------------------------------------- -->
    </div><!-- /tab-content ---------------------------------------------------------------------- -->
</div>
</div>
<?php
$this->load->view('front/footer');
?>
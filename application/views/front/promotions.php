<!-- promotions of room start -->
<?php if(isset($promotion[$rid])) : ?>
<?php foreach ($promotion[$rid] as $pid => $promo) : ?>
    <div class="row data-row">
        <div class="col-md-3 cent">
            <img src="<?php echo site_url('assets/front');?>/img/2persons.png" />
        </div>
        <div class="col-md-3">
            <abbr id="free-cancellation" class="white-tooltip" data-toggle="tooltip" data-placement="top" data-html="true" title="You can cancel this booking right up to Feb 2, 2015 for free. You may be charged if you cancel or change your booking after that. And we can’t refund you if you check out early or don’t turn up at the hotel."><?php echo $promo['promotion_name']; ?></abbr>
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
            <abbr class="price" title="142">&euro; <?php echo $prices->$rid->promotions->$pid->price; ?></abbr>
            <span class="white-tooltip" data-toggle="tooltip" data-placement="top" title="some title"><img src="<?php echo site_url('assets/front');?>/img/i.png" /></span><br />
            Price for <?php echo $options['nights'];?> nights<br />
            <del class="c-f00 price">
            <abbr title="284"><?php echo number_format($prices->$rid->price, 2, '.', ','); ?> &euro;</abbr>
            </del>
            <br />
            You save &euro; <?php echo number_format($prices->$rid->price-$prices->$rid->promotions->$pid->price, 2, '.', ','); ?>
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
<?php endforeach; ?>
<?php endif; ?>
    <!-- promotions of room end -->
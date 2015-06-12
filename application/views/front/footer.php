<div id="footer">
<div class="container bg-333" style="margin-top:200px;">

    <div class="row foo-btm">
    <div class="col-md-2">
            <img src="<?php echo site_url('assets/front');?>/img/scured.png">
        </div>
        <div class="col-md-8">
            <p class="c-898">
            <?php echo $hotel_info->name; ?>  online booking engine | Copyright © 2015 MK IT. CO. |  All rights reserved | Return to <a href="<?php echo $hotel_info->website; ?>" target="_blank"><?php echo $hotel_info->name; ?></a><br />
            Adress: <?php echo $hotel_info->adress; ?> <?php echo $hotel_info->city; ?>  Phone:<?php echo $hotel_info->phone; ?> Email:<a href="mailto:<?php echo $hotel_info->email; ?>"><?php echo $hotel_info->email; ?></a>  <br />
            rabooking.com is based in İstanbul in the Turkey. Your Reference ID is: <a href=""><?php echo $this->session->userdata('my_session_id'); ?></a>
            </p>
        </div>
        <div class="col-md-2">
            <img src="<?php echo site_url('assets/front');?>/img/hwt.png" />
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>
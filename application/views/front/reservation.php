<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8" />
    <title>Finish Reservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo site_url('assets/front'); ?>/css/style.css" media="all" />
    <link type="text/css" rel="stylesheet" href="<?php echo site_url('assets/front'); ?>/css/sprites.css" media="all" />
    <link type="text/css" rel="stylesheet" href="<?php echo site_url('assets/front'); ?>/css/bootstrap-dialog.css" media="all" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/front'); ?>/js/jquery.fancybox.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="<?php echo site_url('assets/front'); ?>/js/jquery.carouFredSel-6.0.4-packed.js"></script>
    <script src="<?php echo site_url('assets/front'); ?>/js/bootstrap-dialog.js"></script>
</head>
<body>
    <div id="main">
        <div id="content">
            <div class="container">
                <br />
                <div>
                <?php if ($reservation->status == 1) :?>
                    <div class="confirm-msg">
                        Thanks <?php echo $reservation->first_name; ?> <?php echo $reservation->last_name; ?>! Your booking is now confirmed.
                    </div>

                    <button class="c-btn btn-cancel-booking pull-right" data-toggle="modal" data-target="#cancel_modal">
                        <span class="sprite cancel-white"></span>&nbsp;&nbsp;&nbsp;Cancel Reservation
                    </button>
                    <button class="c-btn pull-right">
                        <span class="sprite printer-white"></span>&nbsp;&nbsp;&nbsp;Print Confirmation
                    </button>
                    <button id="editConf" class="c-btn pull-right">
                            <span class="sprite pencil-white"></span>&nbsp;Edit
                    </button>

                <?php elseif ($reservation->status == 2) : ?>

                 <div class="confirm-msg">
                      Your reservation has been modified
                    </div>

                    <button class="c-btn btn-cancel-booking pull-right" data-toggle="modal" data-target="#cancel_modal">
                        <span class="sprite cancel-white"></span>&nbsp;&nbsp;&nbsp;Cancel Reservation
                    </button>
                    <button class="c-btn pull-right">
                        <span class="sprite printer-white"></span>&nbsp;&nbsp;&nbsp;Print Confirmation
                    </button>
                    <button id="editConf" class="c-btn pull-right">
                            <span class="sprite pencil-white"></span>&nbsp;Edit
                    </button>

                <?php elseif ($reservation->status == 0) : ?>

                    <div class="error-msg">
                        This Reservation has been cancalled.
                    </div>

                    <button class="c-btn pull-right">
                        <span class="sprite printer-white"></span>&nbsp;&nbsp;&nbsp;Print Confirmation
                    </button>

                <?php endif; ?>

                    <div class="clearfix"></div>
                </div>

                <div class="confirm-actions">
                <?php if ($reservation->status == 1) :?>
                    <div class="a-text col-md-6">
                        <span>We sent the confirmation email to <?php echo $reservation->email; ?> </span><br />
                        <span>We notified <?php echo $hotel->name; ?> of your upcoming stay </span>
                    </div>
                <?php elseif($reservation->status == 2) : ?>
                    <div class="a-text col-md-6">
                        <span>We sent the update email to <?php echo $reservation->email; ?> </span><br />
                        <span>We notified <?php echo $hotel->name; ?> for your update </span>
                    </div>
                <?php endif; ?>

                    <div class="col-md-6">
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="booking-refs">
                    BOOKING NUMBER: <span class="bold"><?php echo $reservation->reservation_code; ?></span> 
                    PIN CODE: <span class="bold"><?php echo $reservation->pincode; ?></span>
                </div>
                <?php $settings = is_object(json_decode($hotel->settings)) ? json_decode($hotel->settings,TRUE) : []; ?>
                <div class="booking-info-cont">
                    <div class="booking-info-head">
                    <?php if (NULL != $hotel->cover_photo) : ?>
                        <img src="<?php echo $hotel->cover_photo; ?>" style="width:100%"/>
                    <?php else: ?>
                        <img src="<?php echo site_url('assets/front'); ?>/img/b-h.jpg" style="width:100%"/>
                    <?php endif; ?>
                        <div class="b-info-address">
                            <span class="address bold">
                            <?php echo $hotel->adress; ?>
                            <br />
                            <?php echo $hotel->city; ?>
                            </span>
                            <br />
                            <?php if (isset($settings['map_lat']) or isset($settings['map_long'])) : ?>
                            <a href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo $settings['map_lat']; ?>+<?php echo $settings['map_long']; ?>" target="_blank">
                                Show map with directions
                            </a>
                            <?php endif; ?>

                            <div class="map-sep"></div>
                            <span style="font-weight:normal">Phone:</span> <span class="bold"><?php echo $hotel->phone; ?></span><br />
                            <a class="bold underline" href="mailto:<?php echo $hotel->email; ?>">Email property</a><br />

                        </div>
                    </div>
                    <div style="background-color:#f8f8f8;border:solid 1px #ddd;padding:26px 15px">
                        <div class="col-md-4" style="height:135px;border-right:solid 1px #999;text-align:center">
                            <span style="line-height:1.2em;display:inline-block;padding:0 30px;border-right:solid 1px #aaa;height:136px">
                                CHECK IN<br />
                                <span style="font-size:68px;font-weight:bold;line-height:1em"><?php echo date('d',strtotime($reservation->checkin)); ?></span><br />
                                <span class="bold"><?php echo date('F-Y',strtotime($reservation->checkin)); ?></span><br />
                                <span style="font-size:12px;font-style:italic"><?php echo date('D',strtotime($reservation->checkin)); ?></span><br />
                                
                                <?php if (isset($settings['checkin_time'])) : ?>
                                <span style="font-size:12px;"><?php echo $settings['checkin_time']; ?></span>
                                <?php endif; ?>
                                <br />
                            </span>
                            <span style="line-height:1.2em;display:inline-block;padding:0 30px;height:135px">
                                CHECK OUT<br />
                                <span style="font-size:68px;font-weight:bold;line-height:1em"><?php echo date('d',strtotime($reservation->checkout)); ?></span><br />
                                <span class="bold"><?php echo date('F-Y',strtotime($reservation->checkout)); ?></span><br />
                                <span style="font-size:12px;font-style:italic"><?php echo date('D',strtotime($reservation->checkout)); ?></span><br />
                                
                                <?php if (isset($settings['checkout_time'])) : ?>
                                <span style="font-size:12px;"><?php echo $settings['checkout_time']; ?></span>
                                <?php endif; ?>
                                <br />
                            </span>
                            <!--
                            <button id="changeDates" class="c-btn">
                                <span class="sprite calender-white"></span>&nbsp;&nbsp;&nbsp;Change Dates
                            </button>
                            -->
                        </div>
                        <div class="col-md-2" style="height:135px;border-right:solid 1px #999;text-align:center">
                            <span style="line-height:1.2em;display:inline-block;padding:0">
                                ROOM<br />
                                <span style="font-size:68px;font-weight:bold;line-height:1em"><?php echo $rooms['total_room']; ?></span><br />
                            </span>
                            <span style="font-size:68px;font-weight:bold;line-height:1em;color:#878787">/</span>
                            <span style="line-height:1.2em;display:inline-block;padding:0">
                                NIGHTS<br />
                                <span style="font-size:68px;font-weight:bold;line-height:1em"><?php echo dateDifference($reservation->checkout,$reservation->checkin); ?></span><br />
                            </span>
                        </div>

                        <div class="col-md-2" style="height:135px;border-right:solid 1px #999;text-align:center">
                            <span style="line-height:1.2em;display:inline-block;padding:0">
                                ADULTS<br />
                                <span style="font-size:68px;font-weight:bold;line-height:1em"><?php echo $reservation->adults; ?></span><br />
                            </span>
                            <span style="font-size:68px;font-weight:bold;line-height:1em;color:#878787">/</span>
                            <span style="line-height:1.2em;display:inline-block;padding:0">
                                CHILDREN<br />
                                <span style="font-size:68px;font-weight:bold;line-height:1em"><?php echo $reservation->children; ?></span><br />
                            </span>
                        </div>

                        <div class="col-md-4" style="height:135px;text-align:center">
                            <span style="line-height:1.2em;display:inline-block;padding:0 30px;height:136px;">
                                TOTAL PRICE<br />
                                <span style="font-size:55px;font-weight:bold;line-height:1em;color:#008cff"><?php echo $reservation->total_price; ?> <?php echo $reservation->currency; ?></span><br />
                                <br />
                                <a href="#" style="font-size:12px;">View price details</a>
                            </span>
                            <!--
                            <button id="editcCard" class="c-btn">
                                <span class="sprite creditcard-white"></span>&nbsp;&nbsp;&nbsp;Edit credit card details
                            </button>
                            &nbsp;
                            <button id="cancelBooking" class="c-btn btn-cancel-booking">
                                <span class="sprite cancel-white"></span>&nbsp;&nbsp;&nbsp;Cancel your booking
                            </button>

                            <div style="margin-top:8px;font-size:12px">It costs US$0 to cancel this booking within: 3 months 17 days</div>
                            -->
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div style="font-weight:bold;margin:20px 0">Room Details</div>

                    <?php
                    foreach ($rooms['booked'] as $key => $room) : ?>
                    <div class="room-details">
                        <div class="room-details-item">
                            <div class="pull-left">
                                <img src="<?php echo $room['photos']['0']['photo_url']; ?>" width="200" height="150" />
                            </div>
                            <div style="margin-left:207px">
                                <div class="room-details-title"><?php echo $room['info']['name']; ?></div>
                                <div style="margin-bottom:10px">
                                    for <span class="editable">{guest name}</span>
                                    <!--
                                    <button class="c-btn btn-edit edit-btn">
                                        <span class="sprite pencil-white"></span>&nbsp;Edit
                                    </button>
                                    <span class="c-editor" style="display:none">
                                        <input type="text" value="Name Surname" />
                                        <a class="c-editor-ok" href="#">Save</a>
                                        <a class="c-editor-cancel" href="#">Cancel</a>
                                    </span>
                                    -->
                                </div>
                                <div class="room-details-desc">

                                    <?php $specs = $room['details']->room_units;
                                    $specs = explode(',', $specs);
                                    //print_r($specs);
                                    $spec_cnt = count($specs);
                                    foreach ($specs as $key => $spec) {
                                        if ($key == $spec_cnt-1) {
                                            echo room_specs($spec); 
                                        }else{
                                            echo room_specs($spec).' * '; 
                                        }
                                       
                                    }

                                    ?>
                                </div>
                                <!--
                                <button id="editGuest" class="c-btn">
                                    <span class="sprite user-white"></span>&nbsp;&nbsp;&nbsp;Edit guest details
                                </button>
                                &nbsp;
                                <button id="changeRoom" class="c-btn">
                                    <span class="sprite key-white"></span>&nbsp;&nbsp;&nbsp;Change your room
                                </button>
                                -->
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <a id="addRoom" class="add-room" href="#">
                        <span class="sprite add-blue va-middle"></span>&nbsp;&nbsp;&nbsp;Add another room
                    </a>

                    <?php if ($reservation->extras != 'false'): ?> 
                    <div style="font-weight:bold;margin:20px 0">Enhance your stay</div>
                    <div class="enhance-cont">
                        <?php foreach (json_decode($reservation->extras,TRUE) as $eid => $extra) : ?>
                        <div class="enhance-item">
                            <div class="pull-left">
                                <img src="<?php echo get_extra_image($eid); ?>" width="140" height="115"/><br />
                                <?php  echo $extra['name']; ?><br />
                                <span style="font-weight:bold;color:#b7b300"><?php echo $extra['price']; ?> <?php echo $reservation->currency; ?></span>
                            </div>
                            <div style="margin-left:154px">
                            <?php foreach ($extra['details'] as $name => $value) : ?>
                                <div style="margin-bottom:3px">
                                    <span class="enhance-label"><?php echo str_replace('_', ' ', $name); ?></span>
                                    <?php 
                                    if (is_array($value)) {

                                        //time ise
                                        if (isset($value['hh'])) {
                                            echo substr($value['hh'],0,-2).$value['mm'];                                        
                                        }else{
                                            echo implode(',', $value);
                                        }
                                        
                                    }else{
                                        echo $value;
                                    } 
                                    ?>
                                </div>
                            <?php endforeach; ?>
                            <!--
                                <div style="margin-bottom:3px">
                                    <span class="enhance-label">Date</span>
                                    <a class="editable edit-btn" href="#"> 15/5/2015</a>
                                    <span class="c-editor" style="display:none">
                                        <input type="text" value="15/5/2015" />
                                        <a class="c-editor-ok" href="#">Save</a>
                                        <a class="c-editor-cancel" href="#">Cancel</a>
                                    </span>
                                </div>
                                <div style="margin-bottom:3px">
                                    <span class="enhance-label">Time</span>
                                    <a class="editable edit-btn" href="#">7:30 AM</a>
                                    <span class="c-editor" style="display:none">
                                        <input type="text" value="7:30 AM" />
                                        <a class="c-editor-ok" href="#">Save</a>
                                        <a class="c-editor-cancel" href="#">Cancel</a>
                                    </span>
                                </div>

                                <div style="margin-bottom:3px">
                                    <span class="enhance-label">Adult</span>
                                    <a class="editable edit-btn" href="#">1 Person</a>
                                    <span class="c-editor" style="display:none">
                                        <input type="text" value="1 Person" />
                                        <a class="c-editor-ok" href="#">Save</a>
                                        <a class="c-editor-cancel" href="#">Cancel</a>
                                    </span>
                                </div>

                                <div style="margin-bottom:3px">
                                    <span class="enhance-label">Location</span>
                                    <span>Hagia Sophia</span>
                                </div>
                                -->
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php endforeach; //extra item end ?>
                    </div>
                    <?php endif; //end of extras ?>
                    <!--
                    <div style="font-weight:bold;margin:20px 0">Enhance your stay</div>
                    <div class="stay-settings">
                        <div class="stay-block">
                            <table>
                                <tr>
                                    <td><span class="sprite parking-black"></span></td>
                                    <td>
                                        Parking is available, no reservations required.
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="sprite time-black"></span></td>
                                    <td>
                                        Change your check-in or check-out time
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="sprite write-black"></span></td>
                                    <td>
                                        Send { hotel name } a different request <br/>
                                        Special request sent to property: "Ground-level room request: this booker requests ground-level room(s) - based on availability Hello " (May 11, 2015) 
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="sprite food-black"></span></td>
                                    <td>
                                        Wine Lovers Package - 25 € (per person) » (Choose, Red, White Or Sparkling)
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="sprite bed-black"></span></td>
                                    <td>
                                        Bed Type  ;  * Separate Beds  * French Bed
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="sprite bed2-black"></span></td>
                                    <td>
                                        Extra Bed for childs 
                                    </td>
                                </tr>
                            </table>
                            <br /><br /><br /><br />
                        </div>

                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="cancel_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cancel Reservation</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure to cancel your reservation?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="cancel_reservation">Cancel Reservation</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <script>
        $(function () {
            var base_url = '<?php echo site_url(); ?>';

            $('.edit-btn').click(function () {
                var url = base_url + 'hotel?hotel_id=<?php echo $reservation->hotel_id; ?>&checkin=<?php echo $reservation->checkin; ?>&checkout=<?php echo $reservation->checkout;?>&adults=<?php echo $reservation->adults; ?>&res_code=<?php echo $reservation->reservation_code; ?>';
                window.Location.replace(url);
                return false;
            });

            $('.c-editor-ok').click(function () {
                // Saving Code

                var tb = $('input[type=text]', $(this).parent());
                if (tb.val().length > 0)
                    $('.editable', $(this).parent().parent()).text(tb.val());

            });

            $('.c-editor a').click(function () {
                $(this).parent().hide();
                $('.edit-btn', $(this).parent().parent()).show();
                $('.editable', $(this).parent().parent()).show();
                return false;
            });

            $('#editConf').click(function () {
                var url = base_url + 'hotel?hotel_id=<?php echo $reservation->hotel_id; ?>&checkin=<?php echo $reservation->checkin; ?>&checkout=<?php echo $reservation->checkout;?>&adults=<?php echo $reservation->adults; ?>&res_code=<?php echo $reservation->reservation_code; ?>';
                window.location.replace(url);
            });

            $('#changeDates').click(function () {
                BootstrapDialog.show({
                    title: 'Change Dates',
                    closeByKeyboard: true,
                    message: $('<div></div>').load('dialog_pages/change_dates.html')
                });
            });

            $('#editcCard').click(function () {
                BootstrapDialog.show({
                    title: 'Edit Credit Card Details',
                    closeByKeyboard: true,
                    message: $('<div></div>').load('dialog_pages/edit_ccard.html')
                });
            });

            $('#editGuest').click(function () {
                BootstrapDialog.show({
                    title: 'Edit Guest Details',
                    closeByKeyboard: true,
                    message: $('<div></div>').load('dialog_pages/edit_guest.html')
                });
            });

            $('#changeRoom').click(function () {
                BootstrapDialog.show({
                    title: 'Change Your Room',
                    closeByKeyboard: true,
                    message: $('<div></div>').load('dialog_pages/change_room.html')
                });
            });

            $('#addRoom').click(function () {
                BootstrapDialog.show({
                    title: 'Add Another Room',
                    closeByKeyboard: true,
                    message: $('<div></div>').load('dialog_pages/add_room.html')
                });
                return false;
            });

            $('#cancel_reservation').on('click',function(){
                var val = {id : <?php echo $reservation->id; ?>, code : '<?php echo $reservation->reservation_code; ?>'}
                jQuery.post( base_url + "actions/cancel_reservation",val,function(data){
                    data = $.parseJSON(data);
                    if (data.status == 'success') {
                      //alert('success');
                      $('#cancel_modal').modal('hide');
                      var html = '<div class="error-msg">Your reservation has been canceled.</div>';

                      $('.confirm-msg').after(html);
                      $('.confirm-msg').fadeOut();
                      $('.btn-cancel-booking').fadeOut();
                      $('#editConf').fadeOut();
                      

                    }
                });
            });
        })
    </script>


    <br /><br /><br /><br /><br /><br /><br /><br />
</body>
</html>
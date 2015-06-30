<?php $settings = is_object(json_decode($hotel_info->settings)) ? json_decode($hotel_info->settings,TRUE) : []; ?>
<?php $manage_url = site_url('hotel/reservation').'/?code='.$id.'&hash='.$rhash; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
 <head>
 <meta charset="UTF-8">
  <style>
@media print {
.noPrint {display: none;}
}
</style>
  <style>
.mg_conf_explorer_entry_point_empty_td {
width:15%!important;
}
.mg_conf_explorer_entry_point_main_td {
width: 70%!important;
}
</style>
  <style>
/* Reset */
#outlook a {padding:0;}
body {width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
.ExternalClass {width:100%;}
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass td, .ExternalClass div {line-height: 100%;}
/* Link color on iOS */
a {color:#0896ff;}
a[x-apple-data-detectors] {
color: inherit !important;
text-decoration: none !important;
font-size: inherit !important;
font-family: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
}
/* Make layout fluid on smaller screens */
@media only screen and (max-width: 619px) {
*[class~=responsive_table] {
width: 100%!important;
}
*[class~=responsive_img] {
height:auto !important;
max-width:600px !important;
width: 100% !important;
}
}
/* General layout choreography for mobile */
@media only screen and (max-width: 480px) {
/* Make cells full width */
*[class~=responsive_td] {
display: block;
width: 100%!important;
}
/* Key - value list design */
*[class~=responsive_key] {
padding-top:7px!important;
padding-bottom:0!important;
padding-right:0!important;
border:0!important;
}
*[class~=responsive_value] {
text-align:left!important;
padding-bottom:7px!important;
padding-top:0!important;
}
*[class~=lang_is_rtl] *[class~=responsive_value] {
text-align: right!important;
}
*[class~=responsive_td_ge] {
display: block;
width: auto !important;
padding-left: 15px !important;
padding-top: 5px !important;
padding-bottom: 0 !important;
}
*[class~=responsive_td_ge_int] {
display: block;
width: auto !important;
padding-left: 15px !important;
padding-top: 0 !important;
padding-bottom: 10px !important;
}
*[class~=responsive_td_ge_logo] {
display: block;
width: auto !important;
padding-left: 15px !important;
padding-top: 15px !important;
}
/* Helpers */
*[class~=noborder_on_mobile] {
border:0!important;
}
*[class~=nopadding_on_mobile] {
padding:0!important;
}
*[class~=pushdown_on_mobile] {
padding-bottom:10px!important;
}
*[class~=center_on_mobile] {
text-align: center!important;
}
*[class~=center_on_mobile] img,
*[class~=center_on_mobile] *[class~=book_again_btn] {
margin: 0 auto;
}
*[class~=center_on_mobile] table {
margin:0 auto;
}
*[class~=hide_on_mobile] {
display: none !important;
}
*[class~=single_row_cell] {
overflow: hidden;
border-bottom: 1px dotted #aaaaaa;
padding-bottom: 5px;
}
.mg_conf_explorer_entry_point_empty_td {
width:2.5%!important;
}
.mg_conf_explorer_entry_point_main_td {
width: 95%!important;
}
}
</style>
  <title>Your modified booking at <?php echo $hotel_info->name; ?></title>
 </head>
 <body class=" en-us" style="
margin:0;
padding:0;
background-color:#fff;
font-family: arial;
" yahoo="fix">

  <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_container" height="100%" style="
margin:0px; padding:0px; border:0px;
 
margin:0;
padding:0;
background-color:#fff;
font-family: arial;
" width="100%">
   <tr>
    <td align="center" valign="top">
     <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_canvas responsive_table" style="width:580px; 
margin:0;
padding:0;
background:#ffffff;
font-family: arial;
">
      <tr>
       <td style="padding-top:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_header" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td class="responsive_td center_on_mobile" style="
text-align:left;
 font-size:0;" valign="top"><a href="<?php echo $hotel_info->website; ?>" target="_blank" title="Booking.com">
<img  alt="rabooking" height="100" src="<?php  echo $hotel_info->hotel_logo; ?>" style="outline:none; text-decoration:none; -ms-interpolation-mode: bicubic; border:none;" width="200" />
</a></td>
          <td class="td-action-print--header" style="
text-align:right;
" valign="middle"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;source=conf_email;pbsource=conf_email_modify;print_confirmation=1" style="display:block;text-decoration:none;" target="_blank"><table align="right" border="0" cellpadding="0" cellspacing="0" style="
margin:0px; padding:0px; border:0px;
background-color:#0896ff;border-radius:3px;padding:5px 10px;margin-left:15px;">
             <tr>
              <td style="
text-align:left;
" valign="middle" width="25"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;source=conf_email;pbsource=conf_email_modify;print_confirmation=1" target="_blank"><img  height="19" src="https://r.bstatic.com/static/img/conf_email/print.gif" style="outline:none; text-decoration:none; -ms-interpolation-mode: bicubic; border:none; display:block;" width="19" /></a></td>
              <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
" valign="middle"><a href="#" style="color:#fff;text-decoration:none;" target="_blank"><span style="white-space:nowrap;">Get the print version</span></a></td>
             </tr>
            </table></a></td>
         </tr>
        </table>
       </td>
      </tr>

      <tr>
       <td style="padding-top:20px; padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_reassurance" style="margin:0px; padding:0px; border:0px;" width="100%">
         <tbody><tr>
          <td style="text-align:left;font-size:18px;line-height:22px;font-family: arial;color:#003580;page-break-after: avoid;font-weight:bold;" valign="top">
            Your modified booking is now confirmed
          </td>
         </tr>
        </tbody></table>
       </td>
      </tr>

      <!-- Your Changes
      <tr>
       <td style="padding-top:20px; padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_reassurance" style="
margin:0px; padding:0px; border:0px;
 " width="100%">
         <tr>
          <td style="
text-align:left;
 
font-size:18px;line-height:22px;
font-family: arial;
color:#003580;
page-break-after: avoid;
font-weight:bold;
" valign="top">
Your modified booking is now confirmed
</td>
         </tr>
        </table>
       </td>
      </tr>
      <tr>
       <td style="padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_mod_summary" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td style="
background-color:#feffe0;
border:1px solid #d3d3d3;
 padding:15px;" valign="top">
           <table border="0" cellpadding="0" cellspacing="0" style="
margin:0px; padding:0px; border:0px;
" width="100%">
            <tr>
             <td style="
text-align:left;
 
font-size:18px;line-height:22px;
font-family: arial;
color:#003580;
page-break-after: avoid;
font-weight:bold;
" valign="top">
Your changes
</td>
            </tr>
            <tr>
             <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
" valign="top">
              <table cellpadding="0" cellspacing="0" style="line-height:17px;">
               <tr>
                <td colspan="2" style="
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 padding:.6em 0 0;" valign="top"><b>
Classic King or Queen Bed
for guest <u>Mizgin Uzan1</u>
</b></td>
               </tr>
               <tr>
                <td style="
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 padding-right:10px; white-space: nowrap;" valign="top">Guest Name:</td>
                <td style="
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
" valign="top">
Mizgin Uzan1
 (was Mizgin Uzan)
</td>
               </tr>
              </table>
             </td>
            </tr>
           </table>
          </td>
         </tr>
        </table>
       </td>
      </tr>
      -->
      <tr>
       <td style="padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_hotel_preview" style="
margin:0px; padding:0px; border:0px;
" width="100%">

        <?php if($hotel_info->cover_photo) : ?>
         <tr>
          <td valign="top">
          <img  border="0" class="responsive_img" height="185" src="<?php echo $hotel_info->cover_photo; ?>" style="outline:none; text-decoration:none; -ms-interpolation-mode: bicubic; border:none; display:block;" width="580" />
          </td>
         </tr>
       <?php endif; ?>

         <tr>
          <td style="padding-top:5px; 
text-align:left;
" valign="top">
           <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_hotel_photo_and_contacts" style="
margin:0px; padding:0px; border:0px;
">
            <tr>
             <td class="responsive_td" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 " valign="top">
              <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_hotel_contacts" style="
margin:0px; padding:0px; border:0px;
" width="100%">
               <tr>
                <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 padding-right:10px;" valign="top"><b>Address:</b></td>
                <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
" valign="top"><span><?php echo $hotel_info->adress; ?></span><br />
<span><?php echo $hotel_info->city; ?></span></td>
               </tr>
               <tr>
                <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 padding-right:10px;" valign="top"><b>Phone:</b></td>
                <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
" valign="top"><span><?php echo $hotel_info->phone; ?> </span></td>
               </tr>

               <tr>
                <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 padding-right:10px;" valign="top"><b>Email:</b></td>
                <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
" valign="bottom"><?php echo $hotel_info->email; ?></td>
               </tr>

               <?php if (isset($settings['map_lat']) or isset($settings['map_long'])) : ?>
               <tr>
                <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 padding-right:10px;" valign="top"><b>Getting there:</b></td>
                <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
" valign="bottom"><a href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo $settings['map_lat']; ?>+<?php echo $settings['map_long']; ?>">Show directions</a></td>
               </tr>
             <?php endif; ?>
              </table>
             </td>
            </tr>
           </table>
          </td>
         </tr>
        </table>
       </td>
      </tr>
      <tr>
       <td class="td--no-padding" style="padding-top:5px; padding-bottom:20px; padding-left:10px; padding-right:10px; padding-top: 0 !important;padding-bottom: 10px !important;" valign="top">
        <style>
*[class~=td-with-right-border] {
/*border-right:1px solid #c3c3c3;*/
}
@media only screen and (max-width: 480px) {
*[class~=td-with-right-border] {
border-right:none !important;
}
*[class~=td-action-print--header] {
display: none !important;
}
*[class~=td-action-print--body] {
display:table-cell !important; width: 100% !important; overflow: visible !important; float: none !important;
}
*[class~=td--has-bg] {
background: #e6edf6 !important;
padding: 10px 0 !important;
border: 2px solid #fff !important;
border-radius: 2px;
}
*[class~=td--no-padding] {
}
}
@media only screen and (min-width: 480px) {
*[class~=td-with-right-border] {
border-right:none;
}
}
</style>
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_actions" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td class="responsive_td pushdown_on_mobile td-with-right-border td--has-bg" style="padding:5px 0;width: 100%;" valign="top" width="100%"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;source=conf_email;pbsource=conf_email_modify" style="display:block;text-decoration:none;" target="_blank"><table border="0" cellpadding="0" cellspacing="0" class="mg_conf_btn" style="
margin:0px; padding:0px; border:0px;
" width="100%">
             <tr>
              <td align="center" valign="top">
               <table border="0" cellpadding="0" cellspacing="0" style="
margin:0px; padding:0px; border:0px;
">
                <tr>
                 <td style="
text-align:left;
" valign="middle" width="30"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;source=conf_email;pbsource=conf_email_modify" target="_blank"><img  height="25" src="https://r.bstatic.com/static/img/conf_email/cog-blue.gif" style="outline:none; text-decoration:none; -ms-interpolation-mode: bicubic; border:none; display:block;" width="25" /></a></td>
                 <td style="
text-align:left;
 
font-size:14px;line-height:19px;
font-family: arial;
color:#333;
page-break-after: avoid;
" valign="middle"><a href="<?php echo $manage_url; ?>" style="color:#0896ff;" target="_blank">
Manage your booking
</a></td>
                </tr>
               </table>
              </td>
             </tr>
            </table></a></td>
          <td class="hide_on_mobile"></td>
          <td class="responsive_td td--has-bg" style="padding:5px 0;width: 100%;" valign="top" width="100%"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;source=conf_email;pbsource=conf_email_modify;print_confirmation=1" style="display:block;text-decoration:none;" target="_blank"><table border="0" cellpadding="0" cellspacing="0" class="mg_conf_btn" style="
margin:0px; padding:0px; border:0px;
" width="100%">
             <tr>
              <td align="center" class="td-action-print--body" style="width:0; overflow:hidden;float:left; display:none;" valign="top">
               <table border="0" cellpadding="0" cellspacing="0" class="td-action-print--body" style="
margin:0px; padding:0px; border:0px;
width:0; overflow:hidden;float:left; display:none;">
                <tr>
                 <td style="
text-align:left;
" valign="middle" width="30"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;source=conf_email;pbsource=conf_email_modify;print_confirmation=1" target="_blank"><img  height="25" src="https://r.bstatic.com/static/img/conf_email/print-blue.gif" style="outline:none; text-decoration:none; -ms-interpolation-mode: bicubic; border:none; display:block;" width="25" /></a></td>
                 <td style="
text-align:left;
 
font-size:14px;line-height:19px;
font-family: arial;
color:#333;
page-break-after: avoid;
" valign="middle"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;source=conf_email;pbsource=conf_email_modify;print_confirmation=1" style="color:#0896ff;" target="_blank"><span style="white-space:nowrap;">Get the print version</span></a></td>
                </tr>
               </table>
              </td>
             </tr>
            </table></a></td>
         </tr>
        </table>
       </td>
      </tr>
      <tr>
       <td style="padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_booking_summary" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
" valign="top"><b>Booking number</b></td>
          <td class="responsive_td responsive_value" style="
text-align:right;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
" valign="top"><?php echo $reservation_code; ?></td>
         </tr>
         <tr>
          <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
 " valign="top"><b>PIN Code</b></td>
          <td class="responsive_td responsive_value" style="
text-align:right;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
 " valign="top"><?php echo $pincode;?></td>
         </tr>
         <tr>
          <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
" valign="top"><b>Your reservation</b></td>
          <td class="responsive_td responsive_value" style="
text-align:right;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
" valign="top">
<?php echo $nights ?> night,
<?php echo count(json_decode($rooms)); ?> room
</td>
         </tr>
         <tr>
          <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
" valign="top"><b>Check-in</b></td>
          <td class="responsive_td responsive_value" style="
text-align:right;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
" valign="top"><time datetime="2015-09-03T15:00:00-04:00"><?php echo date('l F, l, Y',strtotime($checkin)); ?></time>
<span style="color:#777777; white-space:nowrap;">
(15:00 - 23:00)
</span></td>
         </tr>
         <tr>
          <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
 " valign="top"><b>Check-out</b></td>
          <td class="responsive_td responsive_value" style="
text-align:right;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
 " valign="top"><time datetime="2015-09-04T12:00:00-04:00"><?php echo date('l F, l, Y',strtotime($checkout)); ?></time>
<span style="color:#777777; white-space:nowrap;">
(until 12:00)
</span></td>
         </tr>
         <tr>
          <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
 " valign="top"><b>Booked by</b></td>
          <td class="responsive_td responsive_value" style="
text-align:right;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
 " valign="top"><span><?php echo $name_title.' '.$first_name.' '.$last_name; ?></span> (<span><?php echo $email; ?></span>)
</td>
         </tr>
         <tr>
          <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
" valign="top"><b>Booking first made on</b></td>
          <td class="responsive_td responsive_value" style="
text-align:right;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
" valign="top"><?php echo $reservation_date; ?></td>
         </tr>
        </table>
       </td>
      </tr>
      <tr>
       <td style="padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_price" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td style="
background-color:#e6edf6;
border:1px solid #cfd6e0;
 padding:15px;" valign="top">
           <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_price_breakdown" style="
margin:0px; padding:0px; border:0px;
" width="100%">
            <?php foreach (json_decode($rooms) as $key => $room) : ?>
            <tr>
             <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
 color:#003580;" valign="top"><b>
<?php echo $room->name; ?> (x <?php echo $room->qty; ?>)
</b></td>
             <td style="
text-align:right;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
 color:#003580;" valign="top"><b style="white-space:nowrap;"><?php echo $room->price; ?> <?php echo $hotel_info->currency; ?></b></td>
            </tr>
          <?php endforeach; ?>

          <?php foreach (json_decode($extras) as $key => $extra) : ?>
            <tr>
             <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
 color:#003580;" valign="top"><b><?php echo $extra->name; ?>
</b></td>
             <td style="
text-align:right;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px dotted #aaaaaa;
padding-top:5px;
padding-bottom:5px;
 color:#003580;" valign="top"><b style="white-space:nowrap;"><?php echo $extra->price; ?> <?php echo $hotel_info->currency; ?></b></td>
            </tr>
          <?php endforeach; ?>

            <tr>
             <td style="
text-align:left;
 
font-size:18px;line-height:22px;
font-family: arial;
color:#003580;
page-break-after: avoid;
font-weight:bold;
 padding-top:5px;" valign="top"><b>
Total Price
</b></td>
             <td style="
text-align:right;
 
font-size:16px;line-height:21px;
font-family: arial;
color:#333;
page-break-after: avoid;
 padding-top:5px; color:#003580; padding-left:5px;" valign="top"><b style="white-space:nowrap;"><?php echo $total_price; ?> <?php echo $hotel_info->currency; ?></b></td>
            </tr>
            <tr>
             <td colspan="2" style="
text-align:right;
 
font-family: arial;
color:#333;
font-size:11px;line-height:15px;
 vertical-align:middle;" valign="middle"><a href="http://www.booking.com/general.html?tmpl=doc/rate_guarantee&amp;via_bpg_link"><img  src="https://q.bstatic.com/static/img/conf_email/congrats_transparent_bg.png" style="padding-right:5px; vertical-align: middle; outline:none; border:none;" />Best Price Guaranteed</a></td>
            </tr>
           </table>
           <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_price_extra" style="
margin:0px; padding:0px; border:0px;
" width="100%">
            <tr>
             <td>&nbsp;</td>
            </tr>
            
            
           </table>
          </td>
         </tr>
        </table>
       </td>
      </tr>
      <tr>
       <td style="padding-bottom:10px; padding-left:10px; padding-right:10px;" valign="top">
       </td>
      </tr>

      <?php if (isset($settings['map_lat']) or isset($settings['map_long'])) : ?>
      <tr>
       <td style="padding-top:10px; padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_map" style="
margin:0px; padding:0px; border:0px;
 " width="100%">
         <tr>
          <td style="
text-align:left;
 
font-size:22px;line-height:24px;
font-family: arial;
color:#b0b0b0;
page-break-after: avoid;
 color:#003580; padding-bottom:10px;" valign="top"><b>
 <?php echo $hotel_info->name; ?> On Map</b></td>
         </tr>
         <tr>
          <td valign="top"><a href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo $settings['map_lat']; ?>+<?php echo $settings['map_long']; ?>" target="_blank" title="New York Hilton Midtown">
<img border="0" class="responsive_img" height="185" src="https://maps.googleapis.com/maps/api/staticmap?zoom=13&size=600x185&maptype=roadmap&markers=color:blue%7Clabel:S%7C<?php echo $settings['map_lat']; ?>,<?php echo $settings['map_long']; ?>" style="outline:none; text-decoration:none; -ms-interpolation-mode: bicubic; border:none; display:block;" title="Can't see this map? Click here to view location and directions." width="580" />
</a></td>
         </tr>
        </table>
       </td>
      </tr>
      <?php endif; ?>

<?php foreach (json_decode($rooms) as $key => $room) : ?>
<?php if($room->policy != 0) : ?>
<?php $p = get_policy($room->policy);?>

      <tr>
       <td style="padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_room_name_and_description" style="
margin:0px; padding:0px; border:0px;
 " width="100%">
         <tr>
          <td style="
text-align:left;
 
font-size:18px;line-height:22px;
font-family: arial;
color:#003580;
page-break-after: avoid;
font-weight:bold;
 padding-bottom:10px;" valign="top">
Room Details (<?php echo $room->name; ?>)
</td>
         </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_room_policies" style="
margin:0px; padding:0px; border:0px;
 " width="100%">
         <tr>
          <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
padding-right:20px;
" valign="top"><b>Guest name</b></td>
          <td class="responsive_td responsive_value" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
width:70%;
" valign="top">
<?php echo $first_name.' '.$last_name; ?>
</td>
         </tr>
         <tr>
          <td class="responsive_td responsive_key" style="text-align:left;font-family: arial;color:#333;font-size:12px;line-height:17px;border-bottom:1px solid #d3d3d3;padding-top:5px;padding-bottom:5px;padding-right:20px;" valign="top">
          <b><?php echo lang('sales_policy'); ?></b></td>
          <td class="responsive_td responsive_value" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
width:70%;
" valign="top">
<?php if(checkbox_selected(@$p->sales->policy_note)){
            echo lang('policy_note');
        }
        if(checkbox_selected(@$p->sales->credit_card)){
            echo lang('credit_card');
        }

        if(checkbox_selected(@$p->sales->valid_card->status)){
            $value  = $p->sales->valid_card->no_card_depozit_value;
            $days   = $p->sales->valid_card->no_card_depozit_days;
            
            echo sprintf(lang('valid_card'),$value,$p->sales->valid_card->no_card_depozit_method,$days); 

        }

        if(checkbox_selected(@$p->sales->depozit_after_resv->status)){
            $days = $p->sales->depozit_after_resv->days;
            echo sprintf(lang('depozit_after_resv'), $days);
        }

        if(checkbox_selected(@$p->sales->taxes)){
            echo lang('taxes');
        }

        if(checkbox_selected(@$p->sales->checkin->status)){
            echo sprintf(lang('checkin'),$p->sales->checkin->value);
        }

        if(checkbox_selected(@$p->sales->checkout->status)){
            echo sprintf(lang('checkout'),$p->sales->checkout->value);
        }

        if(checkbox_selected(@$p->sales->child_age->status)){
           echo sprintf(lang('child_age'),$p->sales->child_age->value);
        }
        if(checkbox_selected(@$p->sales->payment)){
            echo lang('payment');
        }

        if(checkbox_selected(@$p->sales->info_rate)){
            echo lang('info_rate');
        }

        if(checkbox_selected(@$p->sales->resv_cancel)){
            echo lang('resv_cancel');
        }

        if(checkbox_selected(@$p->sales->resv_contact)){
            echo lang('resv_contact');
        }

        if(checkbox_selected(@$p->sales->taxes)){
            echo lang('taxes');
        }
        ?>
</td>
         </tr>

         <tr>
          <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
padding-right:20px;
" valign="top"><b><?php echo lang('cancellation_policy'); ?></b></td>
          <td class="responsive_td responsive_value" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
width:70%;
" valign="top">
           <div style="
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 margin-bottom:5px;">
  <?php if(checkbox_selected(@$p->cancel->cancellation_time->status)){
            echo sprintf(lang('cancellation_time'),$p->cancel->cancellation_time->value);
        }
        if(checkbox_selected(@$p->cancel->no_show_value->status)){
           $value = $p->cancel->no_show_value->value;
           echo sprintf(lang('no_show_value'),$value,lang(no_show_select($p->cancel->no_show_value->no_card_depozit_method)));
        }

        if(checkbox_selected(@$p->cancel->client_can_cancel)){
            echo lang('client_can_cancel');
        }

        ?>
        </div>
          </td>
         </tr>

         <?php if(NULL != $p->extra) : ?>
         <tr>
          <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
padding-right:20px;
" valign="top"><b>
Other
</b></td>
          <td class="responsive_td responsive_value" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
width:70%;
" valign="top">
           <div style="
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 ">
<?php echo @$p->extra; ?>
</div>
          </td>
         </tr>
       <?php endif; ?>


        </table>
       </td>
      </tr>


    <?php endif; ?>
  <?php endforeach; ?>
 <!--  is everything correct
   <tr>
       <td style="padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_mybooking_widget" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td style="
text-align:left;
 
font-size:18px;line-height:22px;
font-family: arial;
color:#003580;
page-break-after: avoid;
font-weight:bold;
 padding-bottom:10px;" valign="top">
Is everything correct?
</td>
         </tr>
         <tr>
          <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 padding-bottom:5px;" valign="top">
You can always view or change your booking online Ã¢â‚¬â€œ no registration required.
</td>
         </tr>
         <tr>
          <td>
           <table border="0" cellpadding="0" cellspacing="0" style="
margin:0px; padding:0px; border:0px;
" width="100%">
            <tr>
             <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 padding-right:15px;" valign="top">
              <ul style="margin:0px; padding:0px; border:0px; padding-left:15px;">
               <li style="margin-bottom:5px;"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;pbsource=email_changeccdetails" style="color: #0dacee;">
Edit credit card details
</a><li style="margin-bottom:5px;"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;pbsource=email_doCheckinTime" style="color: #0dacee;">
Request early check-in or late check-out
</a><li style="margin-bottom:5px;"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;pbsource=email_changeRequests" style="color: #0dacee;">
Contact the property
</a></ul>
             </td>
             <td class="responsive_td responsive_value" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
" valign="top">
              <ul style="margin:0px; padding:0px; border:0px; padding-left:15px;">
               <li style="margin-bottom:5px;"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;pbsource=email_changeDates" style="color: #0dacee;">
Change dates
</a><li style="margin-bottom:5px;"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;pbsource=email_changeInfo" style="color: #0dacee;">
Edit guest details
</a><li style="margin-bottom:5px;"><a href="https://secure.booking.com/myreservations.en-us.html?bn=991546491;pincode=8213;pbsource=email_doChangeRoom" style="color: #0dacee;">
Change your room
</a></ul>
             </td>
            </tr>
           </table>
          </td>
         </tr>
        </table>
       </td>
      </tr> -->


<!--    Special Requests  
    <tr>
       <td style="padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_special_request" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td style="
text-align:left;
 
font-size:18px;line-height:22px;
font-family: arial;
color:#003580;
page-break-after: avoid;
font-weight:bold;
 padding-bottom:10px;" valign="top">
Special Requests
</td>
         </tr>
         <tr>
          <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 " valign="top">
Ground-level room request: this booker requests ground-level room(s) - based on availability
<br />Hello
</td>
         </tr>
        </table>
       </td>
      </tr> -->



<!-- Important Information
      <tr>
       <td style="padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_important_info" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td style="
text-align:left;
 padding-bottom:10px;" valign="top">
           <table border="0" cellpadding="0" cellspacing="0" style="
margin:0px; padding:0px; border:0px;
">
            <tr>
             <td style="
text-align:left;
" valign="middle" width="30"><img  height="24" src="https://r.bstatic.com/static/img/conf_email/important_info.gif" style="outline:none; text-decoration:none; -ms-interpolation-mode: bicubic; border:none; display:block;" width="24" /></td>
             <td style="
text-align:left;
 
font-size:18px;line-height:22px;
font-family: arial;
color:#003580;
page-break-after: avoid;
font-weight:bold;
" valign="middle">
Important Information
</td>
            </tr>
           </table>
          </td>
         </tr>
         <tr>
          <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
" valign="top">
           <div style="
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 margin-bottom:5px;">Please note that the airport shuttle service has limited hours of operation. Charges may be applicable. Contact the property for details.</div>
           <div style="
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 ">Guests are required to show a photo ID and credit card upon check-in. Please note that all Special Requests are subject to availability and additional charges may apply.</div>
          </td>
         </tr>
        </table>
       </td>
      </tr> -->


      <tr>
       <td style="padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_payment" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td style="
text-align:left;
 
font-size:18px;line-height:22px;
font-family: arial;
color:#003580;
page-break-after: avoid;
font-weight:bold;
 padding-bottom:5px;" valign="top">Payment</td>
         </tr>
         <tr>
          <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 padding-top:5px;" valign="top">
           <div style="
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 margin-bottom:5px;">You have now confirmed and guaranteed your reservation by credit card.</div>
           <div style="
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 margin-bottom:5px;">
All payments are to be made at the property during your stay, unless otherwise stated in the policies.
</div>
           <div style="
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
">
The hotel reserves the right to pre-authorize credit cards prior to arrival. 
</div>
          </td>
         </tr>
         <tr>
          <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 padding-top:5px;" valign="top">
 <?php if(isset($settings['credit_cards'])) : ?>
           <div><b>This property accepts the following forms of payment:</b></div>
           <div>
<?php foreach ($settings['credit_cards'] as $card) {
  echo ucfirst($card).',';
}?>
</div>
<?php endif; ?>
          </td>
         </tr>
        </table>
       </td>
      </tr>


<!-- Booking Conditions 
      <tr>
       <td style="padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_hotel_policies" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td style="
text-align:left;
 
font-size:18px;line-height:22px;
font-family: arial;
color:#003580;
page-break-after: avoid;
font-weight:bold;
 padding-bottom:5px;" valign="top">
Booking Conditions
</td>
         </tr>
         <tr>
          <td style="
text-align:left;
" valign="top">
           <table border="0" cellpadding="0" cellspacing="0" style="
margin:0px; padding:0px; border:0px;
" width="100%">
            <tr>
             <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
padding-right:20px;
" valign="top"><b>Guest parking</b></td>
             <td class="responsive_td responsive_value" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
width:70%;
" valign="top">
Private parking is available on site (reservation is not needed) and costs  USD 55 per  day.
</td>
            </tr>
            <tr>
             <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
padding-right:20px;
" valign="top"><b>Internet</b></td>
             <td class="responsive_td responsive_value" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
width:70%;
" valign="top">
WiFi is available in public areas and is free of charge.
</td>
            </tr>
           </table>
          </td>
         </tr>
         <tr>
          <td style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 padding-top:5px;"><a href="https://www.booking.com/hotel/us/hilton-new-york.html?aid=304142;checkin=2015-09-03;checkout=2015-09-04;label=postbooking_confemail#policies">See all Booking Conditions</a></td>
         </tr>
        </table>
       </td>
      </tr> -->
      <tr>
       <td style="padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_hotel_policies" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td style="
text-align:left;
 
font-size:18px;line-height:22px;
font-family: arial;
color:#003580;
page-break-after: avoid;
font-weight:bold;
 padding-bottom:5px;" valign="top">
Need help with your reservation?
</td>
         </tr>
         <tr>
          <td style="
text-align:left;
" valign="top">
           <table border="0" cellpadding="0" cellspacing="0" style="
margin:0px; padding:0px; border:0px;
" width="100%">
            <tr>
             <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
padding-right:20px;
" valign="top"><b>Contact the property</b></td>
             <td class="responsive_td responsive_value" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
width:70%;
" valign="top">
Phone: <?php echo $hotel_info->phone;?>
</td>
            </tr>
            <tr>
             <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
padding-right:20px;
" valign="top"><b>Manage your booking</b></td>
             <td class="responsive_td responsive_value" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
width:70%;
" valign="top">

              <div style="margin-bottom:10px;">You can <a href="<?php echo $manage_url; ?>" target="_blank">view your reservation</a> or <a href="<?php echo $manage_url; ?>" target="_blank">make changes</a> online anytime.</div>

             </td>
            </tr>
            <tr>
             <td class="responsive_td responsive_key" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
padding-right:20px;
" valign="top">
             </td>
             <td class="responsive_td responsive_value" style="
text-align:left;
 
font-family: arial;
color:#333;
font-size:12px;line-height:17px;
 
border-bottom:1px solid #d3d3d3;
padding-top:5px;
padding-bottom:5px;
 
width:70%;
" valign="top">
              <div>
When calling from a landline or IP phone: <span style="direction: ltr; unicode-bidi:bidi-override;"><?php echo $hotel_info->phone; ?></span><br />
Please dial the International number when calling from a cell phone. 
<br />
When abroad or from United States of America:: <span style="direction: ltr; unicode-bidi:bidi-override;"><?php echo $hotel_info->phone; ?></span><br />
              </div>
             </td>
            </tr>
           </table>
          </td>
         </tr>
        </table>
       </td>
      </tr>

      <tr>
       <td style="
text-align:left;
 
color:#333;
font-style:italic;
font-family: Georgia, Serif;
 padding-top:5px; padding-bottom:20px; padding-left:10px; padding-right:10px; " valign="top">
        <div style="font-size:16px;line-height:21px;">Have a great trip!</div>
        <div style="font-size:13px;line-height:18px;"><?php echo $hotel_info->name; ?>  Customer Service Team</div>
       </td>
      </tr>
      <tr>
       <td style="padding-top:20px; padding-bottom:20px; padding-left:10px; padding-right:10px;" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" class="mg_conf_footer" style="
margin:0px; padding:0px; border:0px;
" width="100%">
         <tr>
          <td align="center" style="
font-family: arial;
font-size:11px;line-height:15px;
color: #687485;
 padding-bottom:10px; padding-top:15px; border-top:1px solid #d3d3d3;" valign="top">
           <div>
Copyright © 1996 - 2015 Rabooking.com.
All rights reserved.<br />
This email was sent by rabooking.com, <?php echo $hotel_info->email; ?>
</div>
          </td>
         </tr>
        </table>
       </td>
      </tr>
     </table>
    </td>
   </tr>
  </table>
 </body>
</html>
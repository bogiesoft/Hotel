<?php $this->load->view('header'); ?>
  <link href="<?php echo site_url('assets/back'); ?>/css/deal.creator.css" rel="stylesheet">

    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> Price Plans </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>">Yönetim</a></li>
          <li class="active">Price Plans</li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            

              <div class="deals_navigation" >
                <input id="deal_type" type="hidden" value="" name="deal_type" />
                <span id="simple_deal_label" class="outer_span">
                  <span class="menu_icon"></span>
                  Basic deal
                  <span class="arrow_up"></span>
                </span>
                <span id="minimum_stay_label" class="outer_span">
                  <span class="menu_icon"></span>
                  Minimum stay
                  <span class="arrow_up"></span>
                </span>
                <span id="early_bird_label" class="outer_span">
                  <span class="menu_icon"></span>
                  Early booker
                  <span class="arrow_up"></span>
                </span>
                <span id="last_minute_label" class="outer_span">
                  <span class="menu_icon"></span>
                  Last minute
                  <span class="arrow_up"></span>
                </span>
                <span id="twentyfour_promotion_label" class="outer_span">
                  <span class="menu_icon"></span>
                  24h promotion
                  <span class="arrow_up"></span>
                </span>   
              </div>

              <div class="alert simple_deal explanation_header">
                <h2>Our <strong>Basic deals</strong> are the easiest to create, just decide on the discount and the dates for the rooms you want to create a promotion for and that's it!</h2>
              </div>

              <div class="alert minimum_stay explanation_header">
                <h2><strong>Minimum Stay</strong> deals require that the booking is for 2 or 3 nights.</h2>
              </div>
              <div class="alert early_bird explanation_header">
                <h2><strong>Early booker</strong> deals are for people booking very early. You can tell us how long in advance they must book - days, weeks, or months!</h2>
              </div>
              <div class="alert last_minute explanation_header">
                <h2><strong>Last minute</strong> deals are only available to people booking very late. Restrict it to the last few days or hours before arrival!</h2>
              </div>
              <div class="alert twentyfour_promotion explanation_header">
                <h2><strong>24 hour promotions</strong> are limited time offers that can only be booked on one particular day.</h2>
              </div>

            </div>
          </div>
        </div>
      </div><!-- row -->

      <div class="row" id="promotion_form" style="display:none">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
              <form>
               
              <div class="form-group">
                <label class="col-sm-3 control-label">Set Name</label>
                  <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                       <input name="discount_name" type="text" class="form-control" />
                    </div>
                  </div>

                  </div>
              </div>


               <div class="form-group">
                <label class="col-sm-3 control-label">Deal discount</label>
                  <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                     
                     <div id="slider-wrapper">
                      <div id="slider-lowest" class="slider-label">0%</div>
                      <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" style="background: rgb(0, 204, 0);"><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 100%;"></a></div> 
                      <div id="slider-highest" class="slider-label end">100%</div>
                      <div id="discount_input">
                        <input id="input_percent" name="discount" type="text" value="40" />%
                      </div>
                      <small>Click and drag the slider to select your percentage discount</small>
                    </div>
                    </div>
                  </div>

                  </div>
              </div>

              <hr>
              <div class="form-group">
                <label class="col-sm-3 control-label">Active Date Range</label>
                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">From</label>
                    <input required type="text" name="start_date" class="form-control input-sm from_date">
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">To</label>
                    <input required type="text" name="end_date" class="form-control input-sm to_date">
                  </div>
                </div><!-- col-sm-6 -->
                </div>
                <div class="row">
                 <small>Date ranges that this plan is available</small>
                </div>
              </div>
              <hr>

               <div class="form-group">
                <label class="col-sm-3 control-label">Available Days</label>
                 <div class="row">
                <?php foreach (days_checkbox() as $d => $day) : ?>
                <div class="col-sm-1">
                  <div class="form-group">
                    <label class="control-label"><?php echo $d; ?></label>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" checked name="daily_range[<?php echo $d; ?>]" id="day_<?php echo $d; ?>" />
                      <label for="day_<?php echo $d; ?>"></label>
                    </div>
                  </div>
                </div><!-- col-sm-6 -->
                <?php endforeach; ?>
               </div>
               </div>
               <hr>

               <div class="form-group min_stay_input" style="display:none">
                <label class="col-sm-3 control-label">Minimum Stay (Nights)</label>
                <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group">
                  <input type="text" id="spinner" name="min_stay">
                  </div>
                  </div>
                </div>
                <hr>
              </div>
              

              <div class="form-group early_booker_input" style="display:none">
                <label class="col-sm-3 control-label">Booking Days</label>
                
                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">From</label>
                    <input required type="text" name="booking_start" class="form-control input-sm from_date">
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">To</label>
                    <input required type="text" name="booking_end" class="form-control input-sm to_date">
                  </div>
                </div><!-- col-sm-6 -->
                </div>
                <div class="row">
                 <small>Date ranges that guests can make reservations</small>
                </div>
                <hr>
              </div>

              <div class="form-group last_minute_input" style="display:none">
                <label class="col-sm-3 control-label">When can the deal be booked?</label>
                
                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                  <input type="text" id="spinner2" name="last_min_qty">
                  </div>                
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                  <select class="form-control" name="last_min_val">
                    <option value="day">Days</option>
                    <option value="hour" selected="selected">Hours</option>

                  </select>
                    
                  </div>
                </div><!-- col-sm-6 -->
                </div>
                <div class="row">
                 <small>Date ranges that guests can make reservations</small>
                </div>
                <hr>
              </div>

              <div class="form-group twentyfour_promotion_input" style="display:none">
                <label class="col-sm-3 control-label">When can customers book?</label>
                
                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">s
                    <input required type="text" name="twentyfour_date" class="form-control input-sm from_date">
                  </div>
                </div><!-- col-sm-6 -->
                </div>
                <div class="row">
                 <small>Customers can only book the deal on the day that you select, from 00:01 until 23:59.</small>
                </div>
                <hr>
              </div>
              

               <div class="form-group">
                <label class="col-sm-3 control-label">Rooms</label>
                 <div class="row">
                <?php foreach ($rooms as $r => $room) : ?>
                <div class="col-sm-1">
                  <div class="form-group">
                    <label class="control-label"><?php echo $room->name; ?></label>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" checked name="rooms[<?php echo $room->id; ?>]" id="day_<?php echo $room->id; ?>" />
                      <label for="day_<?php echo $room->id; ?>"></label>
                    </div>
                  </div>
                </div><!-- col-sm-6 -->
                <?php endforeach; ?>
               </div>
               </div>
               <hr>

              <input id="promo_type" type="hidden" name="promotion_type"/>


              <div class="row">
              <div class="col-sm-2">
              <input type="submit" class="btn btn-primary" value="Kaydet">
              </div>
                
               <div class="col-sm-6">
                <div id="result" class="alert" style="display:none"></div>
                </div>
              </div>

              </form>
            </div>
          </div>
        </div>
      </div><!-- row -->

    </div><!-- contentpanel -->

<script type="text/javascript">
$(document).ready(function(){

  //datepicker
  jQuery('.from_date').datepicker({ dateFormat: 'yy-mm-dd' });
  jQuery('.to_date').datepicker({ dateFormat: 'yy-mm-dd' });

  //slider options
   var update_slider = function (event, ui) {
        $("#input_percent").val(ui.value);
        var rgb;
        if (ui.value < 5) {
    rgb = '#cc0000';
        } else if (ui.value < 15) {
          rgb = '#cc6600';
        } else if (ui.value < 25) {
          rgb = '#cccc00';
        } else if (ui.value < 50) {
          rgb = '#66cc00';
        } else {
          rgb = '#00cc00';
        }

    $("#slider-range").css("background", rgb);
    ui.handle.blur();
  };

  $("#slider-range").slider({
      value: $('#input_percent').val(),
      min: 0,
      max: 100,
      slide: update_slider
  });
  
  function input_percent_change(e) {
    var s = $("#slider-range").slider();
      var value = $('#input_percent').val();
    s.slider('option', 'value', value);
    $.proxy(update_slider(e, {
      handle: $('.ui-slider-handle')[0], 
      value: parseInt(value)
    }), $("#slider-range"));
    //s.slider('refresh');
  }
  $('#input_percent').change(input_percent_change).val($('#slider-range').slider('value'));

  //spinner
  var spinner = jQuery('#spinner').spinner();
  spinner.spinner('value', 2);

  var spinner2 = jQuery('#spinner2').spinner();
  spinner2.spinner('value', 12);

  //explanations on badge hover
  $('#simple_deal_label').mouseover(function(){
    $('.simple_deal').show();});
  $('#simple_deal_label').mouseout(function(){
    if(!$('.simple_deal').hasClass('shown')){
      $('.simple_deal').hide()
    }
  });

  $('#minimum_stay_label').mouseover(function(){
    $('.minimum_stay').show();});
  $('#minimum_stay_label').mouseout(function(){
    if(!$('.minimum_stay').hasClass('shown')){
      $('.minimum_stay').hide()
    }
  });

  $('#early_bird_label').mouseover(function(){
    $('.early_bird').show();});
  $('#early_bird_label').mouseout(function(){
    if(!$('.early_bird').hasClass('shown')){
      $('.early_bird').hide()
    }  
  });

  $('#last_minute_label').mouseover(function(){
    $('.last_minute').show();});
  $('#last_minute_label').mouseout(function(){
    if(!$('.last_minute').hasClass('shown')){
      $('.last_minute').hide()
    }
  });

  $('#twentyfour_promotion_label').mouseover(function(){
    $('.twentyfour_promotion').show();});
  $('#twentyfour_promotion_label').mouseout(function(){
    if(!$('.twentyfour_promotion').hasClass('shown')){
      $('.twentyfour_promotion').hide()
    } 
  });


  //show-hide inputs
  $('#simple_deal_label').on('click', function(){
    remove_shown('simple_deal');
    remove_selected('simple_deal_label');
    $('#promotion_form').fadeIn();
   
    //set promotion type
    $('#promo_type').val('1');

    $('.min_stay_input').fadeOut();
    $('.early_booker_input').fadeOut();
    $('.last_minute_input').fadeOut();
    $('.twentyfour_promotion_input').fadeOut();
  });

  $('#minimum_stay_label').on('click', function(){
    $('#promotion_form').fadeIn();
    remove_shown('minimum_stay');
    remove_selected('minimum_stay_label');

     //set promotion type
    $('#promo_type').val('2');

    $('.min_stay_input').fadeIn();
    $('.early_booker_input').fadeOut();
    $('.last_minute_input').fadeOut();
    $('.twentyfour_promotion_input').fadeOut();
  });

  $('#early_bird_label').on('click', function(){
    $('#promotion_form').fadeIn();
    remove_shown('early_bird');
    remove_selected('early_bird_label');

     //set promotion type
    $('#promo_type').val('3');

    $('.min_stay_input').fadeOut();
    $('.early_booker_input').fadeIn();
    $('.last_minute_input').fadeOut();
    $('.twentyfour_promotion_input').fadeOut();
  });

  $('#last_minute_label').on('click', function(){
    $('#promotion_form').fadeIn();
    remove_shown('last_minute');
    remove_selected('last_minute_label');

     //set promotion type
    $('#promo_type').val('4');

    $('.min_stay_input').fadeOut();
    $('.early_booker_input').fadeOut();
    $('.last_minute_input').fadeIn();
    $('.twentyfour_promotion_input').fadeOut();
  });

  $('#twentyfour_promotion_label').on('click', function(){
    $('#promotion_form').fadeIn();
    remove_shown('twentyfour_promotion');
    remove_selected('twentyfour_promotion_label');

     //set promotion type
    $('#promo_type').val('5');

    $('.min_stay_input').fadeOut();
    $('.early_booker_input').fadeOut();
    $('.last_minute_input').fadeOut();
    $('.twentyfour_promotion_input').fadeIn();

  });



  var remove_shown = function(my_class){

    $('.'+my_class).hasClass('shown') ? $('.'+my_class).removeClass('shown') : $('.'+my_class).addClass('shown').show();
    
    var classes = {
      '1' : 'simple_deal',
      '2' : 'minimum_stay',
      '3' : 'early_bird',
      '4' : 'last_minute',
      '5' : 'twentyfour_promotion'};

      $.each(classes,function(key,val){
        if(my_class!=val){
          $('.'+val).removeClass('shown').hide();
        }
      });
  }

  var remove_selected = function(my_id){
    $('#'+my_id).hasClass('selected') ? $('#'+my_id).removeClass('selected'): $('#'+my_id).addClass('selected');
    var ids = {
      '1' : 'simple_deal_label',
      '2' : 'minimum_stay_label',
      '3' : 'early_bird_label',
      '4' : 'last_minute_label',
      '5' : 'twentyfour_promotion_label'};

      $.each(ids,function(key,val){
        if(my_id!=val){
          $('#'+val).removeClass('selected');
        }
      });
  }

});
</script>
<?php $this->load->view('footer'); ?>
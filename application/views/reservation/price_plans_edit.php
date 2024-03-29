<?php $this->load->view('header'); ?>
  <link href="<?php echo site_url('assets/back'); ?>/css/deal.creator.css" rel="stylesheet">

    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> <?php echo lang('price_plans'); ?> > <?php echo $p->promotion_name; ?></h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('edit_promotion'); ?></li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      <div class="row" id="promotion_form">
          
    <?php if (NULL != $this->session->flashdata('statusSuccess')) : ?>
      <div class="alert alert-success">
       <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <b><?php echo $this->session->flashdata('statusSuccess'); ?></b>
      </div>
    <?php endif; ?>

    <?php if (NULL != $this->session->flashdata('statusError')) : ?>
      <div class="alert alert-danger">
       <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <b><?php echo $this->session->flashdata('statusError'); ?></b>
      </div>
    <?php endif; ?>

        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
              <form id="add_price_plan" class="validate-form">
               
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('set_name'); ?></label>
                  <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                       <input required name="promotion_name" type="text" class="form-control" value="<?php echo $p->promotion_name; ?>" />
                    </div>
                  </div>

                  </div>
              </div>


               <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('deal_discount'); ?></label>
                  <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                     
                     <div id="slider-wrapper">
                      <div id="slider-lowest" class="slider-label">0%</div>
                      <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" style="background: rgb(0, 204, 0);"><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 100%;"></a></div> 
                      <div id="slider-highest" class="slider-label end">100%</div>
                      <div id="discount_input">
                        <input id="input_percent" name="promotion_discount" type="text" value="<?php echo $p->promotion_discount; ?>" />%
                      </div>
                      <small><?php echo lang('deal_discount_info'); ?></small>
                    </div>
                    </div>
                  </div>

                  </div>
              </div>

              <hr>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('date_range'); ?></label>
                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('from'); ?></label>
                    <input required type="text" name="start_date" class="form-control input-sm from_date" value="<?php echo $p->start_date; ?>">
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('to'); ?></label>
                    <input required type="text" name="end_date" class="form-control input-sm to_date" value="<?php echo $p->end_date; ?>">
                  </div>
                </div><!-- col-sm-6 -->
                </div>
                <div class="row">
                 <small><?php echo lang('date_range_info'); ?></small>
                </div>
              </div>
              <hr>

              <?php 
              $promo_days = explode(',', $p->daily_range);
              foreach ($promo_days as $k => $d) {
                $promo_day[$d] = $d;
              }
              ?>
               <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('available_days'); ?></label>
                 <div class="row">
                <?php foreach (days_checkbox() as $d => $day) : ?>
                <?php $checked = isset($promo_day[$d]) ? 'checked' : ''; ?>
                <div class="col-sm-1">
                  <div class="form-group">
                    <label class="control-label"><?php echo $d; ?></label>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" <?php echo $checked; ?> name="daily_range[]" value="<?php echo $d; ?>" id="day_<?php echo $d; ?>" />
                      <label for="day_<?php echo $d; ?>"></label>
                    </div>
                  </div>
                </div><!-- col-sm-6 -->
                <?php endforeach; ?>
               </div>
               </div>
               <hr>

               <?php if ($p->promotion_type=='2'): ?>
               <div class="form-group min_stay_input">
                <label class="col-sm-3 control-label"><?php echo lang('min_stay'); ?></label>
                <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group">
                  <input type="text" id="spinner" name="min_stay" value="<?php echo $p->min_stay; ?>">
                  </div>
                  </div>
                </div>
                <hr>
              </div>
              <?php endif; ?>

              <?php if ($p->promotion_type=='3'): ?>
              <div class="form-group early_booker_input">
                <label class="col-sm-3 control-label"><?php echo lang('booking_days'); ?></label>
                
                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('from'); ?></label>
                    <input required type="text" name="booking_start" class="form-control input-sm from_date" value="<?php echo $p->booking_start; ?>">
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('to'); ?></label>
                    <input required type="text" name="booking_end" class="form-control input-sm to_date" value="<?php echo $p->booking_end; ?>">
                  </div>
                </div><!-- col-sm-6 -->
                </div>
                <div class="row">
                 <small><?php echo lang('booking_days_info'); ?></small>
                </div>
                <hr>
              </div>
              <?php endif; ?>

              <?php if ($p->promotion_type=='4'): ?>
              <div class="form-group last_minute_input">
                <label class="col-sm-3 control-label"><?php echo lang('last_min_days'); ?></label>
                
                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                  <input type="text" id="spinner2" name="last_min_qty" value="<?php echo $p->last_min_qty; ?>">
                  </div>                
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                  <select class="form-control" name="last_min_val">
                    <option value="day" 
                    <?php echo $p->last_min_val=='day' ? 'selected="selected"' :''; ?>>
                    <?php echo lang('days'); ?>
                    </option>
                    <option value="hour" 
                    <?php echo $p->last_min_val=='hour' ? 'selected="selected"' :''; ?>>
                    <?php echo lang('hours'); ?>
                    </option>
                  </select>
                    
                  </div>
                </div><!-- col-sm-6 -->
                </div>
                <div class="row">
                 <small><?php echo lang('last_min_info'); ?></small>
                </div>
                <hr>
              </div>
              <?php endif; ?>

              <?php if ($p->promotion_type=='5'): ?> 
              <div class="form-group twentyfour_promotion_input">
                <label class="col-sm-3 control-label"><?php echo lang('twentyfour_date'); ?></label>
                
                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <input required type="text" name="twentyfour_date" class="form-control input-sm from_date" value="<?php echo $p->twentyfour_date; ?>">
                  </div>
                </div><!-- col-sm-6 -->
                </div>
                <div class="row">
                 <small><?php echo lang('twentyfour_info'); ?></small>
                </div>
                <hr>
              </div>
              <?php endif; ?>

              
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('available_rooms'); ?></label>
                
                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <input type="text" name="available" class="form-control input-sm" value="5">
                  </div>
                </div><!-- col-sm-6 -->
                </div>
                <div class="row">
                 <small><?php echo lang('available_rooms_info'); ?></small>
                </div>
                <hr>
              </div>
              
              <?php 
              $available_rooms = explode(',', $p->rooms); 
              foreach ($available_rooms as $key => $r) {
                $available_room[$r] = $r;
              }
              ?>

               <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('rooms'); ?></label>
                 <div class="row">
                <?php foreach ($rooms as $r => $room) : ?>
                <?php $checked = isset($available_room[$room->id]) ? 'checked' : ''; ?>
                <div class="col-sm-1">
                  <div class="form-group">
                    <label class="control-label"><?php echo $room->name; ?></label>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" <?php echo $checked; ?> name="rooms[]" value="<?php echo $room->id; ?>" id="day_<?php echo $room->id; ?>" />
                      <label for="day_<?php echo $room->id; ?>"></label>
                    </div>
                  </div>
                </div><!-- col-sm-6 -->
                <?php endforeach; ?>
               </div>
               </div>

               <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('default_policy'); ?></label>
                 <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <?php if($policies) : ?>
                      <select name="default_policy">
                      <?php foreach ($policies as $key => $policy) {
                        $selected = $p->default_policy == $policy->id ? 'selected="selected"' :'';
                        echo '<option value="'.$policy->id.'" '.$selected.'>'.$policy->policy_name.'</option>';
                      }
                      ?>
                      </select>
                    <?php else: ?>
                    <?php echo lang('no_policy'); ?>
                    <?php endif; ?>
                    </div>
                  </div><!-- col-sm-6 -->
                  </div>
                  <div id="child-ages" style="display:none">
                  <label class="col-sm-3 control-label"><?php echo lang('children_ages'); ?></label>
                  <div id="child-ages-content"></div>

                  </div>
                </div>

               <hr>

              <input type="hidden" name="promotion_id" value="<?php echo $p->id; ?>" />
              <input type="hidden" name="promotion_type" value="<?php echo $p->promotion_type; ?>" />
              <input type="hidden" name="update" value="1">


              <div class="row">
              <div class="col-sm-2">
              <input type="submit" class="btn btn-primary" value="<?php echo lang('save'); ?>">
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
<script src="<?php echo site_url('assets/back'); ?>/js/jquery.validate.min.js"></script>
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
  spinner.spinner();

  var spinner2 = jQuery('#spinner2').spinner();
  spinner2.spinner();

  //validate form and send
  $.validator.messages.required = 'Bu Alan Gerekli';
  jQuery(".validate-form").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
       /* stop form from submitting normally */
    },

    submitHandler: function(element){
    event.preventDefault();
    
      $("#result").html('');
      $('#loading').show();
      $('#savebutton').addClass('disabled');

  
      var val = $('#add_price_plan').serialize();
  
      $.ajax({
        url: base_url + "reservation_actions/add_price_plan",
        type: "POST",
        data: val,
        dataType: 'json',
        success: function(data){
          $('#loading').hide();
          $('#savebutton').removeClass('disabled');
          $('#result').html(data.message);
          $("#result").removeClass('alert-danger'); 
          $("#result").removeClass('alert-success'); 
          $("#result").addClass('alert-'+data.status);
          $("#result").fadeIn(1000);
          setTimeout(function(){ 
               $("#result").fadeOut(500); }, 3000); 
                    
        },
        error:function(){
          $('#result').html('Something went wrong!');
          $("#result").removeClass('alert-danger'); 
          $("#result").removeClass('alert-success');      
          $("#result").addClass('alert-danger');
          $("#result").fadeIn(1000);
        }   
      });  // ajax end

    }
   
  });

});
</script>
<?php $this->load->view('footer'); ?>
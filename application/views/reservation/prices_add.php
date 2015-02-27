<?php $this->load->view('header'); ?>
<div class="pageheader">
  <h2><i class="fa fa-home"></i> <?php echo lang('set_bar_prices'); ?></h2>
  <div class="breadcrumb-wrapper">
    <span class="label"><?php echo lang('you_are_here'); ?></span>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('dashboard'); ?>"><?php echo lang('manage'); ?></a></li>
      <li class="active"><?php echo lang('set_bar_prices'); ?></li>
    </ol>
  </div>
</div>

<div class="contentpanel">
    
<?php
  $by = $this->input->get('by');
?>

  <ul class="nav nav-tabs">
      <li <?php echo (empty($by) or $by=='date') ? 'class="active"' : ''; ?>><a href="?by=date"><strong><?php echo lang('by_date'); ?></strong></a></li>
      <li <?php echo $by=='season' ? 'class="active"' : ''; ?>><a href="?by=season"><strong><?php echo lang('by_season'); ?></strong></a></li>
  </ul>

  <div class="row">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="col-md-12 col-sm-3">
        <form id="form_by_date" class="validate-form">

        <?php if ($by=='date' or empty($by)) : ?>
          <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo lang('select_date_range'); ?></label>
            <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label"><?php echo lang('from'); ?></label>
                <input required type="text" name="start_date" class="form-control input-sm" id="from_date">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label"><?php echo lang('to'); ?></label>
                <input required type="text" name="end_date" class="form-control input-sm" id="to_date">
              </div>
            </div><!-- col-sm-6 -->
            </div>
          </div>
          <input type="hidden" name="by" value="date">
        <?php else : ?>

          <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo lang('select_season'); ?></label>
            <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <select class="form-control" name='season'>
                  <?php foreach ($seasons as $key => $s) {
                    echo '<option value="'.$s->id.'">'.$s->name.'</option>';
                  }?>
                </select>
              </div>
            </div><!-- col-sm-6 -->
            </div>
          </div>
          <input type="hidden" name="by" value="season">
        <?php endif; ?>

          <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label"><?php echo lang('select_room'); ?></label>
                <select class="form-control" name="room_id" onclick="room_type(this.value)">
                <?php $capacity = ''; ?>
                <?php foreach ($rooms as $key => $room) : ?>
                  <option id="room<?php echo $room->id; ?>" value="<?php echo $room->id; ?>" data-capacity="<?php echo $room->capacity; ?>" data-child="<?php echo $room->max_child; ?>">
                    <?php echo $room->name; ?>
                  </option>
                <?php 
                $capacity[$key]['capacity'] = $room->capacity;
                $capacity[$key]['child'] = $room->max_child;
                $capacity[$key]['room'] = $room->id;
                ?>
                <?php endforeach; ?>
                </select>
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-3">
              <div class="form-group" id="price_type">
                <label class="control-label"><?php echo lang('price_type'); ?></label>
                <select class="form-control" name="price_type" id="price_type_val">
                  <option value="1"><?php echo lang('unit'); ?></option>
                  <option value="2" selected="selected"><?php echo lang('person'); ?></option>
                </select>
              </div>
            </div><!-- col-sm-6 -->
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="row">
            <div class="col-sm-2">
              <div class="form-group">
                <label class="control-label"><?php echo lang('min_stay'); ?></label>
                <input type="text" name="min_stay" value="1" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2">
              <div class="form-group">
                <label class="control-label"><?php echo lang('max_stay'); ?></label>
                <input type="text" name="max_stay" value="99" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2">
              <div class="form-group">
                <label class="control-label"><?php echo lang('available'); ?></label>
                <input type="text" name="available" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            </div>
          </div>



          <div class="form-group" id="static_price">
            <label class="col-sm-3 control-label"><?php echo lang('set_prices'); ?></label>
            <div class="row">
            <div class="col-sm-1 baseprice" style="display:none">
              <div class="form-group">
                <label class="control-label"><?php echo lang('base'); ?></label>
                <input type="text" name="base_price" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="person_price">
            <div class="col-sm-1">
              <div class="form-group">
                <label class="control-label"><?php echo lang('single'); ?></label>
                <input type="text" name="single_price" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-1">
              <div class="form-group">
                <label class="control-label"><?php echo lang('double'); ?></label>
                <input type="text" name="double_price" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->

            <?php 
            if ($capacity['0']['capacity'] > 2) {
              $display = '';
            }else{
              $display = 'style="display:none"';
            }
            ?>
            <div class="col-sm-1 extra_prices0" <?php echo $display; ?>>
              <div class="form-group">
                <label class="control-label"><?php echo lang('triple'); ?></label>
                <input type="text" name="triple_price" value="" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->

            <?php 
            if ($capacity['0']['capacity'] > 3) {
              $display = '';
            }else{
              $display = 'style="display:none"';
            }
            ?>

            <div class="col-sm-1 extra_prices1" <?php echo $display; ?>>
              <div class="form-group">
                <label class="control-label"><?php echo lang('extra'); ?></label>
                <input type="text" name="extra_adult" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
          
            </div><!-- person price end -->
            <div id="child-prices"></div>

            <?php 
            if ($capacity['0']['child'] > 0) : ?>
            <?php foreach (room_children($capacity['0']['room']) as $key => $child) : ?>
            <div class="col-sm-1 child_price">
              <div class="form-group">
                <label class="control-label"><?php echo $child->child_min.'-'.$child->child_max; ?></label>
                <input type="hidden" name="child_price[<?php echo $key; ?>][min]" value="<?php echo $child->child_min; ?>">
                <input type="hidden" name="child_price[<?php echo $key; ?>][max]" value="<?php echo $child->child_max; ?>">
                <input type="text" name="child_price[<?php echo $key; ?>][price]" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <?php endforeach; ?>
            <?php endif; ?>
            </div>
          </div> <!-- static price end -->

          <div class="form-group">
            <label class="col-sm-3 control-label">Daily Range</label>
              <div class="form-group">
                <input type="checkbox" name="daily_range_val" id="daily_range_check"/>
              </div>
          </div>

          <div id="daily_range_prices" style="display:none">
          <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo lang('days'); ?></label>
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
          
          </div> <!-- daily range price end -->

        <div class="form-group">
          <label class="col-sm-3 control-label">
            <button type="submit" id="savebutton" class="btn btn-primary"><?php echo lang('save'); ?></button>
          </label>
          <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
            
              <div id="loading" class="alert" style="display:none">
                <img src="<?php echo site_url('assets/back/images/loaders'); ?>/loader6.gif" />
              </div>

              <div id="result" class="alert" style="display:none"></div>
            </div>
          </div>
          </div>
        </div>

        </form>
      </div> <!-- tab pane by date -->
  </div>
</div>
</div>

<script src="<?php echo site_url('assets/back'); ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
  //datepicker
  jQuery('#from_date').datepicker({ dateFormat: 'yy-mm-dd' });
  jQuery('#to_date').datepicker({ dateFormat: 'yy-mm-dd' });

  //form validate
  $.validator.messages.required = '<?php echo lang('require_field'); ?>';
  jQuery(".validate-form").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    },
    submitHandler: function(element){
      /* stop form from submitting normally */
      event.preventDefault();
      /*clear result div*/
      $("#result").html('');
      $('#loading').show();
      $('#savebutton').addClass('disabled');

      /* get some values from elements on the page: */
      var val = $('#form_by_date').serialize();
      /* Send the data using post and put the results in a div */
      $.ajax({
        url: base_url + "reservation_actions/add_prices",
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

  $('#daily_range_check').click(function () {
    var daily_range_check = $('#daily_range_check').is(':checked')?true:false;
    if (daily_range_check){
      $("#daily_range_prices").toggle('slow');  // checked
      //$("#static_price").toggle('slow');
    }else{
      $("#daily_range_prices").toggle('slow');  // unchecked
      //$("#static_price").toggle('slow');
    };
  });

  $('#price_type_val').on('change', function(){
    var val = this.value;
    //alert(val);
      if (val==1) 
      {
        $('.baseprice').show();
        $('.person_price').hide();
        $('.child_price').hide();
        //$("div.extra_prices0_"+id+", div.extra_prices1_"+id+", div.extra_prices2_"+id+"").hide();

      }else {
        $('.baseprice').hide();
        $('.person_price').show();
        $('.child_price').show();
        //$("div.extra_prices0_"+id+", div.extra_prices1_"+id+", div.extra_prices2_"+id+"").show();
      };
  });

});

function room_type(id){
  var capacity  = $('#room'+id).data('capacity');
  var child     = $('#room'+id).data('child');

  if (capacity<=2){
    $("div.extra_prices0, div.extra_prices1").hide();
  }else if(capacity==3){
    $("div.extra_prices0").show();
  }else{
    $("div.extra_prices0, div.extra_prices1").show();
  };

  if (child>0){
    $('.child_price').remove();
    var html = '';
    $.getJSON( base_url + "reservation_actions/room_children?id="+id).done(function(data){
      //genereate html for children prices
      $.each(data,function(i,item){
        html += '<div class="col-sm-1 child_price">'+
              '<div class="form-group">'+
                '<label class="control-label">'+item.child_min+'-'+item.child_max+'</label>'+
                '<input type="hidden" name="child_price['+i+'][min]" value="'+item.child_min+'">'+
                '<input type="hidden" name="child_price['+i+'][max]" value="'+item.child_max+'">'+
                '<input type="text" name="child_price['+i+'][price]" class="form-control input-sm">'+
              '</div>'+
            '</div><!-- col-sm-6 -->';
      });
      
      $('#child-prices').after(html);

    });
    

    //$('.child_price').show();
  }else{
    $('.child_price').hide();
  };

}

function price_type(value){
  if (value==1) 
  {
    $('.person_price').hide();
    $('.child_price').hide();
    //$("div.extra_prices0_"+id+", div.extra_prices1_"+id+", div.extra_prices2_"+id+"").hide();

  }else {
    $('.person_price').show();
    $('.child_price').show();
    //$("div.extra_prices0_"+id+", div.extra_prices1_"+id+", div.extra_prices2_"+id+"").show();
  };
  
}

</script>
<?php $this->load->view('footer'); ?>

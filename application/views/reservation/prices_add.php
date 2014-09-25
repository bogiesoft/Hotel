<?php $this->load->view('header'); ?>
<div class="pageheader">
  <h2><i class="fa fa-home"></i> Set <abbr title="Best Avalaible Rate">BAR</abbr> Prices</h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('dashboard'); ?>">Yönetim</a></li>
      <li class="active">Set <abbr title="Best Avalaible Rate">BAR</abbr> Prices</li>
    </ol>
  </div>
</div>

<div class="contentpanel">
    
<?php
  $by = $this->input->get('by');
?>

  <ul class="nav nav-tabs">
      <li <?php echo (empty($by) or $by=='date') ? 'class="active"' : ''; ?>><a href="?by=date"><strong>By Date</strong></a></li>
      <li <?php echo $by=='season' ? 'class="active"' : ''; ?>><a href="?by=season"><strong>By Seasons</strong></a></li>
  </ul>

  <div class="row">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="col-md-12 col-sm-3">
        <div class="tab-content mb30">

        <!-- By Date tab start -->
        <div class="tab-pane active" id="by_date">
    
        <form id="form_by_date" class="validate-form">

        <?php if ($by=='date' or empty($by)) : ?>
          <div class="form-group">
            <label class="col-sm-3 control-label">Select Date Range</label>
            <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label">From</label>
                <input required type="text" name="start_date" class="form-control input-sm" id="from_date">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label">To</label>
                <input required type="text" name="end_date" class="form-control input-sm" id="to_date">
              </div>
            </div><!-- col-sm-6 -->
            </div>
          </div>
          <input type="hidden" name="by" value="date">
        <?php else : ?>

          <div class="form-group">
            <label class="col-sm-3 control-label">Select Season</label>
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
                <label class="control-label">Select Room</label>
                <select class="form-control" name="room_id" onclick="room_type(this.value)">
                <?php $capacity = ''; ?>
                <?php foreach ($rooms as $key => $room) : ?>
                  <option id="room<?php echo $room->id; ?>" value="<?php echo $room->id; ?>" data-capacity="<?php echo $room->capacity; ?>" data-child="<?php echo $room->min_child; ?>">
                    <?php echo $room->name; ?>
                  </option>
                <?php 
                $capacity[$key]['capacity'] = $room->capacity;
                $capacity[$key]['child'] = $room->min_child;
                ?>
                <?php endforeach; ?>
                </select>
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-3">
              <div class="form-group" id="price_type">
                <label class="control-label">Price Type</label>
                <select class="form-control" name="price_type" id="price_type_val">
                  <option value="1">Unit</option>
                  <option value="2" selected="selected">Person</option>
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
                <label class="control-label">Min. Stay</label>
                <input type="text" name="min_stay" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2">
              <div class="form-group">
                <label class="control-label">Max. Stay</label>
                <input type="text" name="max_stay" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2">
              <div class="form-group">
                <label class="control-label">Available</label>
                <input type="text" name="available" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            </div>
          </div>



          <div class="form-group" id="static_price">
            <label class="col-sm-3 control-label">Set Prices</label>
            <div class="row">
            <div class="col-sm-1">
              <div class="form-group">
                <label class="control-label">Base</label>
                <input required type="text" name="base_price" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="person_price">
            <div class="col-sm-1">
              <div class="form-group">
                <label class="control-label">SINGLE</label>
                <input type="text" name="single_price" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-1">
              <div class="form-group">
                <label class="control-label">DOUBLE</label>
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
                <label class="control-label">TRIPLE</label>
                <input type="text" name="triple_price" value="" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-1 extra_prices1" <?php echo $display; ?>>
              <div class="form-group">
                <label class="control-label">EXTRA</label>
                <input type="text" name="extra_adult" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
          
            </div><!-- person price end -->
            <?php 
            if ($capacity['0']['child'] > 0) {
              $display = '';
            }else{
              $display = 'style="display:none"';
            }
            ?>
            <div class="col-sm-1 child_price" <?php echo $display; ?>>
              <div class="form-group">
                <label class="control-label">CHILD</label>
                <input type="text" name="child_price" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->

            </div>
          </div> <!-- static price end -->

          <div class="form-group">
            <label class="col-sm-3 control-label">Daily Range</label>
              <div class="form-group">
                <input type="checkbox" name="daily_range_val" id="daily_range_check"/>
              </div>
          </div>

          <div id="daily_range_prices" style="display:none">

          <?php foreach (days_checkbox() as $d => $day) : ?>
          <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $day; ?></label>
            <div class="row">
            <div class="col-sm-1">
              <div class="form-group">
                <label class="control-label">Base</label>
                <input type="text" name="daily_range[<?php echo $d; ?>][base_price]" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="person_price">
            <div class="col-sm-1">
              <div class="form-group">
                <label class="control-label">SINGLE</label>
                <input type="text" name="daily_range[<?php echo $d; ?>][single_price]" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-1">
              <div class="form-group">
                <label class="control-label">DOUBLE</label>
                <input type="text" name="daily_range[<?php echo $d; ?>][double_price]" class="form-control input-sm">
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
                <label class="control-label">TRIPLE</label>
                <input type="text" name="daily_range[<?php echo $d; ?>][triple_price]" value="" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-1 extra_prices1" <?php echo $display; ?>>
              <div class="form-group">
                <label class="control-label">EXTRA</label>
                <input type="text" name="daily_range[<?php echo $d; ?>][extra_adult]" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->
          
            </div><!-- person price end -->
            <?php 
            if ($capacity['0']['child'] > 0) {
              $display = '';
            }else{
              $display = 'style="display:none"';
            }
            ?>
            <div class="col-sm-1 child_price" <?php echo $display; ?>>
              <div class="form-group">
                <label class="control-label">CHILD</label>
                <input type="text" name="daily_range[<?php echo $d; ?>][child_price]" class="form-control input-sm">
              </div>
            </div><!-- col-sm-6 -->

            </div>
            </div> 
          <?php endforeach; ?>
          </div> <!-- daily range price end -->

        <div class="form-group">
          <label class="col-sm-3 control-label">
            <button type="submit" id="savebutton" class="btn btn-primary">Kaydet</button>
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

        </div>
        
        </form>
      </div> <!-- tab pane by date -->
  </div>
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
  $.validator.messages.required = 'Bu Alan Gerekli';
  jQuery(".validate-form").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
      
      $("#form_by_date").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();
        /*clear result div*/
        $("#result").html('');
        $('#loading').show();
        $('#savebutton').addClass('disabled');

        /* get some values from elements on the page: */
        var val = $(this).serialize();
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
              $("#result").removeClass('alert-error'); 
              $("#result").removeClass('alert-success');      
              $("#result").addClass('alert-error');
              $("#result").fadeIn(1000);
            }   
          }); 
      }); /* ajax end */
    }
  });

  $('#daily_range_check').click(function () {
    var daily_range_check = $('#daily_range_check').is(':checked')?true:false;
    if (daily_range_check){
      $("#daily_range_prices").show();  // checked
      $("#static_price").toggle('slow');
    }else{
      $("#daily_range_prices").hide();  // unchecked
      $("#static_price").toggle('slow');
    };
  });

  $('#price_type_val').on('change', function(){
    var val = this.value;
    //alert(val);
      if (val==1) 
      {
        $('.person_price').hide();
        $('.child_price').hide();
        //$("div.extra_prices0_"+id+", div.extra_prices1_"+id+", div.extra_prices2_"+id+"").hide();

      }else {
        $('.person_price').show();
        $('.child_price').show();
        //$("div.extra_prices0_"+id+", div.extra_prices1_"+id+", div.extra_prices2_"+id+"").show();
      };
  });

});

function room_type(id){
  var capacity  = $('#room'+id).data('capacity');
  var child     = $('#room'+id).data('child');

  if (capacity<3){
    $("div.extra_prices0, div.extra_prices1, div.extra_prices2").hide();
  }else{
    $("div.extra_prices0, div.extra_prices1, div.extra_prices2").show();
  };

  if (child>0){
    $('.child_price').show();
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

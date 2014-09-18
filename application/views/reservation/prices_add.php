<?php $this->load->view('header'); ?>
<div class="pageheader">
  <h2><i class="fa fa-home"></i> Set <abbr title="Base Awalible Rate">BAR</abbr> Prices</h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('dashboard'); ?>">Yönetim</a></li>
      <li class="active">Set <abbr title="Base Awalible Rate">BAR</abbr> Prices</li>
    </ol>
  </div>
</div>

<div class="contentpanel">
    

  <ul class="nav nav-tabs">
      <li class="active"><a href="#general" data-toggle="tab"><strong>By Date</strong></a></li>
      <li class=""><a href="#info" data-toggle="tab"><strong>By Seasons</strong></a></li>
  </ul>

  <div class="row">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="col-md-12 col-sm-3">
        <div class="tab-content mb30">

        <!-- By Date tab start -->
        <div class="tab-pane active" id="general">
    
          <div class="form-group">
            <label class="col-sm-3 control-label">Select Date Range</label>
             <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label">From</label>
                <input type="text" name="start_date" class="form-control input-sm" id="from_date">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label">To</label>
                <input type="text" name="end_date" class="form-control input-sm" id="to_date">
              </div>
            </div><!-- col-sm-6 -->
          </div>
          </div>

          <div class="panel-group" id="accordion">
          <?php foreach ($rooms as $key => $room) : ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-target="#collapse<?php echo $key; ?>" href="#collapse<?php echo $key; ?>">
                    <?php echo $room->name; ?>
                  </a>
                </h4>
              </div>
              <div id="collapse<?php echo $key; ?>" class="panel-collapse collapse in">
                <div class="panel-body">


                  <div class="form-group">
                    <label class="col-sm-3 control-label">Set Prices</label>
                    <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group" id="price_type">
                        <label class="control-label">Price Type</label>
                        <select class="form-control" onchange="price_type(<?php echo $room->id; ?>,this.value)" id="price_type<?php echo $room->id; ?>">
                          <option value="1">Unit</option>
                          <option value="2" selected="selected">Person</option>
                        </select>
                      </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label">Base Price</label>
                        <input type="text" name="prices[<?php echo $room->id; ?>][base_price]" class="form-control input-sm">
                      </div>
                    </div><!-- col-sm-6 -->
                    </div>
                  </div>

                  <div class="form-group extra_prices0_<?php echo $room->id; ?>">
                    <label class="col-sm-3 control-label"></label>
                    <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label">Single Price</label>
                        <input type="text" name="prices[<?php echo $room->id; ?>][single_price]" class="form-control input-sm">
                      </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label">Double Price</label>
                        <input type="text" name="prices[<?php echo $room->id; ?>][double_price]" class="form-control input-sm">
                      </div>
                    </div><!-- col-sm-6 -->
                    </div>
                  </div>

                  <?php //capacity'den Büyükse
                  if ($room->capacity > 2) : ?>
                  <div class="form-group extra_prices1_<?php echo $room->id; ?>">
                  <label class="col-sm-3 control-label"></label>
                    <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label">Triple Price</label>
                        <input type="text" name="prices[<?php echo $room->id; ?>][triple_price]" class="form-control input-sm">
                      </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label">Extra Adult</label>
                        <input type="text" name="prices[<?php echo $room->id; ?>][extra_dault]" class="form-control input-sm">
                      </div>
                    </div><!-- col-sm-6 -->
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group extra_prices2_<?php echo $room->id; ?>">
                    <label class="col-sm-3 control-label">Children Prices</label>
                    <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label">Single Child</label>
                        <input type="text" name="prices[<?php echo $room->id; ?>][child_price]" class="form-control input-sm">
                      </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label">Extra Child</label>
                        <input type="text" name="prices[<?php echo $room->id; ?>][extra_child]" class="form-control input-sm">
                      </div>
                    </div><!-- col-sm-6 -->
                    </div>
                  </div>


                </div>
              </div>
            </div>
          <?php endforeach; ?>
          </div> <!-- by date tab end -->

      </div>

    </div>
  </div>
</div>
</div>




</div>

<script type="text/javascript">
jQuery(document).ready(function(){
  //datepicker
  jQuery('#from_date').datepicker({ dateFormat: 'yy-mm-dd' });
  jQuery('#to_date').datepicker({ dateFormat: 'yy-mm-dd' });


  $("select#price_type").change(function(){
      $('.extra_prices').remove();
  });

});

function price_type(id,value){
  if (value==1) 
  {
    $("div.extra_prices0_"+id+", div.extra_prices1_"+id+", div.extra_prices2_"+id+"").hide();

  }else {
    $("div.extra_prices0_"+id+", div.extra_prices1_"+id+", div.extra_prices2_"+id+"").show();
  };
  
}

</script>
<?php $this->load->view('footer'); ?>

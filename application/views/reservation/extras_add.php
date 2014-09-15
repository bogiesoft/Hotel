<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> Add Extras > <?php echo $this->session->userdata('hotel_name'); ?></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>">Yönetim</a></li>
          <li class="active">Add Extras to <?php echo $this->session->userdata('hotel_name'); ?> </li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
    <?php if($this->session->flashdata('success')): ?>
      <div id="result" class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('success'); ?>
      </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
      <div id="result" class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('error'); ?>
      </div>
    <?php endif; ?>


      <ul class="nav nav-tabs">
          <li class="active"><a href="#general" data-toggle="tab"><strong>Genel Bilgi</strong></a></li>
          <li class=""><a href="#description" data-toggle="tab"><strong>Açıklamalar</strong></a></li>
      </ul>
    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
           
           <form id="save_hotel_details2" method="POST" action="<?php echo site_url('reservation_actions/save_extra'); ?>">
            <div class="tab-content mb30">
            
            <div class="tab-pane active" id="general">
              <div class="form-group">
                <label class="col-sm-3 control-label">Adı</label>
                <div class="col-sm-6">
                  <input type="text" name="name" placeholder="Extra Adı" class="form-control input-sm">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Pricing</label>
                 <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">per</label>
                    <select name="per" class="form-control input-sm">
                      <option value="1">Person</option>
                      <option value="2">Unit</option>
                      <option value="3">Day</option>
                      <option value="4">Child</option>
                    </select>
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Price</label>
                    <input type="text" name="price" placeholder="örn: 99.00" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
              </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Limit to period
                  <div data-placement="top" data-toggle="tooltip" class="btn btn-default tooltips" data-original-title="If you set '0' there will be no limitation.">
                  <i class="fa fa-info"></i>
                  </div>
                </label>
                 <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">From</label>
                    <input type="text" name="start_date" class="form-control input-sm" placeholder="yyyy-mm-dd" id="from_date">
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">To</label>
                    <input type="text" name="end_date" class="form-control input-sm" placeholder="yyyy-mm-dd" id="to_date">
                  </div>
                </div><!-- col-sm-6 -->
              </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Available Days</label>
                <div class="col-sm-6">
                <table>
                  <tbody>
                    <tr>
                      <?php $i=0; foreach (days_checkbox() as $k => $v) { $i++;
                      echo '<td width="5%"><input type="checkbox" name="room_units[]" value="'.$k.'"/></td>';
                      echo '<td width="40%">'.$v.'</td>';
                      if($i%2==0) echo '</tr><tr>';
                    } ?>
                    </tr>
                  </tbody>
                </table>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Basic Description</label>
                <div class="col-sm-6">
                <textarea class="form-control" name="basic_desc"></textarea>
                   
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Status</label>
                <div class="col-sm-6">
                  <select name="status" class="form-control input-sm">
                      <option value="1">Active</option>
                      <option value="0">Passive</option>
                  </select>
                </div>
              </div>
            </div> <!-- general end -->

              <div class="tab-pane" id="description">
               
                <a href="#" class="btn btn-success add_field_button pull-right">Add Field</a>
                <div class="input_fields_wrap">
                <div id="item">
                 <div class="form-group">
                    <label class="col-sm-3 control-label">Dil</label>
                    <div class="col-sm-2">
                      <select name="description[1][lang]" size="1" class="form-control input-sm">
                        <?php foreach (languages() as $key => $value) {
                          echo '<option value="'.$value['code'].'">'.$value['name'].'</option>';
                        } ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                      <a class="btn btn-xs btn-danger remove_field" href="#">Remove</a>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Adı</label>
                    <div class="col-sm-6">
                      <input type="text" name="description[1][title]" placeholder="Name" class="form-control input-sm"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Açıklama</label>
                    <div class="col-sm-6">
                      <textarea name="description[1][desc]"  class="form-control"></textarea>
                    </div>
                  </div>

                  
                  <hr>
                </div>
                
                </div>

              </div> <!-- description end -->
            
            </div> <!-- tab content end -->

            <input type="hidden" name="update" value="0" />

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

<script src="<?php echo site_url('assets/back'); ?>/js/jquery.maskedinput.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
  // Chosen Select
  jQuery("#country").chosen({'width':'100%','white-space':'nowrap'});
  
  //datepicker
  jQuery('#from_date').datepicker({ dateFormat: 'yy-mm-dd' });
  jQuery('#to_date').datepicker({ dateFormat: 'yy-mm-dd' });
  // Tooltip
  jQuery('.tooltips').tooltip({ container: 'body'});

  var max_fields      = 30; //maximum input boxes allowed
  var wrapper         = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
  
  var x = 20; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
          x++; //text box increment
          var html = '<div id="item"><div class="form-group"><label class="col-sm-3 control-label">Dil</label><div class="col-sm-2"><select name="description['+x+'][lang]" size="1" class="form-control input-sm"><?php foreach (languages() as $key => $value) { ?><option value="<?php echo $value["code"]; ?>"><?php echo $value["name"]; ?></option><?php } ?></select></div><div class="col-sm-4"><a class="btn btn-xs btn-danger remove_field" href="#">Remove</a></div></div><div class="form-group"><label class="col-sm-3 control-label">Adı</label><div class="col-sm-6"><input type="text" name="description['+x+'][title]" placeholder="Name" class="form-control input-sm"/></div></div><div class="form-group"><label class="col-sm-3 control-label">Açıklama</label><div class="col-sm-6"><textarea name="description['+x+'][desc]"  class="form-control"></textarea></div></div><hr></div>';
          $(wrapper).append(html); //add input box
      }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).closest('#item').remove(); x--;
  })

});

</script>
<?php $this->load->view('footer'); ?>
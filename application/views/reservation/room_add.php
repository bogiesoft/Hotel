<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> <?php echo lang('add_new_room'); ?> > <?php echo $this->session->userdata('hotel_name'); ?></h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('add_new_room'); ?> > <?php echo $this->session->userdata('hotel_name'); ?> </li>
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
          <li class="active"><a href="#general" data-toggle="tab"><strong><?php echo lang('general'); ?></strong></a></li>
          <li class=""><a href="#description" data-toggle="tab"><strong><?php echo lang('translation'); ?></strong></a></li>
      </ul>
    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
           
           <form id="save_hotel_details2" method="POST" action="<?php echo site_url('reservation_actions/save_room'); ?>">
            <div class="tab-content mb30">
            
            <div class="tab-pane active" id="general">
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('room_name'); ?></label>
                <div class="col-sm-6">
                  <input type="text" name="name" placeholder="<?php echo lang('room_name'); ?>" class="form-control input-sm">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('standart_capacity'); ?></label>
                <div class="col-sm-6">
                  <input type="text" name="capacity" value="2" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('capacity'); ?></label>
                 <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('min_capacity'); ?></label>
                    <input type="text" name="min_capacity" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('max_capacity'); ?></label>
                    <input type="text" name="max_capacity" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
              </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('adults'); ?></label>
                 <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('min_adult'); ?></label>
                    <input type="text" name="min_adult" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('max_adult'); ?></label>
                    <input type="text" name="max_adult" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
              </div>
              </div>

               <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('max_kid'); ?></label>
                 <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <select name="max_child" class="form-control input-sm" onclick="children_options(this.value)">
                      <?php for ($i=0; $i <=4 ; $i++) { 
                        echo '<option value="'.$i.'">'.$i.'</option>';
                      }
                      ?>
                      </select>
                    </div>
                  </div><!-- col-sm-6 -->
                  </div>
                  <div id="child-ages" style="display:none">
                  <label class="col-sm-3 control-label"><?php echo lang('children_ages'); ?></label>
                  <div id="child-ages-content"></div>

                  </div>

              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('room_specs'); ?></label>
                <div class="col-sm-6">
                <table>
                  <tbody>
                    <tr>
                    <?php $i=0; foreach (room_specs() as $k => $v) { $i++;
                      echo '<td width="5%"><input type="checkbox" name="room_units[]" value="'.$k.'"/></td>';
                      echo '<td width="40%">'.$v.'</td>';
                      if($i%2==0) echo '</tr><tr>';
                    } ?>
                  </tr>
                  </tbody>
                </table>
                </div>
              </div>

            </div> <!-- general end -->

              <div class="tab-pane" id="description">
               
                <a href="#" class="btn btn-success add_field_button pull-right"><?php echo lang('add_field'); ?></a>
                <div class="input_fields_wrap">
                <div id="item">
                 <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('language'); ?></label>
                    <div class="col-sm-2">
                      <select name="description[1][lang]" size="1" class="form-control input-sm">
                        <?php foreach (languages() as $key => $value) {
                          echo '<option value="'.$value['code'].'">'.$value['name'].'</option>';
                        } ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                      <a class="btn btn-xs btn-danger remove_field" href="#"><?php echo lang('remove'); ?></a>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('name'); ?></label>
                    <div class="col-sm-6">
                      <input type="text" name="description[1][title]" placeholder="Name" class="form-control input-sm"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('description'); ?></label>
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

<script src="<?php echo site_url('assets/back'); ?>/js/jquery.maskedinput.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
  // Chosen Select
  jQuery("#country").chosen({'width':'100%','white-space':'nowrap'});

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
          var html = '<div id="item"><div class="form-group"><label class="col-sm-3 control-label">'+
          '<?php echo lang('language'); ?></label><div class="col-sm-2">'+
          '<select name="description['+x+'][lang]" size="1" class="form-control input-sm">'+
          '<?php foreach (languages() as $key => $value) { ?><option value="<?php echo $value["code"]; ?>">'+
          '<?php echo $value["name"]; ?></option><?php } ?></select></div><div class="col-sm-4">'+
          '<a class="btn btn-xs btn-danger remove_field" href="#"><?php echo lang('remove'); ?></a></div></div>'+
          '<div class="form-group"><label class="col-sm-3 control-label"><?php echo lang('name'); ?></label>'+
          '<div class="col-sm-6"><input type="text" name="description['+x+'][title]" placeholder="Name" class="form-control input-sm"/></div>'+
          '</div><div class="form-group"><label class="col-sm-3 control-label">'+
          '<?php echo lang('description'); ?></label><div class="col-sm-6"><textarea name="description['+x+'][desc]"  class="form-control"></textarea></div>'+
          '</div><hr></div>';
          $(wrapper).append(html); //add input box
      }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).closest('#item').remove(); x--;
  })

  

});


function children_options(cnt){
  //clear content
  $('#child-content').remove();
    if (cnt != 0) {

      $('#child-ages').slideDown();

      var ages = '';
      for (i = 0; i <= 18; i++) {
        ages +=("<option value="+i+"> " + i + "</option>");
      }
 

      html = '<div class="row" id="child-content">';

      for (i = 1; i <= cnt; i++) {
        html +='<div class="col-sm-2">'+
          '<div class="form-group">'+
          '<div class="row">'+
          '<div class="col-sm-4 col-md-3">'+
          '<select name="child_age['+i+'][min]" class="form-control input-sm" style="width:60px" data-toggle="tooltip" data-trigger="focus" data-placement="top" title="Child '+i+' Min. Age">'+
          ages
          +'</select>'+
          '</div>'+
          '<div class="col-sm-4 col-md-3">'+
          '<select name="child_age['+i+'][max]" class="form-control input-sm" style="width:60px" data-toggle="tooltip" data-trigger="focus" data-placement="top" title="Child '+i+' Max. Age">'+
          ages
          +'</select>'+
          '</div>'+
          '</div>'+
        '</div>'+
      '</div><!-- col-sm-6 -->';
      };

      html += '<div>';

    $('#child-ages-content').after(html);
    $("[data-toggle='tooltip']").tooltip();

    }else{
       $('#child-ages').slideUp();
    };

}

</script>
<?php $this->load->view('footer'); ?>
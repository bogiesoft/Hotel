<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> <?php echo lang('edit_room'); ?> > <?php echo $room->name;?> </h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('edit_room'); ?> > <?php echo $room->name;?></li>
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

    <?php if ($room->code != $this->session->userdata('code')) : ?>
      <div id="result" class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo lang('warning_wrong_room'); ?>
      </div>
    <?php else: ?>

          <?php if ($room->hotel_id != $this->session->userdata('hotel_id')) :?>
            <div id="result" class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo sprintf(lang('warning_room_id'),$this->session->userdata('hotel_name')); ?>      
            </div>
          <?php endif; ?>

      <ul class="nav nav-tabs">
          <li class="active"><a href="#general" data-toggle="tab"><strong><?php echo lang('general'); ?></strong></a></li>
          <li class=""><a href="#description" data-toggle="tab"><strong><?php echo lang('translation'); ?></strong></a></li>
          <li class=""><a href="#photos" data-toggle="tab"><strong><?php echo lang('photos'); ?></strong></a></li>
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
                  <input type="text" name="name" value="<?php echo $room->name;?>" class="form-control input-sm">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('standart_capacity'); ?></label>
                <div class="col-sm-6">
                  <input type="text" name="capacity" value="<?php echo $room->capacity;?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('capacity'); ?></label>
                 <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('min_capacity'); ?></label>
                    <input type="text" name="min_capacity" value="<?php echo $room->min_capacity;?>" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('max_capacity'); ?></label>
                    <input type="text" name="max_capacity" value="<?php echo $room->max_capacity;?>" class="form-control input-sm">
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
                    <input type="text" name="min_adult" value="<?php echo $room->min_adult;?>" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('max_adult'); ?></label>
                    <input type="text" name="max_adult" value="<?php echo $room->max_adult;?>" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
              </div>
              </div>

               <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('kids'); ?></label>
                 <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label class="control-label"><?php echo lang('min_kid'); ?></label>
                      <input type="text" name="min_child" value="<?php echo $room->min_child;?>" value="0" class="form-control input-sm">
                    </div>
                  </div><!-- col-sm-6 -->
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label class="control-label"><?php echo lang('max_kid'); ?></label>
                      <input type="text" name="max_child" value="<?php echo $room->max_child;?>" class="form-control input-sm">
                    </div>
                  </div><!-- col-sm-6 -->
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label class="control-label"><?php echo lang('kid_age'); ?></label>
                      <select name="child_age" class="form-control input-sm">
                      <?php for ($i=0; $i <=18 ; $i++) {
                        $selected = $room->child_age == $i ? 'selected="selected"' :'';
                        echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                      }
                      ?>
                      </select>
                    </div>
                  </div><!-- col-sm-6 -->
                  </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('room_specs'); ?></label>
                <div class="col-sm-6">
                <table>
                  <tbody>
                    <tr>
                    <?php $i=0; foreach (room_specs() as $k => $v) { $i++;

                      $room_specs = explode(',', $room->room_units);
                      $room_specs = arr_val_to_key($room_specs);
                      $checked = isset($room_specs[$k]) ? 'checked' : '';


                      echo '<td width="5%"><input type="checkbox" name="room_units[]]" value="'.$k.'" '.$checked.'/></td>';
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
                <?php foreach ($description as $k => $desc) : ?>
                <div id="item">
                 <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('language'); ?></label>
                    <div class="col-sm-2">
                      <select name="description[<?php echo $k; ?>][lang]" size="1" class="form-control input-sm">
                        <?php foreach (languages() as $key => $value) {
                           $selected = $desc->lang == $value['code'] ? 'selected="selected"' : '';
                          echo '<option value="'.$value['code'].'" '.$selected.'>'.$value['name'].'</option>';
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
                      <input type="text" name="description[<?php echo $k; ?>][title]" value="<?php echo $desc->title;?>" class="form-control input-sm"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('description'); ?></label>
                    <div class="col-sm-6">
                      <textarea name="description[<?php echo $k; ?>][desc]"  class="form-control"><?php echo $desc->content;?></textarea>
                    </div>
                  </div>

                  
                  <hr>
                </div>
                <?php endforeach; ?>
                </div>

              </div> <!-- description end -->
            
              
              <div class="tab-pane" id="photos">

                <ul class="filemanager-options">
                    <li>
                      <div class="ckbox ckbox-default">
                        <input type="checkbox" id="selectall" value="1">
                        <label for="selectall"><?php echo lang('select_all'); ?></label>
                      </div>
                    </li>
                    <li>
                      <a onClick="delete_photos();" class="itemopt disabled" style="cursor: pointer;"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?></a>
                    </li>
                    <li class="filter-type">
                    <button type="button" class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#myModal"><?php echo lang('upload_photos'); ?></button>
                    </li>
                    
                  </ul>
                  <div id="result" class="alert" style="display:none"></div>

                  <div class="row filemanager">
                  <link href="<?php echo site_url('assets/back'); ?>/css/prettyPhoto.css" rel="stylesheet">
                  <?php foreach ($photos as $r => $photo): ?>
                  <div class="col-xs-6 col-sm-4 col-md-3 image" id="photo_<?php echo $photo->id; ?>">
                    <div class="thmb">
                      <div class="ckbox ckbox-default" style="display: none;">
                        <input type="checkbox" name="photo_ids[]" id="check<?php echo $photo->id; ?>" value="<?php echo $photo->id; ?>">
                        <label for="check<?php echo $photo->id; ?>"></label>
                      </div>
                      <div class="btn-group fm-group" style="display: none;">
                          <button type="button" class="btn btn-default dropdown-toggle fm-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu fm-menu" role="menu">
                            <li><a href="#"><i class="fa fa-share"></i> <?php echo lang('make_default'); ?></a></li>
                            <li><a href="#"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?></a></li>
                          </ul>
                      </div><!-- btn-group -->
                      <div class="thmb-prev">
                        <a href="<?php echo $photo->photo_url; ?>" data-rel="prettyPhoto" rel="prettyPhoto">
                          <img src="<?php echo $photo->photo_url; ?>" class="img-responsive" alt="" style="height:125px">
                        </a>
                      </div>
                      <center class="text-muted">Added: <?php echo date('d-m-Y',time($photo->add_date)); ?></center>
                    </div><!-- thmb -->
                  </div><!-- col-xs-6 -->
                  <?php endforeach; ?>
                  
                  </div>

              </div> <!-- photos end -->
            </div> <!-- tab content end -->

            <input type="hidden" name="update" value="1" />
            <input type="hidden" name="room_id" value="<?php echo $this->uri->segment('4'); ?>" />
            <div class="row">
              <div class="col-sm-2">
              <input type="submit" class="btn btn-primary" value="<?php echo lang('save'); ?>">
              </div>
                
             <div class="col-sm-6">
              </div>
            </div>

            </form>
            </div>
          </div>
      </div>
  </div><!-- row -->
  
  <?php endif; ?>
</div><!-- contentpanel -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('close'); ?></span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('upload_photos'); ?></h4>
      </div>
      <div class="modal-body">

         <div id="dropzone">
          <form id="myDropzone" action="<?php echo site_url('photos/room_photos'); ?>" class="dropzone" id="demo-upload">
            <div class="dropzone-previews"></div> 
            <div class="fallback"> <!-- this is the fallback if JS isn't working -->
            <input name="file" type="file" multiple />
            </div>

          <input type="hidden" name="room_id" value="<?php echo $this->uri->segment('4'); ?>" />
          </form>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal"><?php echo lang('save_photos'); ?></button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="<?php echo site_url('assets/back'); ?>/css/dropzone.css" />
<script src="<?php echo site_url('assets/back'); ?>/js/dropzone.min.js"></script>
<script src="<?php echo site_url('assets/back'); ?>/js/jquery.prettyPhoto.js"></script>
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
          var html = '<div id="item"><div class="form-group"><label class="col-sm-3 control-label"><?php echo lang('language'); ?></label><div class="col-sm-2"><select name="description['+x+'][lang]" size="1" class="form-control input-sm"><?php foreach (languages() as $key => $value) { ?><option value="<?php echo $value["code"]; ?>"><?php echo $value["name"]; ?></option><?php } ?></select></div><div class="col-sm-4"><a class="btn btn-xs btn-danger remove_field" href="#"><?php echo lang('remove'); ?></a></div></div><div class="form-group"><label class="col-sm-3 control-label"><?php echo lang('name'); ?></label><div class="col-sm-6"><input type="text" name="description['+x+'][title]" placeholder="<?php echo lang('name'); ?>" class="form-control input-sm"/></div></div><div class="form-group"><label class="col-sm-3 control-label"><?php echo lang('description'); ?></label><div class="col-sm-6"><textarea name="description['+x+'][desc]"  class="form-control"></textarea></div></div><hr></div>';
          $(wrapper).append(html); //add input box
      }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).closest('#item').remove(); x--;
  })

  jQuery('.thmb').hover(function(){
      var t = jQuery(this);
      t.find('.ckbox').show();
      t.find('.fm-group').show();
    }, function() {
      var t = jQuery(this);
      if(!t.closest('.thmb').hasClass('checked')) {
        t.find('.ckbox').hide();
        t.find('.fm-group').hide();
      }
    });

  jQuery('.ckbox').each(function(){
    var t = jQuery(this);
    var parent = t.parent();
    if(t.find('input').is(':checked')) {
      t.show();
      parent.find('.fm-group').show();
      parent.addClass('checked');
    }
  });
  
  
  jQuery('.ckbox').click(function(){
    var t = jQuery(this);
    if(!t.find('input').is(':checked')) {
      t.closest('.thmb').removeClass('checked');
      enable_itemopt(false);
    } else {
      t.closest('.thmb').addClass('checked');
      enable_itemopt(true);
    }
  });

  jQuery('#selectall').click(function(){
    if(jQuery(this).is(':checked')) {
      jQuery('.thmb').each(function(){
        jQuery(this).find('input').attr('checked',true);
        jQuery(this).addClass('checked');
        jQuery(this).find('.ckbox, .fm-group').show();
      });
      enable_itemopt(true);
    } else {
      jQuery('.thmb').each(function(){
        jQuery(this).find('input').attr('checked',false);
        jQuery(this).removeClass('checked');
        jQuery(this).find('.ckbox, .fm-group').hide();
      });
      enable_itemopt(false);
    }
  });
  
  function enable_itemopt(enable) {
    if(enable) {
      jQuery('.itemopt').removeClass('disabled');
    } else {
      
      // check all thumbs if no remaining checks
      // before we can disabled the options
      var ch = false;
      jQuery('.thmb').each(function(){
        if(jQuery(this).hasClass('checked'))
          ch = true;
      });
      
      if(!ch)
        jQuery('.itemopt').addClass('disabled');
    }
  }
  
  //Replaces data-rel attribute to rel.
  //We use data-rel because of w3c validation issue
  jQuery('a[data-rel]').each(function() {
    jQuery(this).attr('rel', jQuery(this).data('rel'));
  });


  //pretty photo
  jQuery("a[rel^='prettyPhoto']").prettyPhoto();


});

//delete checked photos
function delete_photos(){
  var selected = [];
  $('.filemanager input:checked').each(function() {
      selected.push($(this).val());
  });

  event.preventDefault();
  $.ajax({
    url: base_url + "reservation_actions/delete_room_photos",
    type: "POST",
    data: {photos:selected},
    dataType: 'json',
    success: function(data){
      $('#loading').hide();

      var photo = $.parseJSON(data.message);

      $.each(photo,function(i,val){
        $('#photo_'+val).fadeOut(1000, function() { $(this).remove(); });
      });
                
    },
    error:function(){
      $('#result').html('Something went wrong!');
      $("#result").removeClass('alert-danger'); 
      $("#result").removeClass('alert-success');      
      $("#result").addClass('alert-danger');
      $("#result").fadeIn(1000);
      setTimeout(function(){ 
               $("#result").fadeOut(500); }, 3000); 
    }   
  });  // ajax end

}

  //if form changed reload page else close modal
  $('#closeModal').on('click',function(){
    $("#modal").modal('hide');
    console.log(location);
    setTimeout(function(){ 
      location.reload(); }, 200);  
  });

  var url = document.location.toString();
  if (url.match('#')) {
      $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
  } 


</script>
<?php $this->load->view('footer'); ?>
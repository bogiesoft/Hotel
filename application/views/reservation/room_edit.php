<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> Add New Room </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>">Yönetim</a></li>
          <li class="active">Add new hotel</li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">

    <?php if ($room->hotel_id != $this->session->userdata('hotel_id')) :?>
      <div id="result" class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      UYARI! Bu Oda şuanki işlem yaptığınız otele ait değil. Değişiklikler <b><?php echo $this->session->userdata('hotel_name'); ?></b> adına kayıt edilecektir.
      </div>
    <?php endif; ?>

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
      Başkalarının odalarını değiştirmeye mi çalışıyorsun?
      </div>
    <?php else: ?>

      <ul class="nav nav-tabs">
          <li class="active"><a href="#general" data-toggle="tab"><strong>Genel Bilgi</strong></a></li>
          <li class=""><a href="#description" data-toggle="tab"><strong>Açıklamalar</strong></a></li>
      </ul>
    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
           
           <form id="save_hotel_details2" method="POST" action="<?php echo site_url('reservation_actions/save_room'); ?>">
            <div class="tab-content mb30">
            
            <div class="tab-pane active" id="general">
              <div class="form-group">
                <label class="col-sm-3 control-label">Oda Adı</label>
                <div class="col-sm-6">
                  <input type="text" name="name" value="<?php echo $room->name;?>" class="form-control input-sm">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Standart Kapasite</label>
                <div class="col-sm-6">
                  <input type="text" name="capacity" value="<?php echo $room->capacity;?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Kapasite</label>
                 <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Min. Kapasite</label>
                    <input type="text" name="min_capacity" value="<?php echo $room->min_capacity;?>" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Max. Kapasite</label>
                    <input type="text" name="max_capacity" value="<?php echo $room->max_capacity;?>" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
              </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Yetişkin Sayısı</label>
                 <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Min. Yetişkin</label>
                    <input type="text" name="min_adult" value="<?php echo $room->min_adult;?>" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Max. Yetişkin</label>
                    <input type="text" name="max_adult" value="<?php echo $room->max_adult;?>" class="form-control input-sm">
                  </div>
                </div><!-- col-sm-6 -->
              </div>
              </div>

               <div class="form-group">
                <label class="col-sm-3 control-label">Çocuk Sayısı</label>
                 <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label class="control-label">Min. Çocuk</label>
                      <input type="text" name="min_child" value="<?php echo $room->min_child;?>" value="0" class="form-control input-sm">
                    </div>
                  </div><!-- col-sm-6 -->
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label class="control-label">Max. Çocuk</label>
                      <input type="text" name="max_child" value="<?php echo $room->max_child;?>" class="form-control input-sm">
                    </div>
                  </div><!-- col-sm-6 -->
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label class="control-label">Max. Çocuk Yaş</label>
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
                <label class="col-sm-3 control-label">Otel özellikleri</label>
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
               
                <a href="#" class="btn btn-success add_field_button pull-right">Add Field</a>
                <div class="input_fields_wrap">
                <?php foreach ($description as $k => $desc) : ?>
                <div id="item">
                 <div class="form-group">
                    <label class="col-sm-3 control-label">Dil</label>
                    <div class="col-sm-2">
                      <select name="description[<?php echo $k; ?>][lang]" size="1" class="form-control input-sm">
                        <?php foreach (languages() as $key => $value) {
                           $selected = $desc->lang == $value['code'] ? 'selected="selected"' : '';
                          echo '<option value="'.$value['code'].'" '.$selected.'>'.$value['name'].'</option>';
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
                      <input type="text" name="description[<?php echo $k; ?>][title]" value="<?php echo $desc->title;?>" class="form-control input-sm"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Açıklama</label>
                    <div class="col-sm-6">
                      <textarea name="description[<?php echo $k; ?>][desc]"  class="form-control"><?php echo $desc->content;?></textarea>
                    </div>
                  </div>

                  
                  <hr>
                </div>
                <?php endforeach; ?>
                </div>

              </div> <!-- description end -->
            
            </div> <!-- tab content end -->

            <input type="hidden" name="update" value="1" />
            <input type="hidden" name="room_id" value="<?php echo $this->uri->segment('4'); ?>" />
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
  
  <?php endif; ?>
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
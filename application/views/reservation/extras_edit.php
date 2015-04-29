<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> <?php echo lang('edit_extra'); ?></h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('edit_extra'); ?> > <?php echo $extra->name; ?> </li>
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

    <?php if ($extra->code != $this->session->userdata('code')) : ?>
      <div id="result" class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo lang('warning_wrong_extra'); ?>
      </div>
    <?php else: ?>


      <?php if ($extra->hotel_id != $this->session->userdata('hotel_id')) :?>
        <div id="result" class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo sprintf(lang('warning_extra_id'),$this->session->userdata('hotel_name')); ?>
        </div>
      <?php endif; ?>


      <ul class="nav nav-tabs">
          <li class="active"><a href="#general" data-toggle="tab"><strong><?php echo lang('general'); ?></strong></a></li>
          <li class=""><a href="#description" data-toggle="tab"><strong><?php echo lang('translation'); ?></strong></a></li>
          <li class=""><a href="#forms" data-toggle="tab"><strong><?php echo lang('forms'); ?></strong></a></li>
      </ul>
    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
           
           <form id="save_hotel_details2" method="POST" action="<?php echo site_url('reservation_actions/save_extra'); ?>">
            <div class="tab-content mb30">
            
            <div class="tab-pane active" id="general">
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('name'); ?></label>
                <div class="col-sm-6">
                  <input type="text" name="name" value="<?php echo $extra->name; ?>" class="form-control input-sm">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                 <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('price_per'); ?></label>
                    <select name="per" class="form-control input-sm" onclick="price_type(this.value)">
                      <option value="1" <?php echo $extra->per == '1' ? 'selected' :''; ?>><?php echo lang('per_person'); ?></option>
                      <option value="2" <?php echo $extra->per == '2' ? 'selected' :''; ?>><?php echo lang('per_unit'); ?></option>
                      <!--
                      <option value="3" <?php echo $extra->per == '3' ? 'selected' :''; ?>><?php echo lang('per_day'); ?></option>
                      <option value="4" <?php echo $extra->per == '4' ? 'selected' :''; ?>><?php echo lang('per_child'); ?></option>
                      -->
                    </select>
                  </div>
                </div><!-- col-sm-6 -->

                <div class="col-sm-3" id="max-person" <?php echo $extra->per != 1 ? 'style="display:none"' : ''; ?>>
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('max_person'); ?></label>
                    <select name="max_person"  class="form-control input-sm" onclick="price_options(this.value)">
                      <?php for ($i=0; $i <= 5 ; $i++) {
                        $selected = $extra->max_person == $i ? 'selected="selected"' : '';
                        echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                      }?>
                    </select>
                   
                  </div>
                </div><!-- col-sm-6 -->
               
              </div>
              </div>

              <div class="form-group">
               <?php $price = json_decode($extra->price); //print_r($price); ?>
               <label class="col-sm-3 control-label"><?php echo lang('pricing'); ?></label>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('price'); ?></label>
                    <?php if($extra->per == 1) : ?>

                    <input type="text" id="unit-price" style="display:none" name="price[unit]" value="<?php echo $price->unit; ?>" class="form-control input-sm">
                    <div id="person-price-content"></div>
                    <div class="row" id="price-content">
                     <?php for ($i=1; $i <= $extra->max_person ; $i++) { ?>
                      <div class="col-sm-2">
                        <div class="form-group">
                        <div class="row">
                        <div class="col-sm-12 col-md-12">
                        <input type="text" name="price[<?php echo $i; ?>]" value="<?php echo $price->$i; ?>" class="form-control input-sm" data-toggle="tooltip" data-trigger="focus" data-placement="top" title="<?php echo sprintf(lang('person_price'),$i); ?>">
                        </div>
                        </div>
                      </div>
                    </div><!-- col-sm-6 -->
                    <?php } ?>
                    </div>

                    <?php else: ?>

                    <input type="text" id="unit-price"  name="price[unit]" value="<?php echo $price->unit; ?>" class="form-control input-sm">
                    <div id="person-price-content"></div>

                  <?php endif; ?>
                  </div>
                </div><!-- col-sm-6 -->

                
              </div>
              <!--
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('limit_period'); ?>
                  <div data-placement="top" data-toggle="tooltip" class="btn btn-default tooltips" data-original-title="If you set '0' there will be no limitation.">
                  <i class="fa fa-info"></i>
                  </div>
                </label>
                 <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('from'); ?></label>
                    <input type="text" name="start_date" class="form-control input-sm" value="<?php echo $extra->start_date; ?>" id="from_date">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label"><?php echo lang('to'); ?></label>
                    <input type="text" name="end_date" class="form-control input-sm" value="<?php echo $extra->end_date; ?>" id="to_date">
                  </div>
                </div>
              </div>
              </div>
              -->

              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('available'); ?></label>
                <div class="col-sm-6">
                <table>
                  <tbody>
                    <tr>
                    <?php $i=0; foreach (days_checkbox() as $k => $v) { $i++;

                      $available_days = explode(',', $extra->available_days);
                      $available_days = arr_val_to_key($available_days);
                      $checked = isset($available_days[$k]) ? 'checked' : '';


                      echo '<td width="5%"><input type="checkbox" name="available_days[]]" value="'.$k.'" '.$checked.'/></td>';
                      echo '<td width="40%">'.$v.'</td>';
                      if($i%2==0) echo '</tr><tr>';
                    } ?>
                  </tr>
                  </tbody>
                </table>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('extra_image'); ?></label>
                <div class="col-sm-6">
                <div id="extra_image"><?php if($extra->image) {echo '<img src="'.$extra->image.'" />'; } ?></div>
                <input type="file" name="userfile" id="uploadedfile">
                <input type="hidden" name="extra_image" id="extra_image_value" value="<?php echo $extra->image; ?>">
                </div>
              </div>



              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('basic_description'); ?></label>
                <div class="col-sm-6">
                <textarea class="form-control" name="basic_desc"><?php echo $extra->description; ?></textarea>
                   
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('status'); ?></label>
                <div class="col-sm-6">
                  <select name="status" class="form-control input-sm">
                      <option value="1" <?php echo $extra->status == '1' ? 'selected' :''; ?>><?php echo lang('active'); ?></option>
                      <option value="0" <?php echo $extra->status == '0' ? 'selected' :''; ?>><?php echo lang('passive'); ?></option>
                  </select>
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
                      <input type="text" name="description[<?php echo $k; ?>][title]" value="<?php echo $desc->title; ?>" class="form-control input-sm"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('desceiprion'); ?></label>
                    <div class="col-sm-6">
                      <textarea name="description[<?php echo $k; ?>][desc]"  class="form-control"><?php echo $desc->content; ?></textarea>
                    </div>
                  </div>

                  
                  <hr>
                </div>
                <?php endforeach; ?>
                
                </div>

              </div> <!-- description end -->
            
            <div class="tab-pane" id="forms">
                  <div class='fb-main'></div>
                  <link href="<?php echo site_url('assets/back'); ?>/css/vendor.css" rel="stylesheet">
                  <link href="<?php echo site_url('assets/back'); ?>/css/formbuilder.css" rel="stylesheet">
                  <script type="text/javascript">
                 
                      $(function(){
                      var form_inputs = '<?php echo $extra->forms; ?>';

                      var obj = '';
                      if (form_inputs != null) {
                        var obj = '<?php echo $extra->forms; ?>';
                      }
                      console.log(form_inputs);
                        fb = new Formbuilder({
                          selector: '.fb-main',
                          bootstrapData:  JSON.parse(obj)
                        });

                        fb.on('save', function(payload){
                          $('#form_input').val('');
                          var value = JSON.stringify(fb.mainView.collection.toJSON());
                          $('#form_input').val(value);
                          console.log(payload);

                         // console.log(JSON.stringify(payload));
                        })
                      });
                    </script>
                    <input type="hidden" name="forms" id="form_input" value='<?php echo $extra->forms; ?>'/>
              </div> <!-- forms end -->

            </div> <!-- tab content end -->

            <input type="hidden" name="update" value="1" />
            <input type="hidden" name="extra_id" value="<?php echo $this->uri->segment('4'); ?>" />
           
            <div class="row">
              <div class="col-sm-2">
              <input type="submit" class="btn btn-primary" value='<?php echo lang('save'); ?>'>
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

  $("[data-toggle='tooltip']").tooltip();

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

});

var person_price = '<?php echo lang('person_price'); ?>';

function price_options(cnt){
  //clear content
  $('#price-content').remove();
  //$('#unit-price').slideDown();
    if (cnt != 0) {
      $('#price-content').slideDown();
      $('#unit-price').slideUp();
      html = '<div class="row" id="price-content">';
      for (i = 1; i <= cnt; i++) {
        var price = person_price.replace(/%s/g,i);
        html +='<div class="col-sm-2">'+
          '<div class="form-group">'+
          '<div class="row">'+
          '<div class="col-sm-12 col-md-12">'+
          '<input type="text" name="price['+i+']" rel="txtTooltip" class="form-control input-sm" data-toggle="tooltip" data-trigger="focus" data-placement="top" title="'+person_price.replace(/%s/g,i)+'">'+
          '</div>'+
          '</div>'+
        '</div>'+
      '</div><!-- col-sm-6 -->';
      };

      html += '<div>';

    $('#person-price-content').after(html);
    $("[data-toggle='tooltip']").tooltip();
    }else{
       $('#unit-price').slideDown();
    };

}

function price_type(type){
  if (type==1) {
    //$('#price-content').remove();
    $('#max-person').slideDown();
    $('#unit-price').slideUp();
    $('#price-content').slideDown();
  }else{
    $('#max-person').slideUp();
    $('#unit-price').slideDown();
    $('#price-content').slideUp();
  }
}

</script>

<script src="<?php echo site_url('assets/back'); ?>/js/jupload.js"></script>
<script type="text/javascript">
  $(function() {
      $('#uploadedfile').change(function() {
          $(this).upload(base_url + 'reservation_actions/upload_extra_image', function(res) {
            var obj = jQuery.parseJSON( res );
            html = '<img src="'+obj.image+'" />';
            $('#extra_image').html(html);
            $('#extra_image_value').val(obj.image);
          }, 'html');
      });
  });

</script>
<?php $this->load->view('footer'); ?>
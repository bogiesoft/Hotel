<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> Hotels </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>">Yönetim</a></li>
          <li class="active">Add new hotel</li>
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

    <?php if ($hotel->code != $this->session->userdata('code')) : ?>
      <div id="result" class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      Başkalarının odalarını değiştirmeye mi çalışıyorsun?
      </div>
    <?php else: ?>

      <ul class="nav nav-tabs">
          <li class="active"><a href="#general" data-toggle="tab"><strong>Genel Bilgi</strong></a></li>
          <li class=""><a href="#info" data-toggle="tab"><strong>Tesis Özellikleri</strong></a></li>
          <li class=""><a href="#description" data-toggle="tab"><strong>Açıklamalar</strong></a></li>
          <li class=""><a href="#accounts" data-toggle="tab"><strong>Hesap Numaraları</strong></a></li>
          <li class=""><a href="#photos" data-toggle="tab"><strong>Fotoğraflar</strong></a></li>
      </ul>
    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
           
           <form id="save_hotel_details2" method="POST" action="<?php echo site_url('reservation_actions/save_hotel'); ?>">
            <div class="tab-content mb30">
            
            <div class="tab-pane active" id="general">
              <div class="form-group">
                <label class="col-sm-3 control-label">Otel adı</label>
                <div class="col-sm-6">
                  <input type="text" name="name" value="<?php echo $hotel->name; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Kategori</label>
                <div class="col-sm-6">
                  <select name="category" class="form-control input-sm mb15">
                  <?php foreach (hotel_category() as $key => $value) {
                    $selected = $hotel->category == $key ? 'selected="selected"' : '';
                    echo  '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                  } ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Adres</label>
                <div class="col-sm-6">
                  <input type="text" name="adress" value="<?php echo $hotel->adress; ?>" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Telefon</label>
                <div class="col-sm-6">
                <input type="text" name="phone" id="phone" value="<?php echo $hotel->phone; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Telefon 2</label>
                <div class="col-sm-6">
                <input type="text" name="phone2" id="phone2" value="<?php echo $hotel->phone2; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Fax</label>
                <div class="col-sm-6">
                  <input type="text" name="fax" value="<?php echo $hotel->fax; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">E-Mail</label>
                <div class="col-sm-6">
                  <input type="text" name="email" value="<?php echo $hotel->email; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Website</label>
                <div class="col-sm-6">
                  <input type="text" name="website" value="<?php echo $hotel->website; ?>" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Country</label>
                <div class="col-sm-6">
                  <select name="country" id="country" class="form-control choosen-select input-sm mb15">
                  <?php foreach ($countries as $key => $c) {
                    $selected = $hotel->country == $c->id ? 'selected="selected"' : ''; 
                    echo '<option value="'.$c->id.'" '.$selected.'>'.$c->name.'</option>';
                  } ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Şehir</label>
                <div class="col-sm-6">
                  <input type="text" name="city" value="<?php echo $hotel->city; ?>" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">ZIP Posta Kodu</label>
                <div class="col-sm-6">
                  <input type="text" name="postcode" value="<?php echo $hotel->postcode; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Para Birimi</label>
                <div class="col-sm-6">
                    <select name="currency" size="1" class="form-control input-sm">
                    <?php foreach (currencies() as $key => $value) {
                      $selected = $hotel->currency == $value ? 'selected="selected"' : '';
                      echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                    } ?>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Yönetici</label>
                <div class="col-sm-6">
                  <input type="text" name="administrator" value="<?php echo $hotel->administrator; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Ön Büro Telefon</label>
                <div class="col-sm-6">
                  <input type="text" name="reception_phone" value="<?php echo $hotel->reception_phone; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Ön Büro Email</label>
                <div class="col-sm-6">
                  <input type="text" name="reception_email" value="<?php echo $hotel->reception_email; ?>" class="form-control input-sm">
                </div>
              </div>

            </div> <!-- general end -->
            

            <div class="tab-pane" id="info">
              <div class="form-group">
                <label class="col-sm-3 control-label">
                Varsayılan Açıklama 
                <div  data-placement="top" data-toggle="tooltip" class="btn btn-default tooltips" data-original-title="Çoklu dil aktif değilse varsayılan açıklama. Diğer Diller için açıklamalar sayfasına bakınız.">
                <i class="fa fa-info"></i>
                </div>

                </label>
                <div class="col-sm-6">
                <textarea name="default_desc" class="form-control"><?php echo $hotel->description; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Otel özellikleri</label>
                <div class="col-sm-6">
                <table>
                  <tbody>
                    <tr>
                    <?php $i=0; foreach (hotel_specs() as $k => $v) { $i++;

                      $hotel_specs = explode(',', $hotel->hotel_specs);
                      $hotel_specs = arr_val_to_key($hotel_specs);
                      $checked = isset($hotel_specs[$k]) ? 'checked' : '';

                      echo '<td width="5%"><input type="checkbox" name="hotel_specs[]" '.$checked.' value="'.$k.'"/></td>';
                      echo '<td width="40%">'.$v.'</td>';
                      if($i%2==0) echo '</tr><tr>';
                    } ?>
                  </tr>
                  </tbody>
                </table>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Restourant</label>
                <div class="col-sm-6">
                <table>
                  <tbody>
                    <tr>
                    <?php $i=0; foreach (restourant_specs() as $k => $v) { $i++;

                      $restourant_specs = explode(',', $hotel->restourant_specs);
                      $restourant_specs = arr_val_to_key($restourant_specs);
                      $checked = isset($restourant_specs[$k]) ? 'checked' : '';

                      echo '<td width="5%"><input type="checkbox" name="restourant_specs[]" '.$checked.' value="'.$k.'"/></td>';
                      echo '<td width="40%">'.$v.'</td>';
                      if($i%2==0) echo '</tr><tr>';
                    } ?>
                  </tr>
                  </tbody>
                </table>
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Spor ve Eğlence</label>
                <div class="col-sm-6">
                <table>
                  <tbody>
                    <tr>
                    <?php $i=0; foreach (sport_specs() as $k => $v) { $i++;

                      $sport_specs = explode(',', $hotel->sport_specs);
                      $sport_specs = arr_val_to_key($sport_specs);
                      $checked = isset($sport_specs[$k]) ? 'checked' : '';

                      echo '<td width="5%"><input type="checkbox" name="sport_specs[]" '.$checked.' value="'.$k.'"/></td>';
                      echo '<td width="40%">'.$v.'</td>';
                      if($i%2==0) echo '</tr><tr>';
                    } ?>
                  </tr>
                  </tbody>
                </table>
                </div>
              </div>

            </div> <!-- info end -->
            

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
                  <label class="col-sm-3 control-label">Açıklama</label>
                  <div class="col-sm-6">
                    <textarea name="description[<?php echo $k; ?>][desc]"  class="form-control"><?php echo $desc->content; ?></textarea>
                  </div>
                </div>
                <hr>
              </div>

            <?php endforeach; ?>
              
              
              </div>

            </div> <!-- description end -->
            

            <div class="tab-pane" id="accounts">
              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Adı 1</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_name1" value="<?php echo $hotel->bank_name1; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Şube 1</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_office1" value="<?php echo $hotel->bank_office1; ?>" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Swift Kodu 1</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_swift1" value="<?php echo $hotel->bank_swift1; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Bank Hesap No 1</label>
                <div class="col-sm-2">
                    <select name="bank_currency1" size="1" class="form-control input-sm">
                    <?php foreach (currencies() as $key => $value) {
                      $selected = $hotel->bank_currency1 == $value ? 'selected="selected"' : '';
                      echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                    } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="bank_account1" value="<?php echo $hotel->bank_account1; ?>" class="form-control input-sm">
                </div>
               
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Lehdar 1</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_beneficiary1" value="<?php echo $hotel->bank_beneficiary1; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Iban 1</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_iban1" value="<?php echo $hotel->bank_iban1; ?>" class="form-control input-sm">
                </div>
              </div>

              <hr> <!-- 1 - 2 arası -->

              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Adı 2</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_name2" value="<?php echo $hotel->bank_name2; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Şube 2</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_office2" value="<?php echo $hotel->bank_office2; ?>" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Swift Kodu 2</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_swift2" value="<?php echo $hotel->bank_swift2; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Bank Hesap No 2</label>
                <div class="col-sm-2">
                    <select name="bank_currency2" size="1" class="form-control input-sm">
                    <?php foreach (currencies() as $key => $value) {
                      $selected =  $hotel->bank_currency2 == $value ? 'selected="selected"' : '';
                      echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                    } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="bank_account2" value="<?php echo $hotel->bank_account2; ?>" class="form-control input-sm">
                </div>
               
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Lehdar 2</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_beneficiary2" value="<?php echo $hotel->bank_beneficiary2; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Iban 2</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_iban2" value="<?php echo $hotel->bank_iban2; ?>" class="form-control input-sm">
                </div>
              </div>


            </div> <!-- bank acounts end -->

            <link rel="stylesheet" href="<?php echo site_url('assets/back'); ?>/css/dropzone.css" />
            <script src="<?php echo site_url('assets/back'); ?>/js/dropzone.min.js"></script>
            <div class="tab-pane" id="photos">

            <h4 class="panel-title">Otel fotoğrafları yükle</h4>
            <p>Dosyaları aşağıdaki alana sürükleyerek kolayca yükleyebilirsiniz</p>

             
            <div id="dropzone">
            <form class="dropzone" id="demo-upload"></form>
            </div>

            <div id="dropzone">
            <form id="myDropzone" action="<?php echo site_url('photos/hotel_photos'); ?>" class="dropzone" id="demo-upload">
              <div class="dropzone-previews"></div> 
              <div class="fallback"> <!-- this is the fallback if JS isn't working -->
              <input name="file" type="file" multiple />
              </div>

            <input type="hidden" name="hotel_id" value="<?php echo $this->uri->segment('4'); ?>" />
            </form>
            </div>


            </div> <!-- photos end -->

          
            </div> <!-- tab content end -->

            <input type="hidden" name="update" value="1" />
            <input type="hidden" name="hotel_id" value="<?php echo $this->uri->segment('4'); ?>" />

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

  // Input Masks
  jQuery("#date").mask("99/99/9999");
  jQuery("#phone").mask("(999) 999-9999");
  jQuery("#phone2").mask("(999) 999-9999");
  jQuery("#ssn").mask("999-99-9999");


  var max_fields      = 30; //maximum input boxes allowed
  var wrapper         = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
  
  var x = 20; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
          x++; //text box increment
          var html = '<div id="item"><div class="form-group"><label class="col-sm-3 control-label">Dil</label><div class="col-sm-2"><select name="description['+x+'][lang]" size="1" class="form-control input-sm"><?php foreach (languages() as $key => $value) { ?><option value="<?php echo $value["code"]; ?>"><?php echo $value["name"]; ?></option><?php } ?></select></div><div class="col-sm-4"><a class="btn btn-xs btn-danger remove_field" href="#">Remove</a></div></div><div class="form-group"><label class="col-sm-3 control-label">Açıklama</label><div class="col-sm-6"><textarea name="description['+x+'][desc]"  class="form-control"></textarea></div></div><hr></div>';
          $(wrapper).append(html); //add input box
      }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).closest('#item').remove(); x--;
  })


});

</script>
<?php $this->load->view('footer'); ?>
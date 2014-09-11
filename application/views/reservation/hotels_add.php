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


      <ul class="nav nav-tabs">
          <li class="active"><a href="#general" data-toggle="tab"><strong>Genel Bilgi</strong></a></li>
          <li class=""><a href="#info" data-toggle="tab"><strong>Tesis Özellikleri</strong></a></li>
          <li class=""><a href="#description" data-toggle="tab"><strong>Açıklamalar</strong></a></li>
          <li class=""><a href="#accounts" data-toggle="tab"><strong>Hesap Numaraları</strong></a></li>
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
                  <input type="text" name="name" placeholder="Otel adı" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Kategori</label>
                <div class="col-sm-6">
                  <select name="category" class="form-control input-sm mb15">
                    <option value="0">Belirtilmemiş</option>
                    <option value="1">1 Yıldız</option>
                    <option value="2">2 Yıldız</option>
                    <option value="3">3 Yıldız</option>
                    <option value="4">4 Yıldız</option>
                    <option value="5">5 Yıldız</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Adres</label>
                <div class="col-sm-6">
                  <input type="text" name="adress" placeholder="Adres" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Telefon</label>
                <div class="col-sm-6">
                <input type="text" name="phone" id="phone" placeholder="Telefon" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Telefon 2</label>
                <div class="col-sm-6">
                <input type="text" name="phone2" id="phone2" placeholder="Telefon 2" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Fax</label>
                <div class="col-sm-6">
                  <input type="text" name="fax" placeholder="Fax" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">E-Mail</label>
                <div class="col-sm-6">
                  <input type="text" name="email" placeholder="E-Mail" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Website</label>
                <div class="col-sm-6">
                  <input type="text" name="website" placeholder="http://www.site.com" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Country</label>
                <div class="col-sm-6">
                  <select name="country" id="country" class="form-control choosen-select input-sm mb15">
                  <?php foreach ($countries as $key => $c) {
                    echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                  } ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Şehir</label>
                <div class="col-sm-6">
                  <input type="text" name="city" placeholder="Şehir" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">ZIP Posta Kodu</label>
                <div class="col-sm-6">
                  <input type="text" name="postcode" placeholder="ZIP Posta Kodu" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Para Birimi</label>
                <div class="col-sm-6">
                    <select name="currency" size="1" class="form-control input-sm">
                    <?php foreach (currencies() as $key => $value) {
                      echo '<option value="'.$value.'">'.$value.'</option>';
                    } ?>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Yönetici</label>
                <div class="col-sm-6">
                  <input type="text" name="administrator" placeholder="Yönetici Adı" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Ön Büro Telefon</label>
                <div class="col-sm-6">
                  <input type="text" name="reception_phone" placeholder="Ön Büro Telefon" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Ön Büro Email</label>
                <div class="col-sm-6">
                  <input type="text" name="reception_email" placeholder="Ön Büro Email" class="form-control input-sm">
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
                <textarea name="default_desc" class="form-control"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Otel özellikleri</label>
                <div class="col-sm-6">
                <table>
                  <tbody>
                    <tr>
                    <?php $i=0; foreach (hotel_specs() as $k => $v) { $i++;
                      echo '<td width="5%"><input type="checkbox" name="hotel_specs[]" value="'.$k.'"/></td>';
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
                      echo '<td width="5%"><input type="checkbox" name="restourant_specs[]" value="'.$k.'"/></td>';
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
                      echo '<td width="5%"><input type="checkbox" name="sport_specs[]" value="'.$k.'"/></td>';
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
                  <label class="col-sm-3 control-label">Açıklama</label>
                  <div class="col-sm-6">
                    <textarea name="description[1][desc]"  class="form-control"></textarea>
                  </div>
                </div>
                <hr>
              </div>
              
              
              </div>

            </div> <!-- description end -->
            

            <div class="tab-pane" id="accounts">
              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Adı 1</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_name1" placeholder="Banka Adı" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Şube 1</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_office1" placeholder="Banka Şube" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Swift Kodu 1</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_swift1" placeholder="Swift Kodu" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Bank Hesap No 1</label>
                <div class="col-sm-2">
                    <select name="bank_currency1" size="1" class="form-control input-sm">
                    <?php foreach (currencies() as $key => $value) {
                      echo '<option value="'.$value.'">'.$value.'</option>';
                    } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="bank_account1" placeholder="Banka Hesap No" class="form-control input-sm">
                </div>
               
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Lehdar 1</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_beneficiary1" placeholder="Lehdar" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Iban 1</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_iban1" placeholder="Iban 1" class="form-control input-sm">
                </div>
              </div>

              <hr> <!-- 1 - 2 arası -->

              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Adı 2</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_name2" placeholder="Banka Adı" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Şube 2</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_office2" placeholder="Banka Şube" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Swift Kodu 2</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_swift2" placeholder="Swift Kodu" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Bank Hesap No 2</label>
                <div class="col-sm-2">
                    <select name="bank_currency2" size="1" class="form-control input-sm">
                    <?php foreach (currencies() as $key => $value) {
                      echo '<option value="'.$value.'">'.$value.'</option>';
                    } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="bank_account2" placeholder="Banka Hesap No" class="form-control input-sm">
                </div>
               
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Lehdar 2</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_beneficiary2" placeholder="Lehdar" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Banka Iban 2</label>
                <div class="col-sm-6">
                  <input type="text" name="bank_iban2" placeholder="Iban" class="form-control input-sm">
                </div>
              </div>


            </div>
          
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

  // Tooltip
  jQuery('.tooltips').tooltip({ container: 'body'});

  // Input Masks
  jQuery("#date").mask("99/99/9999");
  jQuery("#phone").mask("(999) 999-9999");
  jQuery("#phone2").mask("(999) 999-9999");
  jQuery("#ssn").mask("999-99-9999");


  var max_fields      = 10; //maximum input boxes allowed
  var wrapper         = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
  
  var x = 1; //initlal text box count
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


  $("#save_hotel_details").submit(function(event) {
  /* stop form from submitting normally */
  event.preventDefault();
  /*clear result div*/
  $("#result").html('');
  /* get some values from elements on the page: */
  var val = $(this).serialize();
  /* Send the data using post and put the results in a div */
  $.ajax({
      url: base_url + "reservation_actions/save_hotel",
      type: "post",
      data: val,
      dataType: 'json',
      success: function(data){ 
        $('#result').html(data.message);
        $("#result").removeClass('alert-error'); 
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
    }); 
  });




});

</script>
<?php $this->load->view('footer'); ?>
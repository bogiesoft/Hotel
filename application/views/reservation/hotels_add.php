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
           
           <form id="save_hotel_details">
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
                    <select name="bank_currency2" size="1" class="form-control input-sm">
                    <?php foreach (currencies() as $key => $value) {
                      echo '<option value="'.$value.'">'.$value.'</option>';
                    } ?>
                    </select>
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
                <textarea name="description" class="form-control"></textarea>
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
                    <select name="bank_currency2" size="1" class="form-control input-sm">
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


            <input type="submit" class="btn btn-primary" value="Submit">

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

});
</script>
<?php $this->load->view('footer'); ?>
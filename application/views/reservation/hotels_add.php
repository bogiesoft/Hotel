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
                  <input type="text" name="phone" placeholder="Telefon" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Telefon 2</label>
                <div class="col-sm-6">
                  <input type="text" name="phone2" placeholder="Telefon 2" class="form-control input-sm">
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
                    <select name="currency" size="1" class="form-control input-sm mb15">
                      <option value="AUD">AUD</option>
                      <option value="BGN">BGN</option>
                      <option value="BRL">BRL</option>
                      <option value="CAD">CAD</option>
                      <option value="CHF">CHF</option>
                      <option value="CNY">CNY</option>
                      <option value="CZK">CZK</option>
                      <option value="DKK">DKK</option>
                      <option value="EUR">EUR</option>
                      <option value="GBP">GBP</option>
                      <option value="HKD">HKD</option>
                      <option value="HRK">HRK</option>
                      <option value="HUF">HUF</option>
                      <option value="IDR">IDR</option>
                      <option value="ILS">ILS</option>
                      <option value="INR">INR</option>
                      <option value="JPY">JPY</option>
                      <option value="KRW">KRW</option>
                      <option value="LTL">LTL</option>
                      <option value="MXN">MXN</option>
                      <option value="MYR">MYR</option>
                      <option value="NOK">NOK</option>
                      <option value="NZD">NZD</option>
                      <option value="PHP">PHP</option>
                      <option value="PLN">PLN</option>
                      <option value="RON">RON</option>
                      <option value="RUB">RUB</option>
                      <option value="SEK">SEK</option>
                      <option value="SGD">SGD</option>
                      <option value="THB">THB</option>
                      <option value="TRY">TRY</option>
                      <option value="USD">USD</option>
                      <option value="ZAR">ZAR</option>
                    </select>
                </div>
              </div>

            </div> <!-- general end -->
            

            <div class="tab-pane" id="info">

            </div> <!-- info end -->
            

            <div class="tab-pane" id="description">
             
            </div> <!-- description end -->
            

            <div class="tab-pane" id="accounts">

            </div>
          
            </div> <!-- tab content end -->


            <input type="submit" class="btn btn-primary" value="Submit">

            </form>
            </div>
          </div>
      </div>
  </div><!-- row -->

</div><!-- contentpanel -->

<script type="text/javascript">
jQuery(document).ready(function(){
  // Chosen Select
  jQuery("#country").chosen({'width':'100%','white-space':'nowrap'});

});
</script>
<?php $this->load->view('footer'); ?>
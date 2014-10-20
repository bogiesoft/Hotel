<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> Policies > Add New</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>">Yönetim</a></li>
          <li class="active">Add New Policy</li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      <div class="row">
      <form>
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
            <fieldset class="table-legend">
              <legend class="table-legend">Policy Details</legend>

             <div class="form-group">
                <label class="col-sm-3 control-label">Policy Name</label>
                <div class="col-sm-6">
                  <input type="text" name="name" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Default Explanation</label>
                <div class="col-sm-6">
                <textarea name="description" class="form-control"></textarea>
                </div>
              </div>

            </fieldset>

            <fieldset class="table-legend">
              <legend class="table-legend">Sales Policy</legend>
              <table class="table mb30">
                <tbody>
                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][policy_note]" id="policy_note" checked="checked" />
                      <label for="policy_note"></label>
                    </div>
                    </td>
                    <td>Rezervasyon yaptığınız için teşekkür ederiz.Lütfen satış politikasını not ediniz</td>
                  </tr>
                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][credit_card]" id="credit_card" checked="checked" />
                      <label for="credit_card"></label>
                    </div>
                    </td>
                    <td>Rezervasyon garantisi için geçerli kredi kartı gereklidir.</td>
                  </tr>
                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][valid_card]['status']" id="valid_card" />
                      <label for="valid_card"></label>
                    </div>
                    </td>
                    <td>
                    Eğer kredi kartınızda yeterli miktarda garanti miktarı
                    <input type="text" name="policy[sales][valid_card][no_card_depozit_value]" style="width: 36px;height: 20px;">
                    <select name="policy[sales][valid_card][no_card_depozit_method]" style="width:240px; height: 20px">
                      <option value="perc">Rezervasyon değerininin yüzdesi</option>
                      <option value="days">Seçili konaklamada kişi başına geceleme</option>
                      <option value="fix">(EUR) Sabit değer</option>
                    </select>
                    yoksa,
                    Kredi kartı olmayan misafirler için, garanti ödemesini acounta transfer yöntemi ile 
                    <input type="text" name="policy[sales][valid_card][no_card_depozit_days]" style="width: 36px;height: 20px;">
                    gün önce gönderilmesi gerekir.
                    </td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][depozit_after_resv][status]" id="depozit_after_resv" />
                      <label for="depozit_after_resv"></label>
                    </div>
                    </td>
                    <td>
                     For clients without credit cards - guarantee down payment by wire transfer to our account has to be done at least 
                      <input type="text" name="policy[sales][depozit_after_resv][days]" style="width: 36px;height: 20px;">
                      day(s) after making reservation.
                    </td>
                  </tr>

                   <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][taxes][status]" id="taxes" />
                      <label for="taxes"></label>
                    </div>
                    </td>
                    <td>Konaklama ücretleri vergiler ve hizmet bedellerini içerir.</td>
                  </tr>
                  

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][checkin][status]" id="checkin" />
                      <label for="checkin"></label>
                    </div>
                    </td>
                    <td>Check-in otele varış günü <?php echo twentyfour_hour_selectbox('policy[sales][checkin][value]'); ?>
                    dan sonra yapılır.</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][checkout][status]" id="checkout" />
                      <label for="checkout"></label>
                    </div>
                    </td>
                    <td>Check out <?php echo twentyfour_hour_selectbox('policy[sales][checkout][value]'); ?>
                    dan önce otelden çıkış günü</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][child_age][status]" id="child_age" />
                      <label for="child_age"></label>
                    </div>
                    </td>
                    <td><?php echo age_selectbox('policy[sales][child_age][value]'); ?>yaş ve üzeri konaklamalarda yetişkin fiyat listesi uygulanır. Lütfen Yetişkin olarak değerlendiriniz.</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][payment][status]" id="payment" />
                      <label for="payment"></label>
                    </div>
                    </td>
                    <td>Hesap kesimi check out zamanında ön büroda gerçekleşecektir.</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][info_rate][status]" id="info_rate" />
                      <label for="info_rate"></label>
                    </div>
                    </td>
                    <td>Bu fiyat listesinde bulunan fiyatlar gerçeğe yakın fiyatlardır</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][resv_cancel][status]" id="resv_cancel" />
                      <label for="resv_cancel"></label>
                    </div>
                    </td>
                    <td>Rezervasyonunuzu iptal etmek veya değiştirmek istiyorsanız, Lütfen rezervasyon departmanımız ile görüşünüz.</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][resv_contact][status]" id="resv_contact" />
                      <label for="resv_contact"></label>
                    </div>
                    </td>
                    <td>Lütfen rezervasyon ofisi ile iletişim kurunuz.
                      Otel, rezervasyonları iptal etme veya değiştirme hakkını olası sahte rezervasyonlar ve bu tarz nedenler dolayısı ile saklı tutar.</td>
                  </tr>
                 
                    
                 </tbody>
              </table>
              </fieldset>


              <fieldset class="table-legend">
              <legend class="table-legend">Cancelation Policy</legend>
              <table class="table mb30">
                <tbody>
                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[cancel][cancellation_time][status]" id="cancellation_time" checked="checked" />
                      <label for="cancellation_time"></label>
                    </div>
                    </td>
                    <td>Bu rezervasyon otele varış günü <?php echo twentyfour_hour_selectbox('policy[cancel][cancellation_time][value]'); ?> saatine kadar tutulacaktır</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[cancel][no_show_value]['status']" id="no_show_value" />
                      <label for="no_show_value"></label>
                    </div>
                    </td>
                    <td>
                    No Show durumlarında, iptal ücreti uygulanır 
                    <input type="text" name="policy[cancel][no_show_value][no_card_depozit_value]" style="width: 36px;height: 20px;">
                    <select name="policy[cancel][no_show_value][no_card_depozit_method]" style="width:240px; height: 20px">
                      <option value="no_show_days">Seçili konaklamada kişi başına geceleme</option>
                      <option value="no_show_perc">Rezervasyon değerininin yüzdesi</option>
                      <option value="no_show_perc_guarantee">Garanti değerinin yüzdesi</option>
                    </select>
                    </td>
                  </tr>

                 </tbody>
              </table>
              </fieldset>


              <fieldset class="table-legend">
              <legend class="table-legend">Online Cancellation</legend>
              <table class="table mb30">
                <tbody>
                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[cancel][client_can_cancel][status]" id="client_can_cancel"/>
                      <label for="client_can_cancel"></label>
                    </div>
                    </td>
                    <td>Online rezervasyon iptali mümkündür</td>
                  </tr> 

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[cancel][client_confirmation][status]" id="client_confirmation"/>
                      <label for="client_confirmation"></label>
                    </div>
                    </td>
                    <td>Müşteri satış poliçesini okuyup anladığını confirme etmek zorundadır.</td>
                  </tr>             
                    
                 </tbody>
              </table>
              </fieldset>


              
            </div>
          </div>
        </div>
        </form>
      </div><!-- row -->

    </div><!-- contentpanel -->

<?php $this->load->view('footer'); ?>
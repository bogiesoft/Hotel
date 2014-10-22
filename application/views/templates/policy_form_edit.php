<pre>
  <?php print_r($p); ?>
</pre>

<div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
            <fieldset class="table-legend">
              <legend class="table-legend">Policy Details</legend>

             <div class="form-group">
                <label class="col-sm-3 control-label">Policy Name</label>
                <div class="col-sm-6">
                  <input type="text" name="name" value="<?php echo $p->name; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Extra Policies</label>
                <div class="col-sm-6">
                <textarea name="extra_policies" class="form-control"><?php echo $p->extra; ?></textarea>
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
                      <input type="checkbox" name="policy[sales][policy_note]" <?php checkbox_selected(@$p->sales->policy_note); ?> id="policy_note" checked="checked" />
                      <label for="policy_note"></label>
                    </div>
                    </td>
                    <td>Rezervasyon yaptığınız için teşekkür ederiz.Lütfen satış politikasını not ediniz</td>
                  </tr>
                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][credit_card]" <?php checkbox_selected(@$p->sales->credit_card); ?> id="credit_card" checked="checked" />
                      <label for="credit_card"></label>
                    </div>
                    </td>
                    <td>Rezervasyon garantisi için geçerli kredi kartı gereklidir.</td>
                  </tr>
                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][valid_card][status]" <?php checkbox_selected(@$p->sales->valid_card->status); ?> id="valid_card" />
                      <label for="valid_card"></label>
                    </div>
                    </td>
                    <td>
                    Eğer kredi kartınızda yeterli miktarda garanti miktarı
                    <input type="text" name="policy[sales][valid_card][no_card_depozit_value]" value="<?php echo $p->sales->valid_card->no_card_depozit_value; ?>" style="width: 36px;height: 20px;">
                    <?php valid_card_select($p->sales->valid_card->no_card_depozit_method); ?>

                    yoksa,
                    Kredi kartı olmayan misafirler için, garanti ödemesini acounta transfer yöntemi ile 
                    <input type="text" name="policy[sales][valid_card][no_card_depozit_days]" value="<?php echo $p->sales->valid_card->no_card_depozit_days; ?>"style="width: 36px;height: 20px;">
                    gün önce gönderilmesi gerekir.
                    </td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][depozit_after_resv][status]" <?php checkbox_selected(@$p->sales->depozit_after_resv->status); ?> id="depozit_after_resv" />
                      <label for="depozit_after_resv"></label>
                    </div>
                    </td>
                    <td>
                     For clients without credit cards - guarantee down payment by wire transfer to our account has to be done at least 
                      <input type="text" name="policy[sales][depozit_after_resv][days]" value="<?php echo $p->sales->depozit_after_resv->days; ?>" style="width: 36px;height: 20px;">
                      day(s) after making reservation.
                    </td>
                  </tr>

                   <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][taxes]" <?php checkbox_selected(@$p->sales->taxes); ?> id="taxes" />
                      <label for="taxes"></label>
                    </div>
                    </td>
                    <td>Konaklama ücretleri vergiler ve hizmet bedellerini içerir.</td>
                  </tr>
                  

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][checkin][status]" <?php checkbox_selected(@$p->sales->checkin->status); ?> id="checkin" />
                      <label for="checkin"></label>
                    </div>
                    </td>
                    <td>Check-in otele varış günü <?php echo twentyfour_hour_selectbox('policy[sales][checkin][value]',$p->sales->checkin->value); ?>
                    dan sonra yapılır.</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][checkout][status]" <?php checkbox_selected(@$p->sales->checkout->status); ?> id="checkout" />
                      <label for="checkout"></label>
                    </div>
                    </td>
                    <td>Check out <?php  twentyfour_hour_selectbox('policy[sales][checkout][value]',$p->sales->checkout->value); ?>
                    dan önce otelden çıkış günü</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][child_age][status]" <?php checkbox_selected(@$p->sales->child_age->status); ?> id="child_age" />
                      <label for="child_age"></label>
                    </div>
                    </td>
                    <td><?php  age_selectbox('policy[sales][child_age][value]',$p->sales->child_age->value); ?>yaş ve üzeri konaklamalarda yetişkin fiyat listesi uygulanır. Lütfen Yetişkin olarak değerlendiriniz.</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][payment]" <?php checkbox_selected(@$p->sales->payment); ?> id="payment" />
                      <label for="payment"></label>
                    </div>
                    </td>
                    <td>Hesap kesimi check out zamanında ön büroda gerçekleşecektir.</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][info_rate]" <?php checkbox_selected(@$p->sales->info_rate); ?>id="info_rate" />
                      <label for="info_rate"></label>
                    </div>
                    </td>
                    <td>Bu fiyat listesinde bulunan fiyatlar gerçeğe yakın fiyatlardır</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][resv_cancel]" <?php checkbox_selected(@$p->sales->resv_cancel); ?> id="resv_cancel" />
                      <label for="resv_cancel"></label>
                    </div>
                    </td>
                    <td>Rezervasyonunuzu iptal etmek veya değiştirmek istiyorsanız, Lütfen rezervasyon departmanımız ile görüşünüz.</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[sales][resv_contact]" <?php checkbox_selected(@$p->sales->resv_contact); ?> id="resv_contact" />
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
                      <input type="checkbox" name="policy[cancel][cancellation_time][status]" <?php checkbox_selected(@$p->cancel->cancellation_time->status); ?> id="cancellation_time" checked="checked" />
                      <label for="cancellation_time"></label>
                    </div>
                    </td>
                    <td>Bu rezervasyon otele varış günü <?php twentyfour_hour_selectbox('policy[cancel][cancellation_time][value]',$p->cancel->cancellation_time->value); ?> saatine kadar tutulacaktır</td>
                  </tr>

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[cancel][no_show_value][status]" <?php checkbox_selected(@$p->cancel->no_show_value->status); ?> id="no_show_value" />
                      <label for="no_show_value"></label>
                    </div>
                    </td>
                    <td>
                    No Show durumlarında, iptal ücreti uygulanır 
                    <input type="text" name="policy[cancel][no_show_value][value]" value="<?php echo $p->cancel->no_show_value->value; ?>" style="width: 36px;height: 20px;">
                    <?php no_show_select($p->cancel->no_show_value->no_card_depozit_method); ?>
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
                      <input type="checkbox" name="policy[cancel][client_can_cancel]" <?php checkbox_selected(@$p->cancel->client_can_cancel); ?> id="client_can_cancel"/>
                      <label for="client_can_cancel"></label>
                    </div>
                    </td>
                    <td>Online rezervasyon iptali mümkündür</td>
                  </tr> 

                  <tr>
                    <td>
                    <div class="ckbox ckbox-success">
                      <input type="checkbox" name="policy[cancel][client_confirmation]" <?php checkbox_selected(@$p->cancel->client_confirmation); ?> id="client_confirmation"/>
                      <label for="client_confirmation"></label>
                    </div>
                    </td>
                    <td>Müşteri satış poliçesini okuyup anladığını confirme etmek zorundadır.</td>
                  </tr>             
                    
                 </tbody>
              </table>
              </fieldset>

              <fieldset class="table-legend">
              <legend class="table-legend">Extra Policies by Language</legend>
              <a href="#" class="btn btn-success add_field_button pull-right">Add Field</a>
                <div class="input_fields_wrap">
                <?php foreach ($p->description as $lang => $desc): ?>
                <div id="item">
                 <div class="form-group">
                    <label class="col-sm-3 control-label">Dil</label>
                    <div class="col-sm-2">
                      <select name="policy[description][1][lang]" size="1" class="form-control input-sm">
                        <?php foreach (languages() as $key => $value) {
                          $selected = $value['code'] == $lang ? 'selected="selected"' : '';
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
                      <textarea name="policy[description][1][desc]"  class="form-control"><?php echo $desc; ?></textarea>
                    </div>
                  </div>

                  <hr>
                </div>
                <?php endforeach; ?>
                </div>
                </fieldset>

                <input type="hidden" name="policy_id" value="<?php echo $this->uri->segment('4'); ?>" />
              
                <div class="form-group">
                  <div class="col-sm-6">
                  <button type="submit" class="btn btn-success">Kaydet</button>
                  </div>
                </div>

              
            </div>
          </div>
        </div>
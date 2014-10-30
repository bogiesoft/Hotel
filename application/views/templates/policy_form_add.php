<div class="panel panel-default">
  <div class="panel-body">
    <div class="col-md-12 col-sm-3">            
    <fieldset class="table-legend">
      <legend class="table-legend"><?php echo lang('policy_details'); ?></legend>

     <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo lang('policy_name'); ?></label>
        <div class="col-sm-6">
          <input type="text" name="name" class="form-control input-sm">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo lang('extra_policies'); ?></label>
        <div class="col-sm-6">
        <textarea name="extra_policies" class="form-control"></textarea>
        </div>
      </div>

    </fieldset>

    <fieldset class="table-legend">
      <legend class="table-legend"><?php echo lang('sales_policy'); ?></legend>
      <table class="table mb30">
        <tbody>
          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[sales][policy_note]" id="policy_note" checked="checked" />
              <label for="policy_note"></label>
            </div>
            </td>
            <td><?php echo lang('policy_note'); ?></td>
          </tr>
          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[sales][credit_card]" id="credit_card" checked="checked" />
              <label for="credit_card"></label>
            </div>
            </td>
            <td><?php echo lang('credit_card'); ?></td>
          </tr>
          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[sales][valid_card][status]" id="valid_card" />
              <label for="valid_card"></label>
            </div>
            </td>
            <td>
            <?php 
            $value = '<input type="text" name="policy[sales][valid_card][no_card_depozit_value]" style="width: 36px;height: 20px;">';
            $days = ' <input type="text" name="policy[sales][valid_card][no_card_depozit_days]" style="width: 36px;height: 20px;">';
            ?>
            <?php echo sprintf(lang('valid_card'),$value,valid_card_select(),$days); ?>

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
            <?php $days = '<input type="text" name="policy[sales][depozit_after_resv][days]" style="width: 36px;height: 20px;">'; ?>
            <?php echo sprintf(lang('depozit_after_resv'), $days); ?>
            </td>
          </tr>

           <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[sales][taxes]" id="taxes" />
              <label for="taxes"></label>
            </div>
            </td>
            <td><?php echo lang('taxes'); ?></td>
          </tr>
          

          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[sales][checkin][status]" id="checkin" />
              <label for="checkin"></label>
            </div>
            </td>
            <td>
            <?php echo sprintf(lang('checkin'), twentyfour_hour_selectbox('policy[sales][checkin][value]')); ?>
            </td>
          </tr>

          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[sales][checkout][status]" id="checkout" />
              <label for="checkout"></label>
            </div>
            </td>
            <td>
            <?php echo sprintf(lang('checkout'), twentyfour_hour_selectbox('policy[sales][checkout][value]')); ?>
            </td>
            
          </tr>

          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[sales][child_age][status]" id="child_age" />
              <label for="child_age"></label>
            </div>
            </td>
            <td>
            <?php echo sprintf(lang('child_age'),age_selectbox('policy[sales][child_age][value]')); ?>
            </td>
          </tr>

          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[sales][payment]" id="payment" />
              <label for="payment"></label>
            </div>
            </td>
            <td><?php echo lang('payment'); ?></td>
          </tr>

          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[sales][info_rate]" id="info_rate" />
              <label for="info_rate"></label>
            </div>
            </td>
            <td><?php echo lang('info_rate'); ?></td>
          </tr>

          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[sales][resv_cancel]" id="resv_cancel" />
              <label for="resv_cancel"></label>
            </div>
            </td>
            <td><?php echo lang('resv_cancel'); ?></td>
          </tr>

          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[sales][resv_contact]" id="resv_contact" />
              <label for="resv_contact"></label>
            </div>
            </td>
            <td><?php echo lang('resv_contact'); ?></td>
          </tr>
         
            
         </tbody>
      </table>
      </fieldset>


      <fieldset class="table-legend">
      <legend class="table-legend"><?php echo lang('cancellation_policy'); ?></legend>
      <table class="table mb30">
        <tbody>
          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[cancel][cancellation_time][status]" id="cancellation_time" checked="checked" />
              <label for="cancellation_time"></label>
            </div>
            </td>
            <td><?php echo sprintf(lang('cancellation_time'),twentyfour_hour_selectbox('policy[cancel][cancellation_time][value]')); ?>
            </td>
          </tr>

          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[cancel][no_show_value][status]" id="no_show_value" />
              <label for="no_show_value"></label>
            </div>
            </td>
            <td>
            <?php
            $value = '<input type="text" name="policy[cancel][no_show_value][value]" style="width: 36px;height: 20px;">';
            echo sprintf(lang('no_show_value'),$value,no_show_select()); ?>

            </td>
          </tr>

         </tbody>
      </table>
      </fieldset>


      <fieldset class="table-legend">
      <legend class="table-legend"><?php echo lang('online_cancellation'); ?></legend>
      <table class="table mb30">
        <tbody>
          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[cancel][client_can_cancel]" id="client_can_cancel"/>
              <label for="client_can_cancel"></label>
            </div>
            </td>
            <td><?php echo lang('client_can_cancel'); ?></td>
          </tr> 

          <tr>
            <td>
            <div class="ckbox ckbox-success">
              <input type="checkbox" name="policy[cancel][client_confirmation]" id="client_confirmation"/>
              <label for="client_confirmation"></label>
            </div>
            </td>
            <td><?php echo lang('client_confirmation'); ?></td>
          </tr>             
            
         </tbody>
      </table>
      </fieldset>

      <fieldset class="table-legend">
      <legend class="table-legend"><?php echo lang('extra_policies_by_lang'); ?></legend>
      <a href="#" class="btn btn-success add_field_button pull-right"><?php echo lang('add_field'); ?></a>
        <div class="input_fields_wrap">
        <div id="item">
         <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo lang('language'); ?></label>
            <div class="col-sm-2">
              <select name="policy[description][1][lang]" size="1" class="form-control input-sm">
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
            <label class="col-sm-3 control-label"><?php echo lang('description'); ?></label>
            <div class="col-sm-6">
              <textarea name="policy[description][1][desc]"  class="form-control"></textarea>
            </div>
          </div>
          
          
          <hr>
        </div>
        
        </div>

        </fieldset>

        <input type="hidden" name="update" value="0">

      <div class="form-group">
        <div class="col-sm-6">
        <button type="submit" class="btn btn-success"><?php echo lang('save'); ?></button>
        </div>
      </div>

      
    </div>
  </div>
</div>
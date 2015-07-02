<div class="modal fade" id="policyModal" tabindex="-1" role="dialog" aria-labelledby="policyModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Policies</h4>
      </div>
      <div class="modal-body">
        <?php

$p = get_hotel_policy($hotel_info->id);

if ($p == false) {
    echo 'No Policy Found';
}else{


    echo '<h4>'.lang('sales_policy').'</h4>';

    if(checkbox_selected(@$p->sales->policy_note)){
        echo lang('policy_note');
    }
    if(checkbox_selected(@$p->sales->credit_card)){
        echo lang('credit_card');
    }

    if(checkbox_selected(@$p->sales->valid_card->status)){
        $value  = $p->sales->valid_card->no_card_depozit_value;
        $days   = $p->sales->valid_card->no_card_depozit_days;
        
        echo sprintf(lang('valid_card'),$value,$p->sales->valid_card->no_card_depozit_method,$days); 

    }

    if(checkbox_selected(@$p->sales->depozit_after_resv->status)){
        $days = $p->sales->depozit_after_resv->days;
        echo sprintf(lang('depozit_after_resv'), $days);
    }

    if(checkbox_selected(@$p->sales->taxes)){
        echo lang('taxes');
    }

    if(checkbox_selected(@$p->sales->checkin->status)){
        echo sprintf(lang('checkin'),$p->sales->checkin->value);
    }

    if(checkbox_selected(@$p->sales->checkout->status)){
        echo sprintf(lang('checkout'),$p->sales->checkout->value);
    }

    if(checkbox_selected(@$p->sales->child_age->status)){
       echo sprintf(lang('child_age'),$p->sales->child_age->value);
    }
    if(checkbox_selected(@$p->sales->payment)){
        echo lang('payment');
    }

    if(checkbox_selected(@$p->sales->info_rate)){
        echo lang('info_rate');
    }

    if(checkbox_selected(@$p->sales->resv_cancel)){
        echo lang('resv_cancel');
    }

    if(checkbox_selected(@$p->sales->resv_contact)){
        echo lang('resv_contact');
    }

    if(checkbox_selected(@$p->sales->taxes)){
        echo lang('taxes');
    }


    echo '<h4>'.lang('cancellation_policy').'</h4>';
    if(checkbox_selected(@$p->cancel->cancellation_time->status)){
        echo sprintf(lang('cancellation_time'),$p->cancel->cancellation_time->value);
    }
    if(checkbox_selected(@$p->cancel->no_show_value->status)){
       $value = $p->cancel->no_show_value->value;
       echo sprintf(lang('no_show_value'),$value,lang(no_show_select($p->cancel->no_show_value->no_card_depozit_method)));
    }

    if(checkbox_selected(@$p->cancel->client_can_cancel)){
        echo lang('client_can_cancel');
    }


    if (!empty($p->extra)) {
        echo '<h4>Other</h4>';
        echo $p->extra; 
    }
   
}
?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
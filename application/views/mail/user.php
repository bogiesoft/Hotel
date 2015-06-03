<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">

<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
    <!-- <link type="text/css" rel="stylesheet" href="<?php echo site_url('assets/mail'); ?>/css/style.css" media="all" /> -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="<?php echo site_url('assets/mail'); ?>/js/jquery.carouFredSel-6.0.4-packed.js"></script>
    <script src="<?php echo site_url('assets/mail'); ?>/js/main.js"></script>
</head>
<style type="text/css">
/* ------------------------------------------------------------------- controls */
body{color:#333;}
a {color: #4393ff;}
a:hover {}
p{font-size:13px}

.bold{font-weight:bold}
.no-border{border:none !important}

.header{padding-top:17px;margin-bottom:30px}
.print-btn{display:block;background-color:#0896ff;color:#fff;padding:4px 8px;margin-top:52px}
.right-align{text-align:right}

.title1{font-size:20px;margin-bottom:18px}

.contact-block{margin-bottom:40px}
.contact-block .title{font-size:22px;display:inline-block;width:200px;vertical-align:middle}
.contact-block .label1{display:inline-block;width:200px;padding-left:100px;vertical-align:top}
.contact-block .val1{display:inline-block;vertical-align:top}

.title2{font-size:16px;color:#4393ff;text-align:center;margin-bottom:18px}

.details-block{margin-bottom:29px}
.details-block .t-row{border-bottom:dotted 1px #333}
.details-block .label1{padding:0 4px;display:inline-block;}
.details-block .val1{padding:0 4px;display:inline-block;}

.blue-box{background-color:#e6edf6;border:solid 1px #b3cae6;padding:12px;margin-bottom:22px}
.blue-box .t-row{border-bottom:dotted 1px #333}
.blue-box .label1{padding:0 4px;display:inline-block;font-size:13px}
.blue-box .val1{padding:0 4px;display:inline-block;text-align:right;font-size:13px}
.blue-box .toplam{font-size:18px}

.title4{font-size:20px;margin-bottom:7px}


fieldset.table-legend {
border: 1px groove #ddd !important;
padding: 0 1.4em 1.4em 1.4em !important;
margin: 0 0 1.5em 0 !important;
-webkit-box-shadow: 0px 0px 0px 0px #000;
box-shadow: 0px 0px 0px 0px #000;
}
legend.table-legend {
font-size: 1.2em !important;
font-weight: bold !important;
text-align: left !important;
width: auto;
padding: 0 10px;
border-bottom: none;
    }

</style>
<body style="color:#333;font-size:12px">
    <div class="container">
        <div class="row header">
            <img src="<?php echo $hotel_info->hotel_logo; ?>" />
            <a class="print-btn pull-right bold" href="#" style="">
                <span class="glyphicon glyphicon-print"></span>&nbsp;
                Yazdırılabilir versiyonu alın
            </a>
        </div>
        <div class="title1 row">
            <?php echo sprintf(lang('thank_you'),$name_title.' '.$first_name.' '.$last_name); ?>
        </div>
        <div class="contact-block row bold" style="">
            <div style="margin-bottom:3px">
                <span class="label1">Adres:</span>
                <span class="val1">
                    <?php echo $hotel_info->adress; ?> <br/>
                    
                </span>
            </div>
            <div style ="margin-bottom:3px">
                <span class="label1">Telefon:</span>
                <span class="val1">
                    <?php echo $hotel_info->phone; ?>
                </span>
            </div>
            <div style="margin-bottom:3px">
                <span class="label1">Seyahat bilgisi::</span>
                <span class="val1">
                    <a href="#">Ulaşım talimatlarını göster</a>
                </span>
            </div>
        </div>
        <div class="title2">
            <img src="<?php site_url('assets/mail'); ?>/img/gear.png" />&nbsp;
            Rezervasyonunuzu yönetin 
        </div>
        <div class="details-block">
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Rezervasyon numarası</span>
                <span class="val1 col-xs-9 right-align"><?php echo $reservation_code; ?></span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">PIN kodu</span>
                <span class="val1 col-xs-9 right-align"><?php echo $pincode; ?></span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Rezervasyonunuz</span>
                <span class="val1 col-xs-9 right-align"></span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Check-in</span>
                <span class="val1 col-xs-9 right-align"><?php echo $checkin; ?></span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Check-out</span>
                <span class="val1 col-xs-9 right-align"><?php echo $checkout; ?></span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Rezervasyonu yapan</span>
                <span class="val1 col-xs-9 right-align"><?php echo $first_name; ?> <?php echo $last_name; ?></span>
            </div>
        </div>
        
        <div class="blue-box">
            <div class="t-row clearfix">
                <?php foreach (json_decode($rooms) as $key => $room) : ?>
                <span class="label1 col-xs-6 bold"><?php echo $room->name; ?> (x <?php echo $room->qty; ?>)</span>
                <span class="val1 col-xs-6 bold"><?php echo $room->price; ?> <?php echo $hotel_info->currency; ?></span>
                <?php endforeach; ?>

                <?php foreach (json_decode($extras) as $key => $extra) : ?>
                <span class="label1 col-xs-6 bold"><?php echo $extra->name; ?></span>
                <span class="val1 col-xs-6 bold"><?php echo $extra->price; ?> <?php echo $hotel_info->currency; ?></span>
                <?php endforeach; ?>
            </div>
            <div class="t-row clearfix no-border">
                <span class="label1 col-xs-6 bold toplam">Toplam ücret</span>
                <span class="val1 col-xs-6 bold toplam"><?php echo $total_price; ?> <?php echo $hotel_info->currency; ?></span>
            </div>
            <div class="t-row clearfix no-border">
                <span class="label1 col-xs-6 bold">&nbsp;</span>
                <span class="val1 col-xs-6 bold"> En İyi Fiyat Garantisi</span>
            </div>
            <br/>
            <div>
                <?php echo sprintf(lang('payment_box'),$hotel_info->name); ?>
                <br/>
                %14,75 Vergi hariçtir.<br />
                Gecelik 3,50 US$ şehir vergisi hariçtir.<br />
                Önemli: İlave özellikler (ek yatak gibi) bu toplama eklenmemektedir.<br />
                Gösterilen toplam fiyat tesise ödeyeceğiniz miktardır. Booking.com hiçbir rezervasyon ücreti, idari veya başka herhangi bir ücret almaz.
            </div>
        </div>

        <?php foreach (json_decode($rooms) as $key => $room) : ?>
        <?php $p = get_policy($room->policy);?>
        <fieldset class="table-legend">
        <legend class="table-legend"><?php echo $room->name; ?></legend>
        
        <div class="details-block">
            <?php if (isset($room->preferences->guest_name)) { ?>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Konuk adı</span>
                <span class="val1 col-xs-9"><?php echo $room->preferences->guest_name; ?></span>
            </div>
            <?php } ?>
        </div>
       
        <div class="title4 bold">Önemli Bilgiler</div>
        <p>
            Havaalanı servisi sadece belirli saatlerde hizmet vermektedir. Bu hizmet ek ücrete tabi olabilir. Ayrıntılı bilgi için tesisle irtibata geçiniz.<br/>
            Check-in sırasında konukların fotoğraflı kimlik belgesi ve kredi kartı göstermesi gerekmektedir. Özel İsteklerin doluluk durumuna bağlı olduğunu ve ek ücrete tabi olabileceğini lütfen unutmayın.
        </p>
        <p>
            <?php echo $p->extra; ?>
        </p>
        <br/>
        <div class="title4 bold"><?php echo lang('sales_policy'); ?></div>
        <p>
        <?php if(checkbox_selected(@$p->sales->policy_note)){
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
        ?>
        </p>
        <br/>

        <div class="title4 bold"><?php echo lang('cancellation_policy'); ?></div>
        <p>
        <?php if(checkbox_selected(@$p->cancel->cancellation_time->status)){
            echo sprintf(lang('cancellation_time'),$p->cancel->cancellation_time->value);
        }
        if(checkbox_selected(@$p->cancel->no_show_value->status)){
           $value = $p->cancel->no_show_value->value;
           echo sprintf(lang('no_show_value'),$value,lang(no_show_select($p->cancel->no_show_value->no_card_depozit_method)));
        }

        if(checkbox_selected(@$p->cancel->client_can_cancel)){
            echo lang('client_can_cancel');
        }

        ?>
        </p>
        <br/>
        </fieldset>
        <?php endforeach; ?>
        <br />
        <div class="title4 bold"><?php echo lang('need_support'); ?></div>
        <div class="details-block">
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold"><?php echo lang('contact_to_hotel'); ?></span>
                <span class="val1 col-xs-9"><?php echo lang('phone'); ?>: <?php echo $hotel_info->phone; ?></span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold"><?php echo lang('manage_reservation'); ?></span>
                <span class="val1 col-xs-9 bold">
                    Dilediğiniz zaman çevrimiçi olarak rezervasyonunuzu görüntüleyebilir veya<br/>
                    <a href="<?php echo $hotel_info->website; ?>"> değişiklik yapabilirsiniz.<br /></a>
                    <br/>
                    <a href="mailto:<?php echo $hotel_info->email; ?>"> Müşteri hizmetlerine e-posta gönderin.</a>
                </span>
            </div>
            <div class="t-row clearfix no-border">
                <span class="label1 col-xs-3 bold"></span>
                <span class="label1 col-xs-9 bold">
                    Sabit veya IP telefondan ararken: 00800 448 826 367<br/>
                    Cep telefonundan arama yaparken lütfen uluslararası numarayı girin.<br/>
                    Yurtdışından veya Amerika Birleşik Devletleri içinden: +44 20 3320 2641
                </span>
            </div>
        </div>


    </div>
</body>
</html>
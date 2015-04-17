<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo site_url('assets/mail'); ?>/css/style.css" media="all" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="<?php echo site_url('assets/mail'); ?>/js/jquery.carouFredSel-6.0.4-packed.js"></script>
    <script src="<?php echo site_url('assets/mail'); ?>/js/main.js"></script>
</head>
<body style="color:#333;font-size:12px">
    <div class="container">
        <div class="row header">
            <img src="img/logo.png" />
            <a class="print-btn pull-right bold" href="#" style="">
                <span class="glyphicon glyphicon-print"></span>&nbsp;
                Yazdırılabilir versiyonu alın
            </a>
        </div>
        <div class="title1 row">
            Teşekkürler, <?php echo $name_title; ?>  <?php echo $first_name; ?> <?php echo $last_name; ?> Rezervasyonunuz onaylandı.
        </div>
        <div class="contact-block row bold" style="">
            <div style="margin-bottom:7px">
                <span class="title"><?php echo $hotel_info->name; ?></span>

                <a href="#" style="display:inline-block;background-color:#d7dbe6;padding:4px 8px;color:#47518a;font-weight:bold">
                    <span class="glyphicon glyphicon-lock"></span>&nbsp;
                    İş  Seyehati
                </a>
                &nbsp;
                <a href="#" style="display:inline-block;background-color:#d7dbe6;padding:4px 8px;color:#47518a;font-weight:bold">
                    <span class="glyphicon glyphicon-lock"></span>&nbsp;
                    İş  Seyehati
                </a>
            </div>
            <div style="margin-bottom:3px">
                <span class="label1">Adres:</span>
                <span class="val1">
                    <?php echo $hotel_info->address; ?> <br/>
                    
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
            <img src="img/gear.png" />&nbsp;
            Rezervasyonunuzu yönetin 
        </div>
        <div class="details-block">
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Rezervasyon numarası</span>
                <span class="val1 col-xs-9 right-align"><?php echo $reservation_code; ?>/span>
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
                <?php foreach (json_decode($rooms) as $key => $value) : ?>
                <span class="label1 col-xs-6 bold">Klasik İki Çift Kişilik Yataklı Oda</span>
                <span class="val1 col-xs-6 bold">US$319</span>
            </div>
            <div class="t-row clearfix no-border">
                <span class="label1 col-xs-6 bold toplam">Toplam ücret</span>
                <span class="val1 col-xs-6 bold toplam">US$319</span>
            </div>
            <div class="t-row clearfix no-border">
                <span class="label1 col-xs-6 bold">&nbsp;</span>
                <span class="val1 col-xs-6 bold"> En İyi Fiyat Garantisi</span>
            </div>
            <br/>
            <div>
                New York Hilton Midtown tesisinde konaklamanız sırasında ödeme yapacaksınız<br/>
                %14,75 Vergi hariçtir.<br />
                Gecelik 3,50 US$ şehir vergisi hariçtir.<br />
                Önemli: İlave özellikler (ek yatak gibi) bu toplama eklenmemektedir.<br />
                Gösterilen toplam fiyat tesise ödeyeceğiniz miktardır. Booking.com hiçbir rezervasyon ücreti, idari veya başka herhangi bir ücret almaz.
            </div>
        </div>

        <div class="title4">Oda bilgileri </div>
        <p>
            Bu odada ücretsiz banyo malzemeleri ile donatılmış en-suite banyo ve düz ekran kablo TV vardır.
            Bu odaya ilave yatak konulamamaktadır. 
        </p>
        <div class="details-block">
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Konuk adı</span>
                <span class="val1 col-xs-9">metin koca Konuk ismini düzenle </span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Konuk sayısı</span>
                <span class="val1 col-xs-9">en fazla 4 kişi. Konuk sayısını düzenle</span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Öğün Planı</span>
                <span class="val1 col-xs-9">Bu oda için oda fiyatına dahil öğün bulunmamaktadır.</span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Ön ödeme</span>
                <span class="val1 col-xs-9">Teminat tahsil edilmeyecektir.</span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">İptal koşulları</span>
                <span class="val1 col-xs-9">
                    İptalin varış tarihinden 2 gün öncesine kadar yapılması durumunda ücret uygulanmaz. İptalin geç yapılması veya rezervasyonun kullanılmaması durumunda ilk gecenin yüzde 100 kadarı tahsil edilecektir.</br />
                    Tüm iptal ve değişiklik ücretleri tesis tarafından belirlenir.<br/>
                     Bütün ek ücretlerin ödemesini tesise yapacaksınız. 
                </span>
            </div>
            <div class="t-row clearfix no-border">
                <span class="label1 col-xs-3 bold">İptal ücreti</span>
                <span class="val1 col-xs-9">
                    26 Nisan 2015 23:59 [New York] öncesi: US$0<br/>
                    27 Nisan 2015 00:00 [New York] sonrası: US$319<br/>
                    <br/>
                    <a href="#">Rezervasyonunu iptal et</a> 
                </span>
            </div>
        </div>

        <div class="title4 bold">Önemli Bilgiler</div>
        <p>
            Havaalanı servisi sadece belirli saatlerde hizmet vermektedir. Bu hizmet ek ücrete tabi olabilir. Ayrıntılı bilgi için tesisle irtibata geçiniz.<br/>
            Check-in sırasında konukların fotoğraflı kimlik belgesi ve kredi kartı göstermesi gerekmektedir. Özel İsteklerin doluluk durumuna bağlı olduğunu ve ek ücrete tabi olabileceğini lütfen unutmayın.
        </p>
        <br/>
        <div class="title4 bold">Ödeme</div>
        <p>
            Rezervasyonunuzu kredi kartınız ile onayladınız ve garanti altına aldınız.<br/>
            Koşullar da aksi belirtilmediği sürece, tüm ödemeler konaklamanız sırasında tesise yapılmaktadır.<br/>
            Varışınızdan önce kredi kartınızdan ön-provizyon çekilebileceğini lütfen unutmayın.<br/>
            Bu konaklama tesisi şu ödeme biçimlerini kabul etmektedir:<br/>
            American Express, Visa, Euro/Mastercard, Diners Club, JCB, Discover
        </p>
        <br/>
        <div class="title4 bold">Rezervasyon koşulları </div>
        <div class="details-block">
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Konuk park yeri</span>
                <span class="val1 col-xs-9">Otelde (rezervasyon gerekli değildir) özel park yeri mevcuttur ve ücreti günlük 55 USD'dir.</span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">İnternet</span>
                <span class="val1 col-xs-9">Wi-fi ortak alanlarda mevcuttur ve ücretsizdir.</span>
            </div>
            <div class="t-row clearfix no-border">
                <span class="label1 col-xs-12 bold"><a href="#">Tüm rezervasyon koşullarını göster</a></span>
            </div>
        </div>
        <br />
        <div class="title4 bold">Rezervasyonunuzla ilgili desteğe mi ihtiyacınız var?</div>
        <div class="details-block">
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Tesisle iletişime geçin</span>
                <span class="val1 col-xs-9">Telefon: +12125867000</span>
            </div>
            <div class="t-row clearfix">
                <span class="label1 col-xs-3 bold">Rezervasyonunuzu yönetin</span>
                <span class="val1 col-xs-9 bold">
                    Dilediğiniz zaman çevrimiçi olarak rezervasyonunuzu görüntüleyebilir veya<br/>
                    <a href="#"> değişiklik yapabilirsiniz.<br /></a>
                    <br/>
                    <a href="#"> Müşteri hizmetlerine e-posta gönderin</a>
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
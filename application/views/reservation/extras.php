<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> Extras </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>">Yönetim</a></li>
          <li class="active">Extras</li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      <div class="row">
        <a href="<?php echo site_url('reservation/extras/add_new'); ?>" class="btn btn-info pull-right"> Yeni Ekle </a>
      </div>
    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
            <div id="extras"></div>
            </div>
          </div>
        </div>
      </div><!-- row -->

    </div><!-- contentpanel -->

<script src="<?php echo site_url('assets'); ?>/jtable/jquery.jtable.min.js"></script>
<link href="<?php echo site_url('assets'); ?>/jtable/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo site_url('assets'); ?>/jtable/themes/metro/blue/jtable.css" rel="stylesheet">


<script type="text/javascript">
 
    $(document).ready(function () {
    //Localization texts

          var turkishMessages = {
              serverCommunicationError: 'Sunucu ile iletişim kurulurken bir hata oluştu.',
              loadingMessage: 'Kayıtlar yükleniyor...',
              noDataAvailable: 'Hiç kayıt bulunmamaktadır!',
              addNewRecord: '+ Yeni kayıt ekle',
              editRecord: 'Kayıt düzenle',
              areYouSure: 'Emin misiniz?',
              deleteConfirmation: 'Bu odaya ait tüm veriler silinecektir. Emin misiniz?',
              save: 'Kaydet',
              saving: 'Kaydediyor',
              cancel: 'İptal',
              deleteText: 'Sil',
              deleting: 'Siliyor',
              error: 'Hata',
              close: 'Kapat',
              gotoPageLabel: 'Sayfaya Git',
              pageSizeChangeLabel: 'Satır Sayısı',
              cannotLoadOptionsFor: '{0} alanı için seçenekler yüklenemedi!',
              pagingInfo: 'Toplam {2}, {0} ile {1} arası gösteriliyor',
              canNotDeletedRecords: '{1} kayıttan {0} adedi silinemedi!',
              deleteProggress: '{1} kayıttan {0} adedi silindi, devam ediliyor...'
          };

        $('#extras').jtable({
            messages: turkishMessages, //Lozalize
            
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: false, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '<?php echo site_url("reservation_actions/list_extras"); ?>',
                deleteAction : '<?php echo site_url("reservation_actions/delete_extras"); ?>'
            },
            fields: {
                id: {
                    key: true,
                    create: false,
                    edit: false,
                    list: true,
                    width: '4%'
                },
                name: {
                    title: 'Hizmet Adı',
                    width: '23%'
                },
                price:{
                    title: 'Price',
                    width: '10%'
                },
                per:{
                    title: 'Per',
                    width: '12%',
                    display: function (data) {
                      if(data.record.id =='1'){
                        return $('<font color="black">Person</font>');
                      }else if(data.record.id =='2'){
                        return $('<font color="black">Unit</font>');
                      }else if(data.record.id =='3'){
                        return $('<font color="black">Day</font>');
                      }else if(data.record.id =='3'){
                        return $('<font color="black">Child</font>');
                      }
                      
                  }
                },
                status:{
                    title: 'Status',
                    width: '12%',
                    display: function (data) {
                      if(data.record.id =='0'){
                        return $('<font color="red">Passive</font>');
                      }else{
                        return $('<font color="green">Active</font>');
                      }
                      
                  }
                },
                detail:{
                  title: '',
                  width: '2%',
                  sorting: false,
                  display: function (data) {
                      return $('<a href="'+base_url+'reservation/extras/edit/' + data.record.id + '"><img  style="opacity:0.4; width:16px; height:16px; margin-bottom:3px; padding:0;" src="<?php echo site_url("assets/jtable/themes/metro/edit.png"); ?>" /></a>');
                  }
                }


            }
        });
        
        $('#extras').jtable('load');
    });
 
</script>

<?php $this->load->view('footer'); ?>
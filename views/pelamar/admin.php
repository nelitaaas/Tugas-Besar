<h1>Daftar Calon Karyawan</h1>

<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
));

 Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
            return false;
        });
          $('#kpelamar-t-form').submit(function(){
            $.fn.yiiGridView.update('kpelamar-t-grid', {
                    data: $(this).serialize()
            });
        return false;
    });
");


?>
</div><!-- search-form -->
<p>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-table-1">Tabel Calon Karyawan</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-panel-toolbar top clearfix">
                <ul>
                    <li><a class="mws-ic-16 ic-add" href="index.php?r=kepegawaian/pelamar/penerimaanKaryawan">Transaksi Penerimaan Calon Karyawan</a></li>
                </ul>
            </div>
        <div class="mws-table" style="overflow-y: scroll;">
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kpelamar-t-grid',
	'dataProvider'=>$model->searchPelamar(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'Tanggal Lowongan',
            'value'=>'isset($data->tgllowongan) ? $data->tgllowongan : ""',
        ),
//        array(
//            'header'=>'Departement',
//            'name'=>'departement_id',
//            'type'=>'raw',
//            'filter'=>CHtml::listData(DepartementM::model()->findAll(),'departement_id','departement_nama'),
//            'value'=>'isset($data->departement->departement_nama) ? $data->departement->departement_nama : ""',
//        ),
        'nama_pelamar',
        array(
            'header'=>'Jabatan',
            'name'=>'jabatan_id',
            'type'=>'raw',
            'value'=>'isset($data->jabatan->jabatan_nama) ? $data->jabatan->jabatan_nama : ""',
        ),
        'jeniskelamin',
        'alamat_pelamar',
        'noidentitas',
        'tempatlahir_pelamar',

        array(
            'header'=>'Tanggal Lahir Pelamar',
            'value'=>'$data->tgl_lahirpelamar',
        ),
        //'fileCV_Pelamar',
        array(
            'header'=>'Diterima ?',
            'type'=>'raw',
            'value'=> 'CHtml::imagebutton("'.Yii::app()->request->baseUrl.'/css/icons/32/accept.png",array("onclick"=>"location.href=\'index.php?r=kepegawaian/pelamar/updateCalonKaryawan/id/$data->pelamar_id\'"));'
//                                    'value'=> 'CHtml::linkButton(\'update\', array(\'style\'=>\'width:40px;\',\'onclick\'=>\'dialogUpdate()\'))',
        ),
	),
)); ?>
      </div><br>

        <div class="mws-button-row" align="right">
            <?php 
          echo CHtml::htmlButton(Yii::t('mds','{icon} PDF',array('{icon}'=>'<i class="icon-book icon-white"></i>')),array('class'=>'mws-button blue', 'type'=>'button','onclick'=>'print(\'PDF\')'))."&nbsp&nbsp"; 
           //echo CHtml::htmlButton(Yii::t('mds','{icon} Excel',array('{icon}'=>'<i class="icon-pdf icon-white"></i>')),array('class'=>'mws-button green', 'type'=>'button','onclick'=>'print(\'EXCEL\')'))."&nbsp&nbsp"; 
          //echo CHtml::htmlButton(Yii::t('mds','{icon} Print',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button orange', 'type'=>'button','onclick'=>'print(\'PRINT\')'))."&nbsp&nbsp";
            ?>
        </div><br>
     </div>
    </div>
<?php
        /*Untuk Kebutuhan Print*/
        $controller = Yii::app()->controller->id; //mengambil Controller yang sedang dipakai
        $module = Yii::app()->controller->module->id; //mengambil Module yang sedang dipakai
        $urlPrint=  Yii::app()->createAbsoluteUrl($module.'/'.$controller.'/print');
        $urlUpdate = Yii::app()->createUrl($module.'/'.$controller.'/ajaxUpdate');
        
        /*Dialog untuk update List Pelamar*/
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                            'id'=>'confirm',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                'title'=>'',
                                'autoOpen'=>false,
                                'show'=>'blind',
                                'hide'=>'explode',
                                'minWidth'=>330,
                                'minHeight'=>100,
                                'resizable'=>false,
                                'modal'=>true,    
                                 ),
                            ));
//                            echo '<center>Apakah Anda Yakin Akan Membatalkan Pemeriksaan Pasien Ini?<br><br>' ;
                            echo CHtml::hiddenField('pelamar_id');
                            echo "<table><tr><td><div >".CHtml::label('Tgl Diterima', 'tglditerima')."</td>";
                            echo "<td><div class=\'dialog\'>".CHtml::textField('tglditerima', '', array('size'=>20))."</div></div></td>";
                            echo "<tr><td><div >".CHtml::label('Tgl Mulai Bekerja', 'tglmulaibekerja')."</td>";
                            echo "<td><div class=\'dialog\'>".CHtml::textField('tglmulaibekerja', '', array('size'=>20))."</div></div></td></tr></table>";
                            
//                            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
//                                                                            'name'=>'tglmulaibekerja',
//                                                                            'language'=>'id',
//                                                                            'value'=>date('Y-m-d').' 00:00:00',
//                                                                            'mode'=>'date', //use "time","date" or "datetime" (default)
//                                                                            'options'=>array(
//                                                                            'dateFormat'=>'yy-mm-dd',
//                                                                            'changeYear'=>true,
//                                                                            'changeMonth'=>true,
//                                                                            'yearRange'=>'-10y:+2y',
//                                                                            'maxDate'=>'d',
//                                                                            'showAnim'=>'fold',
//                                                                            'timeText'=>'Waktu',
//                                                                            'hourText'=>'Jam',
//                                                                            'minuteText'=>'Menit',
//                                                                            'secondText'=>'Detik',
//                                                                            'showSecond'=>true,
//                                                                            'timeFormat'=>'hh:mms',
//
////                                                                           'showOn'=>'button',
////                                                                           'buttonImage'=> Yii::app()->request->baseUrl."/css/images/calendar.gif",
//                                                                            'buttonImageOnly'=>true,
//                                                                            ),
//                                                                            'htmlOptions'=>array(
////                                                                            'readonly'=>true,
//
//                                                                            ),
//                                                                            )); 
                            echo '<div class="mws-button-row" >';
                            echo CHtml::htmlButton(Yii::t('mds','{icon} Ubah',array('{icon}'=>'<i class="icon-book icon-white"></i>')),array('class'=>'mws-button blue', 'type'=>'button','onclick'=>'ubahStatus(tglditerima, tglmulaibekerja, pelamar_id);return false;'))."&nbsp&nbsp"; 
                            echo CHtml::htmlButton(Yii::t('mds','{icon} Batal',array('{icon}'=>'<i class="icon-pdf icon-white"></i>')),array('class'=>'mws-button green', 'type'=>'button','onclick'=>'$(\'#confirm\').dialog(\'close\');'))."&nbsp&nbsp"; 
                            echo '</div>';
        $this->endWidget('zii.widgets.jui.CJuiDialog');   
        
        
     /*akhir Dialog*/   
        
// register Javascript        
$js = <<< JSCRIPT
function ubahStatus(tgldtrima, tglmb, pelid)
                {
                    $.post("${urlUpdate}", { tglditerima:tgldtrima.value,tglmulaibekerja:tglmb.value, pelamar_id:pelid.value},
                                 function(data){
                                 if(data['status']){
                                    alert('data berhasil diupdate! ');
                                   // $('#confirm').dialog('close');
                                    location.reload();
                                 }else{
                                    alert('data tidak berhasil diupdate!');
                                }
                                }, "json");
}
     
function print(caraPrint)
{
    window.open("${urlPrint}/"+$('#kpelamar-t-form').serialize()+"&caraPrint="+caraPrint,"",'location=_new, width=900px');
}
JSCRIPT;
Yii::app()->clientScript->registerScript('print',$js,CClientScript::POS_HEAD);                        
?>
         
<script type="text/javascript">
	$('#clickme').click(function() {
        $('#ptjk').toggle('fast');
    });
    function dialogUpdate(pelid){
        $('#pelamar_id').val(pelid);
        $('#confirm').dialog('open');   
    } 
                 
   
</script>


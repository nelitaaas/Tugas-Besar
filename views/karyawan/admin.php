<h1>Daftar Karyawan</h1>

<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
));

Yii::app()->clientScript->registerScript('search', "
                $('.search-button').click(function(){
                $('.search-form').toggle();
                return false;
                });
                $('#kkaryawan-m-form').submit(function(){
                $.fn.yiiGridView.update('kkaryawan-m-grid', {
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
        <span class="mws-i-24 i-table-1">Tabel  Karyawan</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-panel-toolbar top clearfix">
            <ul>
                <li><a class="mws-ic-16 ic-add" href="index.php?r=kepegawaian/karyawan/create">Transaksi Karyawan</a></li>
            </ul>
        </div>
        <div class="mws-table" style ="overflow-y: scroll;">
<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kkaryawan-m-grid',
	'dataProvider'=>$model->search(),
        'filter'=>$model,
	'columns'=>array(
//                                'tglditerima',
//                                array(
//                                    'header'=>'Departement',
//                                    'name'=>'departement_id',
//                                    'type'=>'raw',
//                                    'filter'=>CHtml::listData(DepartementM::model()->findAll(),'departement_id','departement_nama'),
//                                    'value'=>'$data->departement->departement_nama',
//                                ),    
//                                'nomorindukkaryawan',      
                                'nama_karyawan',
                               // array(
                                  //  'header'=>'Jabatan',
                                    //'name'=>'jabatan_id',
                                   // 'type'=>'raw',
                                   // 'value'=>'$data->jabatan->jabatan_nama',
                               // ),
                                'jeniskelamin',    
                                'alamat_karyawan',
                                'tempatlahir_karyawan',
                                'tgllahir_karyawan',
//                        array(
//                            'name'=>'no_fingerprint',
//                            'type'=>'raw',
////                            'htmlOptions'=>array('ondblclick'=>'setFinger(this);'),
//                            'value'=>'(empty($data->no_fingerprint)) ? CHtml::link(\'<icon class="mws-ic-16 ic-application-side-boxes icon-mws16"></icon>\', Yii::app()->createUrl($this->grid->owner->module->id.\'/\'.$this->grid->owner->id.\'/finger&id=\'.$data->karyawan_id), array(\'onclick\'=>\'setFinger(this);return false;\', \'class\'=>\'parentFinger\')) : $data->no_fingerprint',
//                        ),
                                
//                                 array(
//                                    'header'=>'file CV',
//                                    'name'=>'pelamar_id',
//                                    'type'=>'raw',
//                                    'value'=>'$data->pelamar->fileCV_Pelamar',

//		array(
//                                    'header'=>'Lihat',
//       		    'class'=>'CButtonColumn',                                  
//                                    'template'=>'{view}',  
//                                ),
                               array(
                                    'header'=>'Ubah',
       		    'class'=>'CButtonColumn',                                  
                                    'template'=>'{update}',  
                                ),
                                array(
                                    'header'=>'Kelola',
                                    'type'=>'raw',
                                    'value'=> 'CHtml::imagebutton("'.Yii::app()->request->baseUrl.'/css/icons/32/accept.png",array("onclick"=>"location.href=\'index.php?r=kepegawaian/kelolaKaryawan/index/id/$data->karyawan_id\'"));'
                                ),
                                array(
                                    'header'=>'Berhenti ?',
                                    'type'=>'raw',
                                    'value'=> 'CHtml::imagebutton("'.Yii::app()->request->baseUrl.'/css/icons/32/stop-icone.png",array("onclick"=>"addkaryawan($data->karyawan_id);opendialog();"));'
                                    
                                ),
//                               array(
//                                    'header'=>'Lihat Riwayat',
//       		    'class'=>'CButtonColumn',                                  
//                                    'template'=>'{view}',  
//                                ),
	),
)); ?>
              </div><br><br>
                  <div class="mws-button-row" align="right">
                    <?php 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} PDF',array('{icon}'=>'<i class="icon-book icon-white"></i>')),array('class'=>'mws-button blue', 'type'=>'button','onclick'=>'print(\'PDF\')'))."&nbsp&nbsp"; 
                    //echo CHtml::htmlButton(Yii::t('mds','{icon} Excel',array('{icon}'=>'<i class="icon-pdf icon-white"></i>')),array('class'=>'mws-button green', 'type'=>'button','onclick'=>'print(\'EXCEL\')'))."&nbsp&nbsp"; 
                    //echo CHtml::htmlButton(Yii::t('mds','{icon} Print',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button orange', 'type'=>'button','onclick'=>'print(\'PRINT\')'))."&nbsp&nbsp";
                 //   echo CHtml::htmlButton(Yii::t('mds','{icon} Petunjuk',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button yellow', 'type'=>'button','id'=>'clickme'))."&nbsp&nbsp";
                    ?>
                </div><br/>
                <!-- <div id ="ptjk" class="mws-form-message info" style="display: none;">
                    <p>
                    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
                    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
                    </p>
                </div> -->
         </div>
    </div>
<?php
        $controller = Yii::app()->controller->id; //mengambil Controller yang sedang dipakai
        $module = Yii::app()->controller->module->id; //mengambil Module yang sedang dipakai
        $urlPrint=  Yii::app()->createAbsoluteUrl($module.'/'.$controller.'/print');

$js = <<< JSCRIPT
function print(caraPrint)
{
    window.open("${urlPrint}/"+$('#kkomponengaji-m-grid').serialize()+"&caraPrint="+caraPrint,"",'location=_new, width=900px');
}
JSCRIPT;
Yii::app()->clientScript->registerScript('print',$js,CClientScript::POS_HEAD);                        
?>

<script type="text/javascript">
	$('#clickme').click(function() {
                    $('#ptjk').toggle('fast');
                });
</script>

<?php

Yii::app()->clientScript->registerScript('jsKaryawanss','
    function setFinger(obj){
        data = $(obj).text();
        url = $(obj).attr("href");
        $(obj).parents("td").append("<input type=\'text\' value=\'"+data+"\' onblur=\"setData(this);\" data-src=\'"+url+"\' class=\"mws-textinput span1 numbersOnly focusing\">");
        $(obj).hide();
        $(".focusing").focus();
    }
    
    function setData(obj){
        data = $(obj).val();
        url = $(obj).attr("data-src");
        $(obj).parents("td").append("<div class=\"grid-view-loading\" id=\"loading-ajax\" style=\"padding:10px;\"></div>");
        $(obj).hide();
        $.post(url,{data:data},function(hasil){
            $("#loading-ajax").remove();
            if (hasil == 1){
                $(obj).parents("td").html(data);
            }
            else{
                $(obj).parents("td").find(".parentFinger").show();
                if (hasil != "Kosong"){
                    alert(hasil);
                }
                
            }
            $(obj).remove();
        });
        
        
    }
', CClientScript::POS_HEAD);

/* DIALOG SCRIPT*/

Yii::app()->clientScript->registerScript('jsKaryawan',$js, CClientScript::POS_HEAD);

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'karyawan-berhenti-d',
    'options'=>array(
        'title'=>'Karyawan Berhenti ?',
        'autoOpen'=>false,
        'width'=>930,
        'height'=>530,
        'modal'=>'true',
        'hide'=>'explode',
        'resizelable'=>false,
    ),
)); ?>

<div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'kkaryawanberhenti-form',
                        'enableAjaxValidation'=>false,
                    
                )); ?>
                <?php echo $form->errorSummary(array($model,$modelkb)); ?>
    <div id="d-kberhenti-form">
       <div class="mws-form-inline"> 
                      <fieldset><legend>Data Karyawan</legend>
                        <div id ="status">
                        </div>
                       <table>
                           <tr>
                               <td > 
                                   <?php //echo $form->hiddenField($model,'karyawanberhenti_id');?>
<!--                            <div class="mws-form-row">
                                <?php CHtml::hiddenField('karyawan_id'); ?>
                                    <?php //echo $form->labelEx($model,'nomorindukkaryawan'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'nomorindukkaryawan',array('size'=>25,'maxlength'=>50,'readonly'=>true,'style'=>'width:160px;')); ?>
                                      </div>
                            </div>       -->
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nama_karyawan'); ?>
                                      <div class="mws-form-item ">                                           
                                                        <?php $form->textField($model,'gelardepan',array('empty'=>'','style'=>'width:60px;','readonly'=>true)); ?>
                                                        <?php echo $form->textField($model,'nama_karyawan',array('maxlength'=>100,'style'=>'width:160px;','readonly'=>true)); ?> 
                                                        <?php $form->textField($model,'gelarbelakang',array('empty'=>'','style'=>'width:60px;','readonly'=>true)); ?>    
                                      </div>
                            </div>
                           
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jeniskelamin'); ?>
                                 <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'jeniskelamin',array('empty'=>'','style'=>'width:160px;','readonly'=>true)); ?>    
                                      </div>
                            </div>
                           
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'statusperkawinan'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'statusperkawinan',array('style'=>'width:160px;','readonly'=>true)); ?>
                                      </div>
                            </div> 
                                   
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'agama'); ?>
                                 <div class="mws-form-item ">                                            <?php echo $form->textField($model,'agama',array('style'=>'width:160px;','readonly'=>true)); ?>
                                      </div>
                            </div>
                                   </td><td>
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tempatlahir_karyawan'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'tempatlahir_karyawan',array('style'=>'width:160px;','readonly'=>true)); ?>
                                      </div>
                            </div>
                             
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tgllahir_karyawan'); ?>
                                     <div class="mws-form-item ">                                           <?php echo $form->textField($model,'tgllahir_karyawan',array('style'=>'width:160px;','readonly'=>true)); ?>
                                      </div>
                            </div>           
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nomobile_karyawan'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'nomobile_karyawan',array('style'=>'width:160px;','readonly'=>true)); ?>
                                      </div>
                            </div>
                                   
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'notelp_karyawan'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'notelp_karyawan',array('style'=>'width:160px;','readonly'=>true)); ?>
                                      </div>
                            </div>
                             </td>
                        </tr>
                    </table>
                  </fieldset>                 
               <fieldset>
                   <legend>Status Berhenti</legend>
                   <table>
                       <tr>
                           <td>
                    <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkb,'statusberhenti_id'); ?>
                        <div class="mws-form-item ">                                            <?php echo $form->dropDownList($modelkb,'statusberhenti_id',  CHtml::listData(KStatusberhentiM::model()->findAll(), 'statusberhenti_id', 'statusberhenti_nama'),array('style'=>'width:160px;')); ?>
                                      </div>
                            </div>
                                       
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkb,'tglberhenti'); ?>
                                     <div class="mws-form-item ">                                          <?php  $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                                                            'model'=>$modelkb,
                                                                            'attribute'=>'tglberhenti',
                                                                            'language'=>'',
                                                                            'mode'=>'date', //use "time","date" or "datetime" (default)
                                                                            'options'=>array(
                                                                            'dateFormat'=>'dd-M-yy',
                                                                            'changeYear'=>true,
                                                                            'changeMonth'=>true,
                                                                            'yearRange'=>'-10y:+2y',
                                                                            'maxDate'=>'d',
                                                                            'showAnim'=>'fold',
                                                                            'timeText'=>'Waktu',
                                                                            'hourText'=>'Jam',
                                                                            'minuteText'=>'Menit',
                                                                            'secondText'=>'Detik',
                                                                            'showSecond'=>true,
                                                                            'timeFormat'=>'hh:mm:ss',

                                                                            'showOn'=>'button',
                                                                            'buttonImage'=> Yii::app()->baseUrl."/css/icons/32/calendar.png",
                                                                            'buttonImageOnly'=>true,
                                                                            ),
                                                                            'htmlOptions'=>array(
//                                                                                    'readonly'=>true,
                                                                                    'style'=>'width:160px;'
                                                                            ),
                                                                            )); ?>
                                      </div>
                            </div>    
                            </td><td>
                                <div class="mws-form-row">
                                            <?php echo $form->labelEx($modelkb,'keterangan_berhenti'); ?>
                                             <div class="mws-form-item ">                                            <?php echo $form->textArea($modelkb,'keterangan_berhenti',array('style'=>'width:160px;','col'=>'6','row'=>'4')); ?>
                                              </div>
                                </div>
                               </td>
                           </tr>
                     </table>          
               </fieldset>
                <div class="mws-button-row">
                        <?php
                             echo CHtml::button($modelkb->isNewRecord ? 'Create' : 'Create', array('id'=>'savekberhenti','onclick'=>'addkaryawanform('.$model->karyawan_id.')','class' => 'mws-button blue'));
                             echo "  ";
                             echo CHtml::ResetButton($modelkb->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green'));
                         ?>
						 
                </div>  
    </div>
    </div>
	
 <?php $this->endWidget(); ?> 
  
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>

 <?php
 
        $controller = Yii::app()->controller->id; //mengambil Controller yang sedang dipakai
        $module = Yii::app()->controller->module->id; //mengambil Module yang sedang dipakai
        $urlPrint=  Yii::app()->createAbsoluteUrl($module.'/'.$controller.'/print');
        $urlberhenti =  Yii::app()->createAbsoluteUrl($module.'/'.$controller.'/ajaxKaryawanBerhenti');
        $urladdkaryawan = Yii::app()->createAbsoluteUrl($module.'/'.$controller.'/ajaxAddKaryawanBerhenti');
        
 /*FUNCTION SCRIPT*/
        
$js = <<< JSCRIPT
function print(caraPrint)
{
    window.open("${urlPrint}/"+$('#sakelompokmenu-k-grid').serialize()+"&caraPrint="+caraPrint,"",'location=_new, width=900px');
}

function opendialog(){
    $('#karyawan-berhenti-d').dialog('open');
}
 
function save(){
    $.post("${urlberhenti}", $('#kkaryawanberhenti-form-d').serialize(),
        function(data){
            $('#status').html(data.status);
    }, "json");
    
}

    
function addkaryawan(id){
    
     $.post("${urladdkaryawan}",{ karyawan_id: id},
        function(data){

             if (data.status == 'form')
            {
                     $('#karyawan-berhenti-d #karyawan_id').val(data.datas[0].karyawan_id);
                     $('#karyawan-berhenti-d #KKaryawanM_nomorindukkaryawan').val(data.datas[0].nomorindukkaryawan);
                     $('#karyawan-berhenti-d #KKaryawanM_gelardepan').val(data.datas[0].gelardepan);
                     $('#karyawan-berhenti-d #KKaryawanM_nama_karyawan').val(data.datas[0].nama_karyawan);
                     $('#karyawan-berhenti-d #KKaryawanM_gelarbelakang').val(data.datas[0].gelarbelakang);
                     $('#karyawan-berhenti-d #KKaryawanM_jeniskelamin').val(data.datas[0].jeniskelamin);
                     $('#karyawan-berhenti-d #KKaryawanM_statusperkawinan').val(data.datas[0].statusperkawinan);
                     $('#karyawan-berhenti-d #KKaryawanM_agama').val(data.datas[0].agama);
                     $('#karyawan-berhenti-d #KKaryawanM_tempatlahir_karyawan').val(data.datas[0].tempatlahir_karyawan);
                     $('#karyawan-berhenti-d #KKaryawanM_tgllahir_karyawan').val(data.datas[0].tgllahir_karyawan);
                     $('#karyawan-berhenti-d #KKaryawanM_nomobile_karyawan').val(data.datas[0].nomobile_karyawan);
                     $('#karyawan-berhenti-d #KKaryawanM_notelp_karyawan').val(data.datas[0].notelp_karyawan);
                    
            }
    }, "json");
    
}

function addkaryawanform(id){
    if ($("#KKaryawanberhentiR_keterangan_berhenti").val() == ''){
     alert("Keterangan Berhenti Harus Diisi");
     $("#KKaryawanberhentiR_keterangan_berhenti").addClass('error');
     return false;
     }
    if ($("#KKaryawanberhentiR_tglberhenti").val() == ''){
     alert("Tanggal Berhenti Harus Diisi");
     $("#KKaryawanberhentiR_tglberhenti").addClass('error');
     return false;
     }
     $.post("${urladdkaryawan}",$('#kkaryawanberhenti-form').serialize(),
        function(data){
                    $('#d-kberhenti-form').html(data.div);
        }, "json");
    
}
     

   
   
JSCRIPT;
Yii::app()->clientScript->registerScript('karyawanberhentipopup',$js,CClientScript::POS_HEAD);                        
?>
<script type="text/javascript">
	$('#clickme').click(function() {
                    $('#ptjk').toggle('fast');
                });
</script>
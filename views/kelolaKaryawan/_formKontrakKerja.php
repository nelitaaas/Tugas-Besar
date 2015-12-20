<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');?>
<div style="width:100%">
<?php 

//$this->renderPartial('_formDataKaryawan',array(
 //              'model'=>$model,
//)); 

?>
<?php
    if(isset($_POST["PDF"]))
    {
        echo "<script>
                    window.open();
                </script>";
    }
?>
<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'sakontrakkaryawan-r-form',
                        'enableAjaxValidation'=>false,
                        'clientOptions'=>array('validateOnSubmit'=>true), //enable event client  ajax validation on submit
                        'htmlOptions'=>array('onKeyPress'=>"return disableKeyPress(event)"),
                )); ?>
                <?php  if(Yii::app()->user->hasFlash('status')): ?>
 
                    <div class="flash-success" style="background: #9adf8f;">
                        <br/>
                    <?php echo Yii::app()->user->getFlash('status'); ?>
                    </div>

                <?php endif; ?>
<!--	<div class="mws-form-message info">Fields with <span class="required">*</span> are required.</div>-->
                 <?php
                    if ($form->errorSummary($modelkk)) {
                    echo '<div class="mws-form-message error">' . $form->errorSummary($modelkk) . '</div>';
                    }
                ?>        
                <div class="mws-form-inline">   
                    <table>
                        <tr>
                            <td>
                                    
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modelkk,'karyawan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($modelkk,'karyawan_id'); ?>
                                      </div>
                            </div>-->
                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modelkk,'jenissurat_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php // echo $form->hiddenField($modeljs,'jenissurat_id',array('maxlength'=>50,'style'=>'width:200;','onKeyPress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkk,'jenissurat_nama'); ?>
                                <div class="mws-form-item ">
                                    <?php echo CHtml::hiddenField('a','0'); ?>
                                    <?php echo $form->dropDownList($modeljs,'jenissurat_id', CHtml::listData(KJenissuratM::model()->findAll(), 'jenissurat_id', 'jenissurat_nama'),array('style'=>'width:130;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkk,'jenissurat_judul'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modeljs,'jenissurat_judul',array('maxlength'=>50,'style'=>'width:200;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                
                            <div class="mws-form-row">
                                    <?php echo CHtml::hiddenField('karyawan_id',$model->karyawan_id);?>
                                    <?php echo $form->labelEx($modelkk,'jabatan_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelkk,'jabatan_id', CHtml::listData(KJabatanM::model()->findAll(), 'jabatan_id', 'jabatan_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkk,'subdepartement_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelkk,'subdepartement_id', CHtml::listData(KSubdepartementM::model()->findAll(), 'subdepartement_id', 'subdepartement_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkk,'departement_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelkk,'departement_id', CHtml::listData(KDepartementM::model()->findAll(), 'departement_id', 'departement_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkk,'nosuratkontrak'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelkk,'nosuratkontrak',array('maxlength'=>50,'style'=>'width:200;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkk,'tglkontrak'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modelkk,
                                        'attribute'=>'tglkontrak',
                                        'language'=>'',
                                        'mode'=>'date', //use "time","date" or "datetime" (default)
                                        'options'=>array(
                                        'dateFormat'=>'dd-M-yy',
                                        'changeYear' => true,
                                        'changeMonth' => true,
                                        'yearRange' => '-70y:+4y',
                                        'showSecond' => false,
                                        'showDate' => false,
                                        'showMonth' => false,
                                        'timeFormat' => 'hh:mm:ss',

                                        'showOn'=>'button',
                                        'buttonImage'=> Yii::app()->baseUrl."/css/icons/32/calendar.png",
                                        'buttonImageOnly'=>true,
                                        ),
                                        'htmlOptions'=>array(
                                        'class'=>'isRequired',
                                        'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
                                        ),
                                        ));?>
                                      </div>
                            </div> 
                               
                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modelkk,'nourutkontrak'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->hiddenField($modelkk,'nourutkontrak',array('onKeyUp'=>'checkInput(this);','style'=>'width:100;')); ?>
                                      </div>
                            </div>
                              
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkk,'tglmulaikontrak'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modelkk,
                                        'attribute'=>'tglmulaikontrak',
                                        'language'=>'',
                                        'mode'=>'date', //use "time","date" or "datetime" (default)
                                        'options'=>array(
                                        'dateFormat'=>'dd-M-yy',
                                        'changeYear' => true,
                                        'changeMonth' => true,
                                        'yearRange' => '-70y:+4y',
                                        'showSecond' => false,
                                        'showDate' => false,
                                        'showMonth' => false,
                                        'timeFormat' => 'hh:mm:ss',

                                        'showOn'=>'button',
                                        'buttonImage'=> Yii::app()->baseUrl."/css/icons/32/calendar.png",
                                        'buttonImageOnly'=>true,
                                        ),
                                        'htmlOptions'=>array(
                                        'class'=>'isRequired',
                                        'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
                                        ),
                                        ));?>
                                      </div>
                            </div>
                             </td><td>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkk,'tglakhirkontrak'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modelkk,
                                        'attribute'=>'tglakhirkontrak',
                                        'language'=>'',
                                        'mode'=>'date', //use "time","date" or "datetime" (default)
                                        'options'=>array(
                                        'dateFormat'=>'dd-M-yy',
                                        'changeYear' => true,
                                        'changeMonth' => true,
                                        'yearRange' => '-70y:+4y',
                                        'showSecond' => false,
                                        'showDate' => false,
                                        'showMonth' => false,
                                        'timeFormat' => 'hh:mm:ss',

                                        'showOn'=>'button',
                                        'buttonImage'=> Yii::app()->baseUrl."/css/icons/32/calendar.png",
                                        'buttonImageOnly'=>true,
                                        ),
                                        'htmlOptions'=>array(
                                        'class'=>'isRequired',
                                        'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
                                        ),
                                        ));?>
                                      </div>
                            </div> 
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkk,'lamakontrak'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelkk,'lamakontrak',array('onKeyUp'=>'checkInput(this);','maxlength'=>30,'style'=>'width:100;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?> Tahun
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkk,'keterangankontrak'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($modelkk,'keterangankontrak',array('rows'=>6, 'cols'=>50,'style'=>'width:180;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php 
                                    echo $form->labelEx($modelkk,'mengetahui'); ?>                    
                                <div class="mws-form-item ">                                            
                                    <?php //$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        //'name'=>'mengetahui',
                                           //'source'=>$this->createUrl('FindKaryawan'),//array('ac1', 'ac2', 'ac3'),
                                    // ));
                                     /*$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'model' => $modelkk,
                                        'name'=>'mengetahui',
                                        'sourceUrl' => Yii::app()->createUrl('ActionAutoComplete/Karyawan'),
                                        'options' => array(
                                            'showAnim' => 'fold',
                                            'minLength' => 2,
                                            'focus'=> 'js:function( event, ui ) {
                                                                            $(this).val( ui.item.label);
                                                                            return false;
                                                                        }',
                                            'select' => 'js:function( event, ui ) {
                                                                                  $("#idKaryawan").val(ui.item.karyawan_id);
                                                                                  $(this).val( ui.item.label);

                                                                        }',
                                        ),
                                        'htmlOptions' => array('onkeypress' => "return $(this).focusNextInputField(event)",
                                            'class' => 'span3 numbersOnly isRequired',

                                        ),
                                    ));*/
                                    //echo $form->dropDownList($model,'nama_karyawan', CHtml::listData(KKaryawanM::model()->findAll(), 'nama_karyawan', 'nama_karyawan'),array('name'=>'mengetahui','style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); 
                                    $this->widget('MyJuiAutoComplete', array(
                                            'model' => $modelkk,
                                            'name'=>'mengetahui',
                                            'sourceUrl' => Yii::app()->createUrl('ActionAutoComplete/Karyawan'),
                                            'options' => array(
                                                'showAnim' => 'fold',
                                                'minLength' => 2,
                                                'focus' => 'js:function( event, ui ) {
                                                                                $(this).val( ui.item.label);
                                                                                return false;
                                                                            }',
                                                'select' => 'js:function( event, ui ) {
                                                                                      $("#idKaryawan").val(ui.item.karyawan_id);

                                                                                      return false;
                                                                            }',
                                            ),
                                            'htmlOptions' => array(
                                                'class' => 'span3',
                                                'onkeypress'=>"return $(this).focusNextInputField(event);",
                                            ),
                                            'tombolDialog' => array('idDialog' => 'dialogKaryawan'),
                                        ));
                                    ?>
                                  
                                  <?php
//                                        echo CHtml::htmlButton('Cari', array('onclick' => '$("#dialogKaryawan").dialog("open");return false;',
//                                            'class' => 'btn btn-primary',
//                                            'onkeypress' => "return $(this).focusNextInputField(event)",
//                                            'rel' => "tooltip",
//                                            'title' => "Klik Untuk Pencarian Karyawan Lebih Lanjut",
//                                            'id' => 'buttonPemilihanKaryawan',
//                                            'readonly'=>true,
//                                        ));
                                        ?>                                                              
                                     </td>
                   </tr>
               </table>
                 <div class="mws-button-row">
                    <?php echo CHtml::ajaxSubmitButton($modelkk->isNewRecord ? 'Create' : 'Create', '', array('replace'=>'#formTab .mws-panel-body'), array('class' => 'mws-button blue','type'=>'submit','onKeyPress'=>'return formSubmit(this,event)'));?>
                   <?php echo CHtml::ResetButton($modelkk->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green'))."<br><br>"; ?>
                    
                <?php $this->endWidget(); ?>
                    <?php 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} PDF',array('{icon}'=>'<i class="icon-book icon-white"></i>')),array('class'=>'mws-button blue', 'type'=>'button','onclick'=>'print(\'PDF\')'))."&nbsp&nbsp"; 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} Excel',array('{icon}'=>'<i class="icon-pdf icon-white"></i>')),array('class'=>'mws-button green', 'type'=>'button','onclick'=>'print(\'EXCEL\')'))."&nbsp&nbsp"; 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} Print',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button orange', 'type'=>'button','onclick'=>'print(\'PRINT\')'))."&nbsp&nbsp";
                   ?>

                </div>   

            </div>
        </div>    	
    </div><!-- form -->
<?php
        $controller = Yii::app()->controller->id; //mengambil Controller yang sedang dipakai
        $module = Yii::app()->controller->module->id; //mengambil Module yang sedang dipakai
        $urlPrint=  Yii::app()->createAbsoluteUrl($module.'/'.$controller.'/Printkontrakkerja');

$js = <<< JSCRIPT
function print(caraPrint)
{
    window.open(" ${urlPrint}/" +$('#sakontrakkaryawan-r-form').serialize() +"&id=$model->karyawan_id&caraPrint=" +caraPrint, " ",'location=_new, width=900px');
}
JSCRIPT;
Yii::app()->clientScript->registerScript('print',$js,CClientScript::POS_HEAD);                        
?>

<script type="text/javascript">
	$('#clickme').click(function() {
                    $('#ptjk').toggle('fast');
                });
</script>
    <script>
    function submitKaryawan()
{
    idKaryawan = $('#idKaryawan').val();
    if(idKaryawan==''){
        alert('Silahkan Pilih Nama KaryawanTerlebih Dahulu');
    }else{
        $.post("${urlGetKaryawan}", { idKaryawan: idKaryawan},
        function(data){
            $('#tableKaryawan').append(data.tr);
            $('#${karyawan}').val('');

        }, "json");
    }   
}
</script>
<?php
    //========= Dialog buat cari data Karyawan =========================
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(// the dialog
        'id' => 'dialogKaryawan',
        'options' => array(
            'title' => 'Pencarian Karyawan',
            'autoOpen' => false,
            'modal' => true,
            'width' => '900',
            'height' => '600',
            'resizable' => false,
        ),
    ));
?>
<div class="mws-table">
<?php
    $modKaryawan = new KaryawanM('search');
    $modKaryawan->unsetAttributes();
    if (isset($_GET['KaryawanM'])) {
        $modKaryawan->attributes = $_GET['KaryawanM'];
    }
    
    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'sakaryawan-m-grid',
    //'ajaxUrl'=>Yii::app()->createUrl('actionAjax/CariDataPasien'),
    'dataProvider' => $modKaryawan->search(),
    'filter' => $modKaryawan,
    'template' => "{pager}{summary}\n{items}",
    'columns' => array(
        array(
            'header' => 'Pilih',
            'type' => 'raw',
            'value' => 'CHtml::Link("<i class=\"mws-ic-16 ic-spellcheck\"></i>",\'\',array("class"=>"btn-small", 
                                            "id" => "selectKaryawan",
                                            "onClick" => "$(\"#mengetahui\").val(\"$data->nama_karyawan\");
                                                          $(\"#\").val(\"$data->nama_karyawan\");
                                                          $(\"#dialogKaryawan\").dialog(\"close\");    
                                                "))',
        ),
        array(
                'header'=>'Nomor Induk Karyawan',
                'name'=>'nomorindukkaryawan',
                'type'=>'raw',
                'value'=>'$data->nomorindukkaryawan',
       ),
        array('header'=>'Nama Karyawan',
                'name'=>'nama_karyawan',
                'type'=>'raw',
                'value'=>'$data->nama_karyawan',
       ),
    ),
    'afterAjaxUpdate' => 'function(id, data){jQuery(\'' . Params::TOOLTIP_SELECTOR . '\').tooltip({"placement":"' . Params::TOOLTIP_PLACEMENT . '"});}',
));
    $this->endWidget();
?>
</div>
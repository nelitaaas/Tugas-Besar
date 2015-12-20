<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');?>
<div style="width:100%">
<?php 
    $this->renderPartial('_formDataKaryawan',array(
                    'model'=>$model,
    )); 
?>
<?php
    if(isset($_POST["PDF"]))
    {
        echo "<script>
                    window.open();
                </script>";
    }
?>
</div>
<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'samutasi-r-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions'=>array('onKeyPress'=>'return disableKeyPress(event)'),
                )); ?>
                <?php  if(Yii::app()->user->hasFlash('status')): ?>
 
                    <div class="flash-success" style="background: #9adf8f;">
                        <br/>
                    <?php echo Yii::app()->user->getFlash('status'); ?>
                    </div>

                <?php endif; ?>
<!--	<div class="mws-form-message info">Fields with <span class="required">*</span> are required.</div>-->
                 <?php
                    if ($form->errorSummary($modelm)) {
                    echo '<div class="mws-form-message error">' . $form->errorSummary($modelm) . '</div>';
                    }
                 ?>        
                <div class="mws-form-inline">   
                    <table>
                             <tr>
                                 <td>
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modelm,'karyawan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($modelm,'karyawan_id',array('style'=>'width:220px;')); ?>
                                      </div>
                            </div>-->
                             <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modelm,'jenissurat_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($modeljs,'jenissurat_id',array('maxlength'=>100,'style'=>'width:250px;')); ?>
                                      </div>
                            </div>
                               
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'jenissurat_nama'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modeljs,'jenissurat_nama',  CHtml::listData(KJenissuratM::model()->findAll(), 'jenissurat_nama', 'jenissurat_nama'),array('empty'=>'', 'style'=>'width:130px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'jenissurat_judul'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modeljs,'jenissurat_judul',array('maxlength'=>100,'style'=>'width:265px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo CHtml::hiddenField('karyawan_id',$model->karyawan_id);?>
                                    <?php echo $form->labelEx($modelm,'mutasi_nomorsurat'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelm,'mutasi_nomorsurat',array('maxlength'=>50,'style'=>'width:220px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                   
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'tglmutasi'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modelm,
                                        'attribute'=>'tglmutasi',
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
                                           'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)"

                                        ),
                                        )); 
                                   ?>
                                      </div>
                            </div>
                               
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'departementawal'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelm,'departementawal', CHtml::listData(KDepartementM::model()->findAll(), 'departement_nama', 'departement_nama'),array('style'=>'width:130;', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'subdepartementawal'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelm,'subdepartementawal', CHtml::listData(KSubdepartementM::model()->findAll(), 'subdepartement_nama', 'subdepartement_nama'),array('style'=>'width:130;', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'jabatanawal'); ?>
                                     <div class="mws-form-item ">                                           
                                    <?php echo $form->dropDownList($modelm,'jabatanawal', CHtml::listData(KJabatanM::model()->findAll(), 'jabatan_nama', 'jabatan_nama'),array('style'=>'width:130;', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                              
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'lokasiawal'); ?>
                                     <div class="mws-form-item ">                                           
                                    <?php echo $form->dropDownList($modelm,'lokasiawal', CHtml::listData(KLokasiM::model()->findAll(), 'lokasi_nama', 'lokasi_nama'),array('style'=>'width:130;', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'departementtujuan'); ?>
                                <div class="mws-form-item ">                                             
                                    <?php echo $form->dropDownList($modelm,'departementtujuan', CHtml::listData(KDepartementM::model()->findAll(), 'departement_nama', 'departement_nama'),array('style'=>'width:130;', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                             </td>   
                             <td>     
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'subdepartementtujuan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelm,'subdepartementtujuan', CHtml::listData(KSubdepartementM::model()->findAll(), 'subdepartement_nama', 'subdepartement_nama'),array('style'=>'width:130;', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'jabatantujuan'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelm,'jabatantujuan', CHtml::listData(KJabatanM::model()->findAll(), 'jabatan_nama', 'jabatan_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'lokasitujuan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelm,'lokasitujuan', CHtml::listData(KLokasiM::model()->findAll(), 'lokasi_nama', 'lokasi_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelm,'keterangan_mutasi'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($modelm,'keterangan_mutasi',array('rows'=>6, 'cols'=>50,'style'=>'width:180px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            
                            <div class="mws-form-row">
                                    <?php 
                                    echo $form->labelEx($modelm,'mengetahui'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'nama_karyawan', CHtml::listData(KKaryawanM::model()->findAll(), 'nama_karyawan', 'nama_karyawan'),array('name'=>'mengetahui','style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                  <?php
                                        echo CHtml::htmlButton('Cari', array('onclick' => '$("#dialogKaryawan").dialog("open");return false;',
                                            'class' => 'btn btn-primary',
                                            'onkeypress' => "return $(this).focusNextInputField(event)",
                                            'rel' => "tooltip",
                                            'title' => "Klik Untuk Pencarian Karyawan Lebih Lanjut",
                                            'id' => 'buttonPemilihanKaryawan',
                                            'readonly'=>true,
                                        ));
                                        ?>
                                      </div>
                            </div>
                                </td>
                             </tr>
                         </table>       
                 <div class="mws-button-row">
                    <?php echo CHtml::submitButton($modelm->isNewRecord ? 'Create' : 'Create', array('class' => 'mws-button blue','type'=>'submit','onKeyPress'=>'return formSubmit(this,event)')); ?>
                    <?php echo CHtml::ResetButton($modelm->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green'))."<br><br>"; ?>
                    
                <?php $this->endWidget(); ?>
                 <form method="post" align="right" action="<?php echo $this->createUrl('PrintMutasi',array('idMutasi'=>$modelm->mutasi_id,'idSurel'=>$modelser->suratelektronik_id)); ?>" target="blank">
                           <?php 
                            echo CHtml::htmlButton(Yii::t('mds','{icon} PDF',array('{icon}'=>'<i class="icon-book icon-white"></i>')),array('class'=>'mws-button blue right', 'type'=>'submit','name'=>'PDF')).""; 
                            echo CHtml::htmlButton(Yii::t('mds','{icon} Excel',array('{icon}'=>'<i class="icon-pdf icon-white"></i>')),array('class'=>'mws-button green right', 'type'=>'submit','name'=>'EXCEL')).""; 
                            echo CHtml::htmlButton(Yii::t('mds','{icon} Print',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button orange right', 'type'=>'submit','name'=>'PRINT'))."";
                           ?>
                     </form><Br>
                </div>   
            </div>
        </div>    	
    </div><!-- form -->
    
<?php JS;
Yii::app()->clientScript->registerScript('masukankaryawan', $jscript, CClientScript::POS_HEAD); ?>
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
    'dataProvider' => $modKaryawan->search(),
    'filter' => $modKaryawan,
    'template' => "{pager}{summary}\n{items}",
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'columns' => array(
        array(
            'header' => 'Pilih',
            'type' => 'raw',
            'value' => 'CHtml::Link("pilih","#",array("class"=>"btn-small", 
                                            "id" => "selectKaryawan",
                                            "onClick" => "$(\"#mengetahui\").val(\"$data->nama_karyawan\");
                                                          $(\"#\").val(\"$data->nama_karyawan\");
                                                          $(\"#dialogKaryawan\").dialog(\"close\");    
                                                "))',
        ),
        'nomorindukkaryawan',
        'nama_karyawan',
    ),
    'afterAjaxUpdate' => 'function(id, data){jQuery(\'' . Params::TOOLTIP_SELECTOR . '\').tooltip({"placement":"' . Params::TOOLTIP_PLACEMENT . '"});}',
));
    
    $this->endWidget();
?>
</div>
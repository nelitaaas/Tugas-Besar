<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');?>
<div style="width:100%">
</div>
<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'samutasi-r-form',
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
                 <?php
                    if ($form->errorSummary($modelm)) {
                    echo '<div class="mws-form-message error">' . $form->errorSummary($modelm) . '</div>';
                    }
                 ?>        
                <div class="mws-form-inline">   
                    <table>
                             <tr>
                                 <td>
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
                            
                                </td>
                             </tr>
                         </table>       
                 <div class="mws-button-row">
                    <?php echo CHtml::ajaxSubmitButton($modelm->isNewRecord ? 'Create' : 'Create', '', array('replace'=>'#formTab .mws-panel-body'), array('class' => 'mws-button blue', 'type'=>'submit','onKeyPress'=>'return formSubmit(this,event)')); ?>
                    <?php echo CHtml::ResetButton($modelm->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green'))."<br><br>"; ?>
                    
                <?php $this->endWidget(); ?>
                 <form method="post" align="right" action="<?php $mutasi_id = isset($modelm->mutasi_id) ? $modelm->mutasi_id : null; $suratelektronk_id = isset($modelser->suratelektronik_id) ? $modelser->suratelektronik_id : null; echo $this->createUrl('PrintMutasi',array('idMutasi'=>$mutasi_id,'idSurel'=>$suratelektronk_id)); ?>" target="blank">
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
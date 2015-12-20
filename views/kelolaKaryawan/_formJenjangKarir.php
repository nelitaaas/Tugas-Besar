<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js'); ?>
<div style="width:100%">
<?php 

//$this->renderPartial('_formDataKaryawan',array(
  //              'model'=>$model,
//)); 
?>
 </div>   
<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'kjenjangkarir-r-form',
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
                        if ($form->errorSummary($modeljk)) {
                        echo '<div class="mws-form-message error">' . $form->errorSummary($modeljk) . '</div>';
                        }
                 ?>        
                <div class="mws-form-inline">   
                    <table>
                        <tr>
                            <td>
                                    
                            <div class="mws-form-row">
                                    <?php echo CHtml::hiddenField('karyawan_id',$model->karyawan_id);?>
                                    <?php echo $form->labelEx($modeljk,'tgljenjangkarir'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modeljk,
                                        'attribute'=>'tgljenjangkarir',
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
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modeljk,'karyawan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($modeljk,'karyawan_id'); ?>
                                      </div>
                            </div>-->
                            
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modeljk,'departement_nama'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modeljk,'departement_nama', CHtml::listData(KDepartementM::model()->findAll(), 'departement_nama', 'departement_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modeljk,'jabatanasal'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modeljk,'jabatanasal', CHtml::listData(KJabatanM::model()->findAll(), 'jabatan_nama', 'jabatan_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modeljk,'lokasiasal'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modeljk,'lokasiasal', CHtml::listData(KLokasiM::model()->findAll(), 'lokasi_nama', 'lokasi_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modeljk,'jabatanbaru'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modeljk,'jabatanbaru', CHtml::listData(KJabatanM::model()->findAll(), 'jabatan_nama', 'jabatan_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modeljk,'lokasibaru'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modeljk,'lokasibaru', CHtml::listData(KLokasiM::model()->findAll(), 'lokasi_nama', 'lokasi_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                           </td><td>    
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modeljk,'fasilitasdiperoleh'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($modeljk,'fasilitasdiperoleh',array('style'=>'width:220px;','rows'=>6, 'cols'=>50,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modeljk,'keterangan_karir'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($modeljk,'keterangan_karir',array('style'=>'width:220px;','rows'=>6, 'cols'=>50,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                     </td>
                   </tr>
               </table>
                 <div class="mws-button-row">
                    <?php
                     echo CHtml::ajaxSubmitButton($modeljk->isNewRecord ? 'Create' : 'Create', '', array('replace'=>'#formTab .mws-panel-body'), array('class' => 'mws-button blue','type'=>'submit', 'onKeyPress'=>'return formSubmit(this,event)'));
                     echo "  ";
                     echo CHtml::ResetButton($modeljk->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>

                </div>   
                    
                <?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div><!-- form -->
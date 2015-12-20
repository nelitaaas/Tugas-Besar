<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');?>
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
                        'id'=>'kprestasikerja-r-form',
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
                                        if ($form->errorSummary($modelpresk)) {
                                        echo '<div class="mws-form-message error">' . $form->errorSummary($modelpresk) . '</div>';
                                        }
                                 ?>        
                <div class="mws-form-inline">   
                    <table>
                        <tr>
                            <td>
                                    
<!--                            <div class="mws-form-row">
                                    
                                    <?php //echo $form->labelEx($modelpresk,'karyawan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($modelpresk,'karyawan_id'); ?>
                                      </div>
                            </div>-->
                            <div class="mws-form-row">
                                    <?php echo CHtml::hiddenField('karyawan_id',$model->karyawan_id);?>
                                    <?php echo $form->labelEx($modelpresk,'tglprestasidiperoleh'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modelpresk,
                                        'attribute'=>'tglprestasidiperoleh',
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
                                    <?php echo $form->labelEx($modelpresk,'departement_nama'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelpresk,'departement_nama', CHtml::listData(KDepartementM::model()->findAll(), 'departement_nama', 'departement_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpresk,'subdepartement_nama'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelpresk,'subdepartement_nama', CHtml::listData(KSubdepartementM::model()->findAll(), 'subdepartement_nama', 'subdepartement_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpresk,'lokasi_nama'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelpresk,'lokasi_nama', CHtml::listData(KLokasiM::model()->findAll(), 'lokasi_nama', 'lokasi_nama'),array('style'=>'width:130;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                             </td><td>  
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpresk,'instansipemberi'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelpresk,'instansipemberi',array('maxlength'=>100,'style'=>'width:220px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpresk,'pejabatpemberi'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelpresk,'pejabatpemberi',array('maxlength'=>100,'style'=>'width:220px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpresk,'namapenghargaan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelpresk,'namapenghargaan',array('maxlength'=>100,'style'=>'width:220px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpresk,'keteranganprestasi'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($modelpresk,'keteranganprestasi',array('rows'=>6, 'cols'=>50,'style'=>'width:220px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                     </td>
                   </tr>
               </table>
                 <div class="mws-button-row">
                    <?php 
                    echo CHtml::ajaxSubmitButton($modelpresk->isNewRecord ? 'Create' : 'Create', '', array('replace'=>'#formTab .mws-panel-body'), array('class' => 'mws-button blue','type'=>'submit', 'onKeyPress'=>'return formSubmit(this,event)'));
                    echo "  ";
                    echo CHtml::ResetButton($modelpresk->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>

                </div>   
                    
                <?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div><!-- form -->
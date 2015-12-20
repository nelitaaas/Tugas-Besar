<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');?>
<div style="width:100%">
<?php 
    $this->renderPartial('_formDataKaryawan',array(
        'model'=>$model,
    )); 
?>
<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'kcutikaryawan-r-form',
                        'enableAjaxValidation'=>false,
//                        'clientOptions'=>array('validateOnSubmit'=>true), /enable event client  ajax validation on submit
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
                    if ($form->errorSummary($modelc)) {
                        echo '<div class="mws-form-message error">' . $form->errorSummary($modelc) . '</div>';
                    }
                 ?>        
                <div class="mws-form-inline">   
                <table>
                        <tr>
                            <td>
                            <div class="mws-form-row">
                                    <?php echo CHtml::hiddenField('karyawan_id',$model->karyawan_id);?>
                                    <?php echo $form->labelEx($modelc,'jeniscuti_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelc,'jeniscuti_id', CHtml::listData(KJeniscutiM::model()->findAll(), 'jeniscuti_id', 'jeniscuti_nama'), array('onKeyPress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modelc,'karyawan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($modelc,'karyawan_id'); ?>
                                      </div>
                            </div>-->
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelc,'tahuncuti'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelc,'tahuncuti',array('onKeyUp'=>'checkInput(this);','size'=>4,'maxlength'=>4,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelc,'tglmulaicuti'); ?>
                                     <div class="mws-form-item ">                                          
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tglmulaicuti',
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
                                    <?php echo $form->labelEx($modelc,'tglakhircuti'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tglakhircuti',
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
                                    <?php echo $form->labelEx($modelc,'lamacuti'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelc,'lamacuti',array('onKeyUp'=>'checkInput(this)','size'=>10,'maxlength'=>30,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?> Hari
                                      </div>
                            </div>
                             </td><td>  
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelc,'alasancuti'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($modelc,'alasancuti',array('rows'=>6, 'cols'=>30,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelc,'keterangancuti'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($modelc,'keterangancuti',array('rows'=>6, 'cols'=>30,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                </td>
                            </tr>
                      </table>
                                    
                 <div class="mws-button-row">
                    <?php
                    echo CHtml::submitButton($modelc->isNewRecord ? 'Create' : 'Create', array('class' => 'mws-button blue','type'=>'submit','onKeyPress'=>'return formSubmit(this,event)'));
                    echo "  ";
                    echo CHtml::ResetButton($modelc->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>

                </div>   
                    
                <?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div><!-- form -->
<?php 
//    $url = Yii::app()->createAbsoluteUrl('kepegawaian/karyawan/cuti');
//    Yii::app()->clientScript->registerScript('simpan', "
////               url = $('#kcutikaryawan-r-form').attr('action');
//                $('#kcutikaryawan-r-form').onclick(function(){
////                    $.post(\$url, $('#testform').serialize());
//                    return false;
//                });
//    ");
    
    
    ?>
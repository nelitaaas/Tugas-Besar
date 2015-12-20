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
                        'id'=>'sapengalamankerja-r-form',
                        'enableAjaxValidation'=>false,
                        'clientOptions'=>array('validateOnSubmit'=>true), //enable event client  ajax validation on submit
                        'htmlOptions'=>array('onKeyPress'=>"return disableKeyPress(event)"),
                )); ?>

<!--	<div class="mws-form-message info">Fields with <span class="required">*</span> are required.</div>-->
                <?php  if(Yii::app()->user->hasFlash('status')): ?>
 
                    <div class="flash-success" style="background: #9adf8f;">
                        <br/>
                    <?php echo Yii::app()->user->getFlash('status'); ?>
                    </div>

                <?php endif; ?>
            
                 <?php
                                        if ($form->errorSummary($modelpk)) {
                                            echo '<div class="mws-form-message error">' . $form->errorSummary($modelpk) . '</div>';
                                        }
                                 ?>        
                <div class="mws-form-inline">   
                    <table>
                           <tr>
                               <td>
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modelpk,'karyawan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($modelpk,'karyawan_id', array('style'=>'width:220px;')); ?>
                                      </div>-->
<!--                            </div>-->

                            <div class="mws-form-row">
                                    <?php echo CHtml::hiddenField('karyawan_id',$model->karyawan_id);?>
                                    <?php //echo $form->labelEx($modelpk,'pengalamankerja_nourut'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->hiddenField($modelpk,'pengalamankerja_nourut',array('onKeyUp'=>'checkInput(this)','style'=>'width:100px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpk,'namaperusahaan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelpk,'namaperusahaan',array('style'=>'width:200px;','maxlength'=>100,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpk,'bidangperusahaan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelpk,'bidangperusahaan',array('style'=>'width:200px;','maxlength'=>100,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpk,'jabatanterahkir'); ?>
                                     <div class="mws-form-item ">                                           
                                       <?php echo $form->textField($modelpk,'jabatanterahkir',array('style'=>'width:200px;','maxlength'=>50,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpk,'tglmasuk'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modelpk,
                                        'attribute'=>'tglmasuk',
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
                                    <?php echo $form->labelEx($modelpk,'tglkeluar'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modelpk,
                                        'attribute'=>'tglkeluar',
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
                                    <?php echo $form->labelEx($modelpk,'lama_tahun'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelpk,'lama_tahun',array('onKeyUp'=>'checkInput(this);','style'=>'width:100px;','onKeyPress'=>"return $(this).focusNextInputField(event)")); ?> Tahun  <?php echo $form->textField($modelpk,'lama_bulan',array('onKeyUp'=>'checkInput(this);','style'=>'width:100px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?> Bulan
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modelpk,'lama_bulan'); ?>
                                     <div class="mws-form-item ">                                           
                                      </div>
                            </div>
                               </td>
                             <td> 
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpk,'alasanberhenti'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($modelpk,'alasanberhenti',array('rows'=>4, 'cols'=>50,'style'=>'width:220px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelpk,'keterangan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($modelpk,'keterangan',array('rows'=>4, 'cols'=>50,'style'=>'width:220px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                </td>
                               </tr>
                   </table>                 
                 <div class="mws-button-row">
                     <?php 
                     echo CHtml::ajaxSubmitButton($modelpk->isNewRecord ? 'Create' : 'Create', '', array('replace'=>'#formTab .mws-panel-body'), array('class' => 'mws-button blue','type'=>'submit', 'onKeyPress'=>'return formSubmit(this,event)')); 
                     echo "  ";
                     echo CHtml::ResetButton($modelpk->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>

                </div>   
                    
                <?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div><!-- form -->
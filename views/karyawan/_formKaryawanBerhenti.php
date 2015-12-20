<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js'); ?>
<?php 
// Yii::app()->clientScript->registerCoreScript('jquery');
//                    $cs=Yii::app()->clientScript;
//                    $cs->registerScriptFile(Yii::app()->baseUrl . '/assets/48d296df/jui/js/jquery-ui-i18n.min.js', CClientScript::POS_END);
//                    $cs->registerScriptFile(Yii::app()->baseUrl . '/assets/2dae5394/jquery-ui-timepicker-addon.js', CClientScript::POS_END);

Yii::app()->clientScript->scriptMap=array(‘jquery.js’=>’false’);
    
?>
<div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'kkaryawanberhenti-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions'=>array('onKeyPress'=>'return disableKeyPress(event)'),
                    
                )); ?>
                
       <div class="mws-form-inline"> 
                      <fieldset><legend>Data Karyawan</legend>
                        <div id ="status">
                        </div>
                       <table>
                           <tr>
                               <td > 
                            <div class="mws-form-row">
                                <?php echo $form->errorSummary(array($model,$modelkb)); ?>
                                <?php echo CHtml::hiddenField('id',$model->karyawan_id); ?>
                                    <?php echo $form->labelEx($model,'nomorindukkaryawan'); ?>
                                     <div class="mws-form-item ">                                            
                                   <?php echo $form->textField($model,'nomorindukkaryawan',array('size'=>25,'maxlength'=>50,'readonly'=>true,'style'=>'width:160px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>       
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nama_karyawan'); ?>
                                      <div class="mws-form-item ">                                           
                                            <?php echo $form->textField($model,'gelardepan',array('empty'=>'','style'=>'width:60px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                            <?php echo $form->textField($model,'nama_karyawan',array('empty'=>'', 'style'=>'width:160px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?> 
                                            <?php echo $form->textField($model,'gelarbelakang',array('empty'=>'','style'=>'width:60px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>    
                                      </div>
                            </div>
                           
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jeniskelamin'); ?>
                                 <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'jeniskelamin',array('empty'=>'','style'=>'width:160px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>    
                                      </div>
                            </div>
                           
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'statusperkawinan'); ?>
                                     <div class="mws-form-item ">                                           
                                         <?php echo $form->textField($model,'statusperkawinan',array('style'=>'width:160px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div> 
                                   
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'agama'); ?>
                                 <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'agama',array('style'=>'width:160px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                   </td><td>
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tempatlahir_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'tempatlahir_karyawan',array('style'=>'width:160px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                             
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tgllahir_karyawan'); ?>
                                     <div class="mws-form-item ">                                           
                                    <?php echo $form->textField($model,'tgllahir_karyawan',array('style'=>'width:160px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>           
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nomobile_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'nomobile_karyawan',array('style'=>'width:160px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                   
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'notelp_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'notelp_karyawan',array('style'=>'width:160px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
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
                        <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelkb,'statusberhenti_id',  CHtml::listData(KStatusberhentiM::model()->findAll(), 'statusberhenti_id', 'statusberhenti_nama'),array('style'=>'width:160px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                       
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelkb,'tglberhenti'); ?>
                                     <div class="mws-form-item ">                                          
                                    <?php  $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
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
//                                      'timeText'=>'Waktu',
//                                      'hourText'=>'Jam',
//                                      'minuteText'=>'Menit',
//                                      'secondText'=>'Detik',
//                                      'showSecond'=>true,
//                                      'timeFormat'=>'hh:mm:ss',

//                                      'showOn'=>'button',
//                                      'buttonImage'=> Yii::app()->baseUrl."/css/icons/32/calendar.png",
//                                      'buttonImageOnly'=>true,
                                        ),
                                        'htmlOptions'=>array(
//                                        'readonly'=>true,
                                                'style'=>'width:160px;',
                                                'onkeypress'=>'return $(this).focusNextInputField(event)'
                                        ),
                                        )); 
                                   ?>
                                      </div>
                            </div>    
                            </td><td>
                                <div class="mws-form-row">
                                            <?php echo $form->labelEx($modelkb,'keterangan_berhenti'); ?>
                                             <div class="mws-form-item ">                                            <?php echo $form->textArea($modelkb,'keterangan_berhenti',array('class'=>'isRequired','style'=>'width:160px;','col'=>'6','row'=>'4','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                              </div>
                                </div>
                               </td>
                           </tr>
                     </table>          
               </fieldset>
                <div class="mws-button-row">
                        <?php
                             echo CHtml::button($modeljk->isNewRecord ? 'Create' : 'Create', array('id'=>'savekberhenti','onclick'=>'addkaryawanform('.$model->karyawan_id.')','class' => 'mws-button blue'));
                             echo "  ";
                             echo CHtml::ResetButton($modeljk->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green'));
                         ?>
                </div>  
</div>
 <?php $this->endWidget(); ?> 


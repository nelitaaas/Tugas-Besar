<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'kjenjangkarir-r-form',
                        'enableAjaxValidation'=>false,
                )); ?>

	<div class="mws-form-message info">Fields with <span class="required">*</span> are required.</div>
                 <?php
                                        if ($form->errorSummary($model)) {
                                        echo '<div class="mws-form-message error">' . $form->errorSummary($model) . '</div>';
                                        }
                                 ?>        
                <div class="mws-form-inline">   
                    <table>
                        <tr>
                            <td>
                                    
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tgljenjangkarir'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                                                            'model'=>$model,
                                                                            'attribute'=>'tgljenjangkarir',
                                                                            'language'=>'',
                                                                            'mode'=>'date', //use "time","date" or "datetime" (default)
                                                                            'options'=>array(
                                                                            'dateFormat'=>'yy-mm-dd',
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
//                                                                            'readonly'=>true,

                                                                            ),
                                                                            )); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'karyawan_id'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'karyawan_id'); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nourutjenjangkarir'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'nourutjenjangkarir'); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'departement_nama'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'departement_nama',array('size'=>60,'maxlength'=>100)); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jabatanasal'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'jabatanasal',array('size'=>60,'maxlength'=>100)); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'lokasiasal'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'lokasiasal',array('size'=>60,'maxlength'=>100)); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jabatanbaru'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'jabatanbaru',array('size'=>60,'maxlength'=>100)); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'lokasibaru'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textField($model,'lokasibaru',array('size'=>60,'maxlength'=>100)); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'fasilitasdiperoleh'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textArea($model,'fasilitasdiperoleh',array('rows'=>6, 'cols'=>50)); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'keterangan_karir'); ?>
                                     <div class="mws-form-item ">                                            <?php echo $form->textArea($model,'keterangan_karir',array('rows'=>6, 'cols'=>50)); ?>
                                      </div>
                            </div>
                               
                                     </td>
                   </tr>
               </table>
                 <div class="mws-button-row">
                    echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'mws-button blue'));                                           echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>

                </div>   
                    
                <?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div><!-- form -->
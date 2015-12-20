<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js'); ?>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-list">Form Master Gaji</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'mastergaji-m-form',
                        'enableAjaxValidation'=>false,
                )); ?>

	<div class="mws-form-message info">Bagian dengan tanda <span class="required">*</span> harus diisi.</div>
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
                                    <?php echo $form->labelEx($model,'lama_bln'); ?>
                                     <div class="mws-form-item ">                                        
<?php echo $form->textField($model,'lama_bln', array('onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput')); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'gajipokok'); ?>
                                     <div class="mws-form-item ">                                        
<?php echo $form->textField($model,'gajipokok', array('onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput')); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'kgalon'); ?>
                                     <div class="mws-form-item ">                                        
<?php echo $form->textField($model,'kgalon', array('onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput')); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'kgelas'); ?>
                                     <div class="mws-form-item ">                                        
<?php echo $form->textField($model,'kgelas', array('onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput')); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'kkarton'); ?>
                                     <div class="mws-form-item ">                                        
<?php echo $form->textField($model,'kkarton', array('onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput')); ?>
                                      </div>
                            </div>
                               
                                     </td>
                   </tr>
               </table>
                 <div class="mws-button-row">
                     <?php echo Chtml::link('Back',$url='index.php?r=kepegawaian/mastergajiM/admin', array('class' => 'mws-button gray left')); ?>
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Create', array('class' => 'mws-button blue')).' ';
                    echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>

                </div>   
                    
                <?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div><!-- form -->
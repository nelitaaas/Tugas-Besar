<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js'); ?>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-list">Form Pendidikan</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'pendidikan-m-form',
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
                                     <?php echo $form->labelEx($model,'pendidikan_nama'); ?>
                                     <div class="mws-form-item ">                                        
                                          <?php echo $form->textField($model,'pendidikan_nama',array('size'=>15,'maxlength'=>50, 
                                                                      'onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput')); ?>
                                     </div>
                                </div>

                                <div class="mws-form-row">
                                     <?php echo $form->labelEx($model,'pendidikan_urutan'); ?>
                                     <div class="mws-form-item ">                                        
                                          <?php echo $form->textField($model,'pendidikan_urutan', array('onkeypress'=>'return $(this).focusNextInputField(event);',
                                                                      'class'=>'mws-textinput')); ?>
                                          </div>
                                </div>

                                <div class="mws-form-row">
                                     <?php echo $form->labelEx($model,'pendidikan_aktif'); ?>
                                     <div class="mws-form-item small">                                        
                                          <?php echo $form->checkBox($model,'pendidikan_aktif', array('onkeypress'=>'return $(this).focusNextInputField(event);',
                                                                     'checked'=>'checked')); ?>
                                     </div>
                                </div>
                            </td>
                         </tr>
                    </table>
                 <div class="mws-button-row">
                    <?php echo Chtml::link('Back',$url='index.php?r=kepegawaian/pendidikanM/admin', array('class' => 'mws-button gray left')); ?>
                    <?php 
                        echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Create', array('class' => 'mws-button blue')).' ';
                        echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); 
                    ?>
                </div>   
                <?php $this->endWidget(); ?>
            </div>
        </div>    	
    </div><!-- form -->
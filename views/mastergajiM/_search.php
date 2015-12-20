<div class="mws-panel mws-collapsible2">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-magnifying-glass-2">Pencarian Master Gaji</span>
    </div>
    <div class="mws-panel-body2">
        <div class="mws-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'id'=>'mastergaji-m-form',
)); ?>
<div class="mws-form-inline">
                        <div class="mws-form-row">
		<?php echo $form->label($model,'lama_bln'); ?>
                                 <div class="mws-form-item ">		
<?php echo $form->textField($model,'lama_bln', array('onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput','style'=>'width:140px')); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'gajipokok'); ?>
                                 <div class="mws-form-item ">		
<?php echo $form->textField($model,'gajipokok', array('onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput','style'=>'width:140px')); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'kgalon'); ?>
                                 <div class="mws-form-item ">		
<?php echo $form->textField($model,'kgalon', array('onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput','style'=>'width:140px')); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'kgelas'); ?>
                                 <div class="mws-form-item ">		
<?php echo $form->textField($model,'kgelas', array('onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput','style'=>'width:140px')); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'kkarton'); ?>
                                 <div class="mws-form-item ">		
<?php echo $form->textField($model,'kkarton', array('onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput','style'=>'width:140px')); ?>
                                </div>
                       </div>     
	<div class="mws-button-row">
                                
<?php echo CHtml::submitButton($model->isNewRecord ? 'Search' : 'Save', array('class' => 'mws-button blue')); ?>
                                <?php echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>	</div>

<?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div>
</div><!-- search-form -->
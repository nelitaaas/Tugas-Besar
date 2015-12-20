<div class="mws-panel mws-collapsible2">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-magnifying-glass-2">Pencarian</span>
    </div>
    <div class="mws-panel-body2">
        <div class="mws-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<div class="mws-form-inline">
                        <div class="mws-form-row">
		<?php echo $form->label($model,'penggajiandetail_id'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'penggajiandetail_id'); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'karykomponen_m'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'karykomponen_m'); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'penggajian_id'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'penggajian_id'); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'jumlah'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'jumlah'); ?>
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
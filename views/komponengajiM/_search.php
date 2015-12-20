<div class="mws-panel mws-collapsible2">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-magnifying-glass-2">Pencarian</span>
    </div>
    <div class="mws-panel-body2">
        <div class="mws-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'id'=>'cariSearch'
)); ?>
<div class="mws-form-inline">
    <div class="mws-form-row">
    <?php echo $form->label($model,'komponengaji_nama'); ?>
             <div class="mws-form-item ">		     
                <?php echo $form->textField($model,'komponengaji_nama',array('class'=>'span3')); ?>
            </div>
    </div>     
    <div class="mws-form-row">
    <?php echo $form->label($model,'komponengaji_singkt'); ?>
             <div class="mws-form-item ">		<?php echo $form->textField($model,'komponengaji_singkt',array('class'=>'span3')); ?>
            </div>
    </div>  
    <div class="mws-form-row">
    <?php echo $form->label($model,'komponengaji_aktif'); ?>
             <div class="mws-form-item small">		<?php echo $form->checkBox($model,'komponengaji_aktif',array('checked'=>true)); ?>
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
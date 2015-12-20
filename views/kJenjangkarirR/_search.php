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
		<?php echo $form->label($model,'jenjangkarir_id'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'jenjangkarir_id'); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'tgljenjangkarir'); ?>
                                 <div class="mws-form-item ">		<?php echo $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
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
		<?php echo $form->label($model,'karyawan_id'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'karyawan_id'); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'nourutjenjangkarir'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'nourutjenjangkarir'); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'departement_nama'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'departement_nama',array('size'=>60,'maxlength'=>100)); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'jabatanasal'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'jabatanasal',array('size'=>60,'maxlength'=>100)); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'lokasiasal'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'lokasiasal',array('size'=>60,'maxlength'=>100)); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'jabatanbaru'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'jabatanbaru',array('size'=>60,'maxlength'=>100)); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'lokasibaru'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textField($model,'lokasibaru',array('size'=>60,'maxlength'=>100)); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'fasilitasdiperoleh'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textArea($model,'fasilitasdiperoleh',array('rows'=>6, 'cols'=>50)); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'keterangan_karir'); ?>
                                 <div class="mws-form-item ">		<?php echo $form->textArea($model,'keterangan_karir',array('rows'=>6, 'cols'=>50)); ?>
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
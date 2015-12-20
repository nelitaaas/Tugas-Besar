<div class="mws-panel mws-collapsible2">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-magnifying-glass-2">Pencarian Penggajian</span>
    </div>
    <div class="mws-panel-body2">
        <div class="mws-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
                'id'=>'penggajian-t-search',
	'method'=>'get','id'=>'cariSearch'
)); ?>
<div class="mws-form-inline">
                <div class="mws-form-row">
                    <?php echo CHtml::label('Tanggal Penggajian','PenggajianT_tglAwal'); ?>
                    <div class="mws-form-item">
                                        <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                            'model'=>$model,
                                            'attribute'=>'tglAwal',
                                            'language'=>'',
                                            'mode'=>'date', //use "time","date" or "datetime" (default)
                                            'options'=>array(
                                                'dateFormat'=>Params::DATE_FORMAT_MEDIUM,
                                                'changeYear'=>true,
                                                'changeMonth'=>true,
                                                'yearRange'=>'-70y:+4y',
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
                                            'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
//                                            'class'=>'dtpicker3',
                                            ),
                                            ));?>
                    </div>
                </div>
                <div class="mws-form-row">
                    <?php echo CHtml::label('Sampai Dengan','PenggajianT_tglAkhir'); ?>
                    <div class="mws-form-item">
                                        <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                            'model'=>$model,
                                            'attribute'=>'tglAkhir',
                                            'language'=>'',
                                            'mode'=>'date', //use "time","date" or "datetime" (default)
                                            'options'=>array(
                                                'dateFormat'=>Params::DATE_FORMAT_MEDIUM,
                                                'changeYear'=>true,
                                                'changeMonth'=>true,
                                                'yearRange'=>'-70y:+4y',
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
                                            'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
//                                            'class'=>'dtpicker3',
                                            ),
                                            ));?>
                    </div>
                </div>
	<div class="mws-button-row">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Search' : 'Save', array('class' => 'mws-button blue')); ?>
            <?php echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>	
        </div>

<?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div>
</div><!-- search-form -->
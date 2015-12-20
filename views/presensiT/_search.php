<div class="mws-panel mws-collapsible2">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-magnifying-glass-2">Pencarian Presensi</span>
    </div>
    <div class="mws-panel-body2">
        <div class="mws-form">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'action' => Yii::app()->createUrl($this->route),
                'method' => 'get',
                'id'=>'formCari',
                    ));
            ?>
            <div class="mws-form-inline">
                <table>
                    <tr>
                        <td>
                <div class="mws-form-row">
                    <?php echo $form->label($model, 'tglAwal'); ?>
                    <div class="mws-form-item ">		
                        <?php
                        $this->widget('MyDateTimePicker', array(
                            'model' => $model,
                            'attribute' => 'tglAwal',
                            'language' => '',
                            'mode' => 'date', //use "time","date" or "datetime" (default)
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'changeYear' => true,
                                'changeMonth' => true,
                                'yearRange' => '-70y:+4y',
                                'showSecond' => false,
                                'showDate' => false,
                                'showMonth' => false,
                                'timeFormat' => 'hh:mm:ss',
                            ),
                            'htmlOptions' => array(
                                'readonly' => true,
                                'onkeypress' => 'return $(this).focusNextInputField(event);',
                            ),
                        ));
                        ?>
                    </div>
                </div>     
                <div class="mws-form-row">
                    <?php echo $form->label($model, 'tglAkhir'); ?>
                    <div class="mws-form-item ">		
                        <?php
                        $this->widget('MyDateTimePicker', array(
                            'model' => $model,
                            'attribute' => 'tglAkhir',
                            'language' => '',
                            'mode' => 'date', //use "time","date" or "datetime" (default)
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'changeYear' => true,
                                'changeMonth' => true,
                                'yearRange' => '-70y:+4y',
                                'showSecond' => false,
                                'showDate' => false,
                                'showMonth' => false,
                                'timeFormat' => 'hh:mm:ss',
                            ),
                            'htmlOptions' => array(
                                'readonly' => true,
                                'onkeypress' => 'return $(this).focusNextInputField(event);',
                            ),
                        ));
                        ?>
                    </div>
                </div>     
                </td>
                <td>
                <div class="mws-form-row">
                    <?php echo $form->label($model, 'no_fingerprint'); ?>
                    <div class="mws-form-item ">		
                        <?php echo $form->textField($model, 'no_fingerprint', array('size' => 30, 'maxlength' => 30, 'onkeypress' => 'return $(this).focusNextInputField(event);', 'class' => 'mws-textinput')); ?>
                    </div>
                </div>     
<!--                <div class="mws-form-row">
                    <?php //echo $form->label($model, 'nama_karyawan'); ?>
                    <div class="mws-form-item ">		
                        <?php //echo $form->textField($model, 'nama_karyawan', array('onkeypress' => 'return $(this).focusNextInputField(event);', 'class' => 'mws-textinput')); ?>
                    </div>
                </div>     -->
                    </td>
                    </tr>
                    </table>
                <div class="mws-button-row">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Search' : 'Save', array('class' => 'mws-button blue')); ?>
                    <?php echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>	</div>
                <?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div>
</div><!-- search-form -->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js'); ?>

<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'pendidikan-r-form',
                        'enableAjaxValidation'=>false,
                        'clientOptions'=>array('validateOnSubmit'=>true), //enable event client  ajax validation on submit
                        'htmlOptions'=>array('onKeyPress'=>"return disableKeyPress(event)"),
                )); ?>
            
                <?php  if(Yii::app()->user->hasFlash('status')): ?>
 
                    <div class="flash-success" style="background: #9adf8f;">
                        <br/>
                    <?php echo Yii::app()->user->getFlash('status'); ?>
                    </div>

                <?php endif; ?>
                 <?php
                    if ($form->errorSummary($modelp)) {
                    echo '<div class="mws-form-message error">' . $form->errorSummary($modelp) . '</div>';
                    }
                 ?>        
                <div class="mws-form-inline">    
                                    
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modelp,'karyawan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($modelp,'karyawan_id'); ?>
                                      </div>
                            </div>-->
<!--                            <br/>-->
                      <table>
                          <tr>
                                <td>
                                    
                            <div class="mws-form-row">
                                <?php echo CHtml::hiddenField('karyawan_id',$model->karyawan_id);?>
                                    <?php echo $form->labelEx($modelp,'jenispendidikan'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelp,'jenispendidikan',CHtml::listData(Params::getLookup(Params::JENISPENDIDIKAN), 'lookup_nama',  'lookup_nama'),array('maxlength'=>50,'style'=>'width:180px;', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modelp,'pendidikankaryawan_nourut'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($modelp,'pendidikankaryawan_nourut',array('onKeyUp'=>'checkInput(this);','style'=>'width:100px;')); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'pendidikankaryawan_nama'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelp,'pendidikankaryawan_nama',array('maxlength'=>100,'style'=>'width:180px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'pendidikankaryawan_alamat'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($modelp,'pendidikankaryawan_alamat',array('rows'=>6, 'cols'=>50,'style'=>'width:180px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'pendidikan_nama'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelp,'pendidikan_nama',CHtml::listData(KPendidikanM::model()->findAll(), 'pendidikan_nama', 'pendidikan_nama'),array('maxlength'=>100,'style'=>'width:130px;', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'jurusan_nama'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelp,'jurusan_nama',CHtml::listData(KJurusanM::model()->findAll(), 'jurusan_nama', 'jurusan_nama'),array('maxlength'=>100,'style'=>'width:130px;', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'propinsi_nama'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelp,'propinsi_nama', CHtml::listData($model->getPropinsiItems(), 'propinsi_nama', 'propinsi_nama'), 
                                      array('style'=>'width:120px','empty'=>'-- Pilih --', 'onkeypress'=>"return $(this).focusNextInputField(event)", 
                                            'ajax'=>array('type'=>'POST',
                                                          'url'=>Yii::app()->createUrl('ActionDynamic/GetKabupatenNama',array('encode'=>false,'namaModel'=>get_class($modelp))),
                                                          'update'=>'#KPendidikankaryawanR_kabupatenkota_nama',
                                                        ),
                                            )); 
                                    //echo $form->dropDownList($modelp,'propinsi_nama',CHtml::listData(KPropinsiM::model()->findAll(), 'propinsi_nama', 'propinsi_nama'),array('maxlength'=>100,'style'=>'width:130px;', 'empty'=>'--Pilih--'));
                                   ?>
                              </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'kabupatenkota_nama'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->dropDownList($modelp,'kabupatenkota_nama',CHtml::listData(KKabupatenkotaM::model()->findAll(), 'kabupatenkota_nama', 'kabupatenkota_nama'),array('maxlength'=>100,'style'=>'width:130px;', 'empty'=>'--Pilih--')); 
                                        echo $form->dropDownList($modelp,'kabupatenkota_nama',CHtml::listData($model->getKabupatenItems($model->kabupatenkota->propinsi_id), 'kabupatenkota_nama', 'kabupatenkota_nama'),
                                            array('style'=>'width:120px','empty'=>'-- Pilih --', 'onkeypress'=>"return $(this).focusNextInputField(event)",
                                            //'ajax'=>array('type'=>'POST',
                                            //             ),
                                            )); 

                                    ?>
                                      </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'fakultas'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelp,'fakultas',array('size'=>50,'maxlength'=>50,'style'=>'width:180px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                    </td>
                                    <td>
                                
                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($modelp,'tglmasuk'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php /*$this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modelp,
                                        'attribute'=>'tglmasuk',
                                        'language'=>'',
                                        'mode'=>'date', //use "time","date" or "datetime" (default)
                                        'options'=>array(
                                        'dateFormat'=>'d-M-yy',
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
//                                      'readonly'=>true,
                                        ),
                                        ));*/ 
                                    ?>
                                      </div>
                            </div> 

<!--                            <div class="mws-form-item ">                                            
                                <input id="KPelamarT_tgl_lahirpelamar" name="KPelamarT[tgl_lahirpelamar]" type="text" class="hasDatepicker">
                                <img class="ui-datepicker-trigger" src="/testhasan/css/icons/32/calendar.png" alt="..." title="...">
                            </div    -->
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'tgllulus'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modelp,
                                        'attribute'=>'tgllulus',
                                        'language'=>'',
                                        'mode'=>'date', //use "time","date" or "datetime" (default)
                                        'options'=>array(
                                        'dateFormat'=>'dd-M-yy',
                                        'changeYear' => true,
                                        'changeMonth' => true,
                                        'yearRange' => '-70y:+4y',
                                        'showSecond' => false,
                                        'showDate' => false,
                                        'showMonth' => false,
                                        'timeFormat' => 'hh:mm:ss',

                                        'showOn'=>'button',
                                        'buttonImage'=> Yii::app()->baseUrl."/css/icons/32/calendar.png",
                                        'buttonImageOnly'=>true,
                                        ),
                                        'htmlOptions'=>array(
                                        'class'=>'isRequired',
                                        'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
                                        ),
                                        ));?>
                                      </div>
                            </div> 

                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'lamapendidikan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelp,'lamapendidikan',array('onKeyUp'=>'checkInput(this);','maxlength'=>30,'style'=>'width:130px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?> Tahun
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'no_ijazah'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelp,'no_ijazah',array('onKeyUp'=>'checkInput(this)','maxlength'=>100,'style'=>'width:180px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'tgl_ijazah'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modelp,
                                        'attribute'=>'tgl_ijazah',
                                        'language'=>'',
                                        'mode'=>'date', //use "time","date" or "datetime" (default)
                                        'options'=>array(
                                        'dateFormat'=>'dd-M-yy',
                                        'changeYear' => true,
                                        'changeMonth' => true,
                                        'yearRange' => '-70y:+4y',
                                        'showSecond' => false,
                                        'showDate' => false,
                                        'showMonth' => false,
                                        'timeFormat' => 'hh:mm:ss',

                                        'showOn'=>'button',
                                        'buttonImage'=> Yii::app()->baseUrl."/css/icons/32/calendar.png",
                                        'buttonImageOnly'=>true,
                                        ),
                                        'htmlOptions'=>array(
                                        'class'=>'isRequired',
                                        'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
                                        ),
                                        ));?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'ttd_ijazah'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelp,'ttd_ijazah',array('maxlength'=>100,'style'=>'width:180px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'nilai_ipk'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modelp,'nilai_ipk',array('maxlength'=>50,'style'=>'width:130px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'gradelulus'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($modelp,'gradelulus', CHtml::listData(Params::getLookup(Params::GRADE), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:160px;', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($modelp,'keterangan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($modelp,'keterangan',array('rows'=>6, 'cols'=>50,'style'=>'width:180px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                              </td>
                            </tr>
                          </table>   
                 <div class="mws-button-row">
                    <?php
                            //echo CHtml::submitButton($modelp->isNewRecord ? 'Create' : 'Save', array('class' => 'mws-button blue'));   
                            echo CHtml::ajaxSubmitButton($modelp->isNewRecord ? 'Create' : 'Create', '', array('replace'=>'#formTab .mws-panel-body'), array('class' => 'mws-button blue','type'=>'submit','onKeyPress'=>'return formSubmit(this,event)'));
                            echo "  ";
                            echo CHtml::ResetButton($modelp->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); 
                    ?>

                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>    	
    </div><!-- form -->
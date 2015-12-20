<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js'); ?>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-list">Form Pendaftaran</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'kpelamar-t-form',
                        'enableAjaxValidation'=>false,
                       // 'focus'=>'#pelamar',
                        'htmlOptions'=>array('enctype'=>'multipart/form-data','onKeyPress'=>'return disableKeyPress(event)'),
                )); ?>

	<div class="mws-form-message info">Bagian dengan tanda<span class="required">*</span> harus diisi.</div>
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
                                    <?php echo $form->labelEx($model,'jenisidentitas'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'jenisidentitas', CHtml::listData(Params::getLookup(Params::JENISIDENTITAS), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:130px;','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'noidentitas'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'noidentitas',array('onKeyUp'=>'checkInput(this);', 'size'=>20,'maxlength'=>100,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nama_pelamar'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'nama_pelamar',array('size'=>20,'maxlength'=>100,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jeniskelamin'); ?>
                                     <div class="mws-form-item ">                                        
                                     <table>
                                       <tr>
                                            <?php 
                                            echo $form->radioButtonList(
                                                $model,
                                                'jeniskelamin', 
                                                array('LAKI-LAKI'=>'LAKI-LAKI', 'PEREMPUAN'=>'PEREMPUAN'),
                                                array( 'template'=>"
                                                     <td>
                                                         {input}
                                                    </td>
                                                    <td>
                                                         {label}
                                                   </td>",'onKeyPress'=>"return $(this).focusNextInputField(event)"
                                               ));
                                              ?>
                                       </tr>
                                    </table>                    
                                     </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nama_keluarga'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'nama_keluarga',array('size'=>20,'maxlength'=>50,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'statusperkawinan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'statusperkawinan', CHtml::listData(Params::getLookup(Params::STATUSPERKAWINAN), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:130px', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jmlanak'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'jmlanak', array('onKeyUp'=>'checkInput(this);','size'=>5,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?> Orang
                                      </div>
                            </div>   
                            
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tempatlahir_pelamar'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'tempatlahir_pelamar',array('size'=>20,'maxlength'=>30,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tgl_lahirpelamar'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tgl_lahirpelamar',
                                        'language'=>'',
                                        'mode'=>'date', //use "time","date" or "datetime" (default)
                                        'options'=>array(
                                        'dateFormat'=>'yy-mm-dd',
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
                                <?php echo $form->labelEx($model,'agama'); ?>
                                    <div class="mws-form-item ">                                            
                                <?php echo $form->dropDownList($model,'agama', CHtml::listData(Params::getLookup(Params::AGAMA), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:150px', 'empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                    </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'pendidikan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'pendidikan_id',  CHtml::listData(KPendidikanM::model()->findAll(), 'pendidikan_id', 'pendidikan_nama'),array('empty'=>'','style'=>'width:150px','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                        
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jabatan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'jabatan_id',  CHtml::listData(KJabatanM::model()->findAll(), 'jabatan_id', 'jabatan_nama'),array('empty'=>'', 'style'=>'width:130px','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'alamatemail'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'alamatemail',array('size'=>25,'maxlength'=>50,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>              
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jurusan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'jurusan_id',  CHtml::listData(KJurusanM::model()->findAll(), 'jurusan_id', 'jurusan_nama'),array('empty'=>'', 'style'=>'width:130px','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div> 
                     
                                          
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'alamat_pelamar'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($model,'alamat_pelamar',array('rows'=>6, 'cols'=>35,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
    </td>
                                       <td>

<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($model,'karyawan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->dropDownList($model,'karyawan_id',  CHtml::listData(KKaryawanM::model()->findAll(), 'karyawan_id', 'nama_karyawan'),array('empty'=>'')); ?>
                                      </div>
                            </div>-->
							       
                            <div class="mws-form-row">
                                  <?php echo $form->labelEx($model,'notelp_karyawan'); ?>
                                    <div class="mws-form-item ">                                            
                                  <?php echo $form->textField($model,'notelp_karyawan',array('onKeyUp'=>'checkInput(this);','size'=>20,'maxlength'=>50,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                    </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nomobile_pelamar'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'nomobile_pelamar',array('onKeyUp'=>'checkInput(this);','size'=>20,'maxlength'=>50,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'kodepos'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'kodepos',array('onKeyUp'=>'checkInput(this);','size'=>8,'maxlength'=>50,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                              <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'propinsi_id'); ?>
                                    <div class="mws-form-item ">                                            
                                    <?php //echo $form->dropDownList($model,'propinsi_id',  CHtml::listData(KPropinsiM::model()->findAll(), 'propinsi_id', 'propinsi_nama'),array('empty'=>'','style'=>'width:150px','empty'=>'--Pilih--')); 
                                          echo $form->dropDownList($model,'propinsi_id', CHtml::listData(KPropinsiM::model()->getPropinsiItems(), 'propinsi_id', 'propinsi_nama'), 
                                          array('style'=>'width:120px','empty'=>'-- Pilih --', 'onkeypress'=>"return $(this).focusNextInputField(event)", 
                                                'ajax'=>array('type'=>'POST',
                                                  'url'=>Yii::app()->createUrl('ActionDynamic/GetKabupaten',array('encode'=>false,'namaModel'=>get_class($model),'attr'=>'propinsi_id')),
                                                  'update'=>'#KPelamarT_kabupatenkota_id',
                                                ),
                                         )); 
                                    ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'kabupatenkota_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->dropDownList($model,'kabupatenkota_id',  CHtml::listData(KKabupatenkotaM::model()->findAll(), 'kabupatenkota_id', 'kabupatenkota_nama'),array('empty'=>'','style'=>'width:150px','empty'=>'--Pilih--')); 
                                        echo $form->dropDownList($model,'kabupatenkota_id',CHtml::listData(KPropinsiM::model()->getKabupatenItems($model->propinsi_id), 'kabupatenkota_id', 'kabupatenkota_nama'),
                                            array('style'=>'width:120px','empty'=>'-- Pilih --', 'onkeypress'=>"return $(this).focusNextInputField(event)",
                                            'ajax'=>array('type'=>'POST',
                                                         ),
                                            )); 
                                    ?>
                                  </div>
                            </div> 
                               
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'warganegara_pelamar'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'warganegara_pelamar', CHtml::listData(Params::getLookup(Params::WARGANEGARA), 'lookup_nama', 'lookup_nama'),array('empty'=>'--Pilih--','style'=>'width:100px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                       
                            
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'departement_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'departement_id',  CHtml::listData(KDepartementM::model()->findAll(), 'departement_id', 'departement_nama'), array('empty'=>'','style'=>'width:150px','empty'=>'--Pilih--','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tgllowongan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tgllowongan',
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
                                    <?php echo $form->labelEx($model,'gajiygdiharapkan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'gajiygdiharapkan',array('size'=>15,'onKeyUp'=>'checkInput(this);','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tglditerima'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tglditerima',
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
                                        'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
                                        ),
                                        ));?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tglmulaibekerja'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tglmulaibekerja',
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
                                        'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
                                        ),
                                        ));?>
                                      </div>
                            </div>
                         
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($model,'karyawan_aktif'); ?>
                                     <div class="mws-form-item small">                                            
                                    <?php //echo $form->checkBox($model,'karyawan_aktif',array('onkeypress'=>"return $(this).focusNextInputField(event)","checked"=>"checked")); ?>
                                      </div>
                            </div>-->
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'photopelamar'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo Chtml::activeFileField($model,'photopelamar',array('maxlength'=>254,'Hint'=>'Isi Jika Akan Menambahkan Logo'
                                                                        ,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                           </div>      
                          <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'fileCV_Pelamar'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo Chtml::activeFileField($model,'fileCV_Pelamar',array('maxlength'=>254,'Hint'=>'Isi Jika Akan Menambahkan Logo','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>  <br/><br/>
							   <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'keterangan_pelamar'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($model,'keterangan_pelamar',array('rows'=>6, 'cols'=>40,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>               
<!--                            <div class="mws-form-row">
                                    <?php /*echo $form->labelEx($model,'Create_Time'); ?>
                                     <div class="mws-form-item ">                                            
                                     *<?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'Create_Time',
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
//                                       'readonly'=>true,

                                        ),
                                        ));*/ ?>
                                      </div>
                            </div>-->   
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($model,'Create_User_Id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($model,'Create_User_Id'); ?>
                                      </div>
                            </div>-->
                             </td>
                             </tr>
                    </table>
                 <div class="mws-button-row">
                    <?php                    
                        echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'mws-button blue','type'=>'submit','onKeypress'=>'return formSubmit(this,event)'));
                        echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); 
                     ?>

                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>    	
    </div><!-- form -->

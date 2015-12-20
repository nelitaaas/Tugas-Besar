<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js'); ?>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-list">Form Karyawan</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'kkaryawan-m-form',
                        'enableAjaxValidation'=>false,
                        'focus'=>'#updateKaryawan',
                         'htmlOptions'=>array('enctype'=>'multipart/form-data','onKeyPress'=>'return disableKeyPress(event)'),
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
                                   <?php echo $form->hiddenField($model,'pelamar_id',array('maxlength'=>100,'style'=>'width:160px;','placeholder'=>'Pelamar','onKeyPress'=>"return $(this).focusNextInputField(event)")); ?> 
                             <div class="mws-form-row">
                                    <?php echo CHtml::label('Tgl diterima', 'tglditerima'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tglditerima',
                                        'name'=>'tglditerima',
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
                                    <?php echo CHtml::label('Tgl Mulai Bekerja', 'tglmulaibekerja'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modelp,
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
                                        'class'=>'isRequired',
                                        'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
                                        ),
                                        ));?>
                                      </div>
                            </div>      
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jenisidentitas'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'jenisidentitas', CHtml::listData(Params::getLookup(Params::JENISIDENTITAS), 'lookup_nama', 'lookup_nama'),array('empty'=>'--Pilih--','style'=>'width:80px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                    <?php echo $form->textField($model,'noidentitas',array('maxlength'=>100, 'placeholder'=>'No Identitas','empty'=>'','style'=>'width:160px;','onKeyPress'=>"return $(this).focusNextInputField(event)")); ?>
                                     </div>    
                                     
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nama_karyawan'); ?>
                                     <div class="mws-form-item ">                                           
                                    <?php echo $form->dropDownList($model,'gelardepan', CHtml::listData(Params::getLookup(Params::GELARDEPAN), 'lookup_nama', 'lookup_nama'),array('empty'=>'--Pilih--','style'=>'width:60px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>                                                                                              
                                    <?php echo $form->textField($model,'nama_karyawan',array('maxlength'=>100,'style'=>'width:160px;','placeholder'=>'Nama Karyawan','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>                                                                                                   
                                    <?php echo $form->dropDownList($model,'gelarbelakang', CHtml::listData(Params::getLookup(Params::GELARBELAKANG), 'lookup_nama', 'lookup_nama'),array('empty'=>'--Pilih--','style'=>'width:60px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>    
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nama_keluarga'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'nama_keluarga',array('maxlength'=>50,'style'=>'width:220px','onKeyPress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>   
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'statusperkawinan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'statusperkawinan', CHtml::listData(Params::getLookup(Params::STATUSPERKAWINAN), 'lookup_nama', 'lookup_nama'),array('empty'=>'--Pilih--','style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div> 
                                                           
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jmlanak'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'jmlanak',array('onKeyUp'=>'checkInput(this);','style'=>'width:80px','onKeyPress'=>"return $(this).focusNextInputField(event)")); ?> Orang
                                      </div>
                            </div>
  
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jabatan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'jabatan_id',  CHtml::listData(KJabatanM::model()->findAll(), 'jabatan_id', 'jabatan_nama'),array('empty'=>'--Pilih--','style'=>'width:150px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>         
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jeniskelamin'); ?>
                                 <div class="mws-form-item ">                                            
                                    <?php //echo $form->dropDownList($model,'jeniskelamin', CHtml::listData(Params::getLookup(Params::JENISKELAMIN), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:210px;')); ?>                                                                                         
                                    <?php //echo $form->radioButtonListInlineRow($modPasien, 'jeniskelamin', Params::getLookup(Params::JENISKELAMIN), array()); ?>    
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
                                               </td>",'onKeyPress'=>"return $(this).focusNextInputField(event)"));
                                              ?>
                                           </tr>
                                    </table>
                                      </div>
                            </div>       
      
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tgllahir_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'tempatlahir_karyawan',array('maxlength'=>30,'style'=>'width:100px;','placeholder'=>'Tempat Lahir','onKeyPress'=>"return $(this).focusNextInputField(event)")); ?>
                                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tgllahir_karyawan',
                                        'name'=>'tgllahir_karyawan',
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
                                <?php echo $form->dropDownList($model,'agama', CHtml::listData(Params::getLookup(Params::AGAMA), 'lookup_nama', 'lookup_nama'),array('empty'=>'--Pilih--','style'=>'width:150px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                </div>
                            </div>
                            <div class="mws-form-row">
                            <?php echo $form->labelEx($model,'pendidikan_id'); ?>
                                <div class="mws-form-item ">                                             
                            <?php echo $form->dropDownList($model,'pendidikan_id', CHtml::listData(KPendidikanM::model()->findAll(), 'pendidikan_id', 'pendidikan_nama'),array('empty'=>'--Pilih--','style'=>'width:150px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                              </div>
                            </div>   
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'alamatemail'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'alamatemail',array('size'=>25,'maxlength'=>50,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            
                              
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nomobile_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'nomobile_karyawan',array('onKeyUp'=>'checkInput(this);','maxlength'=>50,'style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'notelp_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'notelp_karyawan',array('onKeyUp'=>'checkInput(this);','maxlength'=>50,'style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jurusan_id'); ?>
                               <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'jurusan_id',  CHtml::listData(KJurusanM::model()->findAll(), 'jurusan_id', 'jurusan_nama'),array('empty'=>'--Pilih--','style'=>'width:150px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'alamat_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($model,'alamat_karyawan',array('rows'=>6, 'cols'=>40,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'kodepos'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'kodepos',array('onKeyUp'=>'checkInput(this);', 'size'=>10,'maxlength'=>50,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'propinsi_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->dropDownList($model,'propinsi_id', CHtml::listData(KPropinsiM::model()->findAll(), 'propinsi_id', 'propinsi_nama'),array('empty'=>'--Pilih--','style'=>'width:150px')); 
                                      echo $form->dropDownList($model,'propinsi_id', CHtml::listData(KPropinsiM::model()->getPropinsiItems(), 'propinsi_id', 'propinsi_nama'), 
                                      array('style'=>'width:120px','empty'=>'-- Pilih --', 'onkeypress'=>"return $(this).focusNextInputField(event)", 
                                            'ajax'=>array('type'=>'POST',
                                                          'url'=>Yii::app()->createUrl('ActionDynamic/GetKabupaten',array('encode'=>false,'namaModel'=>get_class($model),'attr'=>'propinsi_id')),
                                                          'update'=>'#KKaryawanM_kabupatenkota_id',
                                                        ),
                                            )); 
                                      ?>
                                      </div>
                            </div>        
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'kabupatenkota_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->dropDownList($model,'kabupatenkota_id', CHtml::listData(KKabupatenkotaM::model()->findAll(),'kabupatenkota_id', 'kabupatenkota_nama'),array('empty'=>'--Pilih--','style'=>'width:150px')); 
                                         echo $form->dropDownList($model,'kabupatenkota_id',CHtml::listData(KPropinsiM::model()->getKabupatenItems($model->propinsi_id), 'kabupatenkota_id', 'kabupatenkota_nama'),
                                            array('style'=>'width:120px','empty'=>'-- Pilih --', 'onkeypress'=>"return $(this).focusNextInputField(event)",
                                            'ajax'=>array('type'=>'POST',
                                                         ),
                                            )); 
                                    ?>
                                      </div>
                            </div>
                            
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'warganegara_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'warganegara_karyawan', CHtml::listData(Params::getLookup(Params::WARGANEGARA), 'lookup_nama', 'lookup_nama'),array('empty'=>'--Pilih--','style'=>'width:100px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                   
                             </td>
                            <td>   
                              <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'departement_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'departement_id', CHtml::listData(KDepartementM::model()->findAll(), 'departement_id', 'departement_nama'),array('empty'=>'--Pilih--','style'=>'width:150px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>    
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'subdepartement_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'subdepartement_id', CHtml::listData(KSubdepartementM::model()->findAll(), 'subdepartement_id', 'subdepartement_nama'),array('empty'=>'--Pilih--','style'=>'width:150px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>        
                           
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'golongan_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'golongan_id', CHtml::listData(KGolonganM::model()->findAll(), 'golongan_id', 'golongan_nama'),array('empty'=>'-Pilih--','style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'lokasi_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'lokasi_id', CHtml::listData(KLokasiM::model()->findAll(), 'lokasi_id', 'lokasi_nama'),array('empty'=>'--Pilih--','style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                
<!--                           <div class="mws-form-row">
                                    <?php //echo $form->labelEx($model,'pelamar_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php //echo $form->dropDownList($model,'pelamar_id', CHtml::listData(KPelamarT::model()->findAll(), 'pelamar_id', 'nama_pelamar'),array('empty'=>'')); ?>
                                      </div>
                            </div> -->
                                
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($model,'tgllowongan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php /*$this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tgllowongan',
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
//                                      'readonly'=>true,

                                        ),
                                        ));*/ ?>
                                      </div>
                            </div>-->
                                   
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nomorindukkaryawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'nomorindukkaryawan',array('onKeyUp'=>'checkInput(this);','maxlength'=>50,'style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'npwp'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'npwp',array('onKeyUp'=>'checkInput(this);','maxlength'=>50,'style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'golongandarah'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'gelardepan', CHtml::listData(Params::getLookup(Params::GOLONGANDARAH), 'lookup_nama', 'lookup_nama'),array('empty'=>'--Pilih--','style'=>'width:100px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'rhesus'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->dropDownList($model,'gelardepan', CHtml::listData(Params::getLookup(Params::RHESUS), 'lookup_nama', 'lookup_nama'),array('empty'=>'')); ?>
                                       <table>
                                           <tr>
                                            <?php 
                                            echo $form->radioButtonList(
                                                    $model,
                                                    'rhesus', 
                                                    array('RH+'=>'RH+', 'RH-'=>'RH-'),
                                                    array( 'template'=>"
                                                     <td>
                                                         {input}
                                                    </td>
                                                    <td>
                                                         {label}
                                                   </td>",'onKeyPress'=>"return $(this).focusNextInputField(event)"));
                                              ?>
                                           </tr>
                                    </table>
                                    </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'kategorikaryawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'kategorikaryawan',array('maxlength'=>10,'style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'no_jamsostek'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'no_jamsostek',array('maxlength'=>100,'style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'namabank'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'namabank',array('maxlength'=>50,'style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'norekeningbank'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'norekeningbank',array('onKeyUp'=>'checkInput(this);','maxlength'=>100,'style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                                
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($model,'tglkeluar'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php /* $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tglkeluar',
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
//                                      'readonly'=>true,

                                        ),
                                        )); */?>
                                      </div>
                            </div>-->
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'no_fingerprint'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'no_fingerprint',array('onKeyUp'=>'checkInput(this);','maxlength'=>30,'style'=>'width:180px','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'photo_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo Chtml::activeFileField($model,'photo_karyawan',array('maxlength'=>254,'Hint'=>'Isi Jika Akan Menambahkan Logo','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>   
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($model,'pphditanggungperusahaan'); ?>
                                     <div class="mws-form-item small">                                            
                                    <?php //echo $form->checkBox($model,'pphditanggungperusahaan'); ?>
                                      </div>
                            </div>    
                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($model,'karyawan_aktif'); ?>
                                     <div class="mws-form-item small">                                            
                                    <?php //echo $form->checkBox($model,'karyawan_aktif'); ?>
                                      </div>
                            </div>-->
                                </td>
                               </tr>
                               </table>
                             
                 <div class="mws-button-row">
                    <?php echo Chtml::link('Back',$url='index.php?r=sistemAdministrator/modul/admin', array('class' => 'mws-button gray left'));                    
                    echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'mws-button blue', 'type'=>'submit', 'onKeyPress'=>'return formSubmit(this,event)'));                    
                    echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>
                </div>
                <?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div><!-- form -->
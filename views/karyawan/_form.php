<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');?>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-list">Form Karyawan</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'kkaryawan-m-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions'=>array('onKeyPress'=>'return disableKeyPress(event)'),
                )); ?>

	<div class="mws-form-message info">Bagian dengan tanda <span class="required">*</span> harus diisi.</div>
                 <?php
                        if ($form->errorSummary($model)) {
                        echo '<div class="mws-form-message error">' . $form->errorSummary($model) . '</div>';
                        }
                 ?>  
                  <?php  if(Yii::app()->user->hasFlash('status')): ?>
 
                    <div class="flash-success">
                    <?php echo Yii::app()->user->getFlash('status'); ?>
                    </div>

                 <?php endif; ?>                
                <div class="mws-form-inline">    
                       <table>
                           <tr>
                               <td >
                                   <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tglditerima'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tglditerima',
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
                                        )); 
                                   ?>
                                      </div>
                            </div>  
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jenisidentitas'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'jenisidentitas', CHtml::listData(Params::getLookup(Params::JENISIDENTITAS), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:60px;')); ?>
                                      <?php echo $form->textField($model,'noidentitas',array('maxlength'=>100, 'placeholder'=>'No Identitas','empty'=>'','style'=>'width:100px;')); ?>
                                     </div>    
                                     
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nama_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'gelardepan', CHtml::listData(Params::getLookup(Params::GELARDEPAN), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:60px;')); ?>                                                                                                                                    
                                    <?php echo $form->textField($model,'nama_karyawan',array('maxlength'=>100,'style'=>'width:160px;')); ?>                           
                                    <?php echo $form->dropDownList($model,'gelarbelakang', CHtml::listData(Params::getLookup(Params::GELARBELAKANG), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:60px;')); ?>    
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nama_keluarga'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'nama_keluarga',array('size'=>15,'maxlength'=>50)); ?>
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
                                                           </td>"));
                                                  ?>
                                           </tr>
                                    </table>
                                      </div>
                            </div>       
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tempatlahir_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'tempatlahir_karyawan',array('size'=>15,'maxlength'=>30)); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tgllahir_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php
                                    $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                                        'model' => $model,
                                        'attribute' => 'tgllahir_karyawan',
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
                                    ));
                                    ?>
                                      </div>
                            </div>       
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jabatan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'jabatan_id',  CHtml::listData(KJabatanM::model()->findAll(), 'jabatan_id', 'jabatan_nama'),array('empty'=>'','style'=>'width:120px;')); ?>
                                      </div>
                            </div>     
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'alamatemail'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'alamatemail',array('size'=>15,'maxlength'=>50)); ?>
                                      </div>
                            </div>
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jurusan_id'); ?>
                               <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'jurusan_id',  CHtml::listData(KJurusanM::model()->findAll(), 'jurusan_id', 'jurusan_nama'),array('empty'=>'','style'=>'width:120px;')); ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'alamat_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textArea($model,'alamat_karyawan',array('rows'=>6, 'cols'=>50)); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'kodepos'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'kodepos',array('size'=>8,'maxlength'=>50)); ?>
                                      </div>
                            </div>
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'propinsi_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'propinsi_id', CHtml::listData(KPropinsiM::model()->findAll(), 'propinsi_id', 'propinsi_nama'),array('empty'=>'','style'=>'width:200px;')); ?>
                                      </div>
                            </div>        
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'kabupatenkota_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'kabupatenkota_id', CHtml::listData(KKabupatenkotaM::model()->findAll(),'kabupatenkota_id', 'kabupatenkota_nama'),array('empty'=>'','style'=>'width:200px;')); ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'departement_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'departement_id', CHtml::listData(KDepartementM::model()->findAll(), 'departement_id', 'departement_nama'),array('empty'=>'','style'=>'width:120px;')); ?>
                                      </div>
                            </div>    
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'subdepartement_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'subdepartement_id', CHtml::listData(KSubdepartementM::model()->findAll(), 'subdepartement_id', 'subdepartement_nama'),array('empty'=>'','style'=>'width:120px;')); ?>
                                      </div>
                            </div>        
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'agama'); ?>
                                 <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'agama', CHtml::listData(Params::getLookup(Params::AGAMA), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:120px;')); ?>
                                      </div>
                            </div>
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'pendidikan_id'); ?>
                                 <div class="mws-form-item ">                                             
                                    <?php echo $form->dropDownList($model,'pendidikan_id', CHtml::listData(KPendidikanM::model()->findAll(), 'pendidikan_id', 'pendidikan_nama'),array('empty'=>'','style'=>'width:120px;')); ?>
                                      </div>
                            </div>      

                             </td>
                            <td>   
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'statusperkawinan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'statusperkawinan', CHtml::listData(Params::getLookup(Params::STATUSPERKAWINAN), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:120px;')); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php  $form->labelEx($model,'lokasi_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php  $form->dropDownList($model,'lokasi_id', CHtml::listData(KLokasiM::model()->findAll(), 'lokasi_id', 'lokasi_nama'),array('empty'=>'','style'=>'width:120px;')); ?>
                                      </div>
                            </div>
                                
<!--                            <div class="mws-form-row">
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
                                        ));*/ 
                                    ?>
                                      </div>
                            </div>-->
                                 
<!--                            <div class="mws-form-row">
                                    <?php $form->labelEx($model,'nomorindukkaryawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $form->textField($model,'nomorindukkaryawan',array('size'=>15,'maxlength'=>50)); ?>
                                      </div>
                            </div>-->

                                
                            <div class="mws-form-row">
                                    <?php  $form->labelEx($model,'npwp'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php  $form->textField($model,'npwp',array('size'=>15,'maxlength'=>50)); ?>
                                      </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jmlanak'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'jmlanak',array('size'=>5)); ?>
                                      </div>
                            </div>
  
                            <div class="mws-form-row">
                                    <?php  $form->labelEx($model,'golongandarah'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php  $form->dropDownList($model,'golongandarah', CHtml::listData(Params::getLookup(Params::GOLONGANDARAH), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:120px;')); ?>
                                      </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php  $form->labelEx($model,'rhesus'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php  $form->dropDownList($model,'rhesus', CHtml::listData(Params::getLookup(Params::RHESUS), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:120px;')); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nomobile_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'nomobile_karyawan',array('size'=>15,'maxlength'=>50)); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'notelp_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'notelp_karyawan',array('size'=>15,'maxlength'=>50)); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'warganegara_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model,'warganegara_karyawan', CHtml::listData(Params::getLookup(Params::WARGANEGARA), 'lookup_nama', 'lookup_nama'),array('empty'=>'','style'=>'width:120px;')); ?>
                                      </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php  $form->labelEx($model,'kategorikaryawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php  $form->textField($model,'kategorikaryawan',array('size'=>15,'maxlength'=>10)); ?>
                                      </div>
                            </div>

                            <div class="mws-form-row">
                                    <?php $form->labelEx($model,'no_jamsostek'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php  $form->textField($model,'no_jamsostek',array('size'=>15,'maxlength'=>100)); ?>
                                      </div>
                            </div>
                                
                            <div class="mws-form-row">
                                    <?php  $form->labelEx($model,'namabank'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php $form->textField($model,'namabank',array('size'=>15,'maxlength'=>50)); ?>
                                      </div>
                            </div>

                                
                            <div class="mws-form-row">
                                    <?php  $form->labelEx($model,'norekeningbank'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php  $form->textField($model,'norekeningbank',array('size'=>15,'maxlength'=>100)); ?>
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
//                                       'readonly'=>true,
                                        ),
                                        )); */
                                    ?>
                                      </div>
                            </div>-->
                                
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($model,'no_fingerprint'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($model,'no_fingerprint',array('size'=>25,'maxlength'=>30, 'onblur'=>'cekFingerPrint();', 'class'=>'mws-textinput')); ?>
                                      </div>
                            </div>-->
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'photo_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo Chtml::activeFileField($model,'photo_karyawan',array('maxlength'=>254,'Hint'=>'Isi Jika Akan Menambahkan Logo')); ?>
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
                    <?php echo Chtml::link('Back',Yii::app()->createUrl($this->module->id.'/'.$this->id.'/admin'), array('class' => 'mws-button gray left'));                    
                    echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Create', array('class' => 'mws-button blue','type'=>'submit', 'onKeyPress'=>'return formSubmit(this,event)'));                    
                    echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); 
                    ?>
                </div>   
                <?php $this->endWidget(); ?>
            </div>
        </div>    	
    </div><!-- form -->
    
    
<?php 
    
Yii::app()->clientScript->registerScript('onheadfungsi','
        function cekFingerPrint(){
            finger = $("#'.CHtml::activeId($model, 'no_fingerprint').'").val();
            if (finger != ""){
                $.post("'.Yii::app()->createUrl('actionAjax/cekFinger').'",{finger:finger, '.(($model->isNewRecord) ? '' : 'karyawan : '.$model->karyawan_id).'},function(data){
                    if (data != 1){
                        alert("No Finger Print telah diset untuk Karyawan lain");
                        $("#'.CHtml::activeId($model, 'no_fingerprint').'").val("");
                        $("#'.CHtml::activeId($model, 'no_fingerprint').'").focus();
                        $("#'.CHtml::activeId($model, 'no_fingerprint').'").addClass("error");
                    }
                });
            }
        }
',  CClientScript::POS_HEAD); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js'); ?>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-list">Kelola Data Karyawan</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'kkaryawan-m-form',
                        'enableAjaxValidation'=>false,
                         'htmlOptions'=>array('enctype'=>'multipart/form-data','onKeyPress'=>'return disableKeyPress(event)'),
                )); ?>

	<div class="mws-form-message info">Fields with <span class="required">*</span> are required.</div>
                 <?php
                    if ($form->errorSummary($model)) {
                    echo '<div class="mws-form-message error">' . $form->errorSummary($model) . '</div>';
                    }
                ?>        
            <br/>
                <div class="mws-form-inline">    
                       <table>
                           <tr>
                               <td > 
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nomorindukkaryawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'nomorindukkaryawan',array('size'=>25,'maxlength'=>50,'readonly'=>true,'style'=>'width:160px;','onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>       
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nama_karyawan'); ?>
                                      <div class="mws-form-item ">                                           
                                            <?php echo $form->textField($model,'gelardepan',array('empty'=>'','style'=>'width:60px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                            <?php echo $form->textField($model,'nama_karyawan',array('maxlength'=>100,'style'=>'width:160px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?> 
                                            <?php echo $form->textField($model,'gelarbelakang',array('empty'=>'','style'=>'width:60px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>    
                                      </div>
                            </div>
                           
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jeniskelamin'); ?>
                                 <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'jeniskelamin',array('empty'=>'','style'=>'width:160px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>    
                                      </div>
                            </div>
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tempatlahir_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'tempatlahir_karyawan',array('style'=>'width:160px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                             </td><td>
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tgllahir_karyawan'); ?>
                                     <div class="mws-form-item ">                                           
                                    <?php echo $form->textField($model,'tgllahir_karyawan',array('style'=>'width:110px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div> 
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'statusperkawinan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'statusperkawinan',array('style'=>'width:110px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div> 
                           <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'agama'); ?>
                                 <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'agama',array('style'=>'width:110px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nomobile_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'nomobile_karyawan',array('style'=>'width:110px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                             <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'notelp_karyawan'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'notelp_karyawan',array('style'=>'width:110px;','readonly'=>true,'onkeypress'=>"return $(this).focusNextInputField(event)")); ?>
                                      </div>
                            </div>
                            </td>
                            <td style="width:200px;height:200px;">
                                <img src="<?php echo Params::urlIconModulThumbsDirectory().'kecil_'.$model->photo_karyawan; ?>" width="200" height=200" > 
                            </td>
                        </tr>
                    </table>
              </div>
           <?php $this->endWidget(); ?>
<hr/>
<div class="tab">
   <!-- <ul>
        <li class="tab"><a title="Pendidikan Karyawan"href="<?php echo $this->createUrl('karyawan/pendidikanKaryawan/id/'.$model->karyawan_id)?>">Pendidikan Karyawan</a></li>
        <li class="tab"><a title="Pengalaman Kerja"href="<?php echo $this->createUrl('karyawan/pengalamanKerja/id/'.$model->karyawan_id)?>">Pengalaman Kerja</a></li>
        <li class="tab"><a title="Mutasi"href="<?php echo $this->createUrl('karyawan/mutasi/id/'.$model->karyawan_id)?>">Mutasi</a></li>
        <li class="tab"><a title="Cuti Karyawan"href="<?php echo $this->createUrl('karyawan/cuti/id/'.$model->karyawan_id)?>">Cuti Karyawan</a></li>
        <li class="tab"><a title="Jenjang Karir"href="<?php echo $this->createUrl('karyawan/jenjangKarir/id/'.$model->karyawan_id)?>">Jenjang Karir</a></li>
        <li class="tab"><a title="Kontrak Kerja"href="<?php echo $this->createUrl('karyawan/kontrak/id/'.$model->karyawan_id)?>">Kontrak Kerja</a></li>
        <li class="tab"><a title="Prestasi Kerja"href="<?php echo $this->createUrl('karyawan/prestasiKerja/id/'.$model->karyawan_id)?>">Prestasi Kerja</a></li>
        <li class="tab"><a title="Surat Peringatan"href="<?php echo $this->createUrl('karyawan/suratPeringatan/id/'.$model->karyawan_id)?>">Surat Peringatan</a></li>
    </ul>-->
   <?php 
   
$this->widget('zii.widgets.CMenu',array(
                                'items'=>array(
                                        array('label'=>'Pendidikan Karyawan', 'url'=>array('/kepegawaian/karyawan/pendidikanKaryawan/id/'.$model->karyawan_id),'active'=>$this->id=='pendidikanKaryawan'?true:false),
                                        array('label'=>'Pengalaman Kerja', 'url'=>array('/kepegawaian/karyawan/pengalamanKerja/id/'.$model->karyawan_id),'active'=>$this->id=='pengalamanKerja'?true:false),
                                        array('label'=>'Mutasi', 'url'=>array('/kepegawaian/karyawan/mutasi/id/'.$model->karyawan_id),'active'=>$this->id=='mutasi'?true:false),
                                        array('label'=>'Cuti Karyawan', 'url'=>array('/kepegawaian/karyawan/cuti/id/'.$model->karyawan_id),'active'=>$this->id=='cuti'?true:false),
                                        array('label'=>'Jenjang Karir', 'url'=>array('/kepegawaian/karyawan/jenjangKarir/id/'.$model->karyawan_id),'active'=>$this->id=='jenjangKarir'?true:false),
                                        array('label'=>'Kontrak Kerja', 'url'=>array('/kepegawaian/karyawan/kontrak/id/'.$model->karyawan_id),'active'=>$this->id=='kontrak'?true:false),
                                        array('label'=>'Prestasi Kerja', 'url'=>array('/kepegawaian/karyawan/prestasiKerja/id/'.$model->karyawan_id),'active'=>$this->id=='prestasiKerja'?true:false),
                                        array('label'=>'Surat Peringatan', 'url'=>array('/kepegawaian/karyawan/suratPeringatan/id/'.$model->karyawan_id),'active'=>$this->id=='suratPeringatan'?true:false),
                                ),
        ));
    ?>
</div>

<hr>
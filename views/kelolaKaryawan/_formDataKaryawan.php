<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js'); ?>

    <div class="mws-panel-header">
        <span class="mws-i-24 i-list">Kelola Data Karyawan</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'kkaryawan-m-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions'=>array('enctype'=>'multipart/form-data','onKeyPress'=>"return disableKeyPress(event)"),
                        'clientOptions'=>array('validateOnSubmit'=>true), //enable event client  ajax validation on submit
                )); ?>

	<div class="mws-form-message info">Bagian dengan tanda <span class="required">*</span> harus diisi.</div>
                 <?php
                        if ($form->errorSummary($model)) {
                        echo '<div class="mws-form-message error">' . $form->errorSummary($model) . '</div>';
                        }
                 ?>        
            <br/>
                <div class="mws-form-inline">    
                       <table>
                           <tr>
                               <td>
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
                        <tr>
                            <td colspan="3">
                                <div class="mws-form" style="text-shadow: 1px 1px 0px #eee, 3px 3px 3px #707070;font-size:18px;color:#A3B30A;font-weight:bold;">
                                <?php echo CHtml::checkBox('showhideRiwayat',false,array('onchange'=>'tabelRiwayatkaryawan()','style'=>'margin-left:36px;float:left;cursor:pointer;')).' Riwayat karyawan'; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
              </div>
           <?php $this->endWidget(); ?>
        </div>
        <div class="hide" id="tabelRiwayatkaryawan" style="font-size:11px;">
            <?php $this->renderPartial('_tabelPendidikankaryawan',array()); ?>
            <?php $this->renderPartial('_tabelPengalamankerja',array()); ?>
            <?php $this->renderPartial('_tabelMutasi',array()); ?>
            <?php $this->renderPartial('_tabelCutikaryawan',array()); ?>
            <?php $this->renderPartial('_tabelKomponengaji',array()); ?>
        </div>
    </div>
<script type="text/javascript">
    function tabelRiwayatkaryawan() {
        if ($('#showhideRiwayat').is(':checked'))
        {
            $('#tabelRiwayatkaryawan').show();
        } else {
            $('#tabelRiwayatkaryawan').hide();
        }
    }
    
    function konfirmasi() {
        if(!confirm("Anda yakin akan menghapus item ini ?")){
            return false;
        } else {
                        

        }
    }
</script>
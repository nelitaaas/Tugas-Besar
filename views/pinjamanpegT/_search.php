<div class="mws-panel mws-collapsible2">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-magnifying-glass-2">Pencarian Pinjam Karyawan </span>
    </div>
    <div class="mws-panel-body2">
        <div class="mws-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<div class="mws-form-inline">       
                        <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'karyawan_id'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo $form->dropDownList($model,'karyawan_id',CHtml::listData($model->getKaryawanItems(),'karyawan_id','nama_karyawan'),array('empty'=>'-- Pilih --','style'=>'width:110px')); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'komponengaji_id'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo $form->dropDownList($model,'komponengaji_id',CHtml::listData($model->getKomponenGajiItems(),'komponengaji_id','komponengaji_nama'),array('empty'=>'-- Pilih --','style'=>'width:110px')); ?>
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
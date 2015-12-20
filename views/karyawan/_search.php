<div class="mws-panel mws-collapsible2">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-magnifying-glass-2">Pencarian Karyawan</span>
    </div>
    <div class="mws-panel-body2">
        <div class="mws-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
                'id'=>'kkaryawan-m-form',
)); ?>
<div class="mws-form-inline">
                <table>
                    <tr>
                        <td>
                        <div class="mws-form-row">
		<?php echo $form->label($model,'nomorindukkaryawan'); ?>
                                 <div class="mws-form-item ">		
                <?php echo $form->textField($model,'nomorindukkaryawan',array('size'=>15,'maxlength'=>50,'class'=>'mws-textinput')); ?>
                                </div>
                       </div> 
                       <div class="mws-form-row">
		<?php echo $form->label($model,'jenisidentitas'); ?>
                                 <div class="mws-form-item ">		
                <?php echo $form->textField($model,'jenisidentitas',array('size'=>15,'maxlength'=>50,'class'=>'mws-textinput')); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'noidentitas'); ?>
                                 <div class="mws-form-item ">		
                <?php echo $form->textField($model,'noidentitas',array('size'=>15,'maxlength'=>100,'class'=>'mws-textinput')); ?>
                                </div>
                       </div> 
                        <div class="mws-form-row">
		<?php echo $form->label($model,'nama_karyawan'); ?>
                                 <div class="mws-form-item ">		
                <?php echo $form->textField($model,'nama_karyawan',array('size'=>15,'maxlength'=>100,'class'=>'mws-textinput')); ?>
                                </div>
                       </div> 
                        <div class="mws-form-row">
		<?php echo $form->label($model,'pendidikan_id'); ?>
                                 <div class="mws-form-item ">		
                <?php echo $form->dropDownList($model,'pendidikan_id', CHtml::listData(KPendidikanM::model()->findAll(), 'pendidikan_id', 'pendidikan_nama'), array('empty'=>'','style'=>'width:160px')); ?>
                                </div>
                       </div>  
                       <div class="mws-form-row">
		<?php echo $form->label($model,'jurusan_id'); ?>
                                 <div class="mws-form-item ">		
                <?php echo $form->dropDownList($model,'jurusan_id', CHtml::listData(KJurusanM::model()->findAll(), 'jurusan_id', 'jurusan_nama'), array('empty'=>'','style'=>'width:160px')); ?>
                                </div>
                       </div>  
                         </td>
                          <td>  
                        <div class="mws-form-row">
		<?php echo $form->label($model,'kabupatenkota_id'); ?>
                                 <div class="mws-form-item ">		
                <?php echo $form->dropDownList($model,'kabupatenkota_id', CHtml::listData(KKabupatenkotaM::model()->findAll(), 'kabupatenkota_id', 'kabupatenkota_nama'), array('empty'=>'','style'=>'width:160px')); ?>
                                </div>
                       </div>     
<!--                        <div class="mws-form-row">-->
		<?php // echo $form->label($model,'golongan_id'); ?>
<!--                                 <div class="mws-form-item ">		-->
                <?php // echo $form->dropDownList($model,'golongan_id', CHtml::listData(KGolonganM::model()->findAll(), 'golongan_id', 'golongan_nama'), array('empty'=>'','style'=>'width:160px')); ?>
<!--                                </div>
                       </div>     -->
                        <div class="mws-form-row">
		<?php echo $form->label($model,'lokasi_id'); ?>
                                 <div class="mws-form-item ">		
                <?php echo $form->dropDownList($model,'lokasi_id', CHtml::listData(KLokasiM::model()->findAll(), 'lokasi_id', 'lokasi_nama'), array('empty'=>'','style'=>'width:160px')); ?>
                                </div>
                       </div>     
                        <div class="mws-form-row">
		<?php echo $form->label($model,'jabatan_id'); ?>
                                 <div class="mws-form-item ">		
                <?php echo $form->dropDownList($model,'jabatan_id', CHtml::listData(KJabatanM::model()->findAll(), 'jabatan_id', 'jabatan_nama'), array('empty'=>'','style'=>'width:160px')); ?>
                                </div>
                       </div>      
                         <div class="mws-form-row">
		<?php echo $form->label($model,'departement_id'); ?>
                                 <div class="mws-form-item ">		
                <?php echo $form->dropDownList($model,'departement_id', CHtml::listData(KDepartementM::model()->findAll(), 'departement_id', 'departement_nama'), array('empty'=>'','style'=>'width:160px')); ?>
                                </div>
                       </div>   
                        <div class="mws-form-row">
		<?php echo $form->label($model,'subdepartement_id'); ?>
                            <div class="mws-form-item ">		
                <?php echo $form->dropDownList($model,'subdepartement_id', CHtml::listData(KSubdepartementM::model()->findAll(), 'subdepartement_id', 'subdepartement_nama'), array('empty'=>'','style'=>'width:160px')); ?>
                                </div>
                       </div>  
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
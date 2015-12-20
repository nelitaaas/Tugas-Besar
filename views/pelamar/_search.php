<div class="mws-panel mws-collapsible2">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-magnifying-glass-2">Pencarian Calon Karyawan</span>
    </div>
    <div class="mws-panel-body2">
        <div class="mws-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
                'id'=>'kpelamar-t-form',
)); ?>
<div class="mws-form-inline">
                <table>
                    <tr>
                        <td>
                            <div class="mws-form-row">
                                 <?php echo $form->label($model,'noidentitas'); ?>
                                 <div class="mws-form-item ">		
                                      <?php echo $form->textField($model,'noidentitas',array('size'=>10,'maxlength'=>100,'class'=>'mws-textinput')); ?>
                                 </div>
                           </div>

                            <div class="mws-form-row">
                                 <?php echo $form->label($model,'nama_pelamar'); ?>
                                 <div class="mws-form-item ">		
                                      <?php echo $form->textField($model,'nama_pelamar',array('size'=>15,'maxlength'=>100,'class'=>'mws-textinput')); ?>
                                 </div>
                           </div>    

                           <div class="mws-form-row">
                                <?php echo $form->label($model,'departement_id'); ?>
                                <div class="mws-form-item ">		
                                     <?php echo $form->dropDownList($model,'departement_id', CHtml::listData(KDepartementM::model()->findAll(), 
                                                                    'departement_id', 'departement_nama'), array('empty'=>'','style'=>'width:130px')); ?>
                                </div>
                           </div>
                            
                        </td>
                        <td>
                           <div class="mws-form-row">
                                <?php echo $form->label($model,'jabatan_id'); ?>
                                <div class="mws-form-item ">		
                                     <?php echo $form->dropDownList($model,'jabatan_id', CHtml::listData(KJabatanM::model()->findAll(), 
                                                                    'jabatan_id', 'jabatan_nama'), array('empty'=>'','style'=>'width:130px')); ?>
                                </div>
                           </div> 
                            
                            <div class="mws-form-row">
                                 <?php echo $form->label($model,'alamat_pelamar'); ?>
                                 <div class="mws-form-item ">		
                                      <?php echo $form->textArea($model,'alamat_pelamar',array('rows'=>6, 'cols'=>20)); ?>
                                 </div>
                           </div>  
                       </td>
                   </tr>
               </table>
                           
	<div class="mws-button-row">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Search' : 'Save', array('class' => 'mws-button blue')); ?>
            <?php echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>	
        </div>

<?php $this->endWidget(); ?>
            </div>
        </div>    	
    </div>
</div><!-- search-form -->
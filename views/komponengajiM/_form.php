<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'komponengaji-m-form',
                        'enableAjaxValidation'=>false,
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
                                    
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'komponengaji_kode'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo $form->textField($model,'komponengaji_kode',array('size'=>50,'maxlength'=>50,'class'=>'digit-medium')); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'komponengaji_nama'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo $form->textField($model,'komponengaji_nama',array('size'=>30,'maxlength'=>100)); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'komponengaji_singkt'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo $form->textField($model,'komponengaji_singkt',array('size'=>15,'maxlength'=>20)); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'isgaji'); ?>
                                     <div class="mws-form-item small">                                            
                                         <?php echo CHtml::radioButton('KomponengajiM[is]',true, array('value'=>'isgaji')); ?>
                                        <?php //echo $form->radioButton($model,'isgaji', array('value'=>'isgaji')); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'ispotongan'); ?>
                                     <div class="mws-form-item small">                                            
                                         <?php echo CHtml::radioButton('KomponengajiM[is]',true, array('value'=>'ispotongan')); ?>
                                        <?php //echo $form->radioButton($model,'isgaji', array('value'=>'ispotongan')); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nourut'); ?>
                                     <div class="mws-form-item ">                                           
                                        <?php echo $form->textField($model,'nourut',array('class'=>'digit2')); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'komponengaji_aktif'); ?>
                                     <div class="mws-form-item small">                                            
                                    <?php echo $form->checkBox($model,'komponengaji_aktif'); ?>
                                      </div>
                            </div>
                               
                                     </td>
                   </tr>
               </table>
                 <div class="mws-button-row">
                    <?php
                    echo Chtml::link('Back',$url='index.php?r=sistemAdministrator/komponengajiM/admin', array('class' => 'mws-button gray left'));
                    echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Create', array('class' => 'mws-button blue'));
                    echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>

                </div>   
                    
                <?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div><!-- form -->
<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'penggajiandetail-t-form',
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
                                    <?php echo $form->labelEx($model,'karykomponen_m'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'karykomponen_m'); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'penggajian_id'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'penggajian_id'); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jumlah'); ?>
                                     <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model,'jumlah'); ?>
                                      </div>
                            </div>
                               
                         </td>
                   </tr>
               </table>
                 <div class="mws-button-row">
              <?php      
                  echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'mws-button blue'));                                           
                  echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); 
              ?>
                </div> 
                <?php $this->endWidget(); ?>
            </div>
        </div>    	
    </div><!-- form -->
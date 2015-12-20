<div class="mws-panel mws-collapsible2">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-magnifying-glass-2">Pencarian Jabatan</span>
    </div>
    <div class="mws-panel-body2">
        <div class="mws-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get','id'=>'cariSearch'
)); ?>
<div class="mws-form-inline">
    <table>
        <tr>
            <td>
                
                <div class="mws-form-row">
                     <?php echo $form->label($model,'jabatan_nama'); ?>
                     <div class="mws-form-item ">		
                          <?php echo $form->textField($model,'jabatan_nama',array('size'=>15,'maxlength'=>50, 
                                                      'onkeypress'=>'return $(this).focusNextInputField(event);','class'=>'mws-textinput')); ?>
                    </div>
               </div>
                
                <div class="mws-form-row">
                     <?php echo $form->label($model,'jabatan_aktif'); ?>
                     <div class="mws-form-item small">		
                          <?php echo $form->checkBox($model,'jabatan_aktif', array('onkeypress'=>'return $(this).focusNextInputField(event);','checked'=>'checked')); ?>
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
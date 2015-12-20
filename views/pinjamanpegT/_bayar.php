<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'penerimaankas-t-form',
                'enableAjaxValidation' => false,
                    ));
            ?>

            <?php  
            if  (Yii::app()->user->hasFlash('error')){ ?>
                <div class="mws-form-message error">
                    <?php echo Yii::app()->user->getFlash('error'); ?>
                </div>
            <?php } else if (Yii::app()->user->hasFlash('success')) { ?>
                <div class="mws-form-message success">
                    <?php echo Yii::app()->user->getFlash('success'); ?>
                </div>
            <?php } else { ?>
                <div class="mws-form-message info">Bagian dengan tanda <span class="required">*</span> harus diisi.</div>
            <?php } ?>
            
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
                                <?php echo $form->labelEx($model, 'tglpenerimaan'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php
                                    $this->widget('MyDateTimePicker', array(
                                        'model' => $model,
                                        'attribute' => 'tglpenerimaan',
                                        'language' => '',
                                        'mode' => 'date', //use "time","date" or "datetime" (default)
                                        'options' => array(
                                            'dateFormat' => 'yy-mm-dd',
                                            'changeYear' => true,
                                            'changeMonth' => true,
                                            'yearRange' => '-70y:+4y',
                                            'showSecond' => false,
                                            'showDate' => false,
                                            'showMonth' => false,
                                            'timeFormat' => 'hh:mm:ss',
                                        ),
                                        'htmlOptions' => array(
                                            'readonly'=>true,
                                            'style'=>'width:150px;',
                                        ),
                                    ));
                                    ?>
                                </div>
                            </div>
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'nostruk'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->hiddenField($model, 'penerimaankas_id', array('size' => 20, 'maxlength' => 50, 'class'=>'mws-textinput')); ?>
                                    <?php echo $form->textField($model, 'nostruk', array('size' => 20, 'maxlength' => 50, 'class'=>'mws-textinput')); ?>
                                </div>
                            </div>
                                    
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'uangditerima'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model, 'uangditerima', array('class'=>'mws-textinput numbersOnly', 'onkeyup'=>'setKembalian();')); ?>
                                </div>
                            </div>

                            </td>
                            <td>
                            
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'peg_penerima'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php //echo $form->textField($model, 'peg_penerima', array('size' => 20, 'maxlength' => 100,'class'=>'mws-textinput')); ?>
                                    <?php //echo $form->labelEx($model,'peg_penerima'); ?>
                                     <div class="mws-form-item ">                                            
                                                <?php $this->widget('MyJuiAutoComplete', array(
                                                   'attribute'=>'peg_penerima',
                                                    'model'=>$model,
                                                    'source'=>'js: function(request, response) {
                                                           $.ajax({
                                                               url: "'.Yii::app()->createUrl('ActionAutoComplete/KaryawanGetID').'",
                                                               dataType: "json",
                                                               data: {
                                                                   term: request.term,
                                                               },
                                                               success: function (data) {
                                                                       response(data);
                                                               }
                                                           })
                                                        }',
                                                    'options'=>array(
                                                               'showAnim'=>'fold',
                                                               'minLength' => 2,
                                                               'focus'=> 'js:function( event, ui )
                                                                   {
                                                                    $(this).val(ui.item.label);
                                                                    return false;
                                                                    submitGetKarykomponen();
                                                                    }',
                                                               'select'=>'js:function( event, ui ) {
                                                                   $(\'#PenerimaankasT_peg_penerima\').val(ui.item.label);
                                                                    return false;
                                                                }',
                                                    ),
                                                    'htmlOptions'=>array(
                                                        'readonly'=>false,
                                                        'placeholder'=>'Nama Karyawan',
                                                        'size'=>'17',
                                                        'onkeypress'=>"return $(this).focusNextInputField(event);",
                                                    ),
                                                    'tombolDialog'=>array('idDialog'=>'dialogPegpengeluaran',),
                                            )); ?>
                                </div>
                            </div>
                                <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'jmlbayar'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model, 'jmlbayar', array('readonly'=>true,'class'=>'mws-textinput')); ?>
                                </div>
                            </div>
                                <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'uangkembalian'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($model, 'uangkembalian', array('class'=>'mws-textinput kembalian', 'readonly'=>true)); ?>
                                </div>
                            </div>

                        </td>
                    </tr>
                </table>
                <div class="mws-button-row">
                    <?php
                    if ($model->isNewRecord){
                        echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'mws-button blue')) . ' ';
                        echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green'));
                    }
                    else{
                        echo CHtml::htmlButton(Yii::t('mds','{icon} Print',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button blue right', 'type'=>'button','onclick'=>'print(\'PRINT\')'))."&nbsp&nbsp"; 
                    }
                    
                    ?>

                </div>   
 <?php $this->endWidget(); ?>
            </div>
               
        </div>        
    </div><!-- form -->
    
   <?php
    $this->widget('application.extensions.moneymask.MMask', array(
        'element' => '.numbersOnly',
        'config' => array(
            'defaultZero' => true,
            'allowZero' => true,
            'decimal' => ',',
            'thousands' => '',
            'precision' => 0,
        )
    ));
    ?>

    <?php Yii::app()->clientScript->registerScript('onhead','
        function setKembalian(){
            var bayar = parseFloat($("#'.CHtml::activeId($model, 'jmlbayar').'").val());
            var terima = parseFloat($("#'.CHtml::activeId($model, 'uangditerima').'").val());
            hasil = terima-bayar;
            if (hasil < 0){
                hasil = 0;
            }
            
            $("#'.CHtml::activeId($model, 'uangkembalian').'").val(hasil);
            
        }
', CClientScript::POS_HEAD); ?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'dialogPegpengeluaran',
    'options'=>array(
        'title'=>'Data Karyawan',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>400,
        'height'=>500,
        'resizable'=>false,
    ),
));
        
    $modKaryawan = new KaryawanM;
    $modKaryawan->unsetAttributes();
    if (isset($_GET['KaryawanM'])) {
        $modObatalkes->attributes = $_GET['KaryawanM'];
    }
    $this->widget('zii.widgets.grid.CGridView',array(
        'id'=>'pengeluran-grid',
        'dataProvider'=>$modKaryawan->search(),
        'filter'=>$modKaryawan,
        'template'=>"{pager}{summary}\n{items}",
        'columns'=>array(
            array(
                'header'=>'Pilih',
                'type'=>'raw',
                'value'=>'CHtml::Link("<i class=\"mws-ic-16 ic-accept\"></i>","#",
                                array(
                                        "class"=>"mws-ic-16 ic-accept",
                                        "id" => "selectBarangjadi",
                                        "onClick" => "
                                                              \$(\"#PenerimaankasT_peg_penerima\").val(\"$data->nama_karyawan\");
                                                              \$(\"#dialogPegpengeluaran\").dialog(\"close\");"
                                ))',
            ),
//            array(
//                'name'=>'nomorindukkaryawan',
//            ),
            array(
                'name'=>'nama_karyawan',
            ),
            array(
                'header'=>'Jenis Kelamin',
                'name'=>'jeniskelamin',
            ),
        ),
        'afterAjaxUpdate'=>'function(id, data){jQuery(\''.Params::TOOLTIP_SELECTOR.'\').tooltip({"placement":"'.Params::TOOLTIP_PLACEMENT.'"});}',
    ));
$this->endWidget();

?>
    <?php
$urlPrint=  Yii::app()->createAbsoluteUrl('penjualan/penjualanbrgT/printBayar&id='.$model->penerimaankas_id);
Yii::app()->clientScript->registerScript('onheads', '
    function print(caraPrint){
            window.open("'.$urlPrint.'&caraPrint="+caraPrint,"","location=_new, width=900px");
    }    
', CClientScript::POS_HEAD);
?>
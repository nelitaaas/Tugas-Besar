<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/form.js'); ?>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-list">Presensi</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-form">
            <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'kpresensi-t-form',
                    'enableAjaxValidation' => false,
                        ));
                ?>
            <?php
                if ($form->errorSummary($model)) {
                    echo '<div class="mws-form-message error">' . $form->errorSummary($model) . '</div>';
                }
                else{
                    echo '<div class="mws-form-message info">Bagian dengan tanda  <span class="required">*</span> harus diisi.</div>';
                }
            ?>        
            <div class="mws-form-inline">   
                <table>
                    <tr>
                        <td>
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'no_fingerprint'); ?>
                                <div class="mws-form-item ">   
                                    <?php echo $form->hiddenField($model, 'karyawan_id', array('size' => 30, 'maxlength' => 30, 'onkeypress' => 'return $(this).focusNextInputField(event);', 'class' => 'mws-textinput')); ?>
                                    <?php //echo $form->textField($model, 'no_fingerprint', array('size' => 30, 'maxlength' => 30, 'onkeypress' => 'return $(this).focusNextInputField(event);', 'class' => 'mws-textinput')); ?>
                                    <?php $this->widget('MyJuiAutoComplete', array(
                                           'model'=>$model,
                                            'attribute'=>'no_fingerprint',
                                            'source'=>'js: function(request, response) {
                                                   $.ajax({
                                                       url: "'.Yii::app()->createUrl('ActionAutoComplete/getKaryawanNoFP').'",
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
                                                            }',
                                                       'select'=>'js:function( event, ui ) {
                                                            $("#'.CHtml::activeId($model, 'no_fingerprint').'").val(ui.item.no_fingerprint);
                                                            $("#'.CHtml::activeId($modKaryawan, 'nomorindukkaryawan').'").val(ui.item.nomorindukkaryawan);
                                                            $("#'.CHtml::activeId($modKaryawan, 'gelardepan').'").val(ui.item.gelardepan);
                                                            $("#'.CHtml::activeId($modKaryawan, 'nama_karyawan').'").val(ui.item.nama_karyawan);
                                                            $("#'.CHtml::activeId($modKaryawan, 'gelarbelakang').'").val(ui.item.gelarbelakang);
                                                            $("#'.CHtml::activeId($modKaryawan, 'jeniskelamin').'").val(ui.item.jeniskelamin);
                                                            $("#'.CHtml::activeId($modKaryawan, 'tempatlahir_karyawan').'").val(ui.item.tempatlahir_karyawan);
                                                            $("#'.CHtml::activeId($modKaryawan, 'tgllahir_karyawan').'").val(ui.item.tgllahir_karyawan);
                                                            $("#'.CHtml::activeId($modKaryawan, 'statusperkawinan').'").val(ui.item.statusperkawinan);
                                                            $("#'.CHtml::activeId($modKaryawan, 'nomobile_karyawan').'").val(ui.item.nomobile_karyawan);
                                                            $("#'.CHtml::activeId($modKaryawan, 'notelp_karyawan').'").val(ui.item.notelp_karyawan);
                                                            $("#'.CHtml::activeId($modKaryawan, 'agama').'").val(ui.item.agama);
                                                            $("#'.CHtml::activeId($model, 'karyawan_id').'").val(ui.item.karyawan_id);
                                                            $("#photo_karyawan").attr("src", "'.Params::urlKaryawanThumbsDirectory().'kecil_"+ui.item.photo_karyawan);
                                                            return false;
                                                        }',
                                            ),
                                            'htmlOptions'=>array(
                                                'readonly'=>false,
                                                'size'=>13,
                                                'onkeypress'=>"return $(this).focusNextInputField(event);",
                                            ),
                                            'tombolDialog'=>array('idDialog'=>'dialogKaryawan',),
                                    )); ?>
                                </div>
                            </div>
                            <div class="mws-form-row">
                                <?php  $form->labelEx($modKaryawan, 'nomorindukkaryawan'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php  $form->textField($modKaryawan, 'nomorindukkaryawan', array('size' => 25, 'maxlength' => 50, 'readonly' => true, 'style' => 'width:160px;', 'onkeypress' => "return $(this).focusNextInputField(event)", 'disabled'=>'disabled', 'class' => 'mws-textinput')); ?>
                                </div>
                            </div>       
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($modKaryawan, 'nama_karyawan'); ?>
                                <div class="mws-form-item ">                                           
                                    <?php echo $form->textField($modKaryawan, 'gelardepan', array('empty' => '', 'style' => 'width:60px;', 'readonly' => true, 'onkeypress' => "return $(this).focusNextInputField(event)", 'disabled'=>'disabled', 'class' => 'mws-textinput')); ?>
                                    <?php echo $form->textField($modKaryawan, 'nama_karyawan', array('maxlength' => 100, 'style' => 'width:160px;', 'readonly' => true, 'onkeypress' => "return $(this).focusNextInputField(event)", 'disabled'=>'disabled', 'class' => 'mws-textinput')); ?> 
                                    <?php echo $form->textField($modKaryawan, 'gelarbelakang', array('empty' => '', 'style' => 'width:60px;', 'readonly' => true, 'onkeypress' => "return $(this).focusNextInputField(event)", 'disabled'=>'disabled', 'class' => 'mws-textinput')); ?>    
                                </div>
                            </div>

                            <div class="mws-form-row">
                                <?php echo $form->labelEx($modKaryawan, 'jeniskelamin'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modKaryawan, 'jeniskelamin', array('empty' => '', 'style' => 'width:160px;', 'readonly' => true, 'onkeypress' => "return $(this).focusNextInputField(event)", 'disabled'=>'disabled', 'class' => 'mws-textinput')); ?>    
                                </div>
                            </div>
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($modKaryawan, 'tempatlahir_karyawan'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modKaryawan, 'tempatlahir_karyawan', array('style' => 'width:160px;', 'readonly' => true, 'onkeypress' => "return $(this).focusNextInputField(event)", 'disabled'=>'disabled', 'class' => 'mws-textinput')); ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($modKaryawan, 'tgllahir_karyawan'); ?>
                                <div class="mws-form-item ">                                           
                                    <?php echo $form->textField($modKaryawan, 'tgllahir_karyawan', array('style' => 'width:110px;', 'readonly' => true, 'onkeypress' => "return $(this).focusNextInputField(event)", 'disabled'=>'disabled', 'class' => 'mws-textinput')); ?>
                                </div>
                            </div> 
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($modKaryawan, 'statusperkawinan'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modKaryawan, 'statusperkawinan', array('style' => 'width:110px;', 'readonly' => true, 'onkeypress' => "return $(this).focusNextInputField(event)", 'disabled'=>'disabled', 'class' => 'mws-textinput')); ?>
                                </div>
                            </div> 
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($modKaryawan, 'agama'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modKaryawan, 'agama', array('style' => 'width:110px;', 'readonly' => true, 'onkeypress' => "return $(this).focusNextInputField(event)", 'disabled'=>'disabled', 'class' => 'mws-textinput')); ?>
                                </div>
                            </div>
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($modKaryawan, 'nomobile_karyawan'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modKaryawan, 'nomobile_karyawan', array('style' => 'width:110px;', 'readonly' => true, 'onkeypress' => "return $(this).focusNextInputField(event)", 'disabled'=>'disabled', 'class' => 'mws-textinput')); ?>
                                </div>
                            </div>
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($modKaryawan, 'notelp_karyawan'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->textField($modKaryawan, 'notelp_karyawan', array('style' => 'width:110px;', 'readonly' => true, 'onkeypress' => "return $(this).focusNextInputField(event)", 'disabled'=>'disabled', 'class' => 'mws-textinput')); ?>
                                </div>
                            </div>
                        </td>
                        <td style="width:200px;height:200px;">
                            <img src="" width="200" height=200" id="photo_karyawan" > 
                        </td>
                    </tr>
                </table>
                <hr>
                <table>
                    <tr>
                        <td>
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'tglpresensi'); ?>
                                <div class="mws-form-item ">                                        
                                    <?php
                                    $this->widget('MyDateTimePicker', array(
                                        'model' => $model,
                                        'attribute' => 'tglpresensi',
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
                                            'readonly' => true,
                                            'onkeypress' => 'return $(this).focusNextInputField(event);',
                                        ),
                                    ));
                                    ?>
                                </div>
                            </div>
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'jampresensi'); ?>
                                <div class="mws-form-item ">                                        
                                    <?php //echo date("H:i:s");
                                    $this->widget('MyDateTimePicker', array(
                                        'model' => $model,
                                        'attribute' => 'jampresensi',
                                        'language' => '',
                                        'mode' => 'time', //use "time","date" or "datetime" (default)
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
                                            'readonly' => true,
                                            'onkeypress' => 'return $(this).focusNextInputField(event);',
                                        ),
                                    ));
                                    ?>
                                </div>
                            </div>
                            

                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'keterangan'); ?>
                                <div class="mws-form-item ">                                        
                                    <?php echo $form->textArea($model, 'keterangan', array('rows' => 6, 'cols' => 50, 'onkeypress' => 'return $(this).focusNextInputField(event);',)); ?>
                                </div>
                            </div>
                            </td><td>
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'statuskehadiran_id'); ?>
                                <div class="mws-form-item ">                                        
                                    <?php echo $form->dropDownList($model, 'statuskehadiran_id', CHtml::listData(StatuskehadiranM::model()->findAll('statuskehadiran_aktif = true'), 'statuskehadiran_id','statuskehadiran_nama'), array('onkeypress' => 'return $(this).focusNextInputField(event);', 'class' => 'mws-textinput span3')); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="mws-button-row">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Create', array('class' => 'mws-button blue')) . ' ';
                    echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>

                </div>   

                <?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div><!-- form -->
    
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'dialogKaryawan',
    'options'=>array(
        'title'=>'Data Karyawan',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>900,
        'height'=>600,
        'resizable'=>false,
    ),
));
        
    $modsKaryawan = new KaryawanM;
    $modsKaryawan->unsetAttributes();
    if (isset($_GET['KaryawanM'])) {
        $modsKaryawan->attributes = $_GET['KaryawanM'];
    }
    $this->widget('zii.widgets.grid.CGridView',array(
        'id'=>'pengeluran-grid',
        'dataProvider'=>$modsKaryawan->search(),
        'filter'=>$modsKaryawan,
        'template'=>"{pager}{summary}\n{items}",
        'columns'=>array(
            array(
                'header'=>'Pilih',
                'type'=>'raw',
                'value'=>'CHtml::Link("<i class=\"mws-ic-16 ic-accept\"></i>","",
                        array(
                                "class"=>"mws-ic-16 ic-accept",
                                "id" => "selectKaryawan",
                                "href"=>"",
                                "onClick" => "
                                  \$(\"#'.CHtml::activeId($model, 'no_fingerprint').'\").val(\"$data->no_fingerprint\");
                                  \$(\"#'.CHtml::activeId($modKaryawan, 'nomorindukkaryawan').'\").val(\"$data->nomorindukkaryawan\");
                                  \$(\"#'.CHtml::activeId($modKaryawan, 'gelardepan').'\").val(\"$data->gelardepan\");
                                  \$(\"#'.CHtml::activeId($modKaryawan, 'nama_karyawan').'\").val(\"$data->nama_karyawan\");
                                  \$(\"#'.CHtml::activeId($modKaryawan, 'gelarbelakang').'\").val(\"$data->gelarbelakang\");
                                  \$(\"#'.CHtml::activeId($modKaryawan, 'jeniskelamin').'\").val(\"$data->jeniskelamin\");
                                  \$(\"#'.CHtml::activeId($modKaryawan, 'tempatlahir_karyawan').'\").val(\"$data->tempatlahir_karyawan\");
                                  \$(\"#'.CHtml::activeId($modKaryawan, 'tgllahir_karyawan').'\").val(\"$data->tgllahir_karyawan\");
                                  \$(\"#'.CHtml::activeId($modKaryawan, 'statusperkawinan').'\").val(\"$data->statusperkawinan\");
                                  \$(\"#'.CHtml::activeId($modKaryawan, 'nomobile_karyawan').'\").val(\"$data->nomobile_karyawan\");
                                  \$(\"#'.CHtml::activeId($modKaryawan, 'notelp_karyawan').'\").val(\"$data->notelp_karyawan\");
                                  \$(\"#'.CHtml::activeId($modKaryawan, 'agama').'\").val(\"$data->agama\");
                                  \$(\"#'.CHtml::activeId($model, 'karyawan_id').'\").val(\"$data->karyawan_id\");
                                  \$(\"#photo_karyawan\").attr(\"src\", \"'.Params::urlKaryawanThumbsDirectory().'kecil_$data->photo_karyawan\");
                                  \$(\"#dialogKaryawan\").dialog(\"close\");return false;"
                        ))',
            ),
            array(
                'header'=>'NIP',
                'name'=>'no_fingerprint',
            ),
            //'no_fingerprint',
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
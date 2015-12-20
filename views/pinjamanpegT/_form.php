<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/form.js'); ?>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-list">Form Pinjaman Pegawai</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-form">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'pinjamanpeg-t-form',
                'enableAjaxValidation' => false,
                    ));
            ?>

            <?php if (Yii::app()->user->hasFlash('error')) { ?>
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
                                <?php echo $form->labelEx($model, 'karyawan_id'); ?>
                                <div class="mws-form-item ">
                                    <?php echo $form->hiddenField($model,'karyawan_id',array('readonly'=>true)); ?>
                                    <?php $this->widget('MyJuiAutoComplete', array(
                                                           'name'=>'karyawan',
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
                                                                            }',
                                                                       'select'=>'js:function( event, ui ) {
                                                                           $(\'#PinjamanpegT_karyawan_id\').val(ui.item.value);
                                                                           $(\'#karyawan\').val(ui.item.label);
                                                                            return false;
                                                                        }',
                                                            ),
                                                            'htmlOptions'=>array(
                                                                'readonly'=>false,
                                                                'placeholder'=>'Nama Karyawan',
                                                                'size'=>13,
                                                                'onkeypress'=>"return $(this).focusNextInputField(event);",
                                                            ),
                                                            'tombolDialog'=>array('idDialog'=>'dialogKaryawan',),
                                                    )); ?>
                                </div>
                            </div>


                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'komponengaji_id'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php echo $form->dropDownList($model, 'komponengaji_id', CHtml::listData($model->getKomponenGajiItems(), 'komponengaji_id', 'komponengaji_nama'), array('empty' => '-- Pilih --', 'style' => 'width:140px')); ?>
                                </div>
                            </div>


                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'tglpinjampeg'); ?>
                                <div class="mws-form-item ">                                            
                                    <?php
                                    $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                                        'model' => $model,
                                        'attribute' => 'tglpinjampeg',
                                            'language'=>'',
                                            'mode'=>'date', //use "time","date" or "datetime" (default)
                                            'options'=>array(
                                                'dateFormat'=>Params::DATE_FORMAT,
                                                'changeYear'=>true,
                                                'changeMonth'=>true,
                                                'yearRange'=>'-70y:+4y',
                                                'maxDate'=>'d',
                                                'showAnim'=>'fold',
                                                'timeText'=>'Waktu',
                                                'hourText'=>'Jam',
                                                'minuteText'=>'Menit',
                                                'secondText'=>'Detik',
                                                'showSecond'=>true,
                                                'timeFormat'=>'hh:mm:ss',
                                                'showOn'=>'button',
                                                'buttonImage'=> Yii::app()->baseUrl."/css/icons/32/calendar.png",
                                                'buttonImageOnly'=>true,
                                            ),
                                            'htmlOptions'=>array(
                                            'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
//                                            'class'=>'dtpicker3',
                                            ),
                                    ));
                                    ?>
                                </div>
                            </div>

                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'nopinjam'); ?>
                                <div class="mws-form-item ">
                                    <?php
                                        $command = Yii::app()->db->CreateCommand()->select('MAX(nopinjam) AS maxnumber')->from('pinjamanpeg_t')->queryAll();
                                        $maxnumber = $command[0]['maxnumber'];
                                        $urutan = $maxnumber +1;
                                        $nomor = CustomFormat::pad_zero($urutan,5,TRUE)
                                    ?>
                                    <?php echo $form->textField($model, 'nopinjam', array('maxlength' => 50, 'onkeypress' => 'return $(this).focusNextInputField(event);', 'class' => 'digit-medium','value'=>$nomor)); ?>
                                </div>
                            </div>


                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'untukkeperluan'); ?>
                                <div class="mws-form-item ">                                        
                                    <?php echo $form->textArea($model, 'untukkeperluan', array('rows' => 6, 'cols' => 50, 'onkeypress' => 'return $(this).focusNextInputField(event);',)); ?>
                                </div>
                            </div>
                        </td>
                        <td>

                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'keterangan'); ?>
                                <div class="mws-form-item ">                                        
                                    <?php echo $form->textArea($model, 'keterangan', array('rows' => 6, 'cols' => 50, 'onkeypress' => 'return $(this).focusNextInputField(event);',)); ?>
                                </div>
                            </div>


                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'jumlahpinjaman'); ?>
                                <div class="mws-form-item ">                                        
                                    <?php echo $form->textField($model, 'jumlahpinjaman', array('class'=>'span2 numbersOnly', 'onkeyup'=>'setsisa();')); ?>
                                </div>
                            </div>


                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model, 'lamapinjambln'); ?>
                                <div class="mws-form-item "> 
                                        <?php echo $form->textField($model, 'lamapinjambln', array('onkeypress' => 'return $(this).focusNextInputField(event);', 'class' => 'span2 numbersOnly','style'=>'vertical-align:top;')); ?>
                                        <?php echo CHtml::linkButton('<span class="mws-ic ic-add" style="vertical-align:bottom;"></span>', array('onclick' => 'submitPinjam();return false;','style'=>'text-decoration:none;')); ?> 
                                </div>
                            </div>


                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'persenpinjaman'); ?>
                                <div class="mws-form-item ">
                                    <div class="input-append">
                                    <?php echo $form->textField($model, 'persenpinjaman', array('onkeypress' => 'return $(this).focusNextInputField(event);', 'class' => 'digit2 numbersOnly','style'=>'float:left;')); ?>
                                    <span class="add-on">%</span>
                                    </div>
                                </div>
                            </div>


                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'sisapinjaman'); ?>
                                <div class="mws-form-item ">                                        
                                    <?php echo $form->textField($model, 'sisapinjaman', array('onkeypress' => 'return $(this).focusNextInputField(event);', 'class' => 'span2 numbersOnly sisa')); ?>
                                </div>
                            </div>
                            
                            <div class="mws-form-row">
                                <?php echo $form->labelEx($model, 'Jenis Pengeluaran'); ?>
                                <div class="mws-form-item">
                                    <?php echo $form->dropDownList($model, 'jenispengeluaran_id',CHtml::listData($model->getJenispengeluaranItems(),'jenispengeluaran_id','jenispengeluaran_nama'),array('empty'=>'-- Pilih --','style'=>'width:150px')) ?>
                                </div>
                            </div>
                            
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'pegpengeluran'); ?>
                                     <div class="mws-form-item ">                                            
                                                <?php $this->widget('MyJuiAutoComplete', array(
                                                   'attribute'=>'pegpengeluran',
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
                                                                   $(\'#KPenggajianT_pegpengeluran\').val(ui.item.label);
                                                                    return false;
                                                                }',
                                                    ),
                                                    'htmlOptions'=>array(
                                                        'readonly'=>false,
                                                        'placeholder'=>'Nama Karyawan',
                                                        'size'=>13,
                                                        'onkeypress'=>"return $(this).focusNextInputField(event);",
                                                    ),
                                                    'tombolDialog'=>array('idDialog'=>'dialogPegpengeluaran',),
                                            )); ?>
                                      </div>
                            </div>

                        </td>
                    </tr>
                </table>
                <div class="mws-form-row"><h1> Detail Pinjaman </h1></div>
                <table id="tabelpinjamkaryawan" class='mws-table items' style='border:solid #cccccc 1px;'align="center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Angsuran</th>
                            <th>Tanggal Akan Bayar</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Jumlah Cicilan</th>
                            <?php if ($model->isNewRecord) { ?>
                                <th>Batal</th> 
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                        if (isset($modDetails)) {
                            foreach ($modDetails as $i => $data) {
                                echo '<tr>';
                                echo '<td>' . ($i + 1) . '</td>';
                                echo '<td>' . CHtml::activeTextField($data, '[' . $i . ']angsuranke', array('class' => 'numbersOnly span1 '));

                                if (!$model->isNewRecord) {
                                    echo CHtml::activeHiddenField($data, '[' . $i . ']pinjampegdet_id', array('class' => 'numbersOnly span1 '));
                                }
                                echo '</td><td>' . CHtml::activeTextField($data, '[' . $i . ']tglakanbayar', array('class' => 'numbersOnly span3')) . '</td>
                                            <td>' . CHtml::activeTextField($data, '[' . $i . ']bulan', array('class' => 'numbersOnly span2')) . '</td>
                                            <td>' . CHtml::activeTextField($data, '[' . $i . ']tahun', array('class' => 'numbersOnly span2')) . '</td>
                                            <td>' . CHtml::activeTextField($data, '[' . $i . ']jmlcicilan', array('class' => 'numbersOnly span3')) . '</td>
                                            <td>' . CHtml::activeHiddenField($data, '[' . $i->pinjamanpeg_id . ']pinjamanpeg_id', array('class' => 'numbersOnly span1 ')) . '</td>';
                                if ($model->isNewRecord) {
                                    echo '<tr><td><a href="" onclick="deleteRow(this);return false;"><span class="mws-ic-16 ic-cancel">&nbsp;</span></a></td></tr>';
                                }
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="mws-button-row">
                     <?php 
                          if($model->isNewRecord)
                          {
                           echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Create', array('class' => 'mws-button blue')) . ' ';
                           echo CHtml::submitButton('Bayarkan',array('class'=>'mws-button blue','name'=>'bayar')).' ';
                           echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green'));
                          }else{
                              echo CHtml::submitButton('Bayarkan',array('class'=>'mws-button blue','name'=>'bayarkan')).' ';
                              echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green'));
                          }
                           
                     ?>
                </div>   

<?php $this->endWidget(); ?>
                <?php
                $controller = Yii::app()->controller->id; //mengambil Controller yang sedang dipakai
                $module = Yii::app()->controller->module->id; //mengambil Module yang sedang dipakai
                $urlPrint = Yii::app()->createAbsoluteUrl($module . '/' . $controller . '/print&id=' . $model->pinjamanpeg_id);
                $notif = Yii::t('mds', 'Apakah Anda yakin akan menghapus item ini ?');
                $url = Yii::app()->createUrl('actionAjax/PinjamanKaryawan');
                $js = <<< JS
    
    function submitPinjam(){

    
    lamapinjam = $('#PinjamanpegT_lamapinjambln').val();
    jmlpinjam =  $('#PinjamanpegT_jumlahpinjaman').val();
    persen =  $('#PinjamanpegT_persenpinjaman').val();
    
        $.post("${url}", { lamapinjambln:lamapinjam,jumlahpinjaman:jmlpinjam,persenpinjaman:persen},
        function(data){
            $('#tabelpinjamkaryawan tbody').html(data.tr);                    
            $('.tanggalbayar').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['id'], {'dateFormat':'dd mm yy','minDate':'d','timeText':'Waktu','hourText':'Jam','minuteText':'Menit','secondText':'Detik','showSecond':true,'timeOnlyTitle':'Pilih Waktu','timeFormat':'hh:mm:ss','changeYear':true,'changeMonth':true,'showAnim':'fold', 'focus':function( event, ui ) {alert('deg');return false;}}));
        }, "json");
    }   
        function setTanggal(obj){
            date = $(obj).val();
            potong = date.split(' ');
            //tgl = potong[0];
            bulan = potong[1];
            tahun = potong[2];
        
            if (jQuery.isNumeric(tgl)){
                $(obj).val(tgl);
            }
            if (jQuery.isNumeric(bulan)){
                $(obj).parents('tr').find('.bulan').val(bulan);
            }
            if (jQuery.isNumeric(tahun)){
                $(obj).parents('tr').find('.tahun').val(tahun);
            }
        }
        
function deleteRow(obj){
        if(!confirm("${notif}")) {
            return false;
        }else{
            $(obj).parents('tr').remove();
        }
    }        
function deleteRow(obj){
        if(!confirm("${notif}")) {
            return false;
        }else{
            $(obj).parents('tr').remove();
        }
    }

function remove(obj){
    $(obj).parents('tr').remove();
}

JS;
Yii::app()->clientScript->registerScript('onheadDialog', $js, CClientScript::POS_HEAD);
?>


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
        function setsisa(){
            var jml = parseFloat($("#'.CHtml::activeId($model, 'jumlahpinjaman').'").val());
            var sisa = parseFloat($("#'.CHtml::activeId($model, 'sisapinjaman').'").val());
            hasil=jml;
           
            $("#'.CHtml::activeId($model, 'sisapinjaman').'").val(hasil);
            
        }
', CClientScript::POS_HEAD); ?>
    
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
        
    $modKaryawan = new KaryawanM;
    $modKaryawan->unsetAttributes();
    if (isset($_GET['KaryawanM'])) {
        $modKaryawan->attributes = $_GET['KaryawanM'];
    }
    $this->widget('zii.widgets.grid.CGridView',array(
        'id'=>'karyawan-grid',
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
                                        "onClick" => "\$(\"#PinjamanpegT_karyawan_id\").val($data->karyawan_id);
                                                              \$(\"#karyawan\").val(\"$data->nama_karyawan\");
                                                              \$(\"#dialogKaryawan\").dialog(\"close\");"
                                ))',
            ),
            array(
                'name'=>'nomorindukkaryawan',
            ),
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
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'dialogPegpengeluaran',
    'options'=>array(
        'title'=>'Data Karyawan',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>900,
        'height'=>600,
        'resizable'=>false,
    ),
));
        
    $modKaryawan = new KaryawanM;
    $modKaryawan->unsetAttributes();
    if (isset($_GET['KaryawanM'])) {
        $modKaryawan->attributes = $_GET['KaryawanM'];
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
                                                              \$(\"#PinjamanpegT_pegpengeluran\").val(\"$data->nama_karyawan\");
                                                              \$(\"#dialogPegpengeluaran\").dialog(\"close\");"
                                ))',
            ),
            array(
                'name'=>'nomorindukkaryawan',
            ),
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
<?php 
if (isset($caraPrint)) {
    if($caraPrint=='EXCEL')
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$judulLaporan.'-'.date("Y/m/d").'.xls"');
        header('Cache-Control: max-age=0');     
    }
    echo $this->renderPartial('application.views.headerReport.headerDefault',array('judulLaporan'=>$judulLaporan));      
}
?>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-list">Form Penggajian</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'penggajian-t-form',
                        'enableAjaxValidation'=>false,
                )); ?>

	<div class="mws-form-message info">Bagian dengan tanda <span class="required">*</span> harus diisi.</div>
                <?php  if(Yii::app()->user->hasFlash('error')): ?>
 
                    <div class="flash-success" style="background: #9adf8f;">
                        <br/>
                    <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>

                <?php endif; ?>
                 <?php
                    if ($form->errorSummary($model)) {
                    echo '<div class="mws-form-message error">' . $form->errorSummary($model) . '</div>';
                    }
                 ?>       
                <div class="mws-form-inline">   
                    <table>
                        <tr>
                            <td width="50%">
                                    
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'karyawan_id'); ?>
                                     <div class="mws-form-item ">
                                     <?php echo $form->hiddenField($model,'karyawan_id','',array('readonly'=>true,'id'=>'karyawan_id')); ?>
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
                                                                            submitGetKarykomponen();
                                                                            }',
                                                                       'select'=>'js:function( event, ui ) {
                                                                           $(\'#KPenggajianT_karyawan_id\').val(ui.item.value);
                                                                           $(\'#karyawan\').val(ui.item.label);
                                                                           submitGetKarykomponen();
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
                                    <?php echo $form->labelEx($model,'tglpenggajian'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$model,
                                        'attribute'=>'tglpenggajian',
                                        'language'=>'',
                                        'mode'=>'date', //use "time","date" or "datetime" (default)
                                        'options'=>array(
                                        'dateFormat'=>'dd-M-yy',
                                        'changeYear' => true,
                                        'changeMonth' => true,
                                        'yearRange' => '-70y:+4y',
                                        'showSecond' => false,
                                        'showDate' => false,
                                        'showMonth' => false,
                                        'timeFormat' => 'hh:mm:ss',

                                        'showOn'=>'button',
                                        'buttonImage'=> Yii::app()->baseUrl."/css/icons/32/calendar.png",
                                        'buttonImageOnly'=>true,
                                        ),
                                        'htmlOptions'=>array(
                                        'class'=>'isRequired',
                                        'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
                                        ),
                                        ));?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nopenggajian'); ?>
                                     <div class="mws-form-item ">
                                         <?php
                                            $command = Yii::app()->db->createCommand()->select('MAX(nopenggajian) AS maxnumber')->from('penggajian_t')->queryAll();
                                            $maxnumber = $command[0]['maxnumber'];
                                            $urutan = $maxnumber + 1;
                                            $nomor = CustomFormat::pad_zero($urutan,5,TRUE);
                                         ?>
                                        <?php echo $form->textField($model,'nopenggajian',array('size'=>50,'maxlength'=>50,'class'=>'digit-medium','value'=>$nomor)); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'keterangan'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo $form->textArea($model,'keterangan',array('rows'=>6, 'cols'=>30)); ?>
                                      </div>
                            </div>
                               
                            </td>
                            <td>                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'mengetahui'); ?>
                                     <div class="mws-form-item ">                                            
                                           <?php $this->widget('MyJuiAutoComplete', array(
                                               'attribute'=>'mengetahui',
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
                                                               $(\'#KPenggajianT_mengetahui\').val(ui.item.label);
                                                                return false;
                                                            }',
                                                ),
                                                'htmlOptions'=>array(
                                                    'readonly'=>false,
                                                    'placeholder'=>'Nama Karyawan',
                                                    'size'=>13,
                                                    'onkeypress'=>"return $(this).focusNextInputField(event);",
                                                ),
                                                'tombolDialog'=>array('idDialog'=>'dialogMengetahui',),
                                        )); ?>
                                  </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'menyetujui'); ?>
                                     <div class="mws-form-item ">                                            
                                     <?php $this->widget('MyJuiAutoComplete', array(
                                                           'attribute'=>'menyetujui',
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
                                                                           $(\'#KPenggajianT_menyetujui\').val(ui.item.label);
                                                                            return false;
                                                                        }',
                                                            ),
                                                            'htmlOptions'=>array(
                                                                'readonly'=>false,
                                                                'placeholder'=>'Nama Karyawan',
                                                                'size'=>13,
                                                                'onkeypress'=>"return $(this).focusNextInputField(event);",
                                                            ),
                                                            'tombolDialog'=>array('idDialog'=>'dialogMenyetujui',),
                                                    )); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jenispengeluaran_id'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo $form->dropDownList($model,'jenispengeluaran_id',CHtml::listData($model->getJenispengeluaranItems(),'jenispengeluaran_id','jenispengeluaran_nama'),array('class'=>'digit-medium','readonly'=>true,'empty'=>'-- Pilih --')); ?>
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
                <table class="mws-table" id="komponengaji">
                    <thead>
                        <tr>
                            <th width="10px">No</th>
                            <th>Komponen</th>
                            <th>Gaji</th>
                            <th>Potongan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                 <div class="mws-button-row">
                    <?php
                        //echo CHtml::htmlButton(Yii::t('mds','{icon} Print',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button orange', 'type'=>'button','onclick'=>'printpenggajian(\'PRINT\')'))."&nbsp; &nbsp;";
                        echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Create', array('class' => 'mws-button blue','name'=>'save'))."&nbsp; &nbsp;";
                        echo CHtml::submitButton(Yii::t('mds','Bayarkan'),array('class'=>'mws-button blue', 'type'=>'button','name'=>'bayar'))."&nbsp; &nbsp;";
                        echo CHtml::ResetButton($model->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green'))."&nbsp; &nbsp;";
                    ?>

                </div>   
                    
                <?php $this->endWidget(); ?>
            </div>
        </div>    	
    </div><!-- form -->
<?php
        $controller = Yii::app()->controller->id; //mengambil Controller yang sedang dipakai
        $module = Yii::app()->controller->module->id; //mengambil Module yang sedang dipakai
        $urlPrint=  Yii::app()->createAbsoluteUrl($module.'/'.$controller.'/Printpenggajian');

$js = <<< JSCRIPT
function printpenggajian(caraPrint)
{
    window.open("${urlPrint}/"+$('#penggajian-t-form').serialize()+"&caraPrint="+caraPrint,"",'location=_new, width=900px');
}
JSCRIPT;
Yii::app()->clientScript->registerScript('printpenggajian',$js,CClientScript::POS_HEAD);                        
?>
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
        
   $modKaryawan = new KaryawanM('search');
    $modKaryawan->unsetAttributes();
    if (isset($_GET['KaryawanM'])) {
        $modKaryawan->attributes = $_GET['KaryawanM'];
    }
    $this->widget('zii.widgets.grid.CGridView',array(
        'id'=>'sakaryawan-m-grid',
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
                                        "onClick" => "\$(\"#KPenggajianT_karyawan_id\").val($data->karyawan_id);
                                                              \$(\"#karyawan\").val(\"$data->nama_karyawan\");
                                                              \$(\"#dialogKaryawan\").dialog(\"close\");
                                                              submitGetKarykomponen()"
                                ))',
            ),
            'nomorindukkaryawan',
            'nama_karyawan',
            'jeniskelamin',
            
        ),
        'afterAjaxUpdate'=>'function(id, data){jQuery(\''.Params::TOOLTIP_SELECTOR.'\').tooltip({"placement":"'.Params::TOOLTIP_PLACEMENT.'"});}',
    ));
$this->endWidget();

?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'dialogMengetahui',
    'options'=>array(
        'title'=>'Data Karyawan',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>900,
        'height'=>600,
        'resizable'=>false,
    ),
));
        
    $modKaryawan = new KaryawanM('search');
    $modKaryawan->unsetAttributes();
    if (isset($_GET['KaryawanM'])) {
        $modKaryawan->attributes = $_GET['KaryawanM'];
    }
    $this->widget('zii.widgets.grid.CGridView',array(
        'id'=>'mengetahui-grid',
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
                                                              \$(\"#KPenggajianT_mengetahui\").val(\"$data->nama_karyawan\");
                                                              \$(\"#dialogMengetahui\").dialog(\"close\");"
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
    'id'=>'dialogMenyetujui',
    'options'=>array(
        'title'=>'Data Karyawan',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>900,
        'height'=>600,
        'resizable'=>false,
    ),
));
        
    $modKaryawan = new KaryawanM('search');
    $modKaryawan->unsetAttributes();
    if (isset($_GET['KaryawanM'])) {
        $modKaryawan->attributes = $_GET['KaryawanM'];
    }
    $this->widget('zii.widgets.grid.CGridView',array(
        'id'=>'menyetujui-grid',
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
                                                              \$(\"#KPenggajianT_menyetujui\").val(\"$data->nama_karyawan\");
                                                              \$(\"#dialogMenyetujui\").dialog(\"close\");"
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
        
    $modKaryawan = new KaryawanM('search');
    $modKaryawan->unsetAttributes();
    if (isset($_GET['KaryawanM'])) {
        $modKaryawan->attributes = $_GET['KaryawanM'];
    }
    $this->widget('zii.widgets.grid.CGridView',array(
        'id'=>'pengeluaran-grid',
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
                                                              \$(\"#KPenggajianT_pegpengeluran\").val(\"$data->nama_karyawan\");
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
    <?php
$urlGetKarykomponen = Yii::app()->createUrl('actionAjax/GetKarykomponenItems');
$jscript = <<< JS

function submitGetKarykomponen()
{
    karyawan_id = $('#KPenggajianT_karyawan_id').val();

    if(karyawan_id == ''){
        alert('Silahkan isi nama pegawai');
    }else{
        $.post("${urlGetKarykomponen}", {karyawan_id:karyawan_id},
        function(data){
            $('#komponengaji tbody').html(data.tr);
            $('#KPenggajianT_jmlpotongan').val(data.totalpotongan);
            $('#KPenggajianT_penerimaankotor').val(data.totalgaji);
            $('#KPenggajianT_penerimaanbersih').val(data.penerimaanbersih);
        }, "json");
    }   
}

function remove (obj){
    $(obj).parents('tr').remove();
}

function clear (obj){
    $(obj).parents('tbody').remove();
}
JS;
Yii::app()->clientScript->registerScript('penggajian',$jscript, CClientScript::POS_HEAD);

?>
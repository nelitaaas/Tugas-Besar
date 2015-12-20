<?php
Yii::app()->clientScript->registerScript('search', "
$('#divSearch-form form').submit(function(){
	$.fn.yiiGridView.update('rencana-m-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'kkaryawan-m-grid',
    'dataProvider' => $model->searchKaryawan(),
    'template' => "{pager}{summary}\n{items}",
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'columns' => array(
       
        array(
            'name' => 'karyawan_id',
            'value' => '$data->karyawan_id',
            'filter' => false,
        ),
     
        array(
            'name' => 'nama_karyawan',
            'value' => '$data->nama_karyawan',
            'filter' => false,
        ),

        array(
            'header' => 'Details',
            'type' => 'raw',
            'value' => 'CHtml::Link("<i class=\"icon-list-alt\"></i>",Yii::app()->controller->createUrl("pesanobatalkes/details",array("id"=>$data->pesanobatalkes_id)),
                            array("class"=>"", 
                                  "target"=>"pesan",
                                  "onclick"=>"$(\"#dialogPesanObatAlkes\").dialog(\"open\");",
                                  "rel"=>"tooltip",
                                  "title"=>"Klik untuk melihat details Pemesanan Obat Alkes",
                            ))',
        ),
        array(
            'header' => 'Mutasi',
            'type' => 'raw',
            'value' => '(empty($data->mutasioaruangan_id))
                          ? (($data->ruanganpemesan_id == '.Yii::app()->user->getState('ruangan_id').') ? "Belum Dimutasi": CHtml::Link("<i class=\"icon-list-alt\"></i>","javascript:formMutasi(\'$data->pesanobatalkes_id\',\'$data->nopemesanan\',\'$data->tglpemesanan\')",
                            array("class"=>"", "title"=>"Klik Mendaftarkan Ke Penawaran"))) 
                          : "Telah Dimutasi"; ',
            
        ),
    ),
    'afterAjaxUpdate' => 'function(id, data){jQuery(\'' . Params::TOOLTIP_SELECTOR . '\').tooltip({"placement":"' . Params::TOOLTIP_PLACEMENT . '"});}',
));
?> 

<?php
$form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'id' => 'ivpesanobatalkes-search',
    'type' => 'horizontal',
        ));
?>

<table>
    <tr>
        <td>
            <div class="control-group ">
                <?php echo $form->labelEx($model, 'tglAwal', array('class' => 'control-label')) ?>
                <div class="controls">
                    <?php
                    $this->widget('MyDateTimePicker', array(
                        'model' => $model,
                        'attribute' => 'tglAwal',
                        'mode' => 'date',
                        'options' => array(
                            'dateFormat' => Params::DATE_TIME_FORMAT,
                        ),
                        'htmlOptions' => array('readonly' => true, 'class' => 'dtPicker3', 'onkeypress' => "return $(this).focusNextInputField(event)"
                        ),
                    ));
                    ?>
                </div>
            </div>
            <div class="control-group ">
                <?php echo $form->labelEx($model, 'tglAkhir', array('class' => 'control-label')) ?>
                <div class="controls">
                    <?php
                    $this->widget('MyDateTimePicker', array(
                        'model' => $model,
                        'attribute' => 'tglAkhir',
                        'mode' => 'date',
                        'options' => array(
                            'dateFormat' => Params::DATE_TIME_FORMAT,
                        ),
                        'htmlOptions' => array('readonly' => true, 'class' => 'dtPicker3', 'onkeypress' => "return $(this).focusNextInputField(event)"
                        ),
                    ));
                    ?>
                </div>
            </div> 
        </td>
        <td>
            <?php echo $form->textFieldRow($model, 'nopemesanan', array('class' => 'numberOnly')); ?>
            <?php
            echo $form->dropDownListRow($model, 'ruanganpemesan_id', CHtml::listData($model->RuanganItems, 'ruangan_id', 'ruangan_nama'), array('class' => 'span3', 'onkeypress' => "return $(this).focusNextInputField(event)",
                'empty' => '-- Pilih --',));
            ?>
        </td>
    </tr>
</table>
<div class="form-actions"> 
    <?php echo CHtml::htmlButton(Yii::t('mds', '{icon} Search', array('{icon}' => '<i class="icon-search icon-white"></i>')), array('class' => 'btn btn-primary', 'type' => 'submit')); ?>
</div> 

<?php $this->endWidget(); ?>

<?php
$module = Yii::app()->controller->module->id; //mengambil Module yang sedang dipakai
$controller = Yii::app()->controller->id; //mengambil Controller yang sedang dipakai
$action = $this->getAction()->getId();
$currentUrl = Yii::app()->createUrl($module . '/' . $controller . '/' . $action);

$form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id' => 'form_hiddenPemesanan',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
    'action' => Yii::app()->createAbsoluteUrl($module . '/mutasioaruanganT/index'),
        ));
?>
<?php echo CHtml::hiddenField('idPemesananForm', '', array('readonly' => true)); ?>
<?php echo CHtml::hiddenField('noPemesananForm', '', array('readonly' => true)); ?>
<?php echo CHtml::hiddenField('tglPemesananForm', '', array('readonly' => true)); ?>
<?php echo CHtml::hiddenField('currentUrl', $currentUrl, array('readonly' => true)); ?>
<?php $this->endWidget(); ?>

<?php
$js = <<< JSCRIPT
function formMutasi(idPesan,noPesan,tglPesan)
{
    $('#idPemesananForm').val(idPesan);
    $('#noPemesananForm').val(noPesan);
    $('#tglPemesananForm').val(tglPesan);
    $('#form_hiddenPemesanan').submit();
}


JSCRIPT;
Yii::app()->clientScript->registerScript('javascript', $js, CClientScript::POS_HEAD);

// ===========================Dialog Details=========================================
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'dialogPesanObatAlkes',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Details Pemesanan Obat Dan Alat Kesehatan',
        'autoOpen' => false,
        'minWidth' => 900,
        'minHeight' => 100,
        'resizable' => false,
    ),
));
?>
<iframe src="" name="pesan" width="100%" height="500">
</iframe>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
//===============================Akhir Dialog Details================================
?>

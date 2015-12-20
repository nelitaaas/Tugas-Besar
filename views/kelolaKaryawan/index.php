<div class="mws-panel">
    <div class="mws-panel-body">
<?php

$this->renderPartial('_formDataKaryawan',array('model'=>$model));

$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>array(
        'Pendidikan Karyawan'=>array('title'=>'Pendidikan Karyawan','ajax'=>array('kelolaKaryawan/pendidikanKaryawan/id/'.$id)),
        'Pengalaman Kerja'=>array('title'=>'Pengalaman Kerja','ajax'=>array('kelolaKaryawan/pengalamanKerja/id/'.$id)),
        'Mutasi'=>array('ajax'=>array('title'=>'Mutasi','kelolaKaryawan/mutasi/id/'.$id)),
        'Cuti Karyawan'=>array('title'=>'Cuti Karyawan','ajax'=>array('kelolaKaryawan/cuti/id/'.$id)),
        'Jenjang Karir'=>array('title'=>'Jenjang Karir','ajax'=>array('kelolaKaryawan/jenjangKarir/id/'.$id)),
        'Kontrak Kerja'=>array('title'=>'Kontrak Kerja','ajax'=>array('kelolaKaryawan/kontrak/id/'.$id)),
        'Prestasi Kerja'=>array('title'=>'Prestasi Kerja','ajax'=>array('kelolaKaryawan/prestasiKerja/id/'.$id)),
        'Surat Peringatan'=>array('title'=>'Surat Peringatan','ajax'=>array('kelolaKaryawan/suratPeringatan/id/'.$id)),
        'Komponen Gaji'=>array('title'=>'Komponen Gaji','ajax'=>array('kelolaKaryawan/KomponenGaji/id/'.$id)),
    ),
    'options'=>array(
        'collapsible'=>false,
        'selected'=>0,
    ),
     'themeUrl'=>Yii::app()->request->baseUrl.'/css/jui',
     'theme'=>'redmond',
    'htmlOptions'=>array(
//        'style'=>'width:100%;' 
        'id'=>'formTab'
    ),
));
?>
        </div>   
</div>

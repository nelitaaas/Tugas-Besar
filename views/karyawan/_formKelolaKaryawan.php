<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/integervalidation.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');?>
<div style="width:100%">
<?php 

$pendidikan = $this->renderPartial('_formDataKaryawan',array(
                'model'=>$model,
)); 

//
//$this->widget('zii.widgets.jui.CJuiTabs', array(
//    'tabs'=>array(
//        'StaticTab 1'=>'Content for tab 1',
//        'StaticTab 2'=>array('content'=>'Content for tab 2', 'id'=>'tab2'),
//        // panel 3 contains the content rendered by a partial view
//        'AjaxTab'=>array('ajax'=>$ajaxUrl),
//    ),
//    // additional javascript options for the tabs plugin
//    'options'=>array(
//        'collapsible'=>true,
//    ),
//));

?>
    
 <?php 
//                 $this->widget('CTabView',array(
//                        'tabs'=>array(
//                        $tab1 => array(
//                            'id'=>'tab1_id1',
//                            'title'=>'Inf. Basica',
//                            'views'=>'karyawan/_formPendidikan',
//                            'data'=>$modelp,
//                        ),
//                        $tab2=>array(
//                            'title'=>'Inf. Adicional',
//                            'views'=>'karyawan/_formPengalamanKerja',
//                            'data'=>$modelpk,
//                        ),
//                        $tab3=>array(
//                            'title'=>'Hijos/Alumnos',
//                            'views'=>'karyawan/_formMutasi',
//                            'data'=>$modelm,
//                        ),
//                    ),
//                ));
 
 
?>
    
 
    </div>
 <div style="width:100%;">
  <?php 
//                $urlp = Yii::app()->createUrl('kepegawaian/karyawan/pendidikanKaryawan/id/'.$model->karyawan_id);
//                $urlpk = Yii::app()->createUrl('kepegawaian/karyawan/pengalamanKerja/id/'.$model->karyawan_id);
//                $urlm = Yii::app()->createUrl('kepegawaian/karyawan/mutasi/id/'.$model->karyawan_id);
//                $urlc = Yii::app()->createUrl('kepegawaian/karyawan/cuti/id/'.$model->karyawan_id);
////                $urljk = Yii::app()->createUrl('kepegawaian/karyawan/jenjangKarir');
//                $urlkk = Yii::app()->createUrl('kepegawaian/karyawan/kontrak/id/'.$model->karyawan_id); 
//                $urlpresk = Yii::app()->createUrl('kepegawaian/karyawan/prestasiKerja/id/'.$model->karyawan_id); 
//                $sp = Yii::app()->createUrl('kepegawaian/karyawan/suratPeringatan/id/'.$model->karyawan_id); 
//        $test=array(
////            'Pendidikan Karyawan'=>$this->renderPartial("_formPendidikan",array('modelp'=>$modelp),true),
////            'Pengalaman Kerja'=>$this->renderPartial("_formPengalamanKerja",array('modelpk'=>$modelpk),true),   
////            'Mutasi'=>$this->renderPartial("_formMutasi",array('modelm'=>$modelm),true),
//            'Pendidikan Karyawan'=>array('ajax'=>$urlp),
//            'Pengalaman Kerja'=>array('ajax'=>$urlpk),  
//            'Mutasi'=>array('ajax'=>$urlm),  
//            'Cuti Karyawan'=>array('ajax'=>$urlc), 
////            'Jenjang Karir'=>array('ajax'=>$urljk), 
//            'Kontrak Kerja'=>array('ajax'=>$urlkk),   
//            'Prestasi Kerja'=>array('ajax'=>$urlpresk),  
//            'Surat Peringatan'=>array('ajax'=>$sp),
//        );
?>
 
<?php //$this->widget('system.web.widgets.CTabView', array('tabs'=>$test,)); ?>
<?php /* $this->widget('zii.widgets.jui.CJuiTabs', array('tabs'=>$test,
            'options'=>array(
            'collapsible'=>true,
        ),)); */ ?> 
     
     
     
</div>
<fieldset style="border-top:1px solid #656565;border-bottom: 1px solid #656565">
<div class="tab">
  
    <?php 
    
        $this->widget('zii.widgets.CMenu',array(
                                'items'=>array(
                                        array('label'=>'Pendidikan Karyawan', 'url'=>array('karyawan/pendidikanKaryawan/id/'.$model->karyawan_id)),
                                        array('label'=>'Pengalaman Kerja', 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>! Yii::app()->user->isGuest),
                                        array('label'=>'Mutasi', 'url'=>array('/site/contact'), 'visible'=>! Yii::app()->user->isGuest),
//                                        array('label'=>'Rights', 'url'=>array('/rights'), 'visible'=>!app()->user->isGuest,'active'=>isItemActive($this->route,'rights')),
//                                        array('label'=>'Users', 'url'=>array('/user'), 'visible'=>!app()->user->isGuest,'active'=>isItemActive($this->route,'user')),
//                                        array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>app()->user->isGuest),
                                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>! Yii::app()->user->isGuest)
                                ),
        )); ?>
</div>
</fieldset>
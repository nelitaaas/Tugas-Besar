<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'penggajian-t-form',
                        'enableAjaxValidation'=>false,
                )); ?>
     
                <div class="mws-form-inline">
                    <span class="title"><?php echo 'Rincian gaji '. $model->karyawan->nama_karyawan; ?></span>
                    <table width="100%">
                        <tr>
                            <td width="50%">
                                    
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'karyawan_id'); ?>
                                     <div class="mws-form-item ">
                                     <?php echo CHtml::label($model->karyawan->nama_karyawan,''); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'tglpenggajian'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->tglpenggajian,''); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'nopenggajian'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->nopenggajian,''); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'keterangan'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->keterangan,''); ?>
                                      </div>
                            </div>
                               
                                
                            </td>
                            <td>
                               
                                
<!--                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($model,'mengetahui'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php //echo CHtml::label($model->mengetahui,''); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php //echo $form->labelEx($model,'menyetujui'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php //echo CHtml::label($model->menyetujui,''); ?>
                                      </div>
                            </div>-->
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'penerimaankotor'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->penerimaankotor,''); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'jmlpotongan'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->jmlpotongan,''); ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo $form->labelEx($model,'penerimaanbersih'); ?>
                                     <div class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->penerimaanbersih,''); ?>
                                      </div>
                            </div>
                               
                                     </td>
                   </tr>
               </table>
                    
                <table class="mws-table" id="komponengaji">
                    <thead>
                        <tr>
                            <th style="width:10px;">No</th>
                            <th>Komponen</th>
                            <th>Gaji</th>
                            <th>Potongan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $id = $model->karyawan_id;
                            $nourut = 1;
                            $command = Yii::app()->db->createCommand()->select('MAX(tglberlaku) AS tglterbaru')->from('karykomponen_m')->where("karyawan_id='$id'")->queryAll();
                            $tglterbaru = isset($command[0]['tglterbaru']) ? $command[0]['tglterbaru'] : date('Y-m-d');
                            $modKarykomponen = KarykomponenM::model()->findAllByAttributes(array('karyawan_id'=>$id,'tglberlaku'=>$tglterbaru));
                            $potongan = Yii::app()->db->createCommand()->select('SUM(karykomponen_m.jumlah) AS total')->from('karykomponen_m, komponengaji_m')->where("komponengaji_m.ispotongan=TRUE AND karykomponen_m.karyawan_id='$id' AND karykomponen_m.tglberlaku='$tglterbaru' AND karykomponen_m.komponengaji_id=komponengaji_m.komponengaji_id")->queryAll();
                            $gaji = Yii::app()->db->createCommand()->select('SUM(karykomponen_m.jumlah) AS total')->from('karykomponen_m, komponengaji_m')->where("komponengaji_m.isgaji=TRUE AND karykomponen_m.karyawan_id='$id' AND karykomponen_m.tglberlaku='$tglterbaru' AND karykomponen_m.komponengaji_id=komponengaji_m.komponengaji_id")->queryAll();
                            $totalpotongan = $potongan[0]['total'];
                            $totalgaji = $gaji[0]['total'];
                            $penerimaanbersih = $totalgaji - $totalpotongan;
                            $tr = '';
                            $mengetahui = $model->mengetahui;
                            $menyetujui = $model->menyetujui;
                            foreach ($modKarykomponen as $value)
                            {
                                $tr .= '<tr>';
                                $tr .= '<td>'
//                                    .CHtml::activeHiddenField($modPenggajiandetail,'['.$i.']karykomponen_m',array('value'=>$value->karykomponen_m,'readonly'=>true))
                                    .CHtml::label($nourut,'jumlah'.$nourut)
                                    .'</td>';
                                $tr .= '<td>'.CHtml::label($value->komponengaji->komponengaji_nama,'jumlah'.$nourut).'</td>';
                                $jumlah = $value->jumlah;
//                                $jumlah = CHtml::activeTextField($modPenggajiandetail,'['.$i.']jumlah',array('class'=>'digit-short','id'=>'jumlah'.$nourut,'value'=>''.$value->jumlah));

                                if ($value->komponengaji->isgaji == TRUE) {
                                    $tr .= '<td>'.$jumlah.'</td>';
                                    $tr .= '<td></td>';
                                } else {
                                    $tr .= '<td></td>';
                                    $tr .= '<td>'.$jumlah.'</td>';
                                }
                                $nourut++;
                            }
                                $tr .= '<tr style="border-top:1px solid #CCCCCC"><td colspan="2">Total gaji :</td>';
                                $tr .= '<td>'.$totalgaji.'</td><td></td></tr>';
                                $tr .= '<tr style="border-top:1px solid #CCCCCC"><td colspan="2">Potongan :</td>';
                                $tr .= '<td></td><td>'.$totalpotongan.'</td></tr>';
                                $tr .= '<tr style="border-top:1px solid #CCCCCC"><td colspan="2">Penerimaan bersih :</td>';
                                $tr .= '<td>'.$penerimaanbersih.'</td><td></td></tr>';
                                echo $tr;
                        ?>
                    </tbody>
                </table>
<?php echo $this->renderPartial('application.views.headerReport.footerDefault',array('mengetahui'=>$mengetahui,'menyetujui'=>$menyetujui)); ?>                    
                    <br><br/>
                    <div class="mws-button-row" align="right">
                    <?php 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} PDF',array('{icon}'=>'<i class="icon-book icon-white"></i>')),array('class'=>'mws-button blue', 'type'=>'button','onclick'=>'printview(\'PDF\')'))."&nbsp&nbsp"; 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} Excel',array('{icon}'=>'<i class="icon-pdf icon-white"></i>')),array('class'=>'mws-button green', 'type'=>'button','onclick'=>'printview(\'EXCEL\')'))."&nbsp&nbsp"; 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} Print',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button orange', 'type'=>'button','onclick'=>'printview(\'PRINT\')'))."&nbsp&nbsp";
                    echo CHtml::htmlButton(Yii::t('mds','{icon} Petunjuk',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button yellow', 'type'=>'button','id'=>'clickme'))."&nbsp&nbsp";
                    ?>
                    <?php
                            $controller = Yii::app()->controller->id; //mengambil Controller yang sedang dipakai
                            $module = Yii::app()->controller->module->id; //mengambil Module yang sedang dipakai
                            $urlPrint=  Yii::app()->createAbsoluteUrl($module.'/'.$controller.'/Printrincian');
                            $penggajian_id =$model->penggajian_id;

                            Yii::app()->clientScript->registerScript('Printrincian','
                                function printview(caraPrint)
                                {
                                    window.open("'.$urlPrint.'&id='.$penggajian_id.'&caraPrint="+caraPrint,"","location=_new, width=900px, scrollbar=yes");
                                }    
                            ',CClientScript::POS_HEAD);                        
                    ?>
                </div>

                </div>   
                    
                <?php $this->endWidget(); ?>
            </div>
        </div>    	
    </div><!-- form -->
    <?php
$urlGetKarykomponen = Yii::app()->createUrl('actionAjax/GetKarykomponen');
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

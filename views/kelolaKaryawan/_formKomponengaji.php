<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'karykomponen-m-form',
                        'enableAjaxValidation'=>false,
                )); ?>

                <?php  if(Yii::app()->user->hasFlash('status')): ?>
 
                    <div class="flash-success" style="background: #9adf8f;">
                        <br/>
                    <?php echo Yii::app()->user->getFlash('status'); ?>
                    </div>

                <?php endif; ?>
                 <?php
                    if ($form->errorSummary($modKarykomponen)) {
                    echo '<div class="mws-form-message error">' . $form->errorSummary($modKarykomponen) . '</div>';
                    }
                 ?>        
                <div class="mws-form-inline">
                    <table>
                        <tr>
                            <td>
                                <div class="mws-form-row">
                                    <?php echo $form->labelEx($modKarykomponen,'tglberlaku'); ?>
                                    <div class="mws-form-item">
                                    <?php echo CHtml::hiddenField('tglberlaku','',array('readonly'=>false,'id'=>'karyawan_id')); ?>
                                        <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
                                        'model'=>$modKarykomponen,
                                        'attribute'=>'tglberlaku',
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
                            </td>
                   </tr>
               </table>
                <?php $modKomponengaji = KomponengajiM::model()->findAll(); ?>
                <table class="mws-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Komponen</th>
                            <th>Gaji</th>
                            <th>Potongan</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $id =  $_GET['id'];
                        ?>
                        <?php
                           $galonid = Params::BARANGJADI_GALON_ID;
                           $kartonid = Params::BARANGJADI_KARTON_ID;
                           $karton2id = Params::BARANGJADI_KARTON_ID2;
                           $gelasid = Params::BARANGJADI_GELAS_ID;
                                $nourut = 1;
                                $i = 0;
                            if (!$modKarykomponen->isNewRecord) {
                            }
                              $bln = DATE('m');
                            $command = Yii::app()->db->createCommand()->select('MAX(tglberlaku) AS tglterbaru')->from('karykomponen_m')->where("karyawan_id='$id' ")->queryAll();
                            $komisigalon = Yii::app()->db->createCommand()->select('SUM(penjualanbrgdet_t.jmljual) As total')->from('penjualanbrgdet_t, barangjadi_m, penjualanbrg_t')->where("penjualanbrg_t.penjualanbrg_id = penjualanbrgdet_t.penjualanbrg_id AND barangjadi_m.barangjadi_id=penjualanbrgdet_t.barangjadi_id  AND penjualanbrgdet_t.barangjadi_id='$galonid' AND date_part('MONTH', tglpenjualanbrg)='$bln'")->queryAll();
                            $komisikarton = Yii::app()->db->createCommand()->select('SUM(penjualanbrgdet_t.jmljual) As total')->from('penjualanbrgdet_t, barangjadi_m, penjualanbrg_t')->where("penjualanbrg_t.penjualanbrg_id = penjualanbrgdet_t.penjualanbrg_id AND barangjadi_m.barangjadi_id=penjualanbrgdet_t.barangjadi_id AND penjualanbrgdet_t.barangjadi_id IN($kartonid,$karton2id) AND date_part('MONTH', tglpenjualanbrg)='$bln'")->queryAll();
                            $komisigelas = Yii::app()->db->createCommand()->select('SUM(penjualanbrgdet_t.jmljual) As total')->from('penjualanbrgdet_t, barangjadi_m, penjualanbrg_t')->where("penjualanbrg_t.penjualanbrg_id = penjualanbrgdet_t.penjualanbrg_id AND barangjadi_m.barangjadi_id=penjualanbrgdet_t.barangjadi_id  AND penjualanbrgdet_t.barangjadi_id='$gelasid' AND date_part('MONTH', tglpenjualanbrg)='$bln'")->queryAll();
                            $galon = $komisigalon[0]['total'];
                            $karton = $komisikarton[0]['total'];
                            $gelas = $komisigelas[0]['total'];
                            $tglterbaru = $command[0]['tglterbaru'];
                            $totalgajipoko = isset($masterGaji->gajipokok) ? $masterGaji->gajipokok : 0;
                            $totalkomisigalon = $galon*(isset($masterGaji->kgalon) ? $masterGaji->kgalon : 0);
                            $totalkomisikarton = $karton*(isset($masterGaji->kkarton) ? $masterGaji->kkarton : 0);
                            $totalkomisigelas = $gelas*(isset($masterGaji->kgelas) ? $masterGaji->kgelas : 0);
                            $gaji = isset($gaji1bln->gajipokok) ? $gaji1bln->gajipokok : 0;
                            
                            $jumlah = 0;
                            $trJumlah = '';
                            //$value->jumlah = isset($value->jumlah) ? $value->jumlah : 0;
                            foreach ($modKomponengaji as $value)
                            { 
                                $tr = '<tr class="row">';
                                $tr .= '<td>'
                                    .CHtml::label($nourut,'jumlah'.$nourut)
                                    .'</td>';
                                $tr .= '<td>'.CHtml::label($value->komponengaji_nama,'jumlah'.$nourut).'</td>';
                                
                                    $dataKarykomponen = KarykomponenM::model()->findByAttributes(array('karyawan_id'=>$id,'komponengaji_id'=>$value->komponengaji_id,'tglberlaku'=>$tglterbaru));
                                    if (COUNT($dataKarykomponen) > 0) { $ceklis = true; } else { $ceklis = false;}
                                    
                                    if(count($dataKarykomponen) > 0){
                                        switch($value->komponengaji_id){
                                            case 1 : {
                                                        if($totalgajipoko != 0){
                                                            $jumlah = $totalgajipoko;
                                                        }else{
                                                            $jumlah = isset($gaji1bln) ? $gaji1bln : 0;
                                                        }

                                                     } break;
                                            case 3 : $jumlah = $totalkomisigalon; break;
                                            case 4 : $jumlah = $totalkomisikarton; break;
                                            case 17 : $jumlah = $totalkomisigelas; break;
//                                            default : $jumlah = $gaji; break;
                                        }
                                        
                                        $jumlah = isset($dataKarykomponen->jumlah) ? $dataKarykomponen->jumlah : 0;
//                                        $jumlah = isset($jumlah) ? $jumlah : $dataKarykomponen->jumlah;
//                                        $jumlah = CHtml::textField('jumlah['.$value->komponengaji_id.']',$jumlah,array('class'=>'digit-medium','id'=>'jumlah'.$nourut));
//                                        $trJumlah = CHtml::textField('jumlah['.isset($value->komponengaji_id) ? $value->komponengaji_id : null.']',$jumlah,array('class'=>'digit-medium','id'=>'jumlah'.$nourut));
                                        $trJumlah = CHtml::textField('total['.$value->komponengaji_id.']',$jumlah,array('class'=>'digit-medium','id'=>'jumlah'.$nourut));
                                    }else{
//                                        $trJumlah = CHtml::textField('jumlah['.isset($value->komponengaji_id) ? $value->komponengaji_id : null.']',$jumlah,array('class'=>'digit-medium','id'=>'jumlah'.$nourut));
                                        $trJumlah = CHtml::textField('total['.$value->komponengaji_id.']',$jumlah,array('class'=>'digit-medium','id'=>'jumlah'.$nourut));
                                    }
//                                    
                                    if ($value->isgaji == TRUE) {
                                        $tr .= '<td>'.$trJumlah.'</td>';
                                        $tr .= '<td></td>';
                                    } else {
                                        $tr .= '<td></td>';
                                        $tr .= '<td>'.$trJumlah.'</td>';
                                    }
                                $tr .= '<td>'
                                    .CHtml::checkBox('komponengaji_id[]',$ceklis,array('value'=>$value->komponengaji_id,'url'=>'#','class'=>'checkbox','checked'=>'checked'))
                                    .'</td>';
                                $tr .= '</tr>';
                                $nourut++;
                                $i++;
                                echo $tr;
                            }
                        ?>
                    </tbody>
                </table>
               <div class="mws-button-row">
                    <?php 
                    echo CHtml::submitButton($modKarykomponen->isNewRecord ? 'Create' : 'Create', array('class' => 'mws-button blue'));
                    echo CHtml::ResetButton($modKarykomponen->isNewRecord ? 'Reset' : 'Reset', array('class' => 'mws-button green')); ?>

               </div>   
                    
                <?php $this->endWidget(); ?>

            </div>
        </div>    	
    </div><!-- form -->
</div>
<?php
$jscript = <<< JS
$('.checkbox').click(function() {
  $(this).parent('tr').('.digit-short').val()
});
   
JS;
Yii::app()->clientScript->registerScript('komponengaji',$jscript, CClientScript::POS_HEAD);
?>
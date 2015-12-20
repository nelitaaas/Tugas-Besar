
<?php 
if($caraPrint=='EXCEL')
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$judulLaporan.'-'.date("Y/m/d").'.xls"');
    header('Cache-Control: max-age=0');     
}
echo $this->renderPartial('application.views.headerReport.headerDefault',array('judulLaporan'=>$judulLaporan));      
?>
    <div class="mws-panel-body" align="center">
        <div class="mws-form">
                <?php
                
                    $id = $_GET['id'];
                    $model = PenggajianT::model()->findByPK($id);
                ?>
     
                <div class="mws-form-inline">   
                    <table align="center" width="100%">
                        <tr>
                            <td width="50%">
                                    
                            <div class="mws-form-row">
                                    <?php echo CHtml::label('Nama karyawan','',array('style'=>'text-align:left;')); ?>
                                     <span>
                                     <?php echo CHtml::label($model->karyawan->nama_karyawan,'',array('style'=>'text-align:left;')); ?>
                                      </span>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo CHtml::label('Tgl Penggajian','',array('style'=>'text-align:left;')); ?>
                                     <span class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->tglpenggajian,'',array('style'=>'text-align:left;')); ?>
                                      </span>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo CHtml::label('No penggajian','',array('style'=>'text-align:left;')); ?>
                                     <span class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->nopenggajian,'',array('style'=>'text-align:left;')); ?>
                                      </span>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo CHtml::label('keterangan','',array('style'=>'text-align:left;')); ?>
                                     <span class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->keterangan,'',array('style'=>'text-align:left;')); ?>
                                      </span>
                            </div>
                               
                                
                            </td>
                            <td width="50%" style="padding-left:10%;">
                               
                                
                                                         
                                
                            <div class="mws-form-row">
                                    <?php echo CHtml::label('Penerimaan kotor','',array('style'=>'text-align:left;')); ?>
                                     <span class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->penerimaankotor,'',array('style'=>'text-align:left;')); ?>
                                      </span>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo CHtml::label('Jumlah potongan','',array('style'=>'text-align:left;')); ?>
                                     <span class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->jmlpotongan,'',array('style'=>'text-align:left;')); ?>
                                      </span>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo CHtml::label('Penerimaan bersih','',array('style'=>'text-align:left;')); ?>
                                     <span class="mws-form-item ">                                            
                                        <?php echo CHtml::label($model->penerimaanbersih,'',array('style'=>'text-align:left;')); ?>
                                      </span>
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
                </div>   
            </div>
        </div>
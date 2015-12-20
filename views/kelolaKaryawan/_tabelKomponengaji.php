<!--<span><?php // echo CHtml::checkBox('showhideKomponengaji', false,array('onchange'=>'riwayatKomponengaji()')).' Riwayat Komponen gaji'; ?></span>-->
Komponen gaji
<div class="mws-table" id="tabelKomponengaji" style="width:100%;overflow:auto;">
    <div class="grid-view">
<table class="mws-table" style="width:100%;margin:0px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal berlaku</th>
                    <th>Gaji pokok</th>
                    <th>Penerimaan</th>
                    <th>Pengeluaran</th>
                    <th>Gaji bersih</th>
                    <th>Batal</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $id = $_GET['id'];
                $i = 1;
                $criteria = new CDbCriteria;
                $criteria->select = 'tglberlaku';
                $criteria->group = 'tglberlaku';
                $criteria->compare('karyawan_id',$id);
//                $modKarykompn = KarykomponenM::model()->findAllByAttributes(array('karyawan_id'=>$id),array('distinct'=>'tglberlaku'));
                $modKarykomponen = KarykomponenM::model()->findAll($criteria);
//                $modKarykomponen = Yii::app()->db->createCommand('SELECT tglberlaku FROM karykomponen_m GROUP BY tglberlaku')->queryAll();
                foreach ($modKarykomponen as $value)
                {
                    $tr = '<tr class="odd">';
                    $tr .= '<td>'.$i.'</td>';
                    $tr .= '<td>'.$value->tglberlaku.'</td>';
                    $modKarykomponengajipokok = KarykomponenM::model()->findByAttributes(array('karyawan_id'=>$id,'komponengaji_id'=>'1','tglberlaku'=>$value->tglberlaku));
                    $gajipokok = $modKarykomponengajipokok->jumlah;
                    $tr .= '<td>'.number_format($gajipokok,0,'','.').'</td>';
                    $totalpendapatan = 0;
                    $totalpembayaran  = 0;
                    $modKomponengaji = KomponengajiM::model()->findAll("isgaji=TRUE AND komponengaji_id > 1 ORDER BY komponengaji_id");
                    foreach ($modKomponengaji as $komponen)
                    {
                        $modKarykomponenpendapatan = KarykomponenM::model()->findByAttributes(array('karyawan_id'=>$id,'tglberlaku'=>$value->tglberlaku,'komponengaji_id'=>$komponen->komponengaji_id));
                        $totalpendapatan += isset($modKarykomponenpendapatan->jumlah) ? $modKarykomponenpendapatan->jumlah : 0;
                    }
                    
                    $tr .= '<td>'.number_format($totalpendapatan,0,'','.').'</td>';
                    
                    $modKomponenpotongan = KomponengajiM::model()->findAll("ispotongan=TRUE ORDER BY komponengaji_id");
                    foreach ($modKomponenpotongan as $komponenpotongan)
                    {
                        $modKarykomponenpembayaran = KarykomponenM::model()->findByAttributes(array('karyawan_id'=>$id,'tglberlaku'=>$value->tglberlaku,'komponengaji_id'=>$komponenpotongan->komponengaji_id));
                        $totalpembayaran += isset($modKarykomponenpembayaran->jumlah) ? $modKarykomponenpembayaran->jumlah : 0;
                    }
                    
                    $tr .= '<td>'.number_format($totalpembayaran,0,'','.').'</td>';
                    $gajibersih = $gajipokok+$totalpendapatan-$totalpembayaran;
                    $tr .= '<td>'.number_format($gajibersih,0,'','.').'</td>';
                    $tr .= '<td>'.CHtml::link('<span class="mws-ic-16 ic-delete2"></span>','index.php?r='.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/deleteKarykomponen&karyawan_id='.$id.'&id='.$value->tglberlaku,array('onclick'=>'if (!confirm("Anda yakin akan menghapus item ini ?")) { return false; } else {return true;}')).'</td>';
                    $tr .= '</tr>';
                    echo $tr;
                    $i++;
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    function riwayatKomponengaji() {
        if ($('#showhideKomponengaji').is(':checked'))
            {
                $('#tabelKomponengaji').show();
            } else {
                $('#tabelKomponengaji').hide();
            }
    }
</script>

        <table class="mws-table" style="width:100%;margin:0px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal berlaku</th>
                    <th>Gaji pokok</th>
                    <th>Penerimaan</th>
                    <th>Pengeluaran</th>
                    <th>Gaji bersih</th>
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
                    
                    $modKomponengaji = KomponengajiM::model()->findAll("isgaji=TRUE AND komponengaji_id > 1 ORDER BY komponengaji_id");
                    foreach ($modKomponengaji as $komponen)
                    {
                        $modKarykomponenpendapatan = KarykomponenM::model()->findByAttributes(array('karyawan_id'=>$id,'tglberlaku'=>$value->tglberlaku,'komponengaji_id'=>$komponen->komponengaji_id));
                        $totalpendapatan += $modKarykomponenpendapatan->jumlah;
                    }
                    
                    $tr .= '<td>'.number_format($totalpendapatan,0,'','.').'</td>';
                    
                    $modKomponenpotongan = KomponengajiM::model()->findAll("ispotongan=TRUE ORDER BY komponengaji_id");
                    foreach ($modKomponenpotongan as $komponenpotongan)
                    {
                        $modKarykomponenpembayaran = KarykomponenM::model()->findByAttributes(array('karyawan_id'=>$id,'tglberlaku'=>$value->tglberlaku,'komponengaji_id'=>$komponenpotongan->komponengaji_id));
                        $totalpembayaran += $modKarykomponenpembayaran->jumlah;
                    }
                    
                    $tr .= '<td>'.number_format($totalpembayaran,0,'','.').'</td>';
                    $gajibersih = $gajipokok+$totalpendapatan-$totalpembayaran;
                    $tr .= '<td>'.number_format($gajibersih,0,'','.').'</td>';
                    $tr .= '</tr>';
                    echo $tr;
                    $i++;
                }
            ?>
            </tbody>
        </table>

        <table class="mws-table" style="width:100%;margin:0px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis cuti</th>
                    <th>Tahun cuti</th>
                    <th>Tgl mulai</th>
                    <th>Tgl berakhir</th>
                    <th>Lama</th>
                    <th>Alasan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $id = $_GET['id'];
                $i = 1;
                $modCutikaryawan = CutikaryawanR::model()->findAllByAttributes(array('karyawan_id'=>$id),array('order'=>'nourutcuti'));
                foreach ($modCutikaryawan as $value)
                {
                    $tr = '<tr class="odd">';
                    $tr .= '<td>'.$i.'</td>';
                    $tr .= '<td>'.$value->jeniscuti->jeniscuti_nama.'</td>';
                    $tr .= '<td>'.$value->tahuncuti.'</td>';
                    $tr .= '<td>'.$value->tglmulaicuti.'</td>';
                    $tr .= '<td>'.$value->tglakhircuti.'</td>';
                    $tr .= '<td>'.$value->lamacuti.' hari'.'</td>';
                    $tr .= '<td>'.$value->alasancuti.'</td>';
                    $tr .= '<td>'.$value->keterangancuti.'</td>';
                    $tr .= '</tr>';
                    echo $tr;
                    $i++;
                }
            ?>
            </tbody>
        </table>
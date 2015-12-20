
        <table class="mws-table" style="width:100%;margin:0px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama perusahaan</th>
                    <th>Bidang usaha</th>
                    <th>Jabatan</th>
                    <th>Keterangan</th>
                    <th>Alasan berhenti</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $id = $_GET['id'];
                $modPengalamankerja = PengalamankerjaR::model()->findAllByAttributes(array('karyawan_id'=>$id),array('order'=>'pengalamankerja_nourut'));
                foreach ($modPengalamankerja as $value)
                {
                    $tr = '<tr class="odd">';
                    $tr .= '<td>'.$value->pengalamankerja_nourut.'</td>';
                    $tr .= '<td>'.$value->namaperusahaan.'</td>';
                    $tr .= '<td>'.$value->bidangperusahaan.'</td>';
                    $tr .= '<td>'.$value->jabatanterahkir.'</td>';
                    $tr .= '<td>'.$value->keterangan.'</td>';
                    $tr .= '<td>'.$value->alasanberhenti.'</td>';
                    $tr .= '</tr>';
                    echo $tr;
                    $i++;
                }
            ?>
            </tbody>
        </table>
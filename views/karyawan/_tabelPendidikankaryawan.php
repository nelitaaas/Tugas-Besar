

        <table class="mws-table" width="100%" style="margin-top:0px;width:100%;margin:0px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis pendidikan</th>
                    <th>Nama pendidikan</th>
                    <th>Tgl lulus</th>
                    <th>Nama pendidikan</th>
                    <th>Jurusan</th>
                    <th>Lama pendidikan</th>
                    <th>No ijazah</th>
                    <th>IPK</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $id = $_GET['id'];
                $modPendidikankaryawan = PendidikankaryawanR::model()->findAllByAttributes(array('karyawan_id'=>$id),array('order'=>'pendidikankaryawan_nourut'));
                foreach ($modPendidikankaryawan as $value)
                {
                    $tr = '<tr class="odd">';
                    $tr .= '<td>'.$value->pendidikankaryawan_nourut.'</td>';
                    $tr .= '<td>'.$value->jenispendidikan.'</td>';
                    $tr .= '<td>'.$value->pendidikankaryawan_nama.'</td>';
                    $tr .= '<td>'.$value->tgllulus.'</td>';
                    $tr .= '<td>'.$value->pendidikan_nama.'</td>';
                    $tr .= '<td>'.$value->jurusan_nama.'</td>';
                    $tr .= '<td>'.$value->lamapendidikan.' tahun'.'</td>';
                    $tr .= '<td>'.$value->no_ijazah.'</td>';
                    $tr .= '<td>'.$value->nilai_ipk.'</td>';
                    $tr .= '</tr>';
                    echo $tr;
                    $i++;
                }
            ?>
            </tbody>
        </table>
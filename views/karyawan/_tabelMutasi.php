
        <table class="mws-table" style="width:100%;margin:0px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No surat</th>
                    <th>Tgl mutasi</th>
                    <th>Departement awal</th>
                    <th>Jabatan awal</th>
                    <th>Lokasi awal</th>
                    <th>Departement tujuan</th>
                    <th>Jabatan tujuan</th>
                    <th>Lokasi tujuan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $id = $_GET['id'];
                $i = 1;
                $modMutasi = MutasiR::model()->findAllByAttributes(array('karyawan_id'=>$id),array('order'=>'mutasi_id'));
                foreach ($modMutasi as $value)
                {
                    $tr = '<tr class="odd">';
                    $tr .= '<td>'.$i.'</td>';
                    $tr .= '<td>'.$value->mutasi_nomorsurat.'</td>';
                    $tr .= '<td>'.$value->tglmutasi.'</td>';
                    $tr .= '<td>'.$value->departementawal.' - '.$value->subdepartementawal.'</td>';
                    $tr .= '<td>'.$value->jabatanawal.'</td>';
                    $tr .= '<td>'.$value->lokasiawal.'</td>';
                    $tr .= '<td>'.$value->departementtujuan.' - '.$value->subdepartementtujuan.'</td>';
                    $tr .= '<td>'.$value->jabatantujuan.'</td>';
                    $tr .= '<td>'.$value->lokasitujuan.'</td>';
                    $tr .= '<td>'.$value->keterangan_mutasi.'</td>';
                    $tr .= '</tr>';
                    echo $tr;
                    $i++;
                }
            ?>
            </tbody>
        </table>
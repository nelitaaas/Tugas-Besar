<!--<span><?php // echo CHtml::checkBox('showhideMutasi', false,array('onchange'=>'riwayatMutasi()')).' Data mutasi'; ?></span>-->
Mutasi
<div class="mws-table" id="tabelRiwayatmutasi">
    <div class="grid-view">
        <table class="items" width="100%">
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
                    $tr .= '<td>'.CHtml::link('<span class="mws-ic-16 ic-delete2"></span>','index.php?r='.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/deleteMutasi&karyawan_id='.$id.'&id='.$value->mutasi_id,array('onclick'=>'if (!confirm("Anda yakin akan menghapus item ini ?")) { return false; } else {return true;}')).'</td>';
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
    function riwayatMutasi() {
        if ($('#showhideMutasi').is(':checked'))
            {
                $('#tabelRiwayatmutasi').show();
            } else {
                $('#tabelRiwayatmutasi').hide();
            }
    }
</script>
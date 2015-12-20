<!--<span><?php // echo CHtml::checkBox('showhidePengalamankerja', false,array('onchange'=>'riwayatPengalamankerja()')).' Pengalaman kerja'; ?></span>-->
Pengalaman kerja
<div class="mws-table" id="tabelRiwayatpengalamankerja">
    <div class="grid-view">
        <table class="items" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama perusahaan</th>
                    <th>Bidang usaha</th>
                    <th>Jabatan</th>
                    <th>Keterangan</th>
                    <th>Alasan berhenti</th>
                    <th>Batal</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $id = $_GET['id'];
                $i = 1;
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
                    $tr .= '<td>'.CHtml::link('<span class="mws-ic-16 ic-delete2"></span>','index.php?r='.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/deletePengalamankerja&karyawan_id='.$id.'&id='.$value->pengalamankerja_id,array('if (!confirm("Anda yakin akan menghapus item ini ?")) { return false; } else {return true;}')).'</td>';
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
    function riwayatPengalamankerja() {
        if ($('#showhidePengalamankerja').is(':checked'))
            {
                $('#tabelRiwayatpengalamankerja').show();
            } else {
                $('#tabelRiwayatpengalamankerja').hide();
            }
    }
</script>
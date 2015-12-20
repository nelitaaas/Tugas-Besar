<span><?php // echo CHtml::checkBox('showhidePendidikan', false,array('onchange'=>'riwayatPendidikan()')).' Riwayat pendidikan'; ?></span>
Pendidkan karyawan
<div class="mws-table" id="tabelRiwayatpendidikan">
    <div class="grid-view">
        <table class="items" width="100%">
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
                    <th>Batal</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $id = $_GET['id'];
                $i = 1;
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
//                    $tr .= '<td>'.CHtml::link('<span class="mws-ic-16 ic-delete2"></span>','javascript:void(0);',array('onclick'=>'konfirmasi();')).'</td>';
                    $tr .= '<td>'.CHtml::link('<span class="mws-ic-16 ic-delete2"></span>','index.php?r='.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/deletePendidikan&karyawan_id='.$id.'&id='.$value->pendidikankaryawan_id,array('onclick'=>'return (!confirm("Anda yakin akan menghapus item ini ?")) ? false : true')).'</td>';
//                    $tr .= '<td>'.CHtml::link('<span class="mws-ic-16 ic-delete2"></span>','',array('onclick'=>'if (!confirm("Anda yakin akan menghapus item ini ?")) { return false; } else {return true;}', 'href'=>'')).'</td>';
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
    function riwayatPendidikan() {
        if ($('#showhidePendidikan').is(':checked'))
            {
                $('#tabelRiwayatpendidikan').show();
            } else {
                $('#tabelRiwayatpendidikan').hide();
            }
    }

</script>
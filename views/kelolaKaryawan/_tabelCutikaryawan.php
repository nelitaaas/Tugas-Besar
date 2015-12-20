<!--<span><?php // echo CHtml::checkBox('showhideCutikaryawan', false,array('onchange'=>'riwayatCuitkaryawan()')).' Riwayat Cuti karyawan'; ?></span>-->
Cuti karyawan
<div class="mws-table" id="tabelCutikaryawan">
    <div class="grid-view">
        <table class="items" width="100%">
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
                    <th>Batal</th>
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
                    $tr .= '<td>'.CHtml::link('<span class="mws-ic-16 ic-delete2"></span>','index.php?r='.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/deleteCutikaryawan&karyawan_id='.$id.'&id='.$value->cutikaryawan_id,array('onclick'=>'if (!confirm("Anda yakin akan menghapus item ini ?")) { return false; } else {return true;}')).'</td>';
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
    function riwayatCuitkaryawan() {
        if ($('#showhideCutikaryawan').is(':checked'))
            {
                $('#tabelCutikaryawan').show();
            } else {
                $('#tabelCutikaryawan').hide();
            }
    }
</script>
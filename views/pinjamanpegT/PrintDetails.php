<?php 
if (isset($judulLaporan)) {
if(isset($_POST["EXCEL"]))
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$judulLaporan.'-'.date("Y/m/d").'.xls"');
    header('Cache-Control: max-age=0');     
} 
echo $this->renderPartial('application.views.headerReport.headerDefault',array('judulLaporan'=>$judulLaporan));  
?>
 <?php  } ?>

<?php 
echo CHtml::css('
    label{
        display:inline-block;
        float:left;
        width:200px;
        padding-right:10px;
        }
   .item{
        display:inline-block; 
        float:left;
    }
    .kanan{
        text-align:right;
    }
    .kiri{
        text-align:left;
    }
'); 
?>

<table width="100%">
    <tbody>
        <tr>
            <td width="50%" class='kanan'>
                <div class="mws-form-row">
                    <label>
                        <?php echo CHtml::encode($model->getAttributeLabel('pinjamanpeg_id')); ?>:
                    </label>
                    <div class="item ">                                            
                        <?php echo CHtml::encode($model->pinjamanpeg_id); ?>
                    </div><br>
                    <label>
                        <?php echo CHtml::encode($model->getAttributeLabel('karyawan_id')); ?>:
                    </label>
                    <div class="item ">                                            
                        <?php echo CHtml::encode(isset($model->karyawan->nama_karyawan) ? $model->karyawan->nama_karyawan : "-"); ?>
                    </div><br>
                </div>
            </td>
            <td width="50%" class='kanan'>
                <div class="mws-form-row">
                    <label>
                        <?php echo CHtml::encode($model->getAttributeLabel('komponengaji_id')); ?>:
                    </label>
                    <div class="item ">                                            
                        <?php echo CHtml::encode($model->komponengaji->komponengaji_nama); ?>
                    </div><br>
                    <label>
                        <?php echo CHtml::encode($model->getAttributeLabel('sisapinjaman')); ?>:
                    </label><br>
                    <div class="item ">                                            
                        <?php echo CHtml::encode($model->sisapinjaman); ?>
                    </div><br>
                </div>
            </td>
            
        </tr>
    </tbody>
</table>
<br/>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'belibrgdetail-t-grid',
    'dataProvider' => $modDetails->search(),
    'template' => '{items}',
    'columns' => array(
        array(
          'header'=>'ID',
          'value'=>'$data->pinjampegdet_id',
        ),
        array(
          'header'=>'Angsuran Ke-',
          'value'=>'$data->angsuranke',
        ),
        array(
          'header'=>'Tanggal Akan Dibayar',
          'value'=>'$data->tglakanbayar',
        ),
        array(
          'header'=>'Jumlah Cicilan',
          'value'=>'$data->jmlcicilan',
        ),
        array(
            'header'=>'Pembayaran',
            'value'=>'($data->isbayar == 1) ? "Sudah Dibayar":"Belum Dibayar"',

        ),

    ),
));
?>
<br/>
<?php if (empty($judulLaporan)) { ?>
<style>
.mws-button.blue {
    background-color: #4386BC;
    background-image: -moz-linear-gradient(#5D9ED2, #4386BC);
    border: 1px solid #416B8B;
    color: #FFFFFF;
    width: auto;
    display:block;
    float:right;
}
.mws-button, .ui-button {
    border: 0 none;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 1px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    font-family: 'PTSansRegular',Arial,Helvetica,sans-serif;
    outline: medium none;
    padding: 6px 9px;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4);
}
</style>
<?php } ?>
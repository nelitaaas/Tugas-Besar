<?php
function styleCss($id,$indexTab){
    $css = 'linkTab';
    switch ($indexTab){
        case 0 : {if($id==$indexTab)$css = 'linkTab selected pendidikan' ;break;}
        case 1 : {if($id==$indexTab)$css = 'linkTab selected pengalaman' ;break;}
        case 2 : {if($id==$indexTab)$css = 'linkTab selected mutasi' ;break;}
        case 3 : {if($id==$indexTab)$css = 'linkTab selected cuti' ;break;}
        case 4 : {if($id==$indexTab)$css = 'linkTab selected jenjang' ;break;}
        case 5 : {if($id==$indexTab)$css = 'linkTab selected kontrak' ;break;}
        case 6 : {if($id==$indexTab)$css = 'linkTab selected prestasi' ;break;}
        case 7 : {if($id==$indexTab)$css = 'linkTab selected peringatan' ;break;}
        default : {$css = 'linkTab' ;break;}
    }
    return $css;
}
?>

<a class ="<?php echo styleCss(0,$indexTab)?>" title="Pendidikan Karyawan" href="javascript:Palidasi('karyawan/pendidikanKaryawan/id/<?php echo $id?>')">Pendidikan Karyawan</a>
<a class ="<?php echo styleCss(1,$indexTab)?>" title="Pengalaman Kerja" href="javascript:Palidasi('karyawan/pengalamanKerja/id/<?php echo $id ?>')">Pengalaman Kerja</a>
<a class ="<?php echo styleCss(2,$indexTab)?>" title="Mutasi" href="javascript:Palidasi('karyawan/mutasi/id/<?php echo $id ?>')">Mutasi</a>
<a class ="<?php echo styleCss(3,$indexTab)?>" title="Cuti Karyawan" href="javascript:Palidasi('karyawan/cuti/id/<?php echo $id ?>')">Cuti Karyawan</a>
<a class ="<?php echo styleCss(4,$indexTab)?>" title="Jenjang Karir" href="javascript:Palidasi('karyawan/jenjangKarir/id/<?php echo $id ?>')">Jenjang Karir</a>
<a class ="<?php echo styleCss(5,$indexTab)?>" title="Kontrak Kerja" href="javascript:Palidasi('karyawan/kontrak/id/<?php echo $id ?>')">Kontrak Kerja</a>
<a class ="<?php echo styleCss(6,$indexTab)?>" title="Prestasi Kerja" href="javascript:Palidasi('karyawan/prestasiKerja/id/<?php echo $id ?>')">Prestasi Kerja</a>
<a class ="<?php echo styleCss(7,$indexTab)?>" title="Surat Peringatan" href="javascript:Palidasi('karyawan/suratPeringatan/id/<?php echo $id ?>')">Surat Peringatan</a>

<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>array(
        'Pendidikan Karyawan'=>array('ajax'=>array('karyawan/ajaxpendidikanKaryawan/id/'.$id)),
        'Pengalaman Kerja'=>array('ajax'=>array('karyawan/ajaxpengalamanKerja/id/'.$id)),
        'Mutasi'=>array('ajax'=>array('karyawan/ajaxmutasi/id/'.$id)),
        'Cuti Karyawan'=>array('ajax'=>array('karyawan/ajaxcuti/id/'.$id)),
        'Jenjang Karir'=>array('ajax'=>array('karyawan/ajaxjenjangKarir/id/'.$id)),
        'Kontrak Kerja'=>array('ajax'=>array('karyawan/ajaxkontrak/id/'.$id)),
        'Prestasi Kerja'=>array('ajax'=>array('karyawan/ajaxprestasiKerja/id/'.$id)),
        'Surat Peringatan'=>array('ajax'=>array('karyawan/ajaxsuratPeringatan/id/'.$id)),
    ),
    'options'=>array(
        'collapsible'=>false,
        'selected'=>$indexTab,
        'cache'=>true,
        'deselectable'=>false,
        'disabled'=> array(0,1,2,3,4,5,6,7,8),
    ),
  'themeUrl'=>Yii::app()->request->baseUrl.'/css/jui',
   'theme'=>'redmond',
    'htmlOptions'=>array(
//        'style'=>'width:100%;' 
        'id'=>'tab'
    ),
));
?>


<script type="text/javascript">

function Palidasi(url)
   {
       var berubah = $('#berubah').val();
        if(berubah=='Ya') 
        {
           if(confirm('Apakah Anda Akan menyimpan Perubahan Yang Sudah Dilakukan?'))
               {
                    $('#link').val('index.php/'+url'/kepegawaian/');
                    $('.buttonSimpan').click();
                }
           else
                {
                   location.href = 'index.php/'+url'/kepegawaian/';
                }
        }
        else
        {
        location.href = 'index.php/'+url'/kepegawaian/';
        }
      
   }

</script>

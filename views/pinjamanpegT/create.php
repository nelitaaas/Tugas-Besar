
<h1>Form Pinjaman Pegawai</h1>


<?php if($model->isNewRecord)
      {
        echo $this->renderPartial('_form',
            array
           ('model'=>$model));
        
      }else{
          
           echo $this->renderPartial('_form',
            array
           ('model'=>$model,'modDetails'=>$modDetails));
      }
?>
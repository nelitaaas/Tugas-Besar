<?php

class ActionAutoCompleteController extends Controller
{       
        public function actionPropinsi()
	{
            if(Yii::app()->request->isAjaxRequest) {
                $criteria = new CDbCriteria();
                $criteria->compare('LOWER(propinsi_nama)', strtolower($_GET['term']), true);
                $models = PropinsiM::model()->findAll($criteria);
                foreach($models as $model)
                {
                   $returnVal[] = array(    
                      'label'=>$model->propinsi_nama,
                      'value'=>$model->propinsi_nama,
                      'propinsi_id'=>$model->propinsi_id,
                   );
                }

                echo CJSON::encode($returnVal);
            }
            Yii::app()->end();
	}
        
        public function actionKaryawan()
	{
            if(Yii::app()->request->isAjaxRequest) {
                $criteria = new CDbCriteria();
                $criteria->compare('LOWER(nama_karyawan)', strtolower($_GET['term']), true);
                $criteria->order = 'nama_karyawan';
                $criteria->limit=10;
                $models = KKaryawanM::model()->findAll($criteria);
                foreach($models as $i=>$model)
                {
                    $attributes = $model->attributeNames();
                    foreach($attributes as $j=>$attribute) {
                        $returnVal[$i]['label'] = $model->karyawan_id.' - '.$model->nama_karyawan;
                        $returnVal[$i]['value'] = $model->nama_karyawan;
                        $returnVal[$i]["$attribute"] = $model->$attribute;
                    }
                }

                echo CJSON::encode($returnVal);
            }
            Yii::app()->end();
	}
        

}
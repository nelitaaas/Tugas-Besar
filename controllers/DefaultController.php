<?php

class DefaultController extends Controller
{
            
                public $accordionIndex = Params::ACCORDION_PEGAWAI;
                public function accessRules()
	{
                                
                                
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','daftarKaryawan'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}    
                
	public function actionIndex()
	{
//                        $accordionIndex = 2;    
                         if(!$this->cekRoles(Params::DEFAULT_ADMIN)){throw new CHttpException(401,Yii::t('mds','You are prohibited to access this page. Contact Super Administrator'));}
                         if(!Yii::app()->user->checkAccess('View')){throw new CHttpException(401,Yii::t('mds','You are prohibited to access this page. Contact Super Administrator'));}   
                        $this->render('index');
	}
        
                public function actionDaftarKaryawan()
	{
		$model=new KKaryawanM('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KKaryawanM']))
			$model->attributes=$_GET['KKaryawanM'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
}
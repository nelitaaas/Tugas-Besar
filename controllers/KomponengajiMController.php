<?php

class KomponengajiMController extends Controller
{
      
                public $accordionIndex = Params::ACCORDION_PEGAWAI;
                public $defaultAction = 'admin';
         
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
                if(!Yii::app()->user->checkAccess(Yii::app()->controller->action->id)){throw new CHttpException(401,Yii::t('mds','You are prohibited to access this page. Contact Super Administrator'));}
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','admin','delete','print'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new KomponengajiM;
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KomponengajiM']))
		{
                       	$model->attributes=$_POST['KomponengajiM'];
                        if ($_POST['KomponengajiM']['is'] == "isgaji"){
                            $model->isgaji = true;
                            $model->ispotongan = false;
                        }else{
                            $model->isgaji = false;
                            $model->ispotongan = true;
                        }
                        
			if($model->save())
				$this->redirect(array('admin','id'=>$model->komponengaji_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KomponengajiM']))
		{
			$model->attributes=$_POST['KomponengajiM'];
                        if ($_POST['KomponengajiM']['is'] == "isgaji"){
                            $model->isgaji = true;
                            $model->ispotongan = false;
                        }else{
                            $model->isgaji = false;
                            $model->ispotongan = true;
                        }
			if($model->save())
				$this->redirect(array('admin','id'=>$model->komponengaji_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('KomponengajiM');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KomponengajiM('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KomponengajiM']))
			$model->attributes=$_GET['KomponengajiM'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=KomponengajiM::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='komponengaji-m-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
                
                
                public function actionPrint()
                {
                    $model= new KKomponengajiM;
                    $model->unsetAttributes();
                    $model->attributes=$_REQUEST['KKomponengajiM'];
                    $judulLaporan='Laporan Komponen Gaji';
                    $caraPrint=$_REQUEST['caraPrint'];
//                    echo print_r($model->attributes);exit();
                    if($caraPrint=='PRINT') {
                        $this->layout='//layouts/printWindows';
                        $this->render('Print',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
                    }
                    else if($caraPrint=='EXCEL') {
                        $this->layout='//layouts/printExcel';
                        $this->render('Print',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
                    }
                    else if($_REQUEST['caraPrint']=='PDF') {
                        $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
                        $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
                        $mpdf = new MyPDF('',$ukuranKertasPDF); 
                        $mpdf->useOddEven = 2;  
                        $mpdf->WriteHTML($stylesheet,1);
                        $mpdf->AddPage($posisi,'','','','',15,15,15,15,15,15);
                        $mpdf->WriteHTML($this->renderPartial('Print',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint),true));
                        $mpdf->Output();
                    }                       
                }
}

//mencoba test git
<?php

class PenggajianTController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete','print','bayar','Printpenggajian','Printrincian'),
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
		$this->render('rincian',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new KPenggajianT;
                                $modPenggajiandetail = new PenggajiandetailT;
                                $modPengeluarankas = new PengeluarankasT;
                                $model->tglpenggajian = date('Y-m-d');
                                $model->mengetahui = KaryawanM::model()->findByPk(Params::KARYAWAN_ID)->nama_karyawan;
                                $pegawai = LoginpemakaiK::model()->findByPk(Yii::app()->user->id);
                                $model->pegpengeluran = isset($pegawai->karyawan_id) ? $pegawai->karyawan->nama_karyawan : "";
//                                $model->pegpengeluran = LoginpemakaiK::model()->findByPk(Yii::app()->user->id)->karyawan->nama_karyawan;
                                $model->menyetujui = isset(KaryawanM::model()->findByPk(Params::PEG_MENYETUJUI_ID)->nama_karyawan) ? KaryawanM::model()->findByPk(Params::PEG_MENYETUJUI_ID)->nama_karyawan : "";
                                $model->jenispengeluaran_id = Params::JENIS_PENGELUARAN_ID;
                                $command = Yii::app()->db->createCommand()->select('MAX(pengeluarankas_id) AS maxnumber')->from('pengeluarankas_t')->queryAll();
                                $maxnumber = $command[0]['maxnumber'];
                                $urutan = substr($maxnumber,-1) + 1;
                                $nomor = date('Ymd').CustomFormat::pad_zero($urutan,3,TRUE);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KPenggajianT']))
		{
                                                $transaction = Yii::app()->db->beginTransaction();
                                                try {
                                                    if (isset($_POST['save'])) {
                                                        $model->attributes=$_POST['KPenggajianT'];
                                                        $model->penerimaankotor = Params::formatNumberForDB($model->penerimaankotor);
                                                        $model->penerimaanbersih = Params::formatNumberForDB($model->penerimaanbersih);
                                                        $model->jmlpotongan = Params::formatNumberForDB($model->jmlpotongan);
//                                                       
                                                        $model->pengeluarankas_id = '0';
                                                        $model->bulan = date('m');
                                                        $model->tahun = date('Y');
                                                         
                                                        if ($model->save()) {
                                                            $jumlahdetail = 0;
                                                            if(isset($_POST['PenggajiandetailT'])){
                                                                foreach ($_POST['PenggajiandetailT'] as $i=>$row)
                                                                {
                                                                    $modPenggajiandetail = new PenggajiandetailT;
                                                                    $modPenggajiandetail->karykomponen_id = $row['karykomponen_id'];
                                                                    $modPenggajiandetail->penggajian_id = $model->penggajian_id;
                                                                    $modPenggajiandetail->jumlah = Params::formatNumberForDB($row['jumlah']);
                                                                    if ($modPenggajiandetail->save()) {
                                                                        $jumlahdetail++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        $penggajian = isset($_POST['PenggajiandetailT']) ? $_POST['PenggajiandetailT'] : null;
                                                        if ($jumlahdetail == COUNT($penggajian))
                                                        {
                                                            $transaction->commit();
                                                            $this->redirect(array('admin'));
                                                        }    
                                                    } else if (isset($_POST['bayar'])) {
                                                        $model->attributes=$_POST['KPenggajianT'];
                                                        $model->bulan = date('m');
                                                        $model->tahun = date('Y');
                                                        $model->pengeluarankas_id = $modPengeluarankas->pengeluarankas_id;
                                                        if ($model->save()) {
                                                            $jumlahdetail = 0;
                                                            $idpenggajian = $model->penggajian_id;
                                                            $modPengeluarankas = new PengeluarankasT;
                                                            $modPengeluarankas->jenispengeluaran_id = $_POST['KPenggajianT']['jenispengeluaran_id'];
                                                            $modPengeluarankas->penggajian_id = $model->penggajian_id;
                                                            $modPengeluarankas->tglpengeluaran = date('Y-m-d');
                                                            $modPengeluarankas->nopengeluaran = $nomor;
                                                            $modPengeluarankas->untukkeperluan = 'Gaji karyawan';
                                                            $modPengeluarankas->namapenerima = $model->karyawan->nama_karyawan;
                                                            $modPengeluarankas->keterangan = $model->keterangan;
                                                            $modPengeluarankas->jmlkeluar = $model->penerimaanbersih;
                                                            $modPengeluarankas->pegpengeluran = $_POST['KPenggajianT']['pegpengeluran'];
                                                            $modPengeluarankas->pegmengetahui = $model->mengetahui;
                                                            if ($modPengeluarankas->save()) {
                                                                $modelsave = PenggajianT::model()->findByPK($idpenggajian);
                                                                $modelsave->pengeluarankas_id = $modPengeluarankas->pengeluarankas_id;
                                                                $modelsave->save();
                                                            }
                                                            foreach ($_POST['PenggajiandetailT'] as $i=>$row)
                                                            {
//                                                                echo nl2br(print_r($_POST['PenggajiandetailT'],1));
                                                                $modPenggajiandetail = new PenggajiandetailT;
                                                                $modPenggajiandetail->karykomponen_id = $row[karykomponen_id];
                                                                $modPenggajiandetail->penggajian_id = $model->penggajian_id;
                                                                $modPenggajiandetail->jumlah = $row[jumlah];
                                                                if ($modPenggajiandetail->save()) {
                                                                    $jumlahdetail++;
                                                                }
                                                            }
                                                        }
                                                        if ($jumlahdetail == COUNT($_POST['PenggajiandetailT']))
                                                        {
                                                            $transaction->commit();
                                                            $this->redirect(array('admin'));
                                                        }
                                                    }

                                                }
                                                catch (Exception $ex) {
                                                    $transaction->rollback();
                                                    Yii::app()->user->setFlash('error','<strong>Gagal</strong> Data gagal disimpan. '.$ex->getMessage());
                                                }
//				$this->redirect(array('view','id'=>$model->penggajian_id));
		}

		$this->render('create',array(
			'model'=>$model,
                                                'modPenggajiandetail'=>$modPenggajiandetail,
                                                'modPengeluarankas'=>$modPengeluarankas,
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

		if(isset($_POST['PenggajianT']))
		{
			$model->attributes=$_POST['PenggajianT'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->penggajian_id));
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
		$dataProvider=new CActiveDataProvider('PenggajianT');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KPenggajianT('search');
		$model->unsetAttributes();  // clear any default values
                                $model->tglAwal = date('Y-m-d 00:00:00');
                                $model->tglAkhir = date('Y-m-d H:i:s');
		if(isset($_GET['KPenggajianT'])) {
                                                $format = new CustomFormat();
                                                $model->tglAwal  = $format->formatDateTimeMediumForDB($_REQUEST['KPenggajianT']['tglAwal']);
                                                $model->tglAkhir = $format->formatDateTimeMediumForDB($_REQUEST['KPenggajianT']['tglAkhir']);
			$model->attributes=$_GET['KPenggajianT'];
                                }
		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
                public function actionBayar($id)
                {
                    $this->layout = '//layouts/polos';
                    $model = PenggajianT::model()->findByPK($id);
                    $modPengeluarankas = new KPengeluarankasT;
                    $model->tglpenggajian = date('Y-m-d');
                    $modPengeluarankas->pegmengetahui = KaryawanM::model()->findByPk(Params::KARYAWAN_ID)->nama_karyawan;
                    $pegawai = LoginpemakaiK::model()->findByPk(Yii::app()->user->id);
                    $modPengeluarankas->pegpengeluran = isset($pegawai->karyawan_id) ? $pegawai->karyawan->nama_karyawan : "";
//                    $modPengeluarankas->pegpengeluran = LoginpemakaiK::model()->findByPk(Yii::app()->user->id)->karyawan->nama_karyawan;
                    $modPengeluarankas->jenispengeluaran_id = Params::JENIS_PENGELUARAN_ID;
//                    
                    $this->render('_pembayaran',array('model'=>$model,'modPengeluarankas'=>$modPengeluarankas));
                    if (isset($_POST['KPengeluarankasT']))
                    {
                        $modPengeluarankas->attributes = $_POST['KPengeluarankasT'];
                        if ($modPengeluarankas->save()) {
                            
                            $model->pengeluarankas_id = $modPengeluarankas->pengeluarankas_id;
                            $model->save();
                            $url = Yii::app()->createUrl($this->module->id.'/'.$this->id.'/admin');
                            $jsReload = '<script>$(document).ready(function(){window.top.location.href = "'.$url.'";});</script>';
                            echo $jsReload;
                            Yii::app()->end();
//                            $this->redirect(array('admin'));
                        }
                    }
                }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=PenggajianT::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='penggajian-t-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
                
                
                public function actionPrint()
                {
                    
                     $model=new KPenggajianT('searchTabel');
                    $model->unsetAttributes();
            //        $model->tglpengambilan = date($model->tglpengambilan);
            //        $model->tglAkhir = date($model->tglAkhir);
                if (isset($_GET['KPenggajianT']))
                    $model->attributes = $_GET['KPenggajianT'];
                    $judulLaporan='Laporan Data Penggajian';
                    $caraPrint=$_REQUEST['caraPrint'];
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
                        $styletable = file_get_contents(Yii::getPathOfAlias('webroot.css.core') . '/table.css');
                        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css'). '/mws.style.css');  
                        $mpdf->writeHtml($styletable,1);
                        $mpdf->WriteHTML($stylesheet,1);
                        $mpdf->AddPage($posisi,'','','','',15,15,15,15,15,15);
                        $mpdf->WriteHTML($this->renderPartial('Print',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint),true));
                        $mpdf->Output();
                    }                       
                }
                
                public function actionPrintrincian($id)
                {
                    $model = $this->loadModel($id);
                    if(isset($_REQUEST['PenggajianT'])){
                        $model->attributes=$_REQUEST['PenggajianT'];
                    }
                    $judulLaporan='Laporan Rincian Gaji';
                    $caraPrint=$_REQUEST['caraPrint'];
                    $data = '';
                    if($caraPrint=='PRINT') {
                        $this->layout='//layouts/printWindows';
                        $this->render('Printrincian',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
                    }
                    else if($caraPrint=='EXCEL') {
                        $this->layout='//layouts/printExcel';
                        $this->render('Printrincian',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
                    }
                    else if($_REQUEST['caraPrint']=='PDF') {
                        $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
                        $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
                        $mpdf = new MyPDF('',$ukuranKertasPDF);
                        $styletable = file_get_contents(Yii::getPathOfAlias('webroot.css.core') . '/table.css');
                        $styleform = file_get_contents(Yii::getPathOfAlias('webroot.css.core') . '/form.css');
                        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css'). '/mws.style.css');
                        $mpdf->useOddEven = 2;  
                        $mpdf->writeHtml($styletable,1);
                        $mpdf->WriteHTML($stylesheet,1);
                        $mpdf->WriteHTML($styleform,1);
                        
                        $mpdf->AddPage($posisi,'','','','',15,15,15,15,15,15);
                        $mpdf->WriteHTML($this->renderPartial('Printrincian',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint),true));
                        $mpdf->Output();
                    }                       
                }
                
                public function actionPrintpenggajian()
                {
                    $model= new PenggajianT;
                    $model->attributes=$_REQUEST['PenggajianT'];
                    $judulLaporan='Data Penggajian';
                    $caraPrint=$_REQUEST['caraPrint'];
                    if($caraPrint=='PRINT') {
                        $this->layout='//layouts/printWindows';
                        $this->render('_form',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
                    }                 
                }
}

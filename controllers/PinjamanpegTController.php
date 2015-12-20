<?php

class PinjamanpegTController extends Controller {

    public $accordionIndx = Params::ACCORDION_PEGAWAI;

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        if(!Yii::app()->user->checkAccess(Yii::app()->controller->action->id)){throw new CHttpException(401,Yii::t('mds','You are prohibited to access this page. Contact Super Administrator'));}
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'print', 'details', 'bayar','PrintDetails','bayarkan'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionDetails($id) {
        $this->layout = '//layouts/polos';
        $model = PinjamanpegT::model()->findByPk($id);
        $modDetails = new PinjampegdetT('search');
        $modDetails->pinjamanpeg_id = $model->pinjamanpeg_id;
        $this->render('details', array('modDetails' => $modDetails, 'model' => $model));
    }

    public function actionBayar($id) {
        $this->layout = 'form';
        $modDetails = PinjampegdetT::model()->findAll("pinjamanpeg_id = '$id' AND penerimaankas_id is null LIMIT 1");
        
//        echo print_r($modDetails)
        if ((count($modDetails) == 1) && (empty($modDetails[0]->penerimaankas_id))) {
            $model = new PenerimaankasT;
//            $model->penerimaankas_id;
            $pegawai = LoginpemakaiK::model()->findByPk(Yii::app()->user->id);
            $model->peg_penerima = isset($pegawai->karyawan_id) ? $pegawai->karyawan->nama_karyawan : "";
//            $model->peg_penerima = LoginpemakaiK::model()->findByPk(Yii::app()->user->id)->karyawan->nama_karyawan;
            $model->pinjampegdet_id = $modDetails[0]->pinjampegdet_id;
            $model->tglpenerimaan = date('Y-m-d H:i:s');
            $model->nostruk = Params::noBayarCicilan();
            $model->jmlbayar = $modDetails[0]->jmlcicilan;

            $model->uangditerima = 0;
            $model->uangkembalian = 0;
            
            if (isset($_POST["PenerimaankasT"])) {
                $model->attributes = $_POST['PenerimaankasT'];
//
//                echo '<pre>';
//                echo print_r($model->attributes);
//                
//                exit();
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', '<strong>Berhasil!</strong> Data berhasil disimpan.');
                        $modPinjam = PinjamanpegT::model()->findByPk($id);
                        $modPinjam->sisapinjaman -= $model->jmlbayar;
                        $modPinjam->save();
//                        $url = Yii::app()->createUrl($this->module->id.'/'.$this->id.'/admin');
//                        $jsReload = '<script>$(document).ready(function(){window.top.location.href = "'.$url.'";});</script>';
//                        echo $jsReload;
                        $modDetails[0]->penerimaankas_id = $model->penerimaankas_id;
                        $modDetails[0]->isbayar = true;
                        
                        if ($modDetails[0]->save()) {
                            $url = Yii::app()->createUrl($this->module->id.'/'.$this->id.'/admin');
                            $jsReload = '<script>window.top.location.href = "'.$url.'";</script>';
                            echo $jsReload;
                            Yii::app()->end();
//                            $this->refresh(true, '#');
//                            '<script>
//                            js:function(){$.fn.yiiGridView.update("pinjamanpeg-t-grid")}
//                            </script>';
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Data gagal disimpan ");
                }
            }
            $this->render('_bayar', array('model'=>$model, 'modDetails'=>$modDetails));
        } else {
            $model = PenerimaankasT::model()->findByPk($modDetails->penerimaankas_id);
        }
//        $this->render('_bayar', array('model'=>$model, 'modDetails'=>$modDetails));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id=null) {
        $model = new PinjamanpegT;
        $modDetails = new PinjampegdetT;
        $modPengeluarankas = new PengeluarankasT;
        $model->sisapinjaman = $model->jumlahpinjaman;
        $model->tglpinjampeg = date('Y-m-d H:i:s');
        $model->pengeluarankas_id = '0';
        $pegawai = LoginpemakaiK::model()->findByPk(Yii::app()->user->id);
        $model->pegpengeluran = isset($pegawai->karyawan_id) ? $pegawai->karyawan->nama_karyawan : "";
        $model->persenpinjaman = '0';
//        echo $model->pegpengeluran;exit();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (!empty($id)) {
            $model = PinjamanpegT::model()->find('pinjamanpeg_id = ' . $id . '');
            $modDetails = PinjampegdetT::model()->findAll('pinjamanpeg_id = ' . $model->pinjamanpeg_id . ' ');
           
            }
            
        if (isset($_POST['PinjamanpegT'])) {
//            echo "<pre>".
//            print_r($_POST['PinjamanpegT']);
//            print_r($_POST['PinjampegdetT']);
//            print_r($_POST['PengeluarankasT']);
//            exit();
            $model->attributes = $_POST['PinjamanpegT']; // sesuaikan dengan attribute
            if (count($_POST['PinjampegdetT']) > 0) { // jika detail ada
                $modDetails = $this->validasiTabular($model, $_POST['PinjampegdetT']);
                if ($model->validate()) { // jika validasi data PinjamanpegT benar
                    $transaction = Yii::app()->db->beginTransaction(); // memulai transaksi
                    try {
                        $success = true;
                        if ($model->save()) { // jika model data PinjamanpegT dismpan
                            $modDetails = $this->validasiTabular($model, $_POST['PinjampegdetT']);
                            if (isset($_POST['bayar'])) {
                                $modPengeluarankas->jenispengeluaran_id = $_POST['PinjamanpegT']['jenispengeluaran_id'];
                                $modPengeluarankas->pinjamanpeg_id = $model->pinjamanpeg_id;
                                $modPengeluarankas->tglpengeluaran = date('Y-m-d H:i:s');
                                $modPengeluarankas->nopengeluaran = Params::noPengeluaran();
                                $modPengeluarankas->untukkeperluan = $model->untukkeperluan;
                                $modPengeluarankas->namapenerima = $model->karyawan->nama_karyawan;
                                $modPengeluarankas->keterangan = $model->keterangan;
                                $modPengeluarankas->jmlkeluar = $model->jumlahpinjaman;
                                $modPengeluarankas->pegpengeluran = $_POST['PinjamanpegT']['pegpengeluran'];
                                if ($modPengeluarankas->save()) {
                                    $model->pengeluarankas_id = $modPengeluarankas->pengeluarankas_id;
                                    $model->save();
                                }
                            }
                            
                            foreach ($modDetails as $i => $data) { // simpan detail ke PinjampegdetT
                                if ($data->jmlcicilan > 0) {
                                    if ($data->save()) {
                                        
                                    } else {
                                        $success = false; // jika tidak disimpan set variabel $success=false
                                    }
                                }
                            }
                        } else { // jika model data PinjamanpegT tidak disimpan
                            $success = false;
                        }
                        if ($success == true) { // jika kondisi variabel $success=TRUE
                            $transaction->commit();
                            Yii::app()->user->setFlash('success', '<strong>Berhasil!</strong> Data berhasil disimpan.');
                            $this->redirect(array('bayarkan', 'id' => $model->pinjamanpeg_id));
                        } else { // jika variabel $success=FALSE rollback transaksi
                            $transaction->rollback();
                            Yii::app()->user->setFlash('error', "Data gagal disimpan ");
                        }
                    } catch (Exception $ex) { // jika mendapat error rollback transaksi
                        $transaction->rollback();
                        Yii::app()->user->setFlash('error', "Data gagal disimpan " . $ex->getMessage());
                    }
                }
            } else { // jika tidak ada data PinjampegT
                Yii::app()->user->setFlash('error', '<strong>Gagal!</strong> Data detail barang harus diisi.');
            }
        }

        $this->render('create', array(
            'model' => $model, 'modDetails' => $modDetails,
        ));
    }
    public function actionBayarkan($id=null){
         
        $modPengeluarankas = new PengeluarankasT;
        $model = new PinjamanpegT;
        $model->pinjamanpeg_id = $modPengeluarankas->pinjamanpeg_id;
        $model->pengeluarankas_id = $modPengeluarankas->pengeluarankas_id;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (!empty($id)) {
            $model = PinjamanpegT::model()->findByPk($id);
            $modDetails = PinjampegdetT::model()->findAll('pinjamanpeg_id = ' . $model->pinjamanpeg_id . ' ');
            //$model->karyawan_id = $model->karyawan->nama_karyawan;
            }
       if(isset($_POST['bayar']))
       {
            $modPengeluarankas->jenispengeluaran_id = $_POST['PinjamanpegT']['jenispengeluaran_id'];
            $modPengeluarankas->pinjamanpeg_id = $model->pinjamanpeg_id;
            $modPengeluarankas->tglpengeluaran = date('Y-m-d H:i:s');
            $modPengeluarankas->nopengeluaran = Params::noPengeluaran();
            $modPengeluarankas->untukkeperluan = $model->untukkeperluan;
            $modPengeluarankas->namapenerima = $model->karyawan->nama_karyawan;
            $modPengeluarankas->keterangan = $model->keterangan;
            $modPengeluarankas->jmlkeluar = $model->jumlahpinjaman;
            $modPengeluarankas->pegpengeluran = $_POST["pegpengeluaran"];
            if ($modPengeluarankas->save()) {
//                $model->pengeluarankas_id = $modPengeluarankas->pengeluarankas_id;
//                $model->save();
                PinjamanpegT::model()->updateByPk($id, array('pengeluarankas_id'=>$modPengeluarankas->pengeluarankas_id));
                $this->redirect(array('admin', 'id' => $model->pinjamanpeg_id));
            }
       }
       
        $this->render('bayarkan', array(
            'model' => $model, 'modDetails' => $modDetails, 'modPengeluarankas'=>$modPengeluarankas,
        ));
        
    }
    protected function validasiTabular($model, $data) {
        foreach ($data as $i => $row) {
            $modDetails[$i] = new PinjampegdetT();
            $modDetails[$i]->attributes = $row;
            $modDetails[$i]->pinjamanpeg_id = $model->pinjamanpeg_id;
            $modDetails[$i]->validate();
//            echo print_r($modDetails[$i]->attributes);
//            exit();
        }

        return $modDetails;
    }

    protected function validasiTabular2($model, $data) {
        foreach ($data as $i => $row) {
            $modDetails[$i] = PinjampegdetT::model()->findByPk($row['pinjampegdet_id']);
            $modDetails[$i]->attributes = $row;
            $modDetails[$i]->pinjamanpeg_id = $model->pinjamanpeg_id;
            // $modDetails[$i]->validate();
//            echo print_r($modDetails[$i]->attributes);
//            exit();
        }

        return $modDetails;
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
//		$model=$this->loadModel($id);
        if (!empty($id)) {
            $model = PinjamanpegT::model()->find('pinjamanpeg_id = ' . $id);
            $modDetails = PinjampegdetT::model()->findAll('pinjamanpeg_id = ' . $model->pinjamanpeg_id);
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PinjamanpegT'])) {
            $model->attributes = $_POST['PinjamanpegT'];
            if (count($_POST['PinjampegdetT']) > 0) {
                $modDetails = $this->validasiTabular2($model, $_POST['PinjampegdetT']);
                if ($model->validate()) {
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                        $success = true;
                        if ($model->save()) {
                            $modDetails = $this->validasiTabular2($model, $_POST['PinjampegdetT']);
                            foreach ($modDetails as $i => $data) {
                                if ($data->jmlcicilan > 0) {
                                    if ($data->save()) {
                                        
                                    } else {
                                        $success = false;
                                    }
                                }
                            }
                        } else {
                            $success = false;
                        }
                        if ($success == true) {
                            $transaction->commit();
                            Yii::app()->user->setFlash('success', '<strong>Berhasil!</strong> Data berhasil disimpan.');
                            $this->redirect(array('admin', 'id' => $model->pinjamanpeg_id));
                        } else {
                            $transaction->rollback();
                            Yii::app()->user->setFlash('error', "Data gagal disimpan ");
                        }
                    } catch (Exception $ex) {
                        $transaction->rollback();
                        Yii::app()->user->setFlash('error', "Data gagal disimpan " . $ex->getMessage());
                    }
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Gagal!</strong> Data detail barang harus diisi.');
            }
        }

        $this->render('update', array(
            'model' => $model, 'modDetails' => $modDetails,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('PinjamanpegT');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new PinjamanpegT('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PinjamanpegT']))
            $model->attributes = $_GET['PinjamanpegT'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = PinjamanpegT::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pinjamanpeg-t-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPrint() {
        $model = new PinjamanpegT;
        $model->unsetAttributes();
        $model->attributes = $_REQUEST['PinjamanpegT'];
        $judulLaporan = 'Laporan Pinjaman Pegawai';
        $caraPrint = $_REQUEST['caraPrint'];
        if ($caraPrint == 'PRINT') {
            $this->layout = '//layouts/printWindows';
            $this->render('Print', array('model' => $model, 'judulLaporan' => $judulLaporan, 'caraPrint' => $caraPrint));
        } else if ($caraPrint == 'EXCEL') {
            $this->layout = '//layouts/printExcel';
            $this->render('Print', array('model' => $model, 'judulLaporan' => $judulLaporan, 'caraPrint' => $caraPrint));
        } else if ($_REQUEST['caraPrint'] == 'PDF') {
            $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
            $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
            $mpdf = new MyPDF('', $ukuranKertasPDF);
            $mpdf->useOddEven = 2;
            $mpdf->WriteHTML($stylesheet, 1);
            $mpdf->AddPage($posisi, '', '', '', '', 15, 15, 15, 15, 15, 15);
            $mpdf->WriteHTML($this->renderPartial('Print', array('model' => $model, 'judulLaporan' => $judulLaporan, 'caraPrint' => $caraPrint), true));
            $mpdf->Output();
        }
    }
    
    public function actionPrintDetails($id) {
        $model = PinjamanpegT::model()->findByPk($id);
        $modDetails = new PinjampegdetT('search');
        $modDetails->pinjamanpeg_id = $model->pinjamanpeg_id;
        $judulLaporan = 'Detail Pinjaman Pegawai';
        $caraPrint = $_REQUEST['caraPrint'];
        if ($caraPrint == 'PRINT') {
            $this->layout = '//layouts/printWindows';
            $this->render('PrintDetails', array('model' => $model, 'modDetails'=>$modDetails, 'judulLaporan' => $judulLaporan, 'caraPrint' => $caraPrint));
        } else if ($caraPrint == 'EXCEL') {
            $this->layout = '//layouts/printExcel';
            $this->render('PrintDetails', array('model' => $model, 'modDetails'=>$modDetails, 'judulLaporan' => $judulLaporan, 'caraPrint' => $caraPrint));
        } else if ($_REQUEST['caraPrint'] == 'PDF') {
            $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
            $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
            $mpdf = new MyPDF('', $ukuranKertasPDF);
            $mpdf->useOddEven = 2;
            $mpdf->WriteHTML($stylesheet, 1);
            $mpdf->AddPage($posisi, '', '', '', '', 15, 15, 15, 15, 15, 15);
            $mpdf->WriteHTML($this->renderPartial('PrintDetails', array('model' => $model, 'modDetails'=>$modDetails , 'judulLaporan' => $judulLaporan, 'caraPrint' => $caraPrint), true));
            $mpdf->Output();
        }
    }

}

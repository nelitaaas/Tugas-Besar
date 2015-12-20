<?php

class KepegawaianModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'kepegawaian.models.*',
			'kepegawaian.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
                    if(Yii::app()->user->isGuest) {
                        CController::redirect('index.php?r=login');
                    }
                    if (!in_array($this->name, ModuluserK::modulUser(Yii::app()->user->id))){
                        throw new CHttpException(401,Yii::t('mds','You are prohibited to access this page. Contact Super Administrator'));
                    }
                    return true;
		}
		else
			return false;
	}
}

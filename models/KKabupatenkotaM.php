<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KKabupatenkotaM extends KabupatenkotaM{

    public static function model($className=__CLASS__)
     {
                return parent::model($className);
     }
     /**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'propinsi'=>array(self::BELONGS_TO, 'PropinsiM', 'propinsi_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'kabupatenkota_id' => 'ID Kab / Kota',
			'kabupatenkota_nama' => 'Kota / Kab',
			'kabupatenkota_aktif' => 'Aktif',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('kabupatenkota_id',$this->kabupatenkota_id);
		$criteria->compare('kabupatenkota_nama',$this->kabupatenkota_nama,true);
		$criteria->compare('kabupatenkota_aktif',$this->kabupatenkota_aktif);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
         public function getPropinsiItems()
        {
            return PropinsiM::model()->findAllByAttributes(array('propinsi_aktif'=>true),array('order'=>'propinsi_nama'));
        }
        
        /**
         * Mengambil daftar semua kabupaten berdasarkan propinsi
         * @return CActiveDataProvider 
         */
        public function getKabupatenItems($propinsi_id=null)
        {
            if(!empty($propinsi_id))
                return KabupatenkotaM::model()->findAllByAttributes(array('propinsi_id'=>$propinsi_id,'kabupatenkota_aktif'=>true),array('order'=>'kabupatenkota_nama'));
            else {
                return array();
            }
        }

}

?>

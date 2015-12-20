<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KPropinsiM extends PropinsiM{

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
                    'pendidikankaryawan'=>array(self::BELONGS_TO, 'PendidikankaryawanR', 'pendidikankaryawan_id'),
                    'kabupatenkota'=>array(self::BELONGS_TO, 'KabupatenkotaM', 'kabupatenkota_id'),
                    'pelamar'=>array(self::BELONGS_TO, 'PelamarT', 'pelamar_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'propinsi_id' => 'ID Propinsi',
			'propinsi_nama' => 'Propinsi',
			'propinsi_aktif' => 'Aktif',
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

		$criteria->compare('propinsi_id',$this->propinsi_id);
		$criteria->compare('LOWER(propinsi_nama)',strtolower($this->propinsi_nama),true);
		$criteria->compare('propinsi_aktif',$this->propinsi_aktif);

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

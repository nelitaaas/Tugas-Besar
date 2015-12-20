<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KKomponengajiM extends KomponengajiM{

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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'komponengaji_id' => 'ID ',
			'komponengaji_kode' => 'Kode ',
			'komponengaji_nama' => 'Nama',
			'komponengaji_singkt' => 'Nama Singkat',
			'isgaji' => 'Gaji',
			'ispotongan' => 'Potongan',
			'nourut' => 'Nomor Urut',
			'komponengaji_aktif' => 'Aktif',
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

		$criteria->compare('komponengaji_id',$this->komponengaji_id);
		$criteria->compare('LOWER(komponengaji_kode)',  strtolower($this->komponengaji_kode),true);
		$criteria->compare('LOWER(komponengaji_nama)',  strtolower($this->komponengaji_nama),true);
		$criteria->compare('komponengaji_singkt',$this->komponengaji_singkt,true);
		$criteria->compare('isgaji',$this->isgaji);
		$criteria->compare('ispotongan',$this->ispotongan);
		$criteria->compare('nourut',$this->nourut);
		$criteria->compare('komponengaji_aktif',$this->komponengaji_aktif);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchPrint()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('komponengaji_id',$this->komponengaji_id);
		$criteria->compare('komponengaji_kode',$this->komponengaji_kode,true);
		$criteria->compare('komponengaji_nama',$this->komponengaji_nama,true);
		$criteria->compare('komponengaji_singkt',$this->komponengaji_singkt,true);
		$criteria->compare('isgaji',$this->isgaji);
		$criteria->compare('ispotongan',$this->ispotongan);
		$criteria->compare('nourut',$this->nourut);
		$criteria->compare('komponengaji_aktif',$this->komponengaji_aktif);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false
		));
	}

}

?>

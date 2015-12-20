<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KSuratperingatanR extends SuratperingatanR{

    public static function model($className=__CLASS__)
     {
                return parent::model($className);
     }
     
     public function relations(){
         
         return array(
             'jenissurat'=>array(self::BELONGS_TO, 'JenissuratM', 'jenissurat_id'),
             'suratelektronik'=>array(self::BELONGS_TO, 'SuratelektronikR', 'suratelektronik_id'),
             'karyawan'=>array(self::BELONGS_TO, 'KaryawanM', 'karyawan_id'),
         );
     }
     public function attributeLabels()
	{
		return array(
			'suratperingatan_id' => 'Surat Peringatan',
			'karyawan_id' => 'Karyawan',
			'jenisperingatan_id' => 'Jenis Peringatan',
			'tglsuratperingatan' => 'Tgl Surat Peringatan',
			'nosuratperingatan' => 'No Surat Peringatan',
			'masaberlaku' => 'Masa Berlaku',
			'isisuratperingatan' => 'Isi Surat Peringatan',
			'keterangan_peringatan' => 'Keterangan Peringatan',
                        'jenissurat_id' => 'ID Jenis Surat',
                        'jenissurat_nama' => 'Nama Jenis Surat',
                        'mengetahui' => 'Mengetahui',
                        'jenissurat_judul'=>'Perihal',
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

		$criteria->compare('suratperingatan_id',$this->suratperingatan_id);
		$criteria->compare('karyawan_id',$this->karyawan_id);
		$criteria->compare('jenisperingatan_id',$this->jenisperingatan_id);
		$criteria->compare('tglsuratperingatan',$this->tglsuratperingatan,true);
		$criteria->compare('nosuratperingatan',$this->nosuratperingatan,true);
		$criteria->compare('masaberlaku',$this->masaberlaku,true);
		$criteria->compare('isisuratperingatan',$this->isisuratperingatan,true);
		$criteria->compare('keterangan_peringatan',$this->keterangan_peringatan,true);
                $criteria->compare('jenissurat_id', $this->jenissurat_id);
                $criteria->compare('jenissurat_nama', $this->jenissurat_nama);
                $criteria->compare('mengetahui', $this->mengetahui);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
            public function beforeSave(){
                $format = new CustomFormat();
                //$this->tglrevisimodul = $format->formatDateMediumForDB($this->tglrevisimodul);
                foreach($this->metadata->tableSchema->columns as $columnName => $column){
                        if ($column->dbType == 'date' && (!empty($this->columnName))){
                                $this->$columnName = $format->formatDateForDb($this->$columnName);
                        }elseif ($column->dbType == 'timestamp without time zone' && (!empty($this->$columnName))){

                                $this->$columnName = $format->formatDateTimeforDb($this->$columnName);
                                                     // print_r($this->$columnName);exit();
                        }
                }

                return parent::beforeSave();
            }

}

?>
